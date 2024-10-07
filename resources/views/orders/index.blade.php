<!-- resources/views/orders/index.blade.php -->

@extends('layouts.app')
@section('title', 'Gestion des commandes')
@section('content')
<div class="container-fluid">
    <h1 class="my-4">
        <i class="bi bi-cart3"></i> Gestion des commandes
    </h1>

    <div class="mb-4">
        <a href="{{ route('orders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouvelle commande
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des commandes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="ordersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SOCIETE</th>
                            <th>Désigation</th>
                            <th>Prix Unitaire</th>
                            <th>Quantite</th>
                            <th>Total</th>
                            <th>Client</th>
                            <th>Date de livraison</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @php
                        $count = 1;
                    @endphp
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $order->entreprise->name ?? ''}}</td>
                            <td>{{ $order->designation?? ''}}</td>
                            <th>{{ $order->amount ?? ''}}</th>
                            <td>{{ $order->quantity ?? ''}}</td>
                            <td>{{ number_format($order->amount * $order->quantity, 2, ',', ' ')??'' }} Fr</td>
                            <td>{{ $order->client->name }}</td>
                            <td>{{ $order->order_date->format('d/m/Y') }}</td>
                            <td> {{ $order->status }}</td>
                            {{-- <td>{{ number_format($order->amount, 2, ',', ' ') }} Fr</td> --}}
                            {{-- <td>
                                <span class="badge bg-{{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </td> --}}
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#ordersTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection
