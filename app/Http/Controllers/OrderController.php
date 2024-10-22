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
    /*public function index()
    {
        $orders = Order::with('client')->latest()->get();
        return view('orders.index', compact('orders'));
    }*/
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
            'status_livraison'=>['required','integer'],
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
    {   $proforma_invoice = $order->proformaInvoice;
        $order->delete();
        return redirect()->route('proforma_invoices.orders.index', $proforma_invoice->id)
            ->with('success', 'Commande supprimée avec succès.');
    }
            /*
            public function destroy(Order $order)
            {
             $proforma_invoice = $order->proforma_invoice;
             $order->delete();
            return redirect()->route('proforma_invoices.orders.index', $proforma_invoice->id)
            ->with('success', 'Commande supprimée avec succès.');
           }*/
    public function order_alllist(){
        $orders = Order::with('client')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function generatePDF(Order $order)
    {
         $order->load('detailOrders', 'client', 'entreprise');
        $companies = [
            ['name' => 'Son light IMPRIMERIE'],
            ['name' => 'DEALER GROUP'],
            ['name' => 'BUFI TECHNOLOGIE'],
            ['name' => 'NOVA TECH'],
            ['name' => 'AFRO BUSINESS GROUP'],
            ['name' => 'SOCIETE ANONYME'],
        ];

        // CREATION DES PROFORMA A PARTIR DES COMPANY_KEY EN UTILISANT SWICH EN GENERA PDF POUR CHAQUE COMPANY
        switch ($order->entreprise->id) {
            case 1:
                $pdf = PDF::loadView('orders.pdf', compact('order'));
                break;
            case 2:
                $pdf = PDF::loadView('orders.pdf_Dealer_Group', compact('order'));
                break;
            case 3:
                $pdf = PDF::loadView('orders.pdf_bufi', compact('order'));
                break;
            case 4:
                $pdf = PDF::loadView('orders.pdf_nova', compact('order'));
                break;
            case 5:
                $pdf = PDF::loadView('orders.pdf_afro', compact('order'));
                break;
            default:
                $pdf = PDF::loadView('orders.pdf', compact('order'));
        }



        return $pdf->download('order' . '.pdf');
        $order->load('order', 'order.client', 'order.entreprise');
        $pdf = PDF::loadView('orders.pdf', compact('order'));
        return $pdf->download('commande_' . $order->id . '.pdf');
    }
}
