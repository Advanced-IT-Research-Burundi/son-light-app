<!-- resources/views/stocks/index.blade.php -->

@extends('layouts.app')

@section('title', 'Gestion des stocks')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h3>
            <i class="bi bi-box-seam"></i> Gestion des stocks
        </h3>
        <div>
            <a href="{{ route('stocks.create') }}" class="btn btn-primary me-2">
                <i class="bi bi-plus-circle"></i> Nouveau produit
            </a>
            <a href="{{ route('stocks.createEntry') }}" class="btn btn-success me-2">
                <i class="bi bi-box-arrow-in-down"></i> Entrée stock
            </a>
            <a href="{{ route('stocks.createExit') }}" class="btn btn-danger">
                <i class="bi bi-box-arrow-out-up"></i> Sortie stock
            </a>
        </div>
    </div>
{{--
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="StockTable">
                    <thead class="table-light">
                        <tr>
                            <th>Nom du produit</th>
                            <th>Code</th>
                            <th>Quantité</th>
                            <th>Unité</th>
                            <th>Stock minimal</th>
                            <th>Dernière entrée</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stocks as $stock)
                            <tr class="{{ $stock->quantity <= $stock->min_quantity ? 'table-warning' : '' }}">
                                <td>{{ $stock->product_name }}</td>
                                <td>{{ $stock->code }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->unit }}</td>
                                <td>{{ $stock->min_quantity }}</td>
                                <td>{{ $stock->last_restock_date ? \Carbon\Carbon::parse($stock->last_restock_date)->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $stock->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun produit en stock</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($stocks as $stock)

    <div class="modal fade" id="deleteModal{{ $stock->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $id ?? '' }}">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <h5 class="modal-title">Confirmation de suppression</h5>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    Voulez-vous vraiment supprimer le produit "{{ $stock->product_name }}" ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i> Annuler
                    </button>

                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display: inline-block;" class="delete-form">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger" >
                            <i class="bi bi-trash me-2"></i> Supprimer
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endforeach
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
    $('#StockTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endpush
