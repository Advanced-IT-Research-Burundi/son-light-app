<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DetailOrder;
use Illuminate\Http\Request;

class DetailOrderController extends Controller
{
    public function create(Order $order)
    {
        return view('detail_orders.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $totalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        $detailOrder = $order->detailOrders()->create([
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'unit_price' => $validatedData['unit_price'],
            'total_price' => $totalPrice,
        ]);

        $order->update(['amount' => $order->amount + $totalPrice]);

        return redirect()->route('orders.show', $order)->with('success', 'Produit ajouté à la commande avec succès.');
    }

    public function edit(Order $order, DetailOrder $detailOrder)
    {
        return view('detail_orders.edit', compact('order', 'detailOrder'));
    }

    public function update(Request $request, Order $order, DetailOrder $detailOrder)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $oldTotalPrice = $detailOrder->total_price;
        $newTotalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        $detailOrder->update([
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'unit_price' => $validatedData['unit_price'],
            'total_price' => $newTotalPrice,
        ]);

        $order->update(['amount' => $order->amount - $oldTotalPrice + $newTotalPrice]);

        return redirect()->route('orders.show', $order)->with('success', 'Détail de la commande mis à jour avec succès.');
    }

    public function destroy(Order $order, DetailOrder $detailOrder)
    {
        $order->update(['amount' => $order->amount - $detailOrder->total_price]);
        $detailOrder->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Produit supprimé de la commande avec succès.');
    }
}
