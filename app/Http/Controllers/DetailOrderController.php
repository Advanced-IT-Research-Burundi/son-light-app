<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\ProformaInvoiceList;
use Illuminate\Http\Request;

class DetailOrderController extends Controller
{
    public function create(Order $order)
    {
        $proformaInvoiceList = ProformaInvoiceList::all();
        return view('detail_orders.create', compact('order', 'proformaInvoiceList'));
    }

    public function store(Request $request, Order $order)
    {
        $validatedData = $this->validateDetailOrder($request);

        // Assignation de valeurs par défaut
        $validatedData['pf'] = $validatedData['pf'] ?? 0;
        $validatedData['tc'] = $validatedData['tc'] ?? 0;
        $validatedData['atax'] = $validatedData['atax'] ?? 0;

        // Calculer le prix total
        $totalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        // Créer le détail de la commande
        $order->detailOrders()->create(array_merge($validatedData, ['total_price' => $totalPrice]));

        return redirect()->route('orders.show', $order)->with('success', 'Produit ajouté à la commande avec succès.');
    }

    public function edit(Order $order, DetailOrder $detailOrder)
    {
        return view('detail_orders.edit', compact('order', 'detailOrder'));
    }

    public function update(Request $request, Order $order, DetailOrder $detailOrder)
    {
        $validatedData = $this->validateDetailOrder($request);

        // Assignation de valeurs par défaut
        $validatedData['pf'] = $validatedData['pf'] ?? 0;
        $validatedData['tc'] = $validatedData['tc'] ?? 0;
        $validatedData['atax'] = $validatedData['atax'] ?? 0;

        // Calculer le nouveau prix total
        $newTotalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        // Mettre à jour le détail de la commande
        $detailOrder->update(array_merge($validatedData, ['total_price' => $newTotalPrice]));

        return redirect()->route('orders.show', $order)->with('success', 'Détail de la commande mis à jour avec succès.');
    }

    public function destroy(Order $order, DetailOrder $detailOrder)
    {
        $detailOrder->delete();
        return redirect()->route('orders.show', $detailOrder->order_id)->with('success', 'Produit supprimé de la commande avec succès.');
    }

    public function addselect(Request $request, Order $order)
    {
        $request->validate([
            'select' => 'required|array',
            'order_id' => 'required|exists:orders,id',
        ]);

        foreach ($request->select as $value) {
            $detailOrder = json_decode($value);

            // Assignation de valeurs par défaut
            $detailOrder->pf = $detailOrder->pf ?? 0;
            $detailOrder->tc = $detailOrder->tc ?? 0;
            $detailOrder->atax = $detailOrder->atax ?? 0;

            DetailOrder::create([
                'order_id' => $request->order_id,
                'product_name' => $detailOrder->product_name,
                'quantity' => $detailOrder->quantity,
                'unit_price' => $detailOrder->unit_price,
                'unit' => $detailOrder->unit,
                'pf' => $detailOrder->pf,
                'tc' => $detailOrder->tc,
                'atax' => $detailOrder->atax,
                'total_price' => $detailOrder->total_price,
            ]);
        }

        return redirect()->route('orders.show', $request->order_id)->with('success', 'Produits ajoutés à la commande avec succès.');
    }

    private function validateDetailOrder(Request $request)
    {
        return $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit' => 'nullable|string',
            'unit_price' => 'required|numeric|min:0',
            'pf' => 'nullable|numeric',
            'tc' => 'nullable|numeric',
            'atax' => 'nullable|numeric',
        ]);
    }
}
