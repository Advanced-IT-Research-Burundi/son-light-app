<?php
/*
namespace App\Http\Controllers;

use App\Models\CashRegister;
use App\Models\CashRegisterDenomination;
use App\Models\CashRegisterReceipt;
use Illuminate\Http\Request;
use PDF;

class DailyStockController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->date;

        // Récupération des données
        $cashRegisters = CashRegister::all();
        $denominations = CashRegisterDenomination::with('cashRegister')->get();
        $receipts = CashRegisterReceipt::with('cashRegister')->whereDate('receipt_date', $date)->get();

        $totalEntries = $receipts->where('type', 'entry')->sum('amount');
        $totalExits = $receipts->where('type', 'exit')->sum('amount');

        $data = [
            'cashRegisters' => $cashRegisters,
            'denominations' => $denominations,
            'receipts' => $receipts,
            'totalEntries' => $totalEntries,
            'totalExits' => $totalExits,
            'reportDate' => $date,
        ];

        // Vérifier si une demande de téléchargeur PDF ou CSV est faite
        if ($request->has('download')) {
            $format = $request->download;
            if ($format === 'pdf') {
                return $this->generatePDF($data);
            } elseif ($format === 'csv') {
                return $this->generateCSV($data);
            }
        }

        return view('reports.index', compact('data'));
    }

    private function generatePDF($data)
    {
        // Génération du PDF avec dompdf
        $pdf = PDF::loadView('reports.daily_stock_pdf', compact('data'));
        return $pdf->download('rapport_stock_journalier_' . $data['reportDate'] . '.pdf');
    }

    private function generateCSV($data)
    {
        // Génération du CSV
        $filename = 'rapport_stock_journalier_' . $data['reportDate'] . '.csv';
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID Caisse', 'Solde d\'Ouverture', 'Solde Actuel']); // En-têtes CSV

        foreach ($data['cashRegisters'] as $cashRegister) {
            fputcsv($handle, [$cashRegister->id, $cashRegister->opening_balance, $cashRegister->current_balance]);
        }


        fclose($handle);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        exit();
    }
} */
