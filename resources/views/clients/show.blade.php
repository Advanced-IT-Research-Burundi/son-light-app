<!-- resources/views/clients/show.blade.php -->

@extends('layouts.app')

@section('title', 'Détails du client')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-person"></i> Détails du client : {{ $client?->name }}
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations du client</h6>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nom</dt>
                <dd class="col-sm-9">{{ $client?->name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $client->email }}</dd>

                <dt class="col-sm-3">Téléphone</dt>
                <dd class="col-sm-9">{{ $client->phone ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Entreprise</dt>
                <dd class="col-sm-9">{{ $client->company ?? 'N/A' }}</dd>

                <dt class="col-sm-3">NIF</dt>
                <dd class="col-sm-9">{{ $client->nif ?? 'N/A' }}</dd>

                <dt class="col-sm-3">RC</dt>
                <dd class="col-sm-9">{{ $client->rc ?? 'N/A' }}</dd>

                <dt class="col-sm-3">ASSUJETI</dt>
                <dd class="col-sm-9">{{ $client->assujeti ? 'OUI' : 'NON' }}</dd>

                <dt class="col-sm-3">Adresse</dt>
                <dd class="col-sm-9">{{ $client->address ?? 'N/A' }}</dd>
                <dt class="col-sm-3">Personnne de reference 1</dt>
                <dd class="col-sm-9">{{ $client->persone_reference1 ?? 'N/A' }}</dd>
                <dt class="col-sm-3">Personnne de reference 2</dt>
                <dd class="col-sm-9">{{ $client->persone_reference2 ?? 'N/A' }}</dd>
                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $client->description ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Date de création</dt>
                <dd class="col-sm-9">{{ $client->created_at->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Date de mise  à jour </dt>
                <dd class="col-sm-9">{{ $client->updated_at->format('d/m/Y') }}</dd>
            </dl>
        </div>
    </div>
    <div class="my-4 ">
         <a href="{{ route('clients.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste des clients
        </a>
        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Commandes du client</h6>
        </div>
        <div class="card-body">
            @if($client->orders->count() > 0)
                <table class="table table-bordered">
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
                    <tbody>
                        @foreach($client->orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->company ?? ''}}</td>
                            <td>{{ $order->designation?? ''}}</td>
                            <th>{{ $order->amount ?? ''}}</th>
                            <td>{{ $order->quantity ?? ''}}</td>
                            <td>{{ number_format($order->amount * $order->quantity, 2, ',', ' ')??'' }} Fr Bu</td>
                            <td>{{ $order->client?->name }}</td>
                            <td>{{ $order->order_date->format('d/m/Y') }}</td>
                            <td> {{ $order->status }}</td>

                            <td>
                                {{-- <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info"> --}}
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Aucune commande pour ce client.</p>
            @endif
        </div>
    </div>

    {{-- <div class="mt-4">
        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div> --}}
</div>
@endsection
