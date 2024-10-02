<!-- resources/views/orders/show.blade.php -->
@extends('layouts.app')
@section('title', 'Détails de la commande')
@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-bag"></i> Détails de la commande #{{ $order->id }}
    </h1>
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
                <dd class="col-sm-9">{{ $order->company ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Désignation</dt>
                <dd class="col-sm-9">{{ $order->designation ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Quantité</dt>
                <dd class="col-sm-9">{{ $order->quantity ?? 'Non spécifié' }}</dd>

            
                <dt class="col-sm-3">Montant HT</dt>
                <dd class="col-sm-9">{{ number_format($order->amount_ht, 2, ',', ' ') }} BIF</dd>

                <dt class="col-sm-3">Montant TVAC</dt>
                <dd class="col-sm-9">{{ number_format($order->amount_tvac, 2, ',', ' ') }} BIF</dd>

                <dt class="col-sm-3">Montant</dt>
                <dd class="col-sm-9">{{ number_format($order->amount, 2, ',', ' ') }} BIF</dd>

                <dt class="col-sm-3">Date de commande</dt>
                <dd class="col-sm-9">{{ $order->order_date->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Date de livraison</dt>
                <dd class="col-sm-9">{{ $order->delivery_date->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Statut</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-{{ $order->status_color }}">
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
        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection