<?php
namespace App\Http\Controllers;

use App\Models\CashRegisterDenomination;
use Illuminate\Http\Request;
use App\Models\CashRegister;
use Illuminate\Support\Facades\Auth;

class CashRegisterDenominationController extends Controller
{
    public function index()
    {
        $denominations = CashRegisterDenomination::all();
        return view('denominations.index', compact('denominations'));
    }

    public function create()
    {
        $cashs = CashRegister::latest()->get();
        return view('denominations.create',compact('cashs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'denomination' => 'required|in:10000,5000,2000,1000,500,100,50',
            'quantity' => 'required|integer|min:1',
        ]);

        CashRegisterDenomination::create([
            'denomination' => $request->denomination,
            'quantity' => $request->quantity,
            'cash_register_id' => $request->cash_register_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('denominations.index')->with('success', 'Dénomination ajoutée avec succès.');
    }

    public function show(CashRegisterDenomination $denomination)
    {
        return view('denominations.show', compact('denomination'));
    }

    public function edit(CashRegisterDenomination $denomination)
    {
        $cashs = CashRegister::latest()->get();
        return view('denominations.edit', compact('denomination','cashs'));
    }

    public function update(Request $request, CashRegisterDenomination $denomination)
    {
        $request->validate([
            'denomination' => 'required|in:10000,5000,2000,1000,500,100,50',
            'quantity' => 'required|integer|min:1',
        ]);

        $denomination->update([
            'denomination' => $request->denomination,
            'quantity' => $request->quantity,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('denominations.index')->with('success', 'Dénomination mise à jour avec succès.');
    }

    public function destroy(CashRegisterDenomination $denomination)
    {
        $denomination->delete();
        return redirect()->route('denominations.index')->with('success', 'Dénomination supprimée avec succès.');
    }
}
