<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Client;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function store(OrderStoreRequest $request)
    {

        $validatedData = $request->all();
        $validatedData['user_id'] = Auth::user()->id;
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
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'amount' => ['required', 'numeric'],
            'order_date' => ['required', 'date'],
            'status' => ['required', 'string'],
            'description' => ['nullable', 'string'],
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
