<!-- resources/views/invoices/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>   <i class="bi bi-plus-circle"></i> Créer une facture client pour la facture la commande #{{ $order->id }}</h3>

    {{-- @dump( $order->id) --}}
     <form action="{{ route('invoices.store', ['order_id'=>$order->id]) }}" method="POST">
        @csrf
    <div class="row">
        <div class="form-group mb-3 col-4">
            <label for="number" class="form-label">Numéro de facture</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ old('number', $number) }}" >

            {{-- <input type="hidden" name="number" value="{{ old('number', $number) }}"> --}}

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


                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $detail->id }}">
                        Supprimer
                    </button>
                    <div class="modal fade" id="deleteConfirmationModal{{ $detail->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $detail->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $detail->id }}">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        Confirmation de suppression
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <p>Êtes-vous sûr de vouloir supprimer ce produit ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle me-2"></i> Annuler
                                    </button>
                                    <form action="{{ route( 'orders.detail-orders.destroy', [$order, $detail]) }}" method="POST" style="display: inline-block;" class="delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger" >
                                            <i class="bi bi-trash me-2"></i> Supprimer
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

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
