<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUFI</title>
       <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: black;
            padding: 0px;
        }

        header {
            background-color: #f9e79f;
            border: 1px solid black;
            border-radius: 15px;
            margin-bottom: 5px;
            text-align: center;
            padding-left: 10px;
            padding-right: 5px;
            padding-bottom: 60px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .header_left{
            font-weight: 300;
            font-size: large;
            float: left;
            margin-left: 40px;
        }

        .title {
            font-size: 3rem;
            font-weight: 400;
            margin: 0;
            text-decoration: underline;
        }

        .header_info {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin: 20px 0;
        }

        .header_info div {
            flex: 1;
            text-align: left;
        }

        .header_info h5 {
            margin: 5px 0;
            font-size: 1em;
            text-align: left;
        }

        .header_right {
            font-weight: 300;
            font-size: large;
            text-align: left;
            float: right;
            margin-right: 40px;
        }
        .header_right ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .header_right li {
            margin: 2px 0;
        }

        .border_header {
            margin-top: 10px;
            margin-bottom: 0px;
            text-align: left;
            font-size: 1.2em;
            font-weight: bold;
            color: black;
        }

        .border-text {
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0px 0;
        }

        th, td {
            border: 1px solid black;
            padding: 3px;
            text-align: left;
        }

        @media print {
            body {
                padding: 0;
            }

            header, .border-text, footer {
                page-break-inside: avoid;
            }

            .header_info {
                display: block;
            }

            .header_info div {
                text-align: left;
                margin: 10px 0;
            }
        }

        @media (max-width: 600px) {
            .header_info {
                flex-direction: column;
                align-items: flex-start;
            }

            .header_info div {
                text-align: left;
                margin: 10px 0;
            }

            table {
                font-size: 0.9em;
            }
        }
        .footer {
            position: absolute;
            bottom: 0;
            font-size: 15px;
            color: red;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="title">BUFI TECHNOLOGIES</h1>
        <div class="header_info">
            <div class="header_left">
                <h5>NIF: 4001934464</h5>
                <h5>RC: 35991/22</h5>
            </div>
            <div class="header_right">
                <ul>

                    <li>Services Informatiques</li>
                    <li>Imprimerie - Sérigraphie</li>
                    <li>Location des matériels pour les Evénements</li>
                </ul>
            </div>
        </div>
    </header>
      <div style=" padding:0; margin:0; font-size: 12px;" >
            <p></p>
            <h2 style=" padding:0; margin:0;">Facture N<sup>o</sup> {{ $invoice->number }} du {{ $invoice->created_at->format('d/m/Y') }}<br>
            <strong style="font-size: 14px;">A. Identification du vendeur</strong></h2>
            <p  style="padding:0; margin:0;">
            <strong>Raison sociale : </strong> BUFI TECHNOLOGIES<br>
            <strong>NIF :</strong>  4001934464 <br>
            <strong>RC :</strong> 35991/22 <br>
            <strong>Commune :</strong> Mukaza, quartier Rohero 1 Centre-ville <br>
            <strong>Assujetti à la TVA :</strong>[  ]Oui  [ X ]Non
            </p>
        <h3  style=" padding:0; margin:0;">B. Le Client</h3>
        <p style=" padding:0; margin:0;">
            <strong>Nom et prénom ou raison sociale :</strong> {{ $invoice->order->client?->name }}<br>
            <strong>NIF :</strong> {{ $invoice->order->client->nif ?? '_________' }}<br>
            <strong>Résidence à :</strong> {{ $invoice->order->client->address ?? 'BUJA' }}<br>
            <strong>Assujetti à la TVA :</strong> [ {{ $invoice->order->client->assujeti?'X':' ' }}]Oui   [{{ $invoice->order->client->assujeti?' ':'X' }}]Non <br>
            <strong>Doit ce qui suit: </strong>
        </p>
    </div>
    <div class="border-text">
        <table  style=" padding:0; margin:0;">
            <tr>
                <th>ORDRE</th>
                <th>Nature de l'article ou service</th>
                  <th>Unité</th>
                     <th>Qté</th>
                <th>P.U en FBU</th>
                <th>PVHTVA en FBU</th>
            </tr>
            @foreach($invoice->order->detailOrders as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->unit }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }}</td>
                <td>{{ number_format($detail->total_price, 2) }}</td>
            </tr>
             @endforeach
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>PRIX TOTAL</strong></td>
                    <td><strong>{{ number_format($invoice->order->detailOrders->sum('total_price'), 0) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>TVA</strong></td>
                    <td><strong>{{ $invoice->order->entreprise->assujeti?number_format($invoice->order->detailOrders->sum('total_price') * $invoice->order->tva / 100, 2):'' }}</strong></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>PT TVAC</strong></td>
                    <td><strong>{{ $invoice->order->entreprise->assujeti?number_format($invoice->order->detailOrders->sum('total_price') * (1 + $invoice->order->tva / 100), 0):'' }}</strong></td>
                </tr>
        </table>
        <div>
      <p>
          <strong>Mention obligatoire</strong><br>
        <span>NB : Les non assujettis à la TVA ne remplissent les deux dernières lignes.</span> <br> <br>
         <strong>Nous disons {{ $invoice->order->price_letter}} </strong>
         </p>
    </div>
    </div>

    <div class="footer">
        <p>Quartier ROHERO I Centre Ville, Tél: +257 69 450 198, Compte BCB No 20974710004</p>
    </div>
</body>
</html>
