<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nova</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin-top: 0;
        }
        .title {
            color: black;
            font-size: 24px;
            margin: 0;
            padding: 0;
        }
        header {
            margin-bottom: 10px;
        }
        .header_left {
            float: left;
            font-size: 16px;
        }
        .header_right {
            font-size: 14px;
            float: right;
            margin-right: 30px;
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
            background-color: green;
        }
        .blue {
            background-color: red;
            margin-top: 2px;
        }
        .header_left,
        @media (max-width: 400px) {
            header {
                flex-direction: column;
            }
        }
        .vertical-barr {
            height: 110px;
            transform: rotate(15deg);
            border: 4px solid green;
            float: left;
            margin-right: 5px;
            margin-top: -5px;
            margin-right: 70px;
        }
        .liste {
            float: right;
            padding-left: 40px;
        }
        th {
            background-color: #2E7D32 !important;
            color: white;
            padding: 4px;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header_left">
            <h2 class="title">AFRO BUSINESS GROUP</h2>
            <h5 style="margin: 0;padding: 0">NIF: 4002771212<br>RC: 0060277/24</h5>
        </div>
        <div class="header_right">
            <div class="vertical-barr"></div>
            <div class="liste">
                <p style="margin: 0; padding: 0"><strong>Activités:</strong></p>
                <div style="padding-left: 40px">
                    <ul style="margin: 0; padding: 0">
                        <li style="margin: 0; padding: 0">Fourniture de Bureau</li>
                        <li style="margin: 0; padding: 0">Fourniture des Imprimés</li>
                        <li style="margin: 0; padding: 0">Location des Matériels</li>
                        <li style="margin: 0; padding: 0">Commerce Général</li>
                    </ul>
                </div>
                <p style="margin: 0; padding: 0"><strong>Forme Juridique</strong> : SURL</p>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br> <br>
    <div class="boder">
        <div class="colored-bars">
            <div class="bar yellow"></div>
            <div class="bar blue"></div>
        </div>
        <div style=" padding:0; margin:0;">
            <p></p>
            <h2 style=" padding:0; margin:0;">Facture N<sup>o</sup> {{ $invoice->number }} du {{ $invoice->date ? \Carbon\Carbon::parse($invoice->date)->format('d/m/Y') : '____/____/202__' }}<br>
            <strong style="font-size: 14px;">A. Identification du vendeur</strong></h2>
            <p style="padding:0; margin:0;">
                <strong>Raison sociale : </strong> AFRO BUSINESS GROUP<br>
                <strong>NIF :</strong> 4002771212<br>
                <strong>RC :</strong> 0060277/24 <br>
                <strong>Commune :</strong> Mukaza, Rohero 1 <br>
                <strong>Avenue :</strong> Avenue de Luxembourg <br>
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
                    <th>Unité</th>
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
                    <td><strong>{{ $invoice->order->entreprise->assujeti ? number_format($invoice->order->detailOrders->sum('total_price') * $invoice->tva / 100, 0, ',', '.') : '' }}</strong></td> <!-- TVA formatée -->
                </tr>
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>PT TVAC</strong></td>
                    <td><strong>{{ $invoice->order->entreprise->assujeti ? number_format($invoice->order->detailOrders->sum('total_price') * (1 + $invoice->tva / 100), 0, ',', '.') : '' }}</strong></td>
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
            <p>Adresse: Bujumbura-Burundi, Rohero 1, Avenue de Luxembourg, Tél: +257 79 881 769 (WhatsApp) | +257 69 723 126 | +257 79 732 102
             <span style="color:blue;"> Compte BCB N<sup>o</sup>  21729480005 </span>
            </p>
        </div>
    </div>
</body>
</html>
