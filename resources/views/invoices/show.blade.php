@extends('layouts.app')

@section('content')
<div class="container">
    <h3> <i class="bi bi-eye"></i> Facture #{{ $invoice->number }}</h3>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Détails de la facture</h5>
            <p><strong>Date:</strong> {{ $invoice->created_at->format('d/m/Y') }}</p>
        </div>
    </div>

    <h4><i class="bi bi-bag"></i> Détails de la facture</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Article ou service</th>
                <th>Quantité</th>
                <th>Prix unitaire en Fbu</th>
                <th>Prix total HT en Fbu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoice->order->detailOrders as $detail)
            <tr>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 0) }} </td>
                <td>{{ number_format($detail->total_price, 0) }} </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Aucun détail de commande disponible.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            @if($invoice->order->detailOrders->isNotEmpty())
            <tr>
                <td colspan="3" style="text-align: left;"><strong>Total</strong></td>
                <td><strong>{{ number_format($invoice->order->detailOrders->sum('total_price'), 0) }}</strong></td>
            </tr>
            @else
            <tr>
                <td colspan="4" class="text-center">Aucun total disponible.</td>
            </tr>
            @endif
        </tfoot>
    </table>

    <div class="mt-4">
       <a href="{{  route('invoices.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste des factures
        </a>
        <a href="{{ route('invoices.generatePDF', $invoice) }}" class="btn btn-success"> <i class="bi bi-filetype-pdf"></i>Télécharger PDF</a>
    </div>
</div>
@endsection
