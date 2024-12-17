@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un reçu de caisse</h1>
    <form action="{{ route('cash_register_receipts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="requerant_id">Requérant</label>
            <select name="requerant_id" id="requerant_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">Caissier</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="approbation_id">DAF</label>
            <select name="approbation_id" id="approbation_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Montant</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="motif">Motif</label>
            <input type="text" name="motif" class="form-control" required>
        </div>
{{--
        <div class="form-group">
            <label for="note_validation">Note de validation</label>
            <textarea name="note_validation" class="form-control"></textarea>
        </div>
--}}
        <div class="form-group">
            <label for="cash_register_receipts_date">Date de création</label>
            <input type="datetime-local" name="cash_register_receipts_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cash_register_receipts_approbation_date">Date d'approbation</label>
            <input type="datetime-local" name="cash_register_receipts_approbation_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection