<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('order')->latest()->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create(Order $order) {
        // Récupérer le dernier identifiant de la facture ou utiliser 0 si aucune n'existe
        $lastInvoice = Invoice::latest('id')->first();
        $lastInvoiceId = $lastInvoice ? $lastInvoice->id : 0; // Vérifiez si $lastInvoice est nul

        $number = 'INV-' . str_pad($lastInvoiceId + 1, 4, '0', STR_PAD_LEFT);
        return view('invoices.create', compact('order', 'number'));
    }

    public function store(Request $request)
    {
        try {
            $order = Order::find($request->order_id);
            $validatedData = $request->validate([
                'number' => 'required|unique:invoices',
                'date' => 'nullable|date',
                'due_date' => 'nullable|date|after:date',
            ]);

            $invoice = new Invoice($validatedData);
            $invoice->order_id = $order->id;
            $invoice->status = 'unpaid';
            $invoice->save();

            $order->status = 'invoiced';
            $order->save();

            return redirect()->route('invoices.show', $invoice)->with('success', 'Facture créée avec succès.');

        } catch (Exception $e) {
            // Gestion d'erreur d'application
            return back()->with('error', 'Une erreur s\'est produite lors de la création de la facture : ' . $e->getMessage());
        }
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')
            ->with('success', 'La facture a été supprimée avec succès.');
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
            'date' => 'nullable|date',
            'due_date' => 'nullable|date|after:date',
        ]);
        $invoice->update($request->all());

        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'La facture a été mise à jour avec succès.');
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

        // Création des proformas à partir des keys entreprises en utilisant switch pour générer le PDF pour chaque entreprise
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

        // Téléchargement du PDF
        return $pdf->download('facture_Commande_' . $invoice->number . '.pdf');
    }
}
