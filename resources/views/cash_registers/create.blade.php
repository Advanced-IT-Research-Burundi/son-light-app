@extends('layouts.app')

@section('content')
<div class="container">
    <p> @include('cash_registers.nav')</p>
    <h3 class="mb-4">Créer une Caisse</h3>
    <form action="{{ route('cash_registers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="opening_balance">Solde d'Ouverture</label>
            <input type="number" name="opening_balance" class="form-control" id="opening_balance" step="0.01" required>
            @error('opening_balance')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mt-3">Créer la Caisse</button>
        <a href="{{ route('cash_registers.index') }}" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
@endsection
