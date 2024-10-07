<?php

namespace App\Http\Controllers;

use App\Models\Proforma;
use App\Models\Order;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProformaController extends Controller
{
    public function index()
    {
        $proformas = Proforma::with('order')->get();
        return view('proformas.index', compact('proformas'));
    }

    public function create(Order $order)
    {
        return view('proformas.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'number' => 'required|unique:proformas',
            'date' => 'required|date',
            'validity_period' => 'required|integer|min:1',
        ]);

        $proforma = new Proforma($validatedData);
        $proforma->order_id = $order->id;
        $proforma->total_amount = $order->amount;
        $proforma->status = 'draft';
        $proforma->save();

        return redirect()->route('proformas.show', $proforma)->with('success', 'Facture proforma créée avec succès.');
    }

    public function show(Proforma $proforma)
    {
        $proforma->load('order.detailOrders');
        return view('proformas.show', compact('proforma'));
    }

    public function edit(Proforma $proforma)
    {
        return view('proformas.edit', compact('proforma'));
    }

    public function update(Request $request, Proforma $proforma)
    {
        $validatedData = $request->validate([
            'number' => 'required|unique:proformas,number,' . $proforma->id,
            'date' => 'required|date',
            'validity_period' => 'required|integer|min:1',
            'status' => 'required|in:draft,sent,accepted,rejected',
        ]);

        $proforma->update($validatedData);

        return redirect()->route('proformas.show', $proforma)->with('success', 'Facture proforma mise à jour avec succès.');
    }

    public function destroy(Proforma $proforma)
    {
        $proforma->delete();
        return redirect()->route('proformas.index')->with('success', 'Facture proforma supprimée avec succès.');
    }

    public function generatePDF(Proforma $proforma)
    {
        $proforma->load('order.detailOrders', 'order.client', 'order.entreprise');

        // return view('proformas.pdf',compact('proforma'));
        $pdf = PDF::loadView('proformas.pdf', compact('proforma'));

        return $pdf->download('facture_proforma_' . $proforma->number . '.pdf');
    }
}
