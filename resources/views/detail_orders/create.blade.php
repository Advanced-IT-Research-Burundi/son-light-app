@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Ajouter un article ou un service à la commande #{{ $order->id }}</h3>

    <!-- Formulaire d'ajout d'article ou de service -->
    <form action="{{ route('orders.detail-orders.store', $order) }}" method="POST" id="orderForm">
        @csrf
        @include('detail_orders._form')

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Ajouter l'article ou le service</button>
            <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>

    <hr>

    <!-- Liste des articles ou services de la commande -->
    <h3 class="my-4">Liste des articles ou services de la commande</h3>
    @php
        $count = 1;
    @endphp

    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ordre</th>
                    <th>Article</th>
                    <th>Unité</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Prix total HT en FBu</th>
                    <th>TVA en FBu</th>
                    <th>Prix total TVAC en FBu</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->detailOrders as $detail)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $detail->product_name }}</td>
                    <td>{{ $detail->unit }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->unit_price, 2, ',', ' ') }}</td>
                    <td>{{ number_format($detail->total_price, 2, ',', ' ') }}</td>
                    <td>{{ number_format($detail->total_price * $order->tva / 100, 2, ',', ' ') }}</td>
                    <td>{{ number_format(($detail->total_price + ($detail->total_price * $order->tva / 100)), 2, ',', ' ') }}</td>
                    <td>
                        <a href="{{ route('orders.detail-orders.edit', [$order, $detail]) }}" class="btn btn-sm btn-primary" title="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $detail->id }}" title="Supprimer">
                            <i class="bi bi-trash"></i>
                        </button>
                        <!-- Composant modal -->
                        @include('components.delete-confirmation-modal', [
                            'id'=>  $detail->id,
                            'route'=> 'detail-orders.destroy',
                            'title' => 'Confirmation de suppression',
                            'message' => 'Êtes-vous sûr de vouloir supprimer ce produit ?',
                            'confirmText' => 'Supprimer'
                        ])
                    </td>
                </tr>
                @php
                    $count++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <h3 class="my-4">Liste des articles ou services de la facture proforma</h3>
    <form action="{{ route('addselect') }}" method="post">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Article</th>
                        <th>Unité</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Prix total HT en FBu</th>
                        <th>TVA en FBu</th>
                        <th>Prix total TVAC en FBu</th>
                        <th><button class="btn btn-primary" type="submit">AJOUTER</button></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach($order->proformaInvoice->proformaInvoiceList as $detail)
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ $detail->unit }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->unit_price, 2, ',', ' ') }}</td>
                        <td>{{ number_format($detail->total_price, 2, ',', ' ') }}</td>
                        <td>{{ number_format($detail->total_price * $order->tva / 100, 2, ',', ' ') }}</td>
                        <td>{{ number_format(($detail->total_price + ($detail->total_price * $order->tva / 100)), 2, ',', ' ') }}</td>
                        <td class="text-center">
                            <input type="checkbox" name="select[]" value="{{ json_encode($detail) }}"> <!-- envoyer l'objet en JSON -->
                        </td>
                    </tr>
                    @php
                        $count++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>

    <script>
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            const fields = ['tc', 'atax', 'pf'];
            fields.forEach(function(fieldId) {
                const fieldInput = document.getElementById(fieldId);
                if (fieldInput && fieldInput.value.trim() === '') {
                    fieldInput.value = '0';
                }
            });
        });
    </script>
</div>
@endsection
