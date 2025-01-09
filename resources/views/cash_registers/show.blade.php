@extends('layouts.app')

@section('content')
<div class="container">
    <p> @include('cash_registers.nav')</p>
    <h3 class="mb-4">Détails de la Caisse #{{ $cashRegister->id }}</h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informations de la Caisse</h5>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Solde d'Ouverture:</strong>
                    <span class="float-end">{{ number_format($cashRegister->opening_balance, 2) }} BIF</span>
                </li>
                <li class="list-group-item">
                    <strong>Solde Actuel:</strong>
                    <span class="float-end">{{ number_format($cashRegister->current_balance, 2) }} BIF</span>
                </li>
                <li class="list-group-item">
                    <strong>Date de Création:</strong>
                    <span class="float-end">{{ $cashRegister->created_at->format('d/m/Y H:i:s') }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Auteur de la Création:</strong>
                    <span class="float-end">{{ optional($cashRegister->creator)->name ?? 'Inconnu' }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Date de Dernière Mise à Jour:</strong>
                    <span class="float-end">{{ $cashRegister->updated_at->format('d/m/Y H:i:s') }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Auteur de la Dernière Mise à Jour:</strong>
                    <span class="float-end">{{ optional($cashRegister->updater)->name ?? 'Inconnu' }}</span>
                </li>
            </ul>
            <a href="{{ route('cash_registers.index') }}" class="btn btn-primary mt-3">Retour à la Liste</a>
            <a href="{{ route('cash_registers.edit', $cashRegister) }}" class="btn btn-warning mt-3">Modifier</a>
        </div>
    </div>
</div>
@endsection
