<!-- resources/views/proformas/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>Liste de Factures Proforma </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="ProformaTable" width="100%" cellspacing="0">

        <thead>
            <tr>
                <th>Numéro</th>
                <th>Date</th>
                <th>Commande</th>
                <th>Créé le :</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach($proformas as $proforma)
            <tr>
                <td>{{ $proforma->number }}</td>
                <td>{{ $proforma->date }}</td>
                <td>{{ $proforma->order->designation }}</td>
                <td>{{ $proforma->created_at }}</td>
                <td>{{ $proforma->status }}</td>
                <td>
                    <a href="{{ route('proformas.show', $proforma) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-eye"></i>
                    </a>
                    {{-- printer --}}

                    <a href="{{ route('invoices.create', $proforma) }}" class="btn btn-sm btn-secondary">
                        {{-- <i class="bi bi-printer-fill"></i> --}}
                        <i class="bi bi-printer"></i>
                    </a>
                    <a href="{{ route('orders.show', $proforma->order->id) }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('proformas.destroy', $proforma) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
    </div>

    @if ($proformas->count() < 1)
        <a href="{{ route('proformas.create', $order_id) }}" class="btn btn-primary">Créer la facture proforma</a>
    @endif

    <a href="{{ route('orders.show', $order_id) }}" class="btn btn-secondary">Annuler</a>
</div>

@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#ProformaTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection
