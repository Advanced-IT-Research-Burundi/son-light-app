<!-- resources/views/proformas/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Factures Proforma</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Date</th>
                <th>Commande</th>
                <th>Montant Total</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proformas as $proforma)
            <tr>
                <td>{{ $proforma->number }}</td>
                <td>{{ $proforma->date }}</td>
                <td>{{ $proforma->order->id }}</td>
                <td>{{ $proforma->total_amount }}</td>
                <td>{{ $proforma->status }}</td>
                <td>
                    <a href="{{ route('proformas.show', $proforma) }}" class="btn btn-sm btn-info">Voir</a>
                    <a href="{{ route('proformas.edit', $proforma) }}" class="btn btn-sm btn-primary">Modifier</a>
                    <form action="{{ route('proformas.destroy', $proforma) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection