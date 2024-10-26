<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('order')->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create(Order $order)
    {

        $number = 'INV-' . date("Y-m-d h:i:sa") . '';
        return view('invoices.create', compact('order', 'number'));
    }

    public function store(Request $request)
    {
        $order = Order::find($request->order_id);
        $validatedData = $request->validate([
            'number' => 'required|unique:invoices',
            'date' => 'required|date',
            'due_date' => 'required|date|after:date',
        ]);

        $invoice = new Invoice($validatedData);
        $invoice->order_id = $order->id;
        $invoice->status = 'unpaid';
        $invoice->save();

        $order->status = 'invoiced';
        $order->save();

        return redirect()->route('invoices.show', $invoice)->with('success', 'Facture créée avec succès.');
    }
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')
            ->with('success', 'la facture a ete supprimée avec succès.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('order.detailOrders', 'order.client', 'order.entreprise');
        return view('invoices.show', compact('invoice'));
    }
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([    
            'number' => 'required',
            'date' => 'required|date',
            'due_date' => 'required|date|after:date',
        ]);
        $invoice->update($request->all());

        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'La facture a ete mise à jour avec succès.');
    }
    public function generatePDF(Invoice $invoice)
    {    
        $invoice->load('order.detailOrders', 'order.client', 'order.entreprise');
        $companies = [
            ['name' => 'Son light IMPRIMERIE'],
            ['name' => 'DEALER GROUP'],
            ['name' => 'BUFI TECHNOLOGIE'],
            ['name' => 'NOVA TECH'],
            ['name' => 'AFRO BUSINESS GROUP'],
            ['name' => 'SOCIETE ANONYME'],
        ];

        // CREATION DES PROFORMA A PARTIR DES COMPANY_KEY EN UTILISANT SWICH EN GENERA PDF POUR CHAQUE COMPANY
        switch ($invoice->order->entreprise->id) {
            case 1:
                $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
                break;
            case 2:
                $pdf = PDF::loadView('invoices.pdf_Dealer_Group', compact('invoice'));
                break;
            case 3:
                $pdf = PDF::loadView('invoices.pdf_bufi', compact('invoice'));
                break;
            case 4:
                $pdf = PDF::loadView('invoices.pdf_nova', compact('invoice'));
                break;
            case 5:
                $pdf = PDF::loadView('invoices.pdf_afroOrgin', compact('invoice'));
                break;
            default:
                $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        }



        // $pdf = PDF::loadView('proformas.pdf', compact('proforma'));

        return $pdf->download('facture_Commande_' . $invoice->number . '.pdf');
    }
}
