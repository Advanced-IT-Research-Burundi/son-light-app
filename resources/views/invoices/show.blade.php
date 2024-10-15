<!-- resources/views/invoices/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Facture #{{ $invoice->number }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Détails de la facture</h5>
            <p><strong>Date:</strong> {{ $invoice->created_at->format('d/m/Y') }}</p>
            <p><strong>Date d'échéance:</strong> {{ $invoice->created_at->format('d/m/Y') }}</p>
            <p><strong>Statut:</strong> {{ $invoice->status }}</p>
            <p><strong>Montant total:</strong> {{ number_format($invoice->total_amount, 2) }} €</p>
        </div>
    </div>

    <h2>Détails de la commande</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire en FBu</th>
                <th>Total Fbu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->order->detailOrders as $detail)
            <tr>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }} </td>
                <td>{{ number_format($detail->total_price, 2) }} </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>{{ number_format($invoice->total_amount, 2) }} €</th>
            </tr>
        </tfoot>
    </table>

    <div class="mt-4">
        <a href="{{ route('invoices.generatePDF', $invoice) }}" class="btn btn-primary">Télécharger PDF</a>
    </div>
</div>
@endsection
