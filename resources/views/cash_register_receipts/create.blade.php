@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Créer un Bon de Sortie de Caisse</h3>
    <form action="{{ route('cash_register_receipts.store') }}" method="POST">
        @csrf
      <div class="row">
         <div class="form-group col-6">
            <label for="requerant_id">Requérant</label>
            <select name="requerant_id" id="requerant_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-6">
            <label for="user_id">Caissier</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="row">
      <div class="form-group col-6">
            <label for="approbation_id">DAF</label>
            <select name="approbation_id" id="approbation_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-6">
            <label for="amount">Montant</label>
            <input type="number" name="amount" class="form-control" required>
        </div>
      </div>
      
{{--
      <div class="row">
           <div class="form-group col-6">
            <label for="cash_register_receipts_approbation_date">Date d'approbation</label>
            <input type="datetime-local" name="cash_register_receipts_approbation_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="note_validation">Note de validation</label>
            <textarea name="note_validation" class="form-control"></textarea>
        </div>
--}}
        <div class="form-group col-6">
            <label for="cash_register_receipts_date">Date de création</label>
            <input type="datetime-local" name="cash_register_receipts_date" class="form-control" required>
        </div>
      </div>
       <div class="form-group">
            <label for="motif">Motif</label>
            <input type="text" name="motif" class="form-control" required>
        </div>
       <p></p>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
          <a href="{{ route('cash_register_receipts.index')}}"  class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
          </a>
    </form>
</div>
@endsection