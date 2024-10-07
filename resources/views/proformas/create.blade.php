<!-- resources/views/proformas/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une facture proforma pour la commande #{{ $order->id }}</h1>

    <form action="{{ route('proformas.store', $order) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="number" class="form-label">Numéro de facture proforma</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ $order->id}}" readonly>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date de la facture</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="validity_period" class="form-label">Période de validité (en jours)</label>
            <input type="number" class="form-control" id="validity_period" name="validity_period" value="30" required min="1">
        </div>

        <h2>Détails de la commande</h2>
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
            @foreach($order->detailOrders as $detail)
            <tr>
                <td>{{ $count}}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }} Fr Bu</td>
                <td>{{ number_format($detail->total_price, 2) }} Fr Bu</td>
                <td>{{ $detail->total_price * $order->tva / 100 }} Fr Bu</td>
                <td>{{ number_format( ($detail->total_price + ($detail->total_price * $order->tva / 100)), 2) }} Fr Bu</td>

            </tr>

            @php
                $count++;
                $total += $detail->total_price;
                $totaltva += ($detail->total_price + ($detail->total_price * $order->tva / 100));
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

        <button type="submit" class="btn btn-primary">Créer la facture proforma</button>
        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
