<?php

namespace App\Http\Controllers;

use App\Models\ProformaInvoice;
use App\Http\Requests\StoreProformaInvoiceRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Company;
use App\Models\Order;
use PDF;
use Illuminate\Support\Facades\Auth;

class ProformaInvoiceController extends Controller
{
    public function index()
    {
        $proforma_invoice = ProformaInvoice::with('client')->latest()->get();
        return view('proforma_invoices.index', compact('proforma_invoice'));
    }

    public function create()
    {
        $clients = Client::all();
        $companies = Company::all();
        return view('proforma_invoices.create', compact('clients', 'companies'));
    }

    public function show(ProformaInvoice $proforma_invoice)
    {  
        return view('proforma_invoices.show', compact('proforma_invoice'));
    }

    public function store(StoreProformaInvoiceRequest $request)
    {
        $validatedData = $request->all();

        //dd($validatedData);
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['proforma_invoice_date'] = now();
        $proforma_invoice = ProformaInvoice::create($validatedData);

       
        $proformaInvoiceList = $proforma_invoice->proformaInvoiceList()->create([
            'product_name' => $request->designation,
            'quantity' => $request->quantity,
            'unit_price' => $request->amount,
            'total_price' => ($request->amount * $request->quantity),
        ]);
         
        return redirect()->route('proforma_invoices.index')
            ->with('success', 'la facture proforma a été créée avec succès.');
    }

    public function edit(ProformaInvoice $proforma_invoice)
    {
        $clients = Client::all();
        $companies = Company::all();
        return view('proforma_invoices.edit', compact('proforma_invoice', 'clients','companies'));
    }

    public function update(Request $request, ProformaInvoice $proforma_invoice)
    {
        $request->validate([
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'amount' => ['required', 'numeric'],
            'company_id' => 'required|exists:companies,id',
        ]);

        $proforma_invoice->update(attributes: $request->all());

        

        return redirect()->route('proforma_invoices.index')
            ->with('success', 'l\'article ou le service a été mise à jour avec succès.');
    }

    public function destroy(ProformaInvoice $proforma_invoice)
    {
        $proforma_invoice->delete();

        return redirect()->route('proforma_invoices.index')
            ->with('success', 'l\'article ou le service a été supprimée avec succès.');
    }
    public function generatePDF(ProformaInvoice $proforma_invoice)
    {    
        // $proforma_invoice->load('proforma_invoice.proformaInvoiceList', ' proforma_invoice.client', ' proforma_invoice.entreprise');
        $proforma_invoice->load('proformaInvoiceList', 'client', 'entreprise');
        $companies = [
            ['name' => 'Son light IMPRIMERIE'],
            ['name' => 'DEALER GROUP'],
            ['name' => 'BUFI TECHNOLOGIE'],
            ['name' => 'NOVA TECH'],
            ['name' => 'AFRO BUSINESS GROUP'],
            ['name' => 'SOCIETE ANONYME'],
        ];

        // CREATION DES PROFORMA A PARTIR DES COMPANY_KEY EN UTILISANT SWICH EN GENERA PDF POUR CHAQUE COMPANY
        switch ($proforma_invoice->entreprise->id) {
            case 1:
                $pdf = PDF::loadView('proforma_invoices.pdf', compact('proforma_invoice'));
                break;
            case 2:
                $pdf = PDF::loadView('proforma_invoices.pdf_Dealer_Group', compact('proforma_invoice'));
                break;
            case 3:
                $pdf = PDF::loadView('proforma_invoices.pdf_bufi', compact('proforma_invoice'));
                break;
            case 4:
                $pdf = PDF::loadView('proforma_invoices.pdf_nova', compact('proforma_invoice'));
                break;
            case 5:
                $pdf = PDF::loadView('proforma_invoices.pdf_afro', compact('proforma_invoice'));
                break;
            default:
                $pdf = PDF::loadView('proforma_invoices.pdf', compact('proforma_invoice'));
        }



        // $pdf = PDF::loadView('proformas.pdf', compact('proforma'));

        return $pdf->download('facture_proforma_' . '.pdf');
    }
}
