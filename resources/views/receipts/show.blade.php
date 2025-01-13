@extends('layouts.app')

@section('content')
<div class="container">
    <p> @include('cash_registers.nav')</p>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (auth()->user()->isAdmin() && !$receipt->is_approved)
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Approbation du reçu</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('receipts.approve', $receipt) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="validation_note" class="form-label">Note de validation</label>
                    <input type="text" id="validation_note" name="validation_note" class="form-control" placeholder="Entrez votre note de validation" required>
                </div>

                <div class="alert alert-warning" role="alert">
                    <strong>Attention!</strong> Êtes-vous sûr de vouloir approuver ce reçu ? Cette action est irréversible.
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Approuver ce reçu
                </button>
                <a href="{{ route('receipts.index') }}" class="btn btn-secondary ms-2">Annuler</a>
            </form>
        </div>
    </div>
@endif
<h3 class="my-4">Détails du reçu</h3>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Informations sur le reçu</h5>
        </div>
        <div class="card-body">
            <p><strong>Montant :</strong> {{ number_format($receipt->amount, 2) }} BIF</p>
            <p><strong>Type :</strong> {{ $receipt->type === 'Exit' ? 'Sortie' : 'Entrée' }}</p>
            <p><strong>Justification :</strong>{{ $receipt->justification === 'With_proof' ? 'Avec justification' : 'Sans justification' }}</p>
            <p><strong>Motif :</strong> {{ $receipt->motif ?? 'Non précisé' }}</p>
            <p><strong>Date de réception :</strong> {{ \Carbon\Carbon::parse($receipt->receipt_date)->format('d-m-Y H:i') }}</p>
            <p><strong>Approuvé :</strong> {{ $receipt->is_approved ? 'Oui' : 'Non' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Intervenants</h5>
        </div>
        <div class="card-body">
            <p><strong>Demandeur :</strong> {{ $receipt->requester->name }}</p>
            <p><strong>Créé par :</strong> {{ $receipt->creator->name }}</p>
            <p><strong>Dernière mise à jour par :</strong> {{ $receipt->updater->name }}</p>
            <p><strong>Approuvé par :</strong> {{ $receipt->approver ? $receipt->approver->name : 'Non approuvé' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Dates importantes</h5>
        </div>
        <div class="card-body">
            <p><strong>Date de création :</strong> {{ $receipt->created_at->format('d-m-Y H:i') }}</p>
            <p><strong>Date de mise à jour :</strong> {{ $receipt->updated_at->format('d-m-Y H:i') }}</p>
            <p><strong>Date d'approbation :</strong> {{$receipt->approval_date ? \Carbon\Carbon::parse($receipt->approval_date)->format('d-m-Y H:i') : 'Non approuvé' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Notes de validation</h5>
        </div>
        <div class="card-body">
            <p><strong>Note de validation :</strong> {{ $receipt->validation_note ?? 'Aucune note de validation' }}</p>
        </div>
    </div>

    <div class="text-end">
        <a href="{{ route('receipts.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>
@endsection
