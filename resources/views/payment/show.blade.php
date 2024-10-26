@extends('layouts.app')

@section('title', 'Détails du payement')

@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-eye"></i> Détails du patement #{{ $payment->id }}
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Détails du paiement</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID du paiement :</strong> {{ $payment->id }}</p>
                    <p><strong>Montant :</strong> {{ $payment->amount }}</p>
                    <p><strong>Date de paiement :</strong> {{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</p>
                    <p><strong>Méthode de paiement :</strong> {{ $payment->payment_method }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Description :</strong> {{ $payment->description }}</p>
                    <p><strong>Créé le :</strong> {{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y H:i') }}</p>
                    {{-- <p><strong>Mis à jour le :</strong> {{ \Carbon\Carbon::parse($payment->updated_at)->format('d/m/Y H:i') }}</p> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Détails de la commande associée</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID de la commande :</strong> {{ $payment->invoice->id }}</p>
                    <p><strong>Entreprise :</strong> {{ $payment->invoice->company }}</p>
                    <p><strong>Désignation :</strong> {{ $payment->invoice->designation }}</p>
                    <p><strong>Quantité :</strong> {{ $payment->invoice->quantity }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Montant de la commande :</strong> {{ $payment->invoice->amount }}</p>
                    <p><strong>Date de commande :</strong> {{ \Carbon\Carbon::parse($payment->invoice->order_date)->format('d/m/Y') }}</p>
                    <p><strong>Date de livraison :</strong> {{ \Carbon\Carbon::parse($payment->invoice->delivery_date)->format('d/m/Y') }}</p>
                    <p><strong>Statut :</strong> {{ $payment->invoice->status }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <p><strong>Description de la commande :</strong> {{ $payment->invoice->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
       <a href="{{ route('payments.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
