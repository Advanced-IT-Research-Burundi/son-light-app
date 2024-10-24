<!-- resources/views/invoices/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>   <i class="bi bi-plus-circle"></i> Créer une facture pour la facture la commande #{{ $order->id }}</h3>

    {{-- @dump( $order->id) --}}
     <form action="{{ route('invoices.store', ['order_id'=>$order->id]) }}" method="POST">
        @csrf
    <div class="row">
        <div class="form-group mb-3 col-4">
            <label for="number" class="form-label">Numéro de facture</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ $number }}" required>
        </div>

        <div class="form-group mb-3 col-4">
            <label for="date" class="form-label">Date de la facture</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="form-group mb-3 col-4">
            <label for="due_date" class="form-label">Date d'échéance</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ date('Y-m-d', strtotime('+30 days')) }}" required>
        </div>
    </div>
   
</div>
        <button type="submit" class="btn btn-primary">  <i class="bi bi-check-lg"></i> Créer la facture</button>
        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary"> <i class="bi bi-x-lg"></i>Annuler</a>
    </form>
    <br>
         <h4>Détails de la facture</h4>
    @php
        $count = 1;
    @endphp
    <table class="table">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire en Fbu</th>
                <th>Prix total HT en Fbu</th>
                <th>TVA en Fbu</th>
                <th>Prix total TVAC en Fbu</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->detailOrders as $detail)
            <tr>
                <td>{{ $count}}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 0) }}</td>
                <td>{{ number_format($detail->total_price, 0) }} </td>
                <td>{{ $order->entreprise->assujeti?number_format($detail->total_price * $order->tva / 100, 0):'' }}</td>
                <td>{{ $order->entreprise->assujeti?number_format($detail->total_price + ($detail->total_price * $order->tva / 100), 0):'' }}</td>
                <td>
                    <a href="{{ route('orders.detail-orders.edit', [$order, $detail]) }}" class="btn btn-sm btn-info">Modifier</a>
                    <form action="{{ route('orders.detail-orders.destroy', [$order, $detail]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @php
                $count++;
            @endphp
            @endforeach
        </tbody>
         <tfoot>
            <tr>
                <td colspan="4" style="text-align: left;"><strong>Total</strong></td>
                <td><strong>{{ number_format($order->detailOrders->sum('total_price'), 2) }}</strong></td>
                <td><strong>{{ $order->entreprise->assujeti?number_format($order->detailOrders->sum('total_price') * $order->tva / 100, 0):'' }}</strong></td>
                <td><strong>{{ $order->entreprise->assujeti?number_format($order->detailOrders->sum('total_price') * (1 + $order->tva / 100), 0):'' }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
