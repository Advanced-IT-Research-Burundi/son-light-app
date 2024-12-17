<?php

namespace App\Http\Controllers;

use App\Models\cashRegisterReceipt;
use App\Models\User;
use Illuminate\Http\Request;


class CashRegisterReceiptController extends Controller
{
    public function index()
    {
        $receipts = CashRegisterReceipt::with(['requerant', 'user', 'approbation'])->get();
        return view('cash_register_receipts.index', compact('receipts'));
    }

    public function create()
    {
        $users = User::all();
        return view('cash_register_receipts.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'requerant_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
            'approbation_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'motif' => 'required|string',
            'note_validation' => 'nullable|string',
            'cash_register_receipts_date' => 'required|date',
            'cash_register_receipts_approbation_date' => 'nullable|date',
        ]);

        CashRegisterReceipt::create($validated);

        return redirect()->route('cash_register_receipts.index')->with('success', 'Reçu enregistré avec succès.');
    }

    public function show($id)
    {
        $receipt = CashRegisterReceipt::with(['requerant', 'user', 'approbation'])->findOrFail($id);
        return view('cash_register_receipts.show', compact('receipt'));
    }

    public function edit($id)
    {
        $receipt = CashRegisterReceipt::findOrFail($id);
        $users = User::all();
        return view('cash_register_receipts.edit', compact('receipt', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'requerant_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
            'approbation_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'motif' => 'required|string',
            'note_validation' => 'nullable|string',
            'cash_register_receipts_date' => 'required|date',
            'cash_register_receipts_approbation_date' => 'nullable|date',
        ]);

        $receipt = CashRegisterReceipt::findOrFail($id);
        $receipt->update($validated);

        return redirect()->route('cash_register_receipts.index')->with('success', 'Reçu mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $receipt = CashRegisterReceipt::findOrFail($id);
        $receipt->delete();

        return redirect()->route('cash_register_receipts.index')->with('success', 'Reçu supprimé avec succès.');
    }
}
