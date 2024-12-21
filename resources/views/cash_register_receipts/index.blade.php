@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Liste des Bon de sortie Caisse</h3>
    <a href="{{ route('cash_register_receipts.create') }}" class="btn btn-primary">Créer un nouveau Bon de sortie</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Requérant</th>
                <th>Caissier</th>
                <th>DAF</th>
                <th>Montant</th>
                <th>Motif</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receipts as $receipt)
                <tr>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->requerant->name }}</td>
                    <td>{{ $receipt->user->name }}</td>
                    <td>{{ $receipt->approbation->name }}</td>
                    <td>{{ $receipt->amount }}</td>
                    <td>{{ $receipt->motif }}</td>
                    <td>{{ $receipt->cash_register_receipts_date }}</td>
                    <td>
                        <a href="{{ route('cash_register_receipts.show', $receipt->id) }}" class="btn btn-info">  <i class="bi bi-eye"></i></a>
                        <a href="{{ route('cash_register_receipts.edit', $receipt->id) }}" class="btn btn-warning"> <i class="bi bi-pencil"></i></a>
                        <form action="{{ route('cash_register_receipts.destroy', $receipt->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">  <i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection