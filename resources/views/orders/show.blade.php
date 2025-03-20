@extends('layouts.app')

@section('title', 'Détails de la commande')

@section('content')
<style>
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    .fadeIn {
        animation: fadeIn 0.5s ease-in-out forwards;
    }

    .accordion-header button {
        width: 100%;
        text-align: left;
    }

    .btn-custom {
        background-color: #007bff;
        color: white;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-custom:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .table-responsive {
        overflow-x: auto;
        margin-top: 20px;
    }

    th, td {
        vertical-align: middle;
        text-align: left;
    }

    th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        color: white;
        font-size: 1.15rem;
        padding: 10px 15px;
    }

    .modal-content {
        border-radius: 12px;
    }

    .input-group > .form-control {
        border-radius: 0;
    }

    .input-group > .btn {
        border-radius: 0;
    }

    .footer-buttons {
        margin-top: 20px;
        text-align: right;
    }

    .text-primary {
        color: #007bff !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-success {
        color: #28a745 !important;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table th, .table td {
        padding: 12px;
    }
</style>

<div class="container mt-4">
    <h3 class="mb-4 text-primary">
        <i class="bi bi-bag"></i> Détails de la commande #{{ $order->id }}
    </h3>

    <!-- Informations de la commande -->
    <div class="card shadow mb-4 fadeIn">
        <div class="card-header" id="headingOrderInfo">
            <h6 class="m-0 font-weight-bold">
                <button class="btn btn text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrderInfo" aria-expanded="false" aria-controls="collapseOrderInfo">
                    <i class="bi bi-plus-circle"></i> Informations générale
                </button>
            </h6>
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
            <div class="footer-buttons">
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-custom">
                    <i class="bi bi-pencil"></i> Modifier la commande
                </a>
            </div>

            <h6 class="m-0 font-weight-bold">Détails des articles de la commande</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ordre</th>
                            <th>Article</th>
                            <th>Unité</th>
                            <th>Qté</th>
                            <th>P.U</th>
                            <th>PTHT</th>
                            <th>TC</th>
                            <th>Atax</th>
                            <th>PF</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->detailOrders as $index => $detail)
                        <tr class="fadeIn">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detail->product_name ?? 'Non spécifié' }}</td>
                            <td>{{ $detail->unit ?? 'N/A' }}</td>
                            <td>{{ $detail->quantity ?? 0 }}</td>
                            <td>{{ number_format($detail->unit_price, 0, ',', '.') }} FBU</td>
                            <td>{{ number_format($detail->total_price, 0, ',', '.') }} FBU</td>
                            <td>{{ number_format($detail->tc, 2, ',', '.') }} FBU</td>
                            <td>{{ number_format($detail->atax, 2, ',', '.') }} FBU</td>
                            <td>{{ number_format($detail->pf, 2, ',', '.') }} FBU</td>
                            <td>
                                <a href="{{ route('orders.detail-orders.edit', [$order, $detail]) }}" class="btn btn-sm btn-info" title="Modifier"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('orders.detail-orders.destroy', [$order, $detail]) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ou service ?')">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">Total</th>
                            <th>{{ number_format($order->detailOrders->sum('total_price'), 0, ',', '.') }} FBU</th>
                            <th>{{ number_format($order->detailOrders->sum('tc'), 2, ',', '.') }} FBU</th>
                            <th>{{ number_format($order->detailOrders->sum('atax'), 2, ',', '.') }} FBU</th>
                            <th>{{ number_format($order->detailOrders->sum('pf'), 2, ',', '.') }} FBU</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="5">TVA</th>
                            <th>{{ $order->entreprise->assujeti ? number_format($order->detailOrders->sum('total_price') * $order->tva / 100, 0, ',', ' ') : '0' }} FBU</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="5">PTVAC</th>
                            <th>{{ $order->entreprise->assujeti ? number_format($order->detailOrders->sum('total_price') * (1 + $order->tva / 100), 0, ',', ' ') : '0' }} FBU</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="5">PVT Total</th>
                            <th>
                                {{
                                    number_format(
                                        $order->detailOrders->sum('total_price') +
                                        $order->detailOrders->sum('tc') +
                                        $order->detailOrders->sum('atax') +
                                        $order->detailOrders->sum('pf'), 0, ',', '.')
                                }} FBU
                            </th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="footer-buttons">
                <a href="{{ route('orders.detail-orders.create', $order) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajouter un article
                </a>
            </div>
            <h6 class="m-0 font-weight-bold text-primary">Prix en lettres</h6>
            <form action="{{ route('addPriceLetterOrder', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('price_letter') is-invalid @enderror" id="price_letter" name="price_letter" placeholder="Ex: Nous disons..." value="{{ old('price_letter', $order->price_letter ?? '') }}">
                    @error('price_letter')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Valider
                    </button>
                    <a href="{{ route('order_alllist') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
            <h6 class="m-0 font-weight-bold text-primary">Ajout de Facture</h6>
            <p>Vous souhaitez ajouter une facture à cette commande ?</p>
            <div class="footer-buttons">
                <a href="{{ route('invoices.create', $order) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Créer une facture
                </a>
                <a href="{{ route('invoices.index', $order) }}" class="btn btn-secondary">
                    <i class="bi bi-eye"></i> Consulter la liste des factures
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
