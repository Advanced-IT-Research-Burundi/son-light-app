<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\Order;
use App\Models\OtherOrder;
use PDF;
use App\Models\ProformaInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $proforma_invoice_id = $request->proforma_invoice_id;
        $orders = Order::with('proforma_invoice')->where('proforma_invoice_id',$proforma_invoice_id)->latest()->get();
        return view('orders.index', compact(['orders','proforma_invoice_id']));
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
        $validatedData['user_id'] = Auth::user()->id;
        $order = Order::create($validatedData);

        $detailOrder = $order->detailOrders()->create([
            'product_name' => $request->designation,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price_letter'=>$request->price_letter,
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
            'unit' => ['nullable','string'],
            'price_letter' => ['nullable','string'],
            'status_livraison'=>['required','integer'],
            'order_date' => ['required', 'date'],
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
    {   $proforma_invoice = $order->proformaInvoice;
        $order->delete();
        return redirect()->route('proforma_invoices.orders.index', $proforma_invoice->id)
            ->with('success', 'Commande supprimée avec succès.');
    }
    public function order_alllist(){
        $orders = Order::with('client')->latest()->get();
        return view('orders.index', compact('orders'));
    }
    public function create1()
    {
        $clients = Client::all();
        $companies = Company::all();
        $order=null;
        $proforma_invoices=ProformaInvoice::all();
        return view('orders.create1', compact('clients', 'companies','proforma_invoices','order'));
    }
    public function addPriceLetterOrder(Request $request, Order $order)
    {
        $request->validate([
            'price_letter' => ['nullable', 'string'],
        ]);
    
        $order->price_letter = $request->input('price_letter');
        $order->save();
    
        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Le prix en lettre a été ajouté avec succès.');
    }
}
