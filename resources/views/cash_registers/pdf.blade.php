<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Caisse {{ $cashRegister->id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
            font-size: 14px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1, h3 {
            font-weight: bold;
            color: #333;
        }
        h1 {
            font-size: 28px;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #337ab7;
            padding-bottom: 10px;
        }
        h3 {
            margin-top: 20px;
            font-size: 22px;
            color: #337ab7;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
        }
        table th, table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
            word-break: break-word;
        }
        table th {
            background-color: #337ab7;
            color: white;
            font-size: 14px;
        }
        .total {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .text-success {
            color: #28a745;
        }
        .text-danger {
            color: #dc3545;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #777;
        }
        @media print {
            .container {
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Détails de la Caisse #{{ $cashRegister->id }}</h1>
        <div>
            <h3>Informations de la Caisse</h3>
            <p><strong>Solde Ouverture :</strong> <span class="text-success">{{ number_format($cashRegister->opening_balance, 2, ',', '.') }} BIF</span></p>
            <p><strong>Solde Actuel :</strong> <span class="text-success">{{ number_format($cashRegister->current_balance, 2, ',', '.') }} BIF</span></p>
            <p><strong>Dénominations Totales :</strong> <span class="text-success">{{ number_format($totalDenominations, 2, ',', '.') }} BIF</span></p>
        </div>

        <h3>Dénominations</h3>
        <table>
            <thead>
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
                <tr class="total">
                    <td colspan="2" class="text-right">Total Dénominations :</td>
                    <td>{{ number_format($totalDenominationAmount, 2, ',', '.') }} BIF</td>
                </tr>
            </tbody>
        </table>

        <h3>Reçus</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 10%;">Type</th>
                    <th style="width: 10%;">Montant</th>
                    <th style="width: 20%;">Date & Heure</th>
                    <th style="width: 15%;">Demandeur</th>
                    <th style="width: 15%;">Créé par</th>
                    <th style="width: 15%;">Approuvé par</th>
                    <th style="width: 10%;">Justification</th>
                    <th style="width: 10%;">Motif</th>
                    <th style="width: 10%;">Validation</th>
                </tr>
            </thead>
            <tbody>
                @php $totalEntrées = 0; $totalSorties = 0; @endphp
                @foreach ($cashRegister->receipts as $receipt)
                    @php
                        $total = $receipt->amount;
                        if ($receipt->type === 'entry') {
                            $totalEntrées += $total;
                        } else {
                            $totalSorties += $total;
                        }
                    @endphp
                    <tr>
                        <td>{{ $receipt->type === 'exit' ? 'Sortie' : 'Entrée' }}</td>
                        <td>{{ number_format($total, 2, ',', '.') }} BIF</td>
                        <td>{{ \Carbon\Carbon::parse($receipt->receipt_date)->format('d/m/Y H:i') }}</td>
                        <td>{{ $receipt->requester->name }}</td>
                        <td>{{ $receipt->creator->name }}</td>
                        <td>{{ optional($receipt->approver)->name }}</td>
                        <td>{{ $receipt->justification === 'with_proof' ? 'Avec justification' : 'Sans justification' }}</td>
                        <td>{{ $receipt->motif }}</td>
                        <td>{{ $receipt->is_approved ? 'Oui' : 'Non' }}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td colspan="1" class="text-right">Total Entrées :</td>
                    <td>{{ number_format($totalEntrées, 2, ',', '.') }} BIF</td>
                    <td colspan="7"></td>
                </tr>
                <tr class="total">
                    <td colspan="1" class="text-right">Total Sorties :</td>
                    <td>{{ number_format($totalSorties, 2, ',', '.') }} BIF</td>
                    <td colspan="7"></td>
                </tr>
                <tr class="total">
                    <td colspan="1" class="text-right">Solde Calculé :</td>
                    <td>{{ number_format($cashRegister->opening_balance + $totalEntrées - $totalSorties, 2, ',', '.') }} BIF</td>
                    <td colspan="7"></td>
                </tr>
                <tr class="total">
                    <td colspan="1" class="text-right">Différence avec Solde Actuel :</td>
                    <td class="{{ ($cashRegister->current_balance == $cashRegister->opening_balance + $totalEntrées - $totalSorties) ? 'text-success' : 'text-danger' }}">
                        {{ number_format($cashRegister->current_balance - ($cashRegister->opening_balance + $totalEntrées - $totalSorties), 2, ',', '.') }} BIF
                    </td>
                    <td colspan="7"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
