{{--@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Générer un Rapport de Stock Journalier</h3>

    <form action="{{ route('daily.stock') }}" method="GET">
        @csrf
        <div class="form-group">
            <label for="date">Sélectionnez une date:</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Générer Rapport</button>
    </form>

    @if(isset($data))
        <h4>Données de la Caisse pour le {{ $data['reportDate'] }}</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Caisse</th>
                    <th>Solde d'Ouverture</th>
                    <th>Solde Actuel</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['cashRegisters'] as $cashRegister)
                    <tr>
                        <td>{{ $cashRegister->id }}</td>
                        <td>{{ number_format($cashRegister->opening_balance, 0, ',', ' ') }} BIF</td>
                        <td>{{ number_format($cashRegister->current_balance, 0, ',', ' ') }} BIF</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Données de Billettage</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Dénomination</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['denominations'] as $denomination)
                    <tr>
                        <td>{{ $denomination->denomination }} BIF</td>
                        <td>{{ $denomination->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Transactions pour le {{ $data['reportDate'] }}</h4>
        <p>Total des Entrées : {{ number_format($data['totalEntries'], 0, ',', ' ') }} BIF</p>
        <p>Total des Sorties : {{ number_format($data['totalExits'], 0, ',', ' ') }} BIF</p>
    @endif
</div>
@endsection
--}}
