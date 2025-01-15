<?php
namespace App\Http\Controllers;

use App\Models\CashRegisterReceipt;
use App\Models\CashRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CashRegisterReceiptController extends Controller
{
    public function index()
    {
           $receipts = CashRegisterReceipt::with(['cashRegister', 'creator', 'approver'])->latest()->get();

        return view('receipts.index', compact('receipts'));
    }

    public function show(CashRegisterReceipt $receipt)
    {
        return view('receipts.show', compact('receipt'));
    }
    public function create(CashRegister $cashRegisters)
    {
        $users = User::latest()->get();
        $cashs = CashRegister::latest()->get();
        return view('receipts.create', compact('cashRegisters','users','cashs'));
    }

    public function store(Request $request, CashRegister $cashRegister)
    {
        $request->validate([
            'amount' => 'required|numeric|min:50',
            'type' => 'required|in:entry,exit',
            'justification' => 'required|in:with_proof,without_proof',
            'motif' => 'nullable|string|max:255',
            'receipt_date' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $cashRegister) {

            $receipt = CashRegisterReceipt::create([
                'cash_register_id' => $request->cash_register_id,
                'requester_id' =>$request->requester_id,
                'created_by' => Auth::id(),
                'updated_by' =>Auth::id(),
                'amount' => $request->amount,
                'type' => $request->type,
                'justification' => $request->justification,
                'motif' => $request->motif,
                'receipt_date' => $request->receipt_date,
                'is_approved' => false,
            ]);

            $this->updateCashRegisterBalance($cashRegister, $receipt);
        });

        return redirect()->route('receipts.index')->with('success', 'Opération enregistrée.');
    }
    public function edit(CashRegisterReceipt $receipt)
    {
        $cashs = CashRegister::latest()->get();
        $users = User::latest()->get();
        return view('receipts.edit', compact('receipt','cashs','users'));
    }
    public function update(Request $request, CashRegisterReceipt $receipt)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:entry,exit',
            'justification' => 'required|in:with_proof,without_proof',
            'motif' => 'nullable|string|max:255',
            'validation_note' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $receipt) {
            $cashRegister = $receipt->cashRegister;
            $previousType = $receipt->type;
            $previousAmount = $receipt->amount;

            $receipt->update([
                'cash_register_id' => $request->cash_register_id,
                'requester_id' =>$request->requester_id,
                'amount' => $request->amount,
                'type' => $request->type,
                'justification' => $request->justification,
                'motif' => $request->motif,
                'validation_note' => $request->validation_note,
                'updated_by' => Auth::id(),
            ]);

            $this->adjustCashRegisterBalance($cashRegister, $previousType, $previousAmount, $receipt);
        });

        return redirect()->route('receipts.index')->with('success', 'Opération mise à jour.');
    }
    public function destroy(CashRegisterReceipt $receipt)
    {
        DB::transaction(function () use ($receipt) {
            $cashRegister = $receipt->cashRegister;

            if ($receipt->type === 'entry') {
                $cashRegister->decrement('current_balance', $receipt->amount);
            } else {
                $cashRegister->increment('current_balance', $receipt->amount);
            }

            $receipt->delete();
        });

        return redirect()->route('receipts.index')->with('success', 'Opération supprimée.');
    }
    public function approve(CashRegisterReceipt $receipt)
    {

        if ($receipt->is_approved) {
            return redirect()->route('receipts.index')->with('error', 'Ce reçu a déjà été approuvé.');
        }
        request()->validate([
            'validation_note' => 'required|string|max:255',
        ]);

        $receipt->is_approved = true;
        $receipt->approver_id = Auth::id();
        $receipt->approval_date = now();

        $receipt->validation_note = request('validation_note');
        $receipt->save();

        return redirect()->route('receipts.show', $receipt)->with('success', 'Reçu approuvé avec succès.');
    }
    private function updateCashRegisterBalance(CashRegister $cashRegister, CashRegisterReceipt $receipt)
    {
        if ($receipt->type === 'entry') {
            $cashRegister->increment('current_balance', $receipt->amount);
        } else {
            $cashRegister->decrement('current_balance', $receipt->amount);
        }
    }
    private function adjustCashRegisterBalance(CashRegister $cashRegister, string $previousType, float $previousAmount, CashRegisterReceipt $receipt)
    {
        if ($previousType !== $receipt->type || $previousAmount !== $receipt->amount) {
            if ($previousType === 'entry') {
                $cashRegister->decrement('current_balance', $previousAmount);
            } else {
                $cashRegister->increment('current_balance', $previousAmount);
            }

            if ($receipt->type === 'entry') {
                $cashRegister->increment('current_balance', $receipt->amount);
            } else {
                $cashRegister->decrement('current_balance', $receipt->amount);
            }
        }
    }
}
