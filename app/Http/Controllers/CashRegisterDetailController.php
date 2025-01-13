<?php

namespace App\Http\Controllers;

use App\Models\CashRegister;
use App\Models\CashRegisterReceipt;
use Illuminate\Http\Request;
use PDF;

class CashRegisterDetailController extends Controller
{
    public function show(CashRegister $cashRegister)
    {
        $cashRegister->load(['receipts', 'denominations']);

        $totalDenominations = $cashRegister->denominations->sum(fn($denomination) => $denomination->quantity * $denomination->denomination);
        $totalEntries = $cashRegister->receipts->where('type', 'entry')->sum('amount');
        $totalExits = $cashRegister->receipts->where('type', 'exit')->sum('amount');

        $currentBalance = $cashRegister->current_balance;

        return view('cash_registers.details', compact('cashRegister', 'totalDenominations', 'totalEntries', 'totalExits', 'currentBalance'));
    }
    public function generatePDF(CashRegister $cashRegister)
    {
        $cashRegister->load(['receipts', 'denominations']);

        $totalDenominations = $cashRegister->denominations->sum(fn($denomination) => $denomination->quantity * $denomination->denomination);
        $totalEntries = $cashRegister->receipts->where('type', 'entry')->sum('amount');
        $totalExits = $cashRegister->receipts->where('type', 'exit')->sum('amount');

        $currentBalance = $cashRegister->current_balance;

        $pdf = PDF::loadView('cash_registers.pdf', compact('cashRegister', 'totalDenominations', 'totalEntries', 'totalExits', 'currentBalance'));
        return $pdf->download('details_caisse_' . $cashRegister->id . '.pdf');
    }
}
