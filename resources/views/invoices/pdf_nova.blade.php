<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nova</title>
    <style>
        body {
            font-family: Verdana, Tahoma, Arial, sans-serif;
            font-size: 12px;
            margin-top: 0;
        }
        .title {
            color: blue;
            margin: 0;
            padding: 0;
        }
        header {
            margin-bottom: 10px;
        }
        .header_left {
            font-size: 16px;
            margin-right: 10px;
            float: left;
        }
        .header_right {
            margin-right: 0;
            float: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 15px;
        }
        th, td {
            border: 1px solid black;
            padding: 4px;
            text-align: center;
        }
        .footer {
            position: absolute;
            bottom: 0;
            font-size: 15px;
            width: 100%;
            text-align: center;
        }
        .bar {
            width: 100%;
            height: 4px;
        }
        .yellow {
            background-color: yellow;
        }
        .blue {
            background-color: blue;
        }
        @media (max-width: 400px) {
            header {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header_left">
            <h3 class="title">NOVA TECH BUSINESS</h3>
            <h5 style="margin: 0;padding: 0">NIF: 4002394858<br>RC: 0049244/23</h5>
        </div>
        <div class="header_right">
            <h5 style="margin: 0; padding: 0">Centre Fiscal: DPMC</h5>
            <p style="margin: 0; padding: 0">Activités:</p>
            <div style="padding-left: 40px">
                <ul style="margin: 0; padding: 0">
                    <li style="margin: 0; padding: 0">Fournitures de Bureau et Informatique</li>
                    <li style="margin: 0; padding: 0">Travaux d'édition</li>
                    <li style="margin: 0; padding: 0">Location des Véhicules</li>
                    <li style="margin: 0; padding: 0">Commerce Divers</li>
                </ul>
            </div>

            <p style="margin: 0; padding: 0">Forme Juridique: SURL</p>
        </div>
    </div>
    <br><br><br><br><br><br> <br>
    <div class="boder">
        <div class="colored-bars">
            <div class="bar blue"></div>
            <div class="bar yellow"></div>
        </div>
        <div style=" padding:0; margin:0;">
            <p></p>
            <h2 style=" padding:0; margin:0;">
                Facture N<sup>o</sup> {{ $invoice->number }} du {{ $invoice->date ? \Carbon\Carbon::parse($invoice->date)->format('d/m/Y') : '____/____/202__' }}<br>
                <strong style="font-size: 14px;">A. Identification du vendeur</strong>
            </h2>
            <p style="padding:0; margin:0;">
                <strong>Raison sociale : </strong> NOVA TECH BUSINESS<br>
                <strong>NIF :</strong>  4002394858 <br>
                <strong>RC :</strong>  0049244/23 <br>
                <strong>Commune :</strong> Mukaza, Rohero 1 <br>
                <strong>Assujetti à la TVA :</strong> Oui[  ]  Non[ X ]
            </p>
            <h3 style=" padding:0; margin:0;">B. Le Client</h3>
            <p style=" padding:0; margin:0;">
                <strong>Nom et prénom ou raison sociale :</strong> {{ $invoice->order->client?->name }}<br>
                <strong>NIF :</strong> {{ $invoice->order->client->nif ?? '_________' }}<br>
                <strong>Résidence à :</strong> {{ $invoice->order->client->address ?? 'BUJA' }}<br>
                <strong>Assujetti à la TVA :</strong> Oui [ {{ $invoice->order->client->assujeti ? 'X' : ' ' }}] Non [{{ $invoice->order->client->assujeti ? ' ' : 'X' }}] <br>
                <strong>Doit ce qui suit: </strong>
            </p>
        </div>

        <div class="border-text">
            <table style=" padding:0; margin:0;">
                <tr>
                    <th>N<sup>o</sup></th>
                    <th>DESIGNATION</th>
                    <th>UNITE</th>
                    <th>QTE</th>
                    <th>P.U</th>
                    <th>P.T</th>
                </tr>
                @foreach($invoice->order->detailOrders as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->product_name }}</td>
                    <td>{{ $detail->unit }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                    <td>{{ number_format($detail->total_price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>PRIX TOTAL</strong></td>
                    <td><strong>{{ number_format($invoice->order->detailOrders->sum('total_price'), 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>TVA</strong></td>
                    <td><strong>{{ $invoice->order->entreprise->assujeti ? number_format($invoice->order->detailOrders->sum('total_price') * $invoice->order->tva / 100, 0, ',', '.') : '' }}</strong></td> <!-- Format modifié -->
                </tr>
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>PT TVAC</strong></td>
                    <td><strong>{{ $invoice->order->entreprise->assujeti ? number_format($invoice->order->detailOrders->sum('total_price') * (1 + $invoice->order->tva / 100), 0, ',', '.') : '' }}</strong></td> <!-- Format modifié -->
                </tr>
            </table>
            <div>
                <p>
                    <strong>Mention obligatoire</strong><br>
                    <span>NB : Les non assujettis à la TVA ne remplissent les deux dernières lignes.</span> <br> <br>
                    <strong>Nous disons {{ $invoice->order->price_letter }} </strong>
                </p>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="colored-bars">
            <div class="bar yellow"></div>
            <div class="bar blue"></div>
            <p>Adresse: Centre Ville, Mukaza, Rohero I Tél: (+257) 68 020 191 Email: novatechbusiness23@gmail.com
                <span style="color:blue;"> Compte BCB N<sup>o</sup>  21633140002 <span>
            </p>
        </div>
    </div>
</body>
</html>
