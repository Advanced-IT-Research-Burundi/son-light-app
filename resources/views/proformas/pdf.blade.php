<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture Proforma {{ $proforma->number }}</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            background-color: #f9f9f9;
            margin: 20px;
            color: #333;
        }
        .header {
            margin-right: 30px;
            margin-left: 30px;
            text-align: center;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            width: 120px;
            height: auto;
        }
        .info-box {
            background-color: #e0f7fa;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: left;

        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #b2ebf2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .footer {
            position: absolute;
            bottom: 0;
            font-size: 10px;
            background-color: #e0f7fa;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
        <div class="header">
            <table>
                <tr style="text-align: center">
                    {{-- <td><img src="{{ asset('images/logo.jpeg') }}" alt="Son Light Logo" class="logo"></td> --}}
                    <h3>SON LIGHT / PAPER SERVICES</h3>
                </tr>
            </table>
        </div>

    <div class="info-box">
        <table style="border: none;">
            <tr>
                <td style="border: none"><strong>NIF :</strong> 4000652612<br><strong>RC :</strong> 06190</td>
                <td style="border: none"> <p>Travaux d'imprimerie, Fourniture du matériel, <br>Bureautique et Informatique, Sérigraphie, <br>Location des Rétroprojecteurs et Commerce général</p>
                </td>
            </tr>
        </table>

    </div>

    <h2>FACTURE PROFORMA du {{ $proforma->created_at->format('d/m/Y') }}</h2>

    <div>
        <h4>A. Identification du vendeur</h4>
        <p>
            <strong>Raison sociale :</strong> SON LIGHT<br>
            <strong>NIF :</strong> 4000652612<br>
            <strong>RC :</strong> 06190<br>
            <strong>Tél :</strong> +257 69 723 126 / 79 881 769<br>
            <strong>Commune :</strong> Mukaza, quartier Rohero2<br>
            <strong>Avenue :</strong> Avenue de la France<br>
            <strong>Assujetti à la TVA :</strong> Oui [x] Non [ ]
        </p>

        <h4>B. Le Client</h4>
        <p>
            <strong>Nom et prénom ou raison sociale :</strong> {{ $proforma->order->client->name }}<br>
            <strong>NIF :</strong> {{ $proforma->order->client->nif ?? '_________' }}<br>
            <strong>Résidence à :</strong> {{ $proforma->order->client->address ?? 'BUJA' }}<br>
            <strong>Assujetti à la TVA :</strong> Oui [ ] Non [ ]
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Nature de l'article ou service</th>
                <th>Qté</th>
                <th>PU en FBU</th>
                <th>PVHTVA en FBU</th>
                <th>TVA*</th>
                <th>TV-TVAC*</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proforma->order->detailOrders as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }}</td>
                <td>{{ number_format($detail->total_price, 2) }}</td>
                <td>{{ number_format($detail->total_price * $proforma->order->tva / 100, 2) }}</td>
                <td>{{ number_format($detail->total_price + ($detail->total_price * $proforma->order->tva / 100), 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total</strong></td>
                <td>{{ number_format($proforma->order->detailOrders->sum('total_price'), 2) }}</td>
                <td>{{ number_format($proforma->order->detailOrders->sum('total_price') * $proforma->order->tva / 100, 2) }}</td>
                <td>{{ number_format($proforma->order->detailOrders->sum('total_price') * (1 + $proforma->order->tva / 100), 2) }}</td>
            </tr>
        </tfoot>
    </table>
    <div>
        <strong>Mention obligatoire</strong><br>
        <span>NB : Les non assujettis à la TVA ne remplissent les deux dernières colonnes.</span>
    </div>

    <div class="footer">
        <p>Rohero 2, Av de France N°12, Galerie Kusta Place n°E,D,M | Tél: +257 79 881 769 (whatsapp) +257 69 723 126 / 79 732 102 | E-mail: sonlightimprimerie@gmail.com</p>
    </div>
</body>
</html>
