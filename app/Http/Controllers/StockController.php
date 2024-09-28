<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('stocks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'code' => 'required|string|unique:stocks,code|max:50',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'min_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $stock = Stock::create($validatedData);

        return redirect()->route('stocks.index')
            ->with('success', 'Produit ajouté au stock avec succès.');
    }

    public function show(Stock $stock)
    {
        $stock->load('movements');
        return view('stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'code' => 'required|string|unique:stocks,code,' . $stock->id . '|max:50',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'min_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $stock->update($validatedData);

        return redirect()->route('stocks.index')
            ->with('success', 'Informations du stock mises à jour avec succès.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')
            ->with('success', 'Produit supprimé du stock avec succès.');
    }
}

class StockMovementController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:add,remove',
            'reason' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validatedData) {
            $stock = Stock::findOrFail($validatedData['stock_id']);

            if ($validatedData['type'] == 'remove' && $stock->quantity < $validatedData['quantity']) {
                throw new \Exception('Quantité insuffisante en stock.');
            }

            $movement = new StockMovement([
                'quantity' => $validatedData['quantity'],
                'type' => $validatedData['type'],
                'reason' => $validatedData['reason'],
                'user_id' => auth()->id(),
            ]);

            $stock->movements()->save($movement);

            if ($validatedData['type'] == 'add') {
                $stock->quantity += $validatedData['quantity'];
            } else {
                $stock->quantity -= $validatedData['quantity'];
            }

            $stock->save();
        });

        return redirect()->route('stocks.index')
            ->with('success', 'Mouvement de stock enregistré avec succès.');
    }
}
