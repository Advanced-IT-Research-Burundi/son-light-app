<!-- resources/views/orders/show.blade.php -->
@extends('layouts.app')
@section('title', 'Détails de la commande')
@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-bag"></i> Détails de la commande #{{ $order->id }}
    </h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la commande</h6>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Numéro de commande</dt>
                <dd class="col-sm-9">{{ $order->id }}</dd>

                <dt class="col-sm-3">Client</dt>
                <dd class="col-sm-9">{{ $order->client->name }}</dd>

                <dt class="col-sm-3">Entreprise</dt>
                <dd class="col-sm-9">{{ $order->entreprise->name ?? 'Non spécifié' }}</dd>

               {{-- <dt class="col-sm-3">Désignation</dt>
                <dd class="col-sm-9">{{ $order->designation ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Quantité</dt>
                <dd class="col-sm-9">{{ $order->quantity ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Prix Unitaire</dt>
                <dd class="col-sm-9">{{ number_format($order->amount, 2, ',', ' ') }} BIF</dd>

                <dt class="col-sm-3">Montant HT</dt>
                <dd class="col-sm-9">{{ number_format($order->amount *$order->quantity, 2, ',', ' ') }} BIF</dd>

                <dt class="col-sm-3">Montant TVAC</dt>
                <dd class="col-sm-9">{{ number_format($order->amount_tvac, 2, ',', ' ') }} BIF</dd>

                  --}}
                <dt class="col-sm-3">Date de commande</dt>
                <dd class="col-sm-9">{{ $order->order_date->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Date de livraison</dt>
                <dd class="col-sm-9">{{ $order->delivery_date->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Statut</dt>
                <dd class="col-sm-9">
                    <span class="">
                        {{ $order->status }}
                    </span>
                </dd>

                <dt class="col-sm-3">Créé par</dt>
                <dd class="col-sm-9">{{ $order->user->name }}</dd>

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $order->description ?? 'Aucune description' }}</dd>
            </dl>
        </div>
    </div>

    <div class="mt-4">
    <a href="{{  route('order_alllist') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste des commandes
        </a>
        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <a href="{{ route('orders.detail-orders.create', $order) }}" class="btn btn-primary">Ajouter un article ou service</a>
        <a href="{{ route('orders.generatePDF', $order) }}" class="btn btn-success">
            <i class="bi bi-filetype-pdf"></i>
            </i>
            Générer PDF
        </a>
        <a href="{{ route('order_alllist')}}" class="btn btn-primary">
        <i class="bi bi-eye"></i> visualiser des commandes </a>
    </div>



</div>
<br>
    @php
        $count = 1;
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
                <th>Actions</th>
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
        {{-- <tfoot>
            <tr>
                <th colspan="4">Total en Fbu</th>
                <th>{{ number_format($order->amount, 2) }}</th>
                <th></th>
            </tr>
        </tfoot> --}}
    </table>
</div>
@endsection
