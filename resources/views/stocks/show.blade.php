<!-- resources/views/stocks/show.blade.php -->

@extends('layouts.app')

@section('title', 'Détails du produit')

@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-box-seam"></i> Détails du produit : {{ $stock->product_name }}
    </h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations du produit</h6>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">SKU</dt>
                <dd class="col-sm-9">{{ $stock->sku }}</dd>

                <dt class="col-sm-3">Nom du produit</dt>
                <dd class="col-sm-9">{{ $stock->product_name }}</dd>

                <dt class="col-sm-3">Quantité actuelle</dt>
                <dd class="col-sm-9">{{ $stock->quantity }} {{ $stock->unit }}</dd>

                <dt class="col-sm-3">Quantité minimale</dt>
                <dd class="col-sm-9">{{ $stock->min_quantity }} {{ $stock->unit }}</dd>

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $stock->description ?? 'Aucune description' }}</dd>

                <dt class="col-sm-3">Dernière mise à jour</dt>
                <dd class="col-sm-9">{{ $stock->updated_at->format('d/m/Y H:i') }}</dd>
            </dl>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Historique des mouvements</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="movementsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Quantité</th>
                            <th>Raison</th>
                            <th>Utilisateur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stock->movements as $movement)
                        <tr>
                            <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $movement->type == 'add' ? 'Ajout' : 'Retrait' }}</td>
                            <td>{{ $movement->quantity }} {{ $stock->unit }}</td>
                            <td>{{ $movement->reason ?? 'Non spécifié' }}</td>
                            <td>{{ $movement->user->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#movementsTable').DataTable({
        "order": [[ 0, "desc" ]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection