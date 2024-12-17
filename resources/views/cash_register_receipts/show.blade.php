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

    <a href="{{ route('cash_register_receipts.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection