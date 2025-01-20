@extends('layouts.app')

@section('content')
<div class="container">
    <p> @include('cash_registers.nav')</p>
    <h3 class="mb-4"><i class="bi bi-receipt"></i> Détails des Reçus de la Caisse #{{ $cashRegister->id }}</h3>

    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Solde de Clôture</h5>
        </div>
        <div class="card-body">
            <h5>Solde d'Ouverture : <span class="text-success">{{ number_format($cashRegister->opening_balance, 2, ',', '.') }} BIF</span></h5>
            <h5>Solde Actuel : <span class="text-success">{{ number_format($cashRegister->current_balance, 2, ',', '.') }} BIF</span></h5>
            <h5>Dénominations Totales : <span class="text-success">{{ number_format($totalDenominations, 2, ',', '.') }} BIF</span></h5>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Résumé Financier</h5>
        </div>
        <div class="card-body">
            <h5>Total des Entrées : <span class="text-success">{{ number_format($totalEntries, 2, ',', '.') }} BIF</span></h5>
            <h5>Total des Sorties : <span class="text-danger">{{ number_format($totalExits, 2, ',', '.') }} BIF</span></h5>
            <h5>Solde Net (Entrées - Sorties) :
                <span class="{{ ($totalEntries - $totalExits >= 0) ? 'text-success' : 'text-danger' }}">
                    {{ number_format($totalEntries - $totalExits, 2, ',', '.') }} BIF
                </span>
            </h5>
            <h5>Solde Calculé : <span class="text-success">{{ number_format($cashRegister->opening_balance + $totalEntries - $totalExits, 2, ',', '.') }} BIF</span></h5>
            <h5>Différence avec Solde Actuel :
                <span class="{{ ($cashRegister->current_balance == $cashRegister->opening_balance + $totalEntries - $totalExits) ? 'text-success' : 'text-danger' }}">
                    {{ number_format($cashRegister->current_balance - ($cashRegister->opening_balance + $totalEntries - $totalExits), 2, ',', '.') }} BIF
                </span>
            </h5>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Dénominations du Solde de Clôture</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Dénomination (BIF)</th>
                        <th>Quantité</th>
                        <th>Total (BIF)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalDenominationAmount = 0; @endphp
                    @foreach ($cashRegister->denominations as $denomination)
                        @php $total = $denomination->denomination * $denomination->quantity; @endphp
                        <tr>
                            <td>{{ number_format($denomination->denomination, 0, ',', '.') }}</td>
                            <td>{{ $denomination->quantity }}</td>
                            <td>{{ number_format($total, 2, ',', '.') }} BIF</td>
                        </tr>
                        @php $totalDenominationAmount += $total; @endphp
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-right font-weight-bold">Total Dénominations :</td>
                        <td class="font-weight-bold">{{ number_format($totalDenominationAmount, 2, ',', '.') }} BIF</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Reçus</h5>
        </div>
        <div class="card-body">
            @if($cashRegister->receipts->isEmpty())
                <p>Aucun reçu enregistré.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Type</th>
                            <th>Montant</th>
                            <th>Date & Heure</th>
                            <th>Demandeur</th>
                            <th>Créé par</th>
                            <th>Approuvé par</th>
                            <th>Justification</th>
                            <th>Motif</th>
                            <th>Validation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cashRegister->receipts as $receipt)
                            <tr>
                                <td>{{ $receipt->type === 'exit' ? 'Sortie' : 'Entrée' }}</td>
                                <td>{{ number_format($receipt->amount, 0, ',', '.') }} BIF</td>
                                <td>{{ \Carbon\Carbon::parse($receipt->receipt_date)->format('d/m/Y H:i') ?? 'Pas d\'information' }}</td>
                                <td>{{ $receipt->requester->name ?? 'Pas d\'information' }}</td>
                                <td>{{ $receipt->creator->name ?? 'Pas d\'information' }}</td>
                                <td>{{ optional($receipt->approver)->name ?? 'Pas d\'information' }}</td>
                                <td>{{ $receipt->justification === 'with_proof' ? 'Avec justification' : 'Sans justification' }}</td>
                                <td>{{ $receipt->motif ?? 'Pas d\'information' }}</td>
                                <td>{{ $receipt->is_approved ? 'Oui' : 'Non' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body text-center">
            <a href="{{ route('cash_registers.index') }}" class="btn btn-primary mt-3">Retour à la Liste</a>
            <a href="{{ route('cash_registers.pdf', $cashRegister) }}" class="btn btn-primary mt-3">Générer PDF</a>
        </div>
    </div>
</div>
@endsection
