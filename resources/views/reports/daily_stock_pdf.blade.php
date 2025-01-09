{{--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport de Stock Journalier</title>
    <style>
        /* Ajoutez votre style ici */
    </style>
</head>
<body>
    <h1>Rapport de Stock Journalier pour le {{ $data['reportDate'] }}</h1>

    <h2>Données de la Caisse</h2>
    <table>
        <thead>
            <tr>
                <th>ID Caisse</th>
                <th>Solde d'Ouverture</th>
                <th>Solde Actuel</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['cashRegisters'] as $cashRegister)
                <tr>
                    <td>{{ $cashRegister->id }}</td>
                    <td>{{ number_format($cashRegister->opening_balance, 0, ',', ' ') }} BIF</td>
                    <td>{{ number_format($cashRegister->current_balance, 0, ',', ' ') }} BIF</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Données de Billettage</h2>
    <table>
        <thead>
            <tr>
                <th>Dénomination</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['denominations'] as $denomination)
                <tr>
                    <td>{{ $denomination->denomination }} BIF</td>
                    <td>{{ $denomination->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

     <h2>Transactions pour le {{ $data['reportDate'] }}</h2>
    <p>Total des Entrées : {{ number_format($data['totalEntries'], 0, ',', ' ') }} BIF</p>
    <p>Total des Sorties : {{ number_format($data['totalExits'], 0, ',', ' ') }} BIF</p>
</body>
</html>--}}
