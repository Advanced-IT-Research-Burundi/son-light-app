<!-- resources/views/orders/index.blade.php -->

@extends('layouts.app')
@section('title', 'Gestion des commandes')
@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-cart3"></i> Gestion des commandes
    </h3>
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
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $count }}</td>
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $order->entreprise->name ?? ''}}</td>
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $order->designation?? ''}}</td>
                            <th style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $order->amount ?? ''}}</th>
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $order->quantity ?? ''}}</td>
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ number_format($order->amount * $order->quantity, 2, ',', ' ')??'' }} Fr Bu</td>
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $order->client->name }}</td>
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $order->order_date->format('d/m/Y') }}</td>
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; "> {{ $order->status }}</td>
                            {{-- <td>{{ number_format($order->amount, 2, ',', ' ') }} Fr Bu</td> --}}
                            {{-- <td>
                                <span class="badge bg-{{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </td> --}}
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">
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
            <div class="mb-4">
                   <a href="{{ route('proforma_invoices.index') }}" class="btn btn-secondary">
                   <i class="bi bi-arrow-left"></i> Retour à la liste des factures proforma</a>
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                   <i class="bi bi-arrow-right"></i> Aller à la liste des factures</a>
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
