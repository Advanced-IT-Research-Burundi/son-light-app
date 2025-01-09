@extends('layouts.app')

@section('content')
<div class="container">
    <p> @include('cash_registers.nav')</p>
    <h3 class="mt-4">Liste des reçus</h3>
    <a href="{{ route('receipts.create') }}" class="btn btn-primary mb-3">Créer un nouveau reçu</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Montant</th>
                <th>Type</th>
                <th>Justification</th>
                <th>Demandeur</th>
                <th>Date de réception</th>
                <th>Approuvé</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receipts as $receipt)
            <tr>
                <td>{{ number_format($receipt->amount, 2) }}</td>
                <td>{{ $receipt->type }}</td>
                <td>{{ $receipt->justification }}</td>
                <td>{{ $receipt->requester->name }}</td>
                <td>{{ \Carbon\Carbon::parse($receipt->receipt_date)->format('d-m-Y H:i') }}</td>
                <td>
                    @if ($receipt->is_approved)
                        <span class="badge bg-success">Oui</span>
                    @else
                        <span class="badge bg-danger">Non</span>
                    @endif
                </td>
                <td class="d-flex align-items-center">
                    <a href="{{ route('receipts.show', $receipt) }}" class="btn btn-info me-1" title="Voir">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('receipts.edit', $receipt) }}" class="btn btn-warning me-1" title="Modifier">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('receipts.destroy', $receipt) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger me-1" title="Supprimer">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
