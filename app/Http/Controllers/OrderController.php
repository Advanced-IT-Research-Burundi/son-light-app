<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Client;
use App\Models\Company;
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
        $companies = Company::all();
        return view('orders.create', compact('clients', 'companies'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function store(OrderStoreRequest $request)
    {
        $validatedData = $request->all();

        //dd($validatedData);
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['delivery_date'] = now();
        $order = Order::create($validatedData);


        $detailOrder = $order->detailOrders()->create([
            'product_name' => $request->designation,
            'quantity' => $request->quantity,
            'unit_price' => $request->amount,
            'total_price' => ($request->amount * $request->quantity),
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Commande créée avec succès.');
    }

    public function edit(Order $order)
    {
        $clients = Client::all();
        $companies = Company::all();
        return view('orders.edit', compact('order', 'clients','companies'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'amount' => ['required', 'numeric'],
            'order_date' => ['required', 'date'],
            'status' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'company_id' => 'required|exists:companies,id',
        ]);

        $order->update(attributes: $request->all());

        

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
