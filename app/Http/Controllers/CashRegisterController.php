<?php

namespace App\Http\Controllers;

use App\Models\CashRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashRegisterController extends Controller
{
    public function index()
    {
        $cashRegisters = CashRegister::latest()->get();
        return view('cash_registers.index', compact('cashRegisters'));
    }

    public function create()
    {
        return view('cash_registers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'opening_balance' => 'required|numeric|min:0',
        ]);

        CashRegister::create([
            'opening_balance' => $request->opening_balance,
            'current_balance' => $request->opening_balance,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('cash_registers.index')->with('success', 'Caisse créée avec succès.');
    }

    public function show(CashRegister $cashRegister)
    {
        return view('cash_registers.show', compact('cashRegister'));
    }

    public function edit(CashRegister $cashRegister)
    {
        return view('cash_registers.edit', compact('cashRegister'));
    }

    public function update(Request $request, CashRegister $cashRegister)
    {
        $request->validate([
            'opening_balance' => 'required|numeric|min:0',
        ]);

        $cashRegister->update([
            'opening_balance' => $request->opening_balance,
            'current_balance' => $request->opening_balance,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('cash_registers.index')->with('success', 'Caisse mise à jour avec succès.');
    }

    public function destroy(CashRegister $cashRegister)
    {
        $cashRegister->delete();
        return redirect()->route('cash_registers.index')->with('success', 'Caisse supprimée.');
    }
}
