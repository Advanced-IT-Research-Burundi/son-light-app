@extends('layouts.app')

@section('content')
@section('title', 'Gestion des commandes')
@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-cart3"></i> Gestion des factures clients
    </h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des factures client</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="ordersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Num facture</th>
                            <th>Num commande</th>
                             <th>Client</th>
                            <th>Societe fact</th>
                            
                            <th>Date creation</th>
                            <th>Date d'echeance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @php
                        $count = 1;
                    @endphp
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $invoice->number ?? ''}}</td>
                            <td>{{ $invoice->order_id}}</td>
                            <td>{{ $invoice->order->client?->name}}</td>
                            <td>{{ $invoice->order->entreprise->name}}</td>
                            <td>{{ $invoice->created_at}}</td>
                            <td>{{ $invoice->due_date}}</td>
                            {{-- <td>{{ $invoice->date->format('d/m/Y') }}</td>
                            <td>{{ $invoice->due_date->format('d/m/Y') }}</td> --}}
                            <td>
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>


                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $invoice->id }}">
                                    <i class="bi bi-trash"></i>
                                  </button>
                                      <!-- Composant modal -->
                                    @include('components.delete-confirmation-modal', [
                                        'id'=>  $invoice->id,
                                        'route'=> 'invoices.destroy',
                                        'title' => 'Confirmation de suppression',
                                        'message' => 'Êtes-vous sûr de vouloir supprimer cette commande ?',
                                        'confirmText' => 'Supprimer'
                                    ])

                            </td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
                <div class="mb-4">
                  <a href="{{ route('order_alllist')}}" class="btn btn-primary">
                   <i class="bi bi-arrow-left"></i> Retour à la liste des commandes</a>
                </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>

$(document).ready(function() {
    $('#ordersTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection
