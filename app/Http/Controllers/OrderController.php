<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\Order;
use App\Models\ProformaInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $proforma_invoice_id = $request->proforma_invoice_id;
        $orders = Order::with('proforma_invoice')
            ->where('proforma_invoice_id', $proforma_invoice_id)
            ->latest()
            ->get();

        return view('orders.index', compact('orders', 'proforma_invoice_id'));
    }

    public function create(ProformaInvoice $proforma_invoice)
    {
        $clients = Client::orderBy('name')->get();
        $companies = Company::all();

        return view('orders.create', compact('clients', 'companies', 'proforma_invoice'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function store(OrderStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['user_id'] = Auth::id();
            $validatedData['status_livraison'] = $request->input('status_livraison', false);

            // Utilisation des colonnes de la migration
            $validatedData['tva'] = $request->input('tva', 0);
            $validatedData['amount_ht'] = $request->input('amount_ht', 0);
            $validatedData['amount_tvac'] = $request->input('amount_tvac', 0); // Assurez-vous que ce nom est correct

            $order = Order::create($validatedData);

            $order->detailOrders()->create([
                'product_name' => $request->designation,
                'quantity' => $request->quantity,
                'unit' => $request->unit,
                'unit_price' => $request->amount,
                'total_price' => $request->amount * $request->quantity,
                'tc' => $request->input('tc', 0),
                'atax' => $request->input('atax', 0),
                'pf' => $request->input('pf', 0),
                'tva' => $validatedData['tva'],
            ]);

            return redirect()->route('orders.show', $order)
                ->with('success', 'Commande créée avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de la commande : ' . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Une erreur est survenue lors de la création de la commande.'])
                ->withInput();
        }
    }

    public function edit(Order $order)
    {
        $clients = Client::orderBy('name')->get();
        $companies = Company::all();
        $proforma_invoice = ProformaInvoice::find($order->proforma_invoice_id);

        return view('orders.edit', compact('order', 'clients', 'companies', 'proforma_invoice'));
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|integer|exists:clients,id',
            'proforma_invoice_id' => 'required',
            'amount' => 'required|numeric',
            'quantity' => 'required|numeric',
            'unit' => 'nullable|string',
            'price_letter' => 'nullable|string',
            'status_livraison' => 'required|boolean',
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'designation' => 'required|string',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
            'tc' => 'nullable|numeric',
            'atax' => 'nullable|numeric',
            'pf' => 'nullable|numeric',
            'tva' => 'nullable|numeric',
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Commande mise à jour avec succès.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order_alllist')
            ->with('success', 'Commande supprimée avec succès.');
    }

    public function order_alllist()
    {
        $orders = Order::with('client')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create1()
    {
        $clients = Client::orderBy('name')->get();
        $companies = Company::all();
        $proforma_invoices = ProformaInvoice::all();

        return view('orders.create1', compact('clients', 'companies', 'proforma_invoices'));
    }

    public function addPriceLetterOrder(Request $request, Order $order)
    {
        $request->validate([
            'price_letter' => 'nullable|string',
        ]);

        $order->update(['price_letter' => $request->input('price_letter')]);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Le prix en lettres a été ajouté avec succès.');
    }
}
