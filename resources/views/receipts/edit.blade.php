@extends('layouts.app')

@section('content')
<div class="container">
    <p> @include('cash_registers.nav')</p>
    <h3 class="my-4">Modifier le reçu</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('receipts.update', $receipt) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3 col-12">
            <label for="cash_register_id" class="form-label">
                <i class="bi bi-cash-coin"></i> Caisse
            </label>
            <select class="form-select @error('cash_register_id') is-invalid @enderror" id="cash_register_id" name="cash_register_id" required>
                <option value="">Sélectionnez une caisse</option>
                @foreach($cashs as $cashRegister)
                    <option value="{{ $cashRegister->id }}" {{ old('cash_register_id', $cash_register_id ?? '') == $cashRegister->id ? 'selected' : '' }}>
                        Caisse Numéro #{{ $cashRegister?->id }} || Montant de {{ number_format($cashRegister->opening_balance, 2) }} BIF || Créé le {{ $cashRegister->created_at->format('d/m/Y H:i:s') }} || Auteur de la création : {{ optional($cashRegister->creator)->name ?? 'Inconnu' }}
                    </option>
                @endforeach
            </select>
            @error('cash_register_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-4 col-12">
            <label for="requester_id" class="mb-2"><i class="bi bi-person-check"></i> Assigné à</label>
            <select name="requester_id" id="requester_id" class="form-control @error('requester_id') is-invalid @enderror" required>
                <option value="">Sélectionnez un requêteur</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('requester_id', $requester_id ?? '') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('requester_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="amount">Montant</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $receipt->amount }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="entry" {{ $receipt->type == 'entry' ? 'selected' : '' }}>Entrée</option>
                <option value="exit" {{ $receipt->type == 'exit' ? 'selected' : '' }}>Sortie</option>
            </select>
        </div>

        <div class="form-group">
            <label for="justification">Justification</label>
            <select class="form-control" id="justification" name="justification" required>
                <option value="with_proof" {{ $receipt->justification == 'with_proof' ? 'selected' : '' }}>Avec preuve</option>
                <option value="without_proof" {{ $receipt->justification == 'without_proof' ? 'selected' : '' }}>Sans preuve</option>
            </select>
        </div>

        <div class="form-group">
            <label for="motif">Motif (optionnel)</label>
            <textarea class="form-control" id="motif" name="motif" rows="3">{{ $receipt->motif }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('receipts.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
