<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockEntry;
use App\Models\StockExit;
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
            'code' => 'required|string|unique:stocks,code',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'min_quantity' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        $validatedData['last_restock_date'] = now();
        Stock::create($validatedData);

        return redirect()->route('stocks.index')->with('success', 'Produit ajouté au stock avec succès');
    }

    public function createEntry()
    {
        $products = Stock::all();
        return view('stocks.create-entry', compact('products'));
    }



    public function createExit()
    {
        $products = Stock::where('quantity', '>', 0)->get();
        return view('stocks.create-exit', compact('products'));
    }


    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'product_name' => 'required|string|max:255',
    //         'code' => 'required|string|unique:stocks,code|max:50',
    //         'quantity' => 'required|integer|min:0',
    //         'unit' => 'required|string|max:50',
    //         'min_quantity' => 'required|integer|min:0',
    //         'description' => 'nullable|string',
    //     ]);

    //     $stock = Stock::create($validatedData);

    //     return redirect()->route('stocks.index')
    //         ->with('success', 'Produit ajouté au stock avec succès.');
    // }

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
    public function storeEntry(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:stocks,id',
            'quantity_entered' => 'required|numeric|min:1',
            'entry_date' => 'required|date',
            'supplier' => 'nullable|string',
            'entry_notes' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validatedData) {
            $stock = Stock::findOrFail($validatedData['product_id']);
            $stock->increment('quantity', $validatedData['quantity_entered']);
            $stock->last_restock_date = $validatedData['entry_date'];
            $stock->save();

            StockEntry::create([
                'stock_id' => $stock->id,
                'quantity_entered' => $validatedData['quantity_entered'],
                'entry_date' => $validatedData['entry_date'],
                'supplier' => $validatedData['supplier'] ?? null,
                'entry_notes' => $validatedData['entry_notes'] ?? null
            ]);
        });

        return redirect()->route('stocks.index')->with('success', 'Entrée de stock enregistrée');
    }

    public function storeExit(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:stocks,id',
            'quantity_exited' => 'required|numeric|min:1',
            'exit_date' => 'required|date',
            'destination' => 'nullable|string',
            'exit_notes' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validatedData) {
            $stock = Stock::findOrFail($validatedData['product_id']);

            if ($validatedData['quantity_exited'] > $stock->quantity) {
                throw new \Exception('Quantité de sortie supérieure au stock disponible');
            }

            $stock->decrement('quantity', $validatedData['quantity_exited']);


            StockExit::create([
                'stock_id' => $stock->id,
                'quantity_exited' => $validatedData['quantity_exited'],
                'exit_date' => $validatedData['exit_date'],
                'destination' => $validatedData['destination'] ?? null,
                'exit_notes' => $validatedData['exit_notes'] ?? null
            ]);
        });

        return redirect()->route('stocks.index')->with('success', 'Sortie de stock enregistrée');
    }

    public function showHistory(Stock $stock) {
    {
        // $stock = Stock::findOrFail($id);
        $entries = $stock->entries()->orderBy('entry_date', 'desc')->get();
        $exits = $stock->exits()->orderBy('exit_date', 'desc')->get();

        return view('stocks.history', compact('stock', 'entries', 'exits'));
    }
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
