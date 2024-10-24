<!-- resources/views/orders/index.blade.php -->

@extends('layouts.app')
@section('title', 'Gestion des factures proforma')
@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-cart3"></i> Gestion des factures proforma
    </h3>
     <div class="row">
     <div class="mb-4 col-3">
        <a href="{{ route('proforma_invoices.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouvelle facture proforma
        </a>
    </div>
     </div>
   

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des factures proforma</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="proforma_invoicesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Num. Fac.Proforma</th>
                            <th>Client</th>
                            <th>SOCIETE</th>
                            <th>Désigation</th>
                            <th>P.U</th>
                            <th>Qté</th>
                            <th>PVHTVA en FBu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @php
                        $count = 1;
                    @endphp
                    <tbody>
                        @foreach($proforma_invoices as $proforma_invoice)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $proforma_invoice->client->name }}</td>
                            <td>{{ $proforma_invoice->entreprise->name ?? ''}}</td>
                            <td>{{ $proforma_invoice->designation?? ''}}</td>
                            <th>{{ $proforma_invoice->amount ?? ''}}</th>
                            <td>{{ $proforma_invoice->quantity ?? ''}}</td>
                            <td>{{ number_format($proforma_invoice->amount * $proforma_invoice->quantity, 2, ',', ' ')??'' }} FBu</td>
                            {{-- <td>{{ number_format($proforma_invoice->amount, 2, ',', ' ') }} FBu</td> --}}
                            {{-- <td>
                            </td> --}}
                            <td>
                                <a href="{{ route('proforma_invoices.show', $proforma_invoice->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('proforma_invoices.edit', $proforma_invoice->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('proforma_invoices.destroy', $proforma_invoice->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet element de facture proforma ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
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
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#proforma_invoicesTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection