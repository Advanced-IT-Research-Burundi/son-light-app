<!-- resources/views/stocks/index.blade.php -->

@extends('layouts.app')

@section('title', 'Gestion des stocks')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">
        <i class="bi bi-box-seam"></i> Gestion des stocks
    </h1>

    <div class="mb-4">
        <a href="{{ route('stocks.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un produit
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des produits en stock</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="stocksTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>CODE</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Unité</th>
                            <th>Quantité minimale</th>
                            <th>Dernière mise à jour</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $stock)
                        <tr class="{{ $stock->quantity <= $stock->min_quantity ? 'table-danger' : '' }}">
                            <td>{{ $stock->code }}</td>
                            <td>{{ $stock->product_name }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->unit }}</td>
                            <td>{{ $stock->min_quantity }}</td>
                            <td>{{ $stock->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('stocks.show', $stock->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addStockModal" data-stock-id="{{ $stock->id }}">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#removeStockModal" data-stock-id="{{ $stock->id }}">
                                    <i class="bi bi-dash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('stocks._add_stock_modal')
@include('stocks._remove_stock_modal')
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#stocksTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });

    $('#addStockModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var stockId = button.data('stock-id');
        var modal = $(this);
        modal.find('#addStockId').val(stockId);
    });

    $('#removeStockModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var stockId = button.data('stock-id');
        var modal = $(this);
        modal.find('#removeStockId').val(stockId);
    });
});
</script>
@endsection
