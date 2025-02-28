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
        // Validation des données
        $validatedData = $this->validateRequest($request);

        // Calcul du prix total
        $totalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        // Création de l'élément de la facture pro forma
        $proformaInvoiceList = $proforma_invoice->proformaInvoiceList()->create(array_merge($validatedData, ['total_price' => $totalPrice]));

        // Optionnel : Mettez à jour le montant total de la facture
        //$this->updateProformaInvoiceAmount($proforma_invoice, $totalPrice);

        return redirect()->route('proforma_invoices.show', $proforma_invoice)
                         ->with('success', 'L\'article ou service a été ajouté à la facture pro forma avec succès.');
    }

    public function edit(ProformaInvoice $proforma_invoice, ProformaInvoiceList $proformaInvoiceList)
    {
        return view('proforma_invoice_lists.edit', compact('proforma_invoice', 'proformaInvoiceList'));
    }

    public function update(Request $request, ProformaInvoice $proforma_invoice, ProformaInvoiceList $proformaInvoiceList)
    {
        // Validation des données
        $validatedData = $this->validateRequest($request);

        // Calcul des prix
        $oldTotalPrice = $proformaInvoiceList->total_price;
        $newTotalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        // Mise à jour de l'élément de la facture pro forma
        $proformaInvoiceList->update(array_merge($validatedData, ['total_price' => $newTotalPrice]));

        // Optionnel : Mettez à jour le montant total de la facture
        //$this->updateProformaInvoiceAmount($proforma_invoice, $newTotalPrice - $oldTotalPrice);

        return redirect()->route('proforma_invoices.show', $proforma_invoice)
                         ->with('success', 'Le détail de la facture pro forma a été mis à jour avec succès.');
    }

    public function destroy(ProformaInvoice $proforma_invoice, ProformaInvoiceList $proformaInvoiceList)
    {
        // Optionnel : Mettez à jour le montant total de la facture
        //$this->updateProformaInvoiceAmount($proforma_invoice, -$proformaInvoiceList->total_price);

        $proformaInvoiceList->delete();

        return redirect()->route('proforma_invoices.show', $proforma_invoice)
                         ->with('success', 'L\'article ou service a été supprimé de la facture pro forma avec succès.');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'unit' => 'nullable|string',
        ]);
    }

    // Optionnel : Méthode pour mettre à jour le montant total de la pro forma
    private function updateProformaInvoiceAmount(ProformaInvoice $proforma_invoice, float $amountChange)
    {
        $proforma_invoice->update(['amount' => $proforma_invoice->amount + $amountChange]);
    }
}
