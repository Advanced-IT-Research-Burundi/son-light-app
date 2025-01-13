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
            margin: 20px;
            padding: 0;
            background-color: #f7f7f7;
            font-size: 12px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1, h3, h4 {
            font-weight: bold;
            color: #333;
        }
        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #337ab7;
            padding-bottom: 10px;
        }
        h3 {
            margin-top: 20px;
            font-size: 18px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #dddddd;
            padding: 5px;
            text-align: left;
            word-break: break-word;
        }
        table th {
            background-color: #337ab7;
            color: white;
            font-size: 12px;
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
                @foreach ($cashRegister->receipts as $receipt)
                    <tr>
                        <td>{{ $receipt->type === 'Exit' ? 'Sortie' : 'Entrée' }}</td>
                        <td>{{ number_format($receipt->amount, 2, ',', '.') }} BIF</td>
                        <td>{{ \Carbon\Carbon::parse($receipt->receipt_date)->format('d/m/Y H:i') }}</td>
                        <td>{{ $receipt->requester->name }}</td>
                        <td>{{ $receipt->creator->name }}</td>
                        <td>{{ optional($receipt->approver)->name }}</td>
                        <td>{{ $receipt->justification === 'With_proof' ? 'Avec justification' : 'Sans justification' }}</td>
                        <td>{{ $receipt->motif }}</td>
                        <td>{{ $receipt->is_approved ? 'Oui' : 'Non' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
