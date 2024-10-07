<!-- resources/views/proformas/pdf.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture Proforma {{ $proforma->number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Facture Proforma</h1>
        <p>Numéro : {{ $proforma->number }}</p>
    </div>

    <div class="info">
        <p><strong>Date :</strong> {{ $proforma->date->format('d/m/Y') }}</p>
        <p><strong>Validité :</strong> {{ $proforma->validity_period }} jours</p>
        <p><strong>Client :</strong> {{ $proforma->order->client->name }}</p>
        <p><strong>Entreprise :</strong> {{ $proforma->order->company->name }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proforma->order->detailOrders as $detail)
            <tr>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }} €</td>
                <td>{{ number_format($detail->total_price, 2) }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total HT :</strong> {{ number_format($proforma->total_amount, 2) }} €</p>
        <p><strong>TVA (20%) :</strong> {{ number_format($proforma->total_amount * 0.2, 2) }} €</p>
        <p><strong>Total TTC :</strong> {{ number_format($proforma->total_amount * 1.2, 2) }} €</p>
    </div>

    <div class="footer">
        <p>Cette facture proforma est valable jusqu'au {{ $proforma->date->addDays($proforma->validity_period)->format('d/m/Y') }}.</p>
    </div>
</body>
</html>