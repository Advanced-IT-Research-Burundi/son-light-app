<!-- resources/views/proformas/show.blade.php -->
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
            {{-- <p><strong>Montant total:</strong> {{ $proforma->total_amount }}</p> --}}
        </div>
    </div>

    @php
        $count = 1;
        $total = 0;
        $totaltva = 0;
    @endphp

    <table class="table">
    <thead>
        <tr>
        <th>Ordre</th>
        <th>Produit</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Prix total HT</th>
        <th>TVA</th>
        <th>Prix total TVAC</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proforma->order->detailOrders as $detail)
        <tr>
        <td>{{ $count}}</td>
        <td>{{ $detail->product_name }}</td>
        <td>{{ $detail->quantity }}</td>
        <td>{{ number_format($detail->unit_price, 2) }} Fr Bu</td>
        <td>{{ number_format($detail->total_price, 2) }} Fr Bu</td>
        <td>{{ $detail->total_price * $proforma->order->tva / 100 }} Fr Bu</td>
            <td>{{ number_format( ($detail->total_price + ($detail->total_price * $proforma->order->tva / 100)), 2) }} Fr Bu</td>

        </tr>

        @php
            $count++;
            $total += $detail->total_price;
            $totaltva += ($detail->total_price + ($detail->total_price * $proforma->order->tva / 100));
        @endphp
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="4">Total</th>
        <th>{{ number_format($total, 2) }} Fr Bu</th>
        <th></th>
        <th>{{ number_format($totaltva, 2) }} Fr Bu</th>

        </tr>
    </tfoot>
    </table>

    <div class="mt-4">
        {{-- <a href="{{ route('proformas.edit', $proforma) }}" class="btn btn-primary">Modifier</a> --}}
        <a href="{{ route('proformas.generatePDF', $proforma) }}" class="btn btn-success">Générer PDF</a>
    </div>

</div>
@endsection
