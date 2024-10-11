<?php

namespace App\Http\Controllers;

use App\Models\Proforma;
use App\Models\Order;
use PDF;
use Illuminate\Http\Request;


class ProformaController extends Controller
{
    public function index(Request $request)
    {
        $order_id = $request->order_id;
        $proformas = Proforma::with('order')->where('order_id',$order_id)->latest()->get();
        return view('proformas.index', compact(['proformas','order_id']));
    }
    public function create(Order $order)
    {
        return view('proformas.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'number' => 'required|unique:proformas',
            'date' => 'required|date',
            'validity_period' => 'required|integer|min:1',
        ]);

        $proforma = new Proforma($validatedData);
        $proforma->order_id = $order->id;
        $proforma->total_amount = $order->amount;
        $proforma->status = 'draft';
        $proforma->save();

        return redirect()->route('proformas.show', $proforma)->with('success', 'Facture proforma créée avec succès.');
    }

    public function show(Proforma $proforma)
    {
        $proforma->load('order.detailOrders');
        return view('proformas.show', compact('proforma'));
    }

    public function edit(Proforma $proforma)
    {
        return view('proformas.edit', compact('proforma'));
    }

    public function update(Request $request, Proforma $proforma)
    {
        $validatedData = $request->validate([
            'number' => 'required|unique:proformas,number,' . $proforma->id,
            'date' => 'required|date',
            'validity_period' => 'required|integer|min:1',
            'status' => 'required|in:draft,sent,accepted,rejected',
        ]);

        $proforma->update($validatedData);

        return redirect()->route('proformas.show', $proforma)->with('success', 'Facture proforma mise à jour avec succès.');
    }

    public function destroy(Proforma $proforma)
    {
        $proforma->delete();
        return redirect()->route('proformas.index')->with('success', 'Facture proforma supprimée avec succès.');
    }

    public function generatePDF(Proforma $proforma)
    {
        $proforma->load('order.detailOrders', 'order.client', 'order.entreprise');

        $companies = [
            ['name' => 'Son light IMPRIMERIE'],
            ['name' => 'DEALER GROUP'],
            ['name' => 'BUFI TECHNOLOGIE'],
            ['name' => 'NOVA TECH'],
            ['name' => 'AFRO BUSINESS GROUP'],
            ['name' => 'SOCIETE ANONYME'],
        ];

        // CREATION DES PROFORMA A PARTIR DES COMPANY_KEY EN UTILISANT SWICH EN GENERA PDF POUR CHAQUE COMPANY
        switch ($proforma->order->entreprise->id) {
            case 1:
                $pdf = PDF::loadView('proformas.pdf', compact('proforma'));
                break;
            case 2:
                $pdf = PDF::loadView('proformas.pdf_Dealer_Group', compact('proforma'));
                break;
            case 3:
                $pdf = PDF::loadView('proformas.pdf_bufi', compact('proforma'));
                break;
            case 4:
                $pdf = PDF::loadView('proformas.pdf_nova', compact('proforma'));
                break;
            case 5:
                $pdf = PDF::loadView('proformas.pdf_afro', compact('proforma'));
                break;
            default:
                $pdf = PDF::loadView('proformas.pdf', compact('proforma'));
        }



        // $pdf = PDF::loadView('proformas.pdf', compact('proforma'));

        return $pdf->download('facture_proforma_' . $proforma->number . '.pdf');
    }
}
