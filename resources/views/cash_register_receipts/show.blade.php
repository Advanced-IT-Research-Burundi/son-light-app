@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Détails du Bon de Sortie de Caisse</h3>

    <div>
        <strong>ID:</strong> {{ $receipt->id }}<br>
        <strong>Requérant:</strong> {{ $receipt->requerant->name }}<br>
        <strong>Caissier:</strong> {{ $receipt->user->name }}<br>
        <strong>DAF:</strong> {{ $receipt->approbation->name }}<br>
        <strong>Montant:</strong> {{ $receipt->amount }}<br>
        <strong>Motif:</strong> {{ $receipt->motif }}<br>
        <strong>Note de validation:</strong> {{ $receipt->note_validation }}<br>
        <strong>Date de création:</strong> {{ $receipt->cash_register_receipts_date }}<br>
        <strong>Date d'approbation:</strong> {{ $receipt->cash_register_receipts_approbation_date }}<br>
    </div>
    <p></p>
    
    <div class="card shadow mb-4 ">
        <div class="card-body">
                <div class="card-body">
    <h6 class="m-0 font-weight-bold text-primary">Approuve cette demande </h6>
     <div class="row">
        <p></p>
     </div>
   <form action="{{ route('addNoteValidation', $receipt->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
       <div class="form-group col-12">
            <label for="cash_register_receipts_approbation_date">Date d'approbation</label>
            <input type="datetime-local" name="cash_register_receipts_approbation_date" class="form-control" 
                value="{{ $receipt->cash_register_receipts_approbation_date ? \Carbon\Carbon::parse($receipt->cash_register_receipts_approbation_date)->format('Y-m-d\TH:i') : '' }}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label for="note_validation">Note de validation</label>
            <textarea name="note_validation" class="form-control">{{ $receipt->note_validation }}</textarea>
        </div>
        <div class="form-group mb-3 col-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> Valider
            </button>
            <a href="{{ route('cash_register_receipts.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-lg"></i> Annuler
            </a>
        </div>
    </div>
</form>
    </div>
    </div>
      </div>


    <a href="{{ route('cash_register_receipts.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection