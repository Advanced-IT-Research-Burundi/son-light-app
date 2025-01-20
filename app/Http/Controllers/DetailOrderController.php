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
        $proformaInvoiceList =ProformaInvoiceList::all();
        return view('detail_orders.create', compact('order','proformaInvoiceList'));
    }

    public function store(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit' => 'nullable|string',
            'unit_price' => 'required|numeric|min:0',
            'pf'=>['nullable'],
            'tc'=>['nullable'],
            'atax'=>['nullable']
        ]);

        $totalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        $detailOrder = $order->detailOrders()->create([
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'unit' => $validatedData['unit'],
            'unit_price' => $validatedData['unit_price'],
            'pf'=> $validatedData['pf'],
            'tc'=> $validatedData['tc'],
            'atax'=> $validatedData['atax'],
            'total_price' => $totalPrice,
        ]);

        //$order->update(['amount' => $order->amount + $totalPrice]);

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
            'unit' => 'nullable|string',
            'pf'=>['nullable'],
            'tc'=>['nullable'],
            'atax'=>['nullable'],
        ]);

        $oldTotalPrice = $detailOrder->total_price;
        $newTotalPrice = $validatedData['quantity'] * $validatedData['unit_price'];

        $detailOrder->update([
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'pf'=> $validatedData['pf'],
            'tc'=> $validatedData['tc'],
            'atax'=> $validatedData['atax'],
            'unit_price' => $validatedData['unit_price'],
            'unit'=>$validatedData['unit'],
            'total_price' => $newTotalPrice,
        ]);

        //$order->update(['amount' => $order->amount - $oldTotalPrice + $newTotalPrice]);

        return redirect()->route('orders.show', $order)->with('success', 'Détail de la commande mis à jour avec succès.');
    }

    public function destroy( Order $order,DetailOrder $detailOrder)
    {
       // $order->update(['amount' => $order->amount - $detailOrder->total_price]);
        $detailOrder->delete();

        return redirect()->route('orders.show', $detailOrder->order_id)->with('success', 'Produit supprimé de la commande avec succès.');
    }

    public function addselect(Request $request,Order $order){

        // dd($request->all());
        foreach ($request->select as $key => $value) {
            $detailOrder =  json_decode( $value);

            DetailOrder::create([
                'order_id' =>$request->order_id,
                'product_name'=>$detailOrder->product_name,
                'quantity'=>$detailOrder->quantity,
                'unit_price'=>$detailOrder->unit_price,
                'unit'=>$detailOrder->unit,
                'total_price'=>$detailOrder->total_price,
            ]);

        }

     return redirect()->route('orders.show', $request->order_id)->with('success', 'Produit supprimé de la commande avec succès.');


    }
}
