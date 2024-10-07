s<!-- resources/views/proformas/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Facture Proforma #{{ $proforma->number }}</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Détails de la facture</h5>
            <p><strong>Date:</strong> {{ $proforma->date }}</p>
            <p><strong>Période de validité:</strong> {{ $proforma->validity_period }} jours</p>
            <p><strong>Statut:</strong> {{ $proforma->status }}</p>
            <p><strong>Montant total:</strong> {{ $proforma->total_amount }}</p>
        </div>
    </div>

    <h2 class="mt-4">Détails de la commande</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proforma->order->detailOrders as $detail)
            <tr>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ $detail->unit_price }}</td>
                <td>{{ $detail->total_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('proformas.edit', $proforma) }}" class="btn btn-primary">Modifier</a>
        <a href="{{ route('proformas.generatePDF', $proforma) }}" class="btn btn-success">Générer PDF</a>
    </div>

</div>
@endsection
