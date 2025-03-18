@extends('layouts.app')

@section('title', 'Gestion des factures pro forma')

@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-cart3"></i> Gestion des factures pro forma
    </h3>

    <div class="row mb-4">
        <div class="col-md-6">
            <a href="{{ route('proforma_invoices.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nouvelle facture pro forma
            </a>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('order_alllist') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-right"></i> Aller à la liste des commandes
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Liste des factures pro forma</h6>
            <div>
                <i class="bi bi-filter me-2"></i>
                <input type="text" id="search" class="form-control form-control-sm d-inline" placeholder="Recherche..." style="width: 200px;">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="proforma_invoicesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-primary">
                            <th>Ordre</th>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Société</th>
                            <th>Créé par</th>
                            <th>Date de création</th>
                            <th>Date de facturation</th>
                            <th>Total (PTVA)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @php
                    $count = 1;
                @endphp
                    <tbody>
                        @foreach($proforma_invoices as $proforma_invoice)
                        <tr>
                            <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $count }}</td>
                            <td>{{ $proforma_invoice->id }}</td>
                            <td>{{ $proforma_invoice->client->name ?? '' }}</td>
                            <td>{{ $proforma_invoice->entreprise->name ?? '' }}</td>
                            <td>{{ $proforma_invoice->user->name ?? '' }}</td>
                            <td>{{ $proforma_invoice->created_at ? $proforma_invoice->created_at->format('d/m/Y') : '____/____/202__' }}</td>
                            <td>{{ $proforma_invoice->proforma_invoice_date ? $proforma_invoice->proforma_invoice_date->format('d/m/Y') : '____/____/202__' }}</td>
                            <td>
                                @php
                                    $totalHTVA = $proforma_invoice->proformaInvoiceList->sum('total_price');
                                    $tva = $proforma_invoice->entreprise->assujeti ? ($totalHTVA * $proforma_invoice->tva / 100) : 0;
                                    $totalTVAC = $totalHTVA + $tva;
                                @endphp
                                {{ number_format($totalTVAC, 0, ',', '.') }} FBu
                            </td>
                            <td>
                                <a href="{{ route('proforma_invoices.show', $proforma_invoice->id) }}" class="btn btn-sm btn-info" title="Voir détails">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('proforma_invoices.edit', $proforma_invoice->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $proforma_invoice->id }}" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <!-- Modal de confirmation de suppression -->
                                <div class="modal fade" id="deleteConfirmationModal{{ $proforma_invoice->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $proforma_invoice->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $proforma_invoice->id }}">Confirmation de suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer cet élément de facture pro forma ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('proforma_invoices.destroy', $proforma_invoice->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @php
                        $count++;
                    @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <p>
        <br><br><br>
    </p>
</div>

@section('scripts')
<script>
$(document).ready(function() {
    // Initialise le tableau DataTables avec la recherche
    var table = $('#proforma_invoicesTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });

    // Filtrage de la recherche
    $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });
});
</script>
@endsection
@endsection
