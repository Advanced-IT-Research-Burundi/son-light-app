<?php

namespace App\Http\Controllers;

use App\Models\ProformaInvoice;
use App\Models\ProformaInvoiceList;
use Illuminate\Http\Request;

class ProformaInvoiceListController extends Controller
{
    
    public function create(ProformaInvoice $proforma_invoice)
    {
        return view('proforma_invoice_lists.create', compact('proforma_invoice'));
    }

    public function store(Request $request, ProformaInvoice $proforma_invoice)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $totalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        $proformaInvoiceList = $proforma_invoice->proformaInvoiceList()->create([
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'unit_price' => $validatedData['unit_price'],
            'total_price' => $totalPrice,
        ]);

        $proforma_invoice->update(['amount' => $proforma_invoice->amount + $totalPrice]);

        return redirect()->route('proforma_invoices.show', $proforma_invoice)->with('success', 'article ou service a été ajouté à la facture proforma avec succès.');
    }

    public function edit(ProformaInvoice $proforma_invoice, ProformaInvoiceList $proformaInvoiceList)
    {
        return view('proforma_invoice_lists.edit', compact('proforma_invoice', 'proformaInvoiceList'));
    }

    public function update(Request $request, ProformaInvoice $proforma_invoice, ProformaInvoiceList $ProformaInvoiceList)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $oldTotalPrice = $ProformaInvoiceList->total_price;
        $newTotalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        $ProformaInvoiceList->update([
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'unit_price' => $validatedData['unit_price'],
            'total_price' => $newTotalPrice,
        ]);

        $proforma_invoice->update(['amount' => $proforma_invoice->amount - $oldTotalPrice + $newTotalPrice]);

        return redirect()->route('proforma_invoices.show', $proforma_invoice)->with('success', 'Détail de la facture proforma a été  mis à jour avec succès.');
    }

    public function destroy(ProformaInvoice $proforma_invoice, ProformaInvoiceList $proformaInvoiceList)
    {
        $proforma_invoice->update(['amount' => $proforma_invoice->amount - $proformaInvoiceList->total_price]);
        $proformaInvoiceList->delete();

        return redirect()->route('proforma_invoices.show', $proforma_invoice)->with('success', 'L\'article ou service a été supprimé de la facture proforma avec succès.');
    }

}
