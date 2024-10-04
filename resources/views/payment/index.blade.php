{{--

@section('content')
payment.index template
@endsection
--}}
@extends('layouts.app')

@section('title', 'Gestion des commandes')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">
        <i class="bi bi-cash-coin"></i> Gestion des payements
    </h1>

    <div class="mb-4">
        <a href="{{ route('payments.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouvel payement
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des payements</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="paymentsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Commande</th>
                            <th>Client</th>
                            <th>Montant</th>
                            <th>Mode Payement</th>
                            <th>Date </th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @php
                        $count = 1;
                    @endphp

                    <tbody>
                        @foreach($payments as $payment)
                         <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $payment->order->designation ?? ''}}</td>
                            <td>{{ $payment->order->client->name?? ''}}</td>
                            <th>{{ $payment->amount ?? ''}}</th>
                            <td>{{ $payment->payment_method ?? ''}}</td>
                            <td>{{ $payment->payment_date }}</td>
                            <td> {{ $payment->description }}</td>

                            <td>
                                <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce Payement ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                           <!-- <td>{{ $payment->designation?? ''}}</td>-->
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
    $('#paymentsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection

