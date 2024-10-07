<!-- resources/views/proformas/pdf.blade.php -->
<!DOCTYPE html>
<html lang="Fr Bu">
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
        <p><strong>Date :</strong> {{ $proforma->date }}</p>
        <p><strong>Validité :</strong> {{ $proforma->validity_period }} jours</p>
        <p><strong>Client :</strong> {{ $proforma->order->client->name }}</p>
        <p><strong>Entreprise :</strong> {{ $proforma->order->entreprise->name ??'' }}</p>
    </div>

    @php
        $count = 1;
        $total = 0;
        $tva = 0;
        $totaltva = 0;
    @endphp
    <table>
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total HT</th>
                <th>TVA</th>
                <th>Prix total TVAC</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proforma->order->detailOrders as $detail)
            <tr>
            <td>{{ $count}}</td>
            <td>{{ $detail->product_name }}</td>
            <td>{{ $detail->quantity }}</td>
            <td>{{ number_format($detail->unit_price, 2) }} Fr Bu</td>
            <td>{{ number_format($detail->total_price, 2) }} Fr Bu</td>
            <td>{{ $detail->total_price * $proforma->order->tva / 100 }} Fr Bu</td>
                <td>{{ number_format( ($detail->total_price + ($detail->total_price * $proforma->order->tva / 100)), 2) }} Fr Bu</td>
            </tr>

            @php
                $count++;
                $total += $detail->total_price;
                $tva += $detail->total_price * $proforma->order->tva / 100;
                $totaltva += ($detail->total_price + ($detail->total_price * $proforma->order->tva / 100));
            @endphp
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total HT :</strong> {{ number_format($total, 2) }} Fr Bu</p>
        <p><strong>TVA ({{ $proforma->order->tva }} % ) :</strong> {{ number_format($tva, 2) }} Fr Bu</p>
        <p><strong>Total TTC :</strong> {{ number_format($totaltva , 2) }} Fr Bu</p>
    </div>

    <div class="footer">
        <p>Cette facture proforma est valable jusqu'au {{ (new DateTime($proforma->date))->add(new DateInterval('P' . $proforma->validity_period . 'D'))->format('d/m/Y') }}.</p>
    </div>
</body>
</html>
