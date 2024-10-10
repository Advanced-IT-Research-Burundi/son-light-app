<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Proforma;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('proforma')->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create(Proforma $proforma)
    {

        $number = 'INV-' . date('Y-m-d') . '';
        return view('invoices.create', compact('proforma', 'number'));
    }

    public function store(Request $request)
    {
        $proforma = Proforma::find($request->proforma_id);
        $validatedData = $request->validate([
            'number' => 'required|unique:invoices',
            'date' => 'required|date',
            'due_date' => 'required|date|after:date',
        ]);

        $invoice = new Invoice($validatedData);
        $invoice->proforma_id = $proforma->id;
        $invoice->total_amount = $proforma->total_amount;
        $invoice->status = 'unpaid';
        $invoice->save();

        $proforma->status = 'invoiced';
        $proforma->save();

        return redirect()->route('invoices.show', $invoice)->with('success', 'Facture créée avec succès.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('proforma.order.detailOrders');
        return view('invoices.show', compact('invoice'));
    }

    public function generatePDF(Invoice $invoice)
    {
        $invoice->load('proforma.order.detailOrders', 'proforma.order.client', 'proforma.order.entreprise');

        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));

        return $pdf->download('facture_' . $invoice->number . '.pdf');
    }
}
