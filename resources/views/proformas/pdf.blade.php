<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture Proforma {{ $proforma->number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: left;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
            height: auto;
        }
        .info-box {
            background-color: #f0f0f0;
            padding: 5px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Son Light Logo" class="logo">

    </div>

    <div class="info-box flex justify-between">
        <div>
            NIF : 4000652612<br>
            RC : 06190<br>
        </div>
        <div>
            Travaux d'imprimerie, Fourniture du matériel<br>
            Bureautique et Informatique, Sérigraphie<br>
            Location des Rétroprojecteurs et Commerce général
        </div>

    </div>

    <h2>FACTURE PROFORMA du {{ $proforma->created_at->format('d/m/Y') }}</h2>

    <div>
        <h4>A. Identification du vendeur</h4>
        <p>
            <strong>Raison sociale</strong> : SON LIGHT PAPER SERVICES<br>
            <strong>NIF</strong> : 4000652612<br>
            <strong>RC</strong> : 06190<br>
            <strong>Tél</strong> : +257 69 723 126/ 79 881 769<br>
            <strong>Commune</strong> :  Mukaza, quartier Rohero2<br>
            <strong>Avenue</strong> :  Avenue de la France<br>
            <strong>Assujetti à la TVA </strong> : : Oui [x] Non [ ]

        </p>

        <h4>B. Le Client</h4>
        <p>
            <strong>Nom et prénom ou raison sociale</strong> : {{ $proforma->order->client->name }}<br>
            <strong>NIF</strong> : {{ $proforma->order->client->nif ?? '_________' }}<br>
            <strong>Résidence à</strong> : {{ $proforma->order->client->address ?? 'BUJA' }}<br>
            <strong>Assujetti à la TVA</strong> : Oui [ ] Non [ ]
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

    <div class="footer">
        <p>Mention obligatoire</p>
        <p>NB : Les non assujettis à la TVA ne remplissent les deux dernières colonnes.</p>
        <p>Rohero 2, Av de France N°12 ,Galerie Kusta Place n°E,D,M<br>
        Tél: +257 79 881 769 (whatsapp) +257 69 723 126 / 79 732 102<br>
        E-mail: sonlightimprimerie@gmail.com</p>
    </div>
</body>
</html>
