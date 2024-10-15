<!-- resources/views/invoices/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une facture pour la facture proforma #{{ $order->number }}</h1>

    {{-- @dump( $proforma->id) --}}
    <form action="{{ route('invoices.store', ['order_id'=>$order->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="number" class="form-label">Numéro de facture</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ $number }}" readonly>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date de la facture</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Date d'échéance</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ date('Y-m-d', strtotime('+30 days')) }}" required>
        </div>

        <h2>Détails de la facture</h2>
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
                    <td>{{ number_format($detail->unit_price, 2) }}</td>
                    
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th>{{ number_format($order->total_amount, 2) }} €</th>
                </tr>
            </tfoot>
        </table>

        <button type="submit" class="btn btn-primary">Créer la facture</button>
        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
