<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\Order;
use PDF;
use App\Models\ProformaInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('client')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create(ProformaInvoice $proforma_invoice)
    {
        $clients = Client::all();
        $companies = Company::all();
        $order=null;
        return view('orders.create', compact('clients', 'companies','proforma_invoice','order'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function store(OrderStoreRequest $request)
    {
        $validatedData = $request->all();

        // dd($validatedData);
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['order_date'] = now();
        $order = Order::create($validatedData);

            // dd(($request->amount * $request->quantity));
            
        $detailOrder = $order->detailOrders()->create([
            'product_name' => $request->designation,
            'quantity' => $request->quantity,
            'unit_price' => $request->amount,
            'total_price' => ($request->amount * $request->quantity),
        ]);

        return redirect()->route('orders.show',$order)
            ->with('success', 'Commande créée avec succès.');
    }

    public function edit(Order $order)
    {
        $clients = Client::all();
        $proforma_invoice = ProformaInvoice::find($order->proforma_invoice_id); 
        $companies = Company::all();
        return view('orders.edit', compact('order', 'clients','companies','proforma_invoice'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'proforma_invoice_id' => ['required'],
            'amount' => ['required','numeric'],
            'quantity' => ['required','numeric'],
            // 'order_date' => ['required', 'date'],
            'delivery_date' => ['required', 'date'],
            'designation' => ['required', 'string'],
            'status' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'company_id' => 'required|exists:companies,id',
        ]);
        $order->update($request->all());

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Commande mise à jour avec succès.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
    public function order_alllist(){
        $orders = Order::with('client')->latest()->get();
        return view('orders.index', compact('orders'));
    }
}
