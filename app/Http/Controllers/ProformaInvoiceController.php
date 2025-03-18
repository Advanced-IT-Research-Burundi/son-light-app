<?php

namespace App\Http\Controllers;

use App\Models\ProformaInvoice;
use App\Http\Requests\StoreProformaInvoiceRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Company;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProformaInvoiceController extends Controller
{
    public function index()
    {

        $proforma_invoices = ProformaInvoice::with('client', 'entreprise', 'user')
                            ->orderBy('id', 'desc')
                            ->get();

        return view('proforma_invoices.index', compact('proforma_invoices'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        $companies = Company::all();
        return view('proforma_invoices.create', compact('clients', 'companies'));
    }

    public function show(ProformaInvoice $proforma_invoice)
    {
        $order = Order::all();
        return view('proforma_invoices.show', compact('proforma_invoice', 'order'));
    }

    public function store(StoreProformaInvoiceRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();


        $proforma_invoice = ProformaInvoice::create($validatedData);


        $this->createProformaInvoiceList($request, $proforma_invoice);

        return redirect()->route('proforma_invoices.index')
            ->with('success', 'La facture pro forma a été créée avec succès.');
    }

    private function createProformaInvoiceList(Request $request, ProformaInvoice $proforma_invoice)
    {
        $proforma_invoice->proformaInvoiceList()->create([
            'product_name' => $request->designation,
            'quantity' => $request->quantity,
            'unit_price' => $request->amount,
            'total_price' => $request->amount * $request->quantity,
            'price_letter' => $request->price_letter,
            'unit' => $request->unit,
        ]);
    }

    public function edit(ProformaInvoice $proforma_invoice)
    {
        $clients = Client::orderBy('name')->get();
        $companies = Company::all();
        return view('proforma_invoices.edit', compact('proforma_invoice', 'clients', 'companies'));
    }

    public function update(Request $request, ProformaInvoice $proforma_invoice)
    {
        $validatedData = $request->validate($this->updateValidationRules($proforma_invoice));

        $proforma_invoice->update($validatedData);

        return redirect()->route('proforma_invoices.index')
            ->with('success', 'La facture pro forma a été mise à jour avec succès.');
    }

    private function updateValidationRules(ProformaInvoice $proforma_invoice)
    {
        return [
            'client_id' => 'required|integer|exists:clients,id',
            'amount' => 'required|numeric',
            'unit' => 'nullable|string',
            'proforma_invoice_date' => 'nullable|date',
            'invoice_number' => 'nullable|string|unique:proforma_invoices,invoice_number,' . $proforma_invoice->id,
            'price_letter' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    public function addPriceLetter(Request $request, ProformaInvoice $proforma_invoice)
    {
        $request->validate([
            'price_letter' => 'nullable|string',
        ]);

        $proforma_invoice->price_letter = $request->input('price_letter');
        $proforma_invoice->save();

        return redirect()->route('proforma_invoices.show', $proforma_invoice)
            ->with('success', 'Le prix en lettres a été ajouté avec succès.');
    }

    public function destroy(ProformaInvoice $proforma_invoice)
    {

        if ($proforma_invoice->proformaInvoiceList()->count() > 0) {
            return redirect()->route('proforma_invoices.index')
                ->with('error', 'Vous ne pouvez pas supprimer cette facture car elle contient des éléments.');
        }

        $proforma_invoice->delete();

        return redirect()->route('proforma_invoices.index')
            ->with('success', 'La facture pro forma a été supprimée avec succès.');
    }

    public function generatePDF(ProformaInvoice $proforma_invoice)
    {
        $proforma_invoice->load('proformaInvoiceList', 'client', 'entreprise');

        $pdfView = $this->getPDFView($proforma_invoice->entreprise->id);

        $pdf = PDF::loadView($pdfView, compact('proforma_invoice'));
        return $pdf->download('facture_proforma_' . $proforma_invoice->invoice_number . '.pdf');
    }

    private function getPDFView($entrepriseId)
    {
        switch ($entrepriseId) {
            case 2:
                return 'proforma_invoices.pdf_Dealer_Group';
            case 3:
                return 'proforma_invoices.pdf_bufi';
            case 4:
                return 'proforma_invoices.pdf_nova';
            case 5:
                return 'proforma_invoices.pdf_afroOrgin';
            default:
                return 'proforma_invoices.pdf';
        }
    }
}
