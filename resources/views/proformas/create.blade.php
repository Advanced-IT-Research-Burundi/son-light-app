<!-- resources/views/proformas/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une facture proforma pour la commande #{{ $order->id }}</h1>

    <form action="{{ route('proformas.store', $order) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="number" class="form-label">Numéro de facture proforma</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ $number }}" readonly>
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
                @foreach($order->detailOrders as $detail)
                <tr>
                    <td>{{ $detail->product_name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->unit_price, 2) }} €</td>
                    <td>{{ number_format($detail->total_price, 2) }} €</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th>{{ number_format($order->amount, 2) }} €</th>
                </tr>
            </tfoot>
        </table>

        <button type="submit" class="btn btn-primary">Créer la facture proforma</button>
        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection