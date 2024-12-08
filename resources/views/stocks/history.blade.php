<!-- resources/views/stocks/history.blade.php -->

@extends('layouts.app')

@section('title', 'Historique du stock - ' . $stock->product_name)

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h3>
            <i class="bi bi-clock-history"></i> Historique du stock : {{ $stock->product_name }}
        </h3>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <i class="bi bi-box-arrow-in-down"></i> Entrées de stock
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Quantité</th>
                                <th>Fournisseur</th>
                                <th>Notes</th>
                                <th>Utilisateur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entries as $entry)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($entry->entry_date)->format('d/m/Y') }}</td>
                                    <td>{{ $entry->quantity_entered }}</td>
                                    <td>{{ $entry->supplier ?? 'N/A' }}</td>
                                    <td>{{ $entry->entry_notes ?? '-' }}</td>
                                    <td>{{ $entry->user->name ?? 'N/A'}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune entrée</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-danger text-white">
                    <i class="bi bi-box-arrow-out-up"></i> Sorties de stock
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Quantité</th>
                                <th>Destination</th>
                                <th>Notes</th>
                                <th>Utilisateur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($exits as $exit)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($exit->exit_date)->format('d/m/Y') }}</td>
                                    <td>{{ $exit->quantity_exited }}</td>
                                    <td>{{ $exit->destination ?? 'N/A' }}</td>
                                    <td>{{ $exit->exit_notes ?? '-' }}</td>
                                    <td>{{ $entry->user->name ?? 'N/A'}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune sortie</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




