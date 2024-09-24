<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;

use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('client')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('orders.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'order_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'description' => 'nullable|string',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['delivery_date'] = now();


         Order::create($validatedData);

        return redirect()->route('orders.index')
            ->with('success', 'Commande créée avec succès.');
    }

    public function edit(Order $order)
    {
        $clients = Client::all();
        return view('orders.edit', compact('order', 'clients'));
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'order_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'description' => 'nullable|string',
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.index')
            ->with('success', 'Commande mise à jour avec succès.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
}
