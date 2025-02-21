@extends('layouts.app')

@section('title', 'Détails de la commande')

@section('content')
<style>
/* Ajout du CSS d'animate.css directement ici pour les animations */
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.fadeIn {
    animation: fadeIn 0.5s ease-in-out forwards;
}

.animate__animated {
    animation-duration: 1s;
    animation-fill-mode: both;
}

/* Vous pouvez ajouter d'autres animations ou changements ici */
</style>

<div class="container">
    <h3 class="my-4">
        <i class="bi bi-bag"></i> Détails de la commande #{{ $order->id }}
    </h3>

    <div class="card shadow mb-4 fadeIn">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la commande</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Champ</th>
                        <th scope="col">Données</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Numéro de commande</td>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td>Client</td>
                        <td>{{ $order->client?->name ?? 'Non spécifié' }}</td>
                    </tr>
                    <tr>
                        <td>Entreprise</td>
                        <td>{{ $order->entreprise->name ?? 'Non spécifié' }}</td>
                    </tr>
                    <tr>
                        <td>Prix total HTVA</td>
                        <td>{{ number_format($order->detailOrders->sum('total_price'), 0, ',', '.') }} FBU</td>
                    </tr>
                    <tr>
                        <td>TVA</td>
                        <td>{{ $order->entreprise->assujeti ? number_format($order->detailOrders->sum('total_price') * $order->tva / 100, 0, ',', '.') : '0' }} FBU</td>
                    </tr>
                    <tr>
                        <td>Prix total TVAC</td>
                        <td>{{ $order->entreprise->assujeti ? number_format($order->detailOrders->sum('total_price') * (1 + $order->tva / 100), 0, ',', '.') : '0' }} FBU</td>
                    </tr>
                    <tr>
                        <td>Prix en lettres</td>
                        <td>{{ $order->price_letter }}</td>
                    </tr>
                    <tr>
                        <td>Date de commande</td>
                        <td>{{ $order->order_date->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>Date de livraison</td>
                        <td>{{ $order->delivery_date->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>Livraison Terminée ?</td>
                        <td style="color: {{ $order->status_livraison == 1 ? 'blue' : 'red' }};">
                            {{ $order->status_livraison == 1 ? 'OUI' : 'Non' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Statut de la commande</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                    <tr>
                        <td>Créé par</td>
                        <td>{{ $order->user->name ?? 'Non spécifié' }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $order->description ?? 'Aucune description' }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4">
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Modifier la commande
                </a>
            </div>
        </div>
    </div>

    <br>

    <div class="card shadow mb-4 fadeIn">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Article</th>
                        <th>Unité</th>
                        <th>Qté</th>
                        <th>P.U</th>
                        <th>PTHT</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->detailOrders as $index => $detail)
                    <tr class="fadeIn">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->product_name ?? '' }}</td>
                        <td>{{ $detail->unit ?? '' }}</td>
                        <td>{{ $detail->quantity ?? '' }}</td>
                        <td>{{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                        <td>{{ number_format($detail->total_price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('orders.detail-orders.edit', [$order, $detail]) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i></a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $detail->id }}">
                                <i class="bi bi-trash"></i>
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
                                            <form action="{{ route('orders.detail-orders.destroy', [$order, $detail]) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-2"></i> Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Total</th>
                        <th>{{ number_format($order->detailOrders->sum('total_price'), 0, ',', '.') }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4 fadeIn">
        <div class="card-body">
            <h6 class="m-0 font-weight-bold text-primary">Veuillez écrire le prix en toutes lettres en commençant par "Nous disons".</h6>
            <form action="{{ route('addPriceLetterOrder', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-8">
                        <input type="text" class="form-control @error('price_letter') is-invalid @enderror" id="price_letter" name="price_letter" value="{{ old('price_letter', $order->price_letter ?? '') }}" required>
                        @error('price_letter')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-check-lg"></i> Valider
                        </button>
                        <a href="{{ route('order_alllist') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('order_alllist') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste des commandes
        </a>
        <a href="{{ route('orders.detail-orders.create', $order) }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Article ou service
        </a>
        <a href="{{ route('invoices.create', $order) }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Facture
        </a>
        <a href="{{ route('invoices.index', $order) }}" class="btn btn-primary">
            <i class="bi bi-eye"></i> Factures
        </a>
    </div>

</div>
@endsection
