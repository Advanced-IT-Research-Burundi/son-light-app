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
            padding: 10px;
            text-align: left; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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

    <div class="border_header">
        <h2 style="margin: 0; padding: 0">FACTURE  NUMERO {{ $invoice->id }} <br><br>
    <span style="color:black;  font-size: 14px;">Date de facturation: <strong style="margin: 0; padding: 0"> Le {{ $invoice->created_at->format('d/m/Y') }}</strong></span></h2>
    </div>
    <div class="border-text">
        <h4 style="text-decoration: underline; margin: 0; padding: 0"">CLIENT : {{ $invoice->order->client->name }}</h4>
        <table>
            <tr>
                <th>ORDRE</th>
                <th>Nature de l'article ou service</th>
                <th>Quantité</th>
                <th>P.U en FBU</th>
                <th>PVHTVA en FBU</th>
            </tr>
            @foreach($invoice->order->detailOrders as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 0) }}</td>
                <td>{{ number_format($detail->total_price, 0) }}</td>
            </tr>
             @endforeach
                <tr>
                    <td colspan="4" style="text-align: left;"><strong>PRIX TOTAL</strong></td>
                    <td><strong>{{ number_format($invoice->order->detailOrders->sum('total_price'), 0) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;"><strong>TVA</strong></td>
                    <td><strong>{{ $invoice->order->entreprise->assujeti?number_format($invoice->order->detailOrders->sum('total_price') * $invoice->order->tva / 100, 0):'' }}</strong></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;"><strong>PT TVAC</strong></td>
                    <td><strong>{{ $invoice->order->entreprise->assujeti?number_format($invoice->order->detailOrders->sum('total_price') * (1 + $invoice->order->tva / 100), 0):'' }}</strong></td>
                </tr>
        </table>
        <p><strong>Mention obligatoire  </strong> <br>
        NB: Les non assujettis à la TVA ne remplissent les deux dernières lignes
       </p>
    </div>

    <div class="footer">
        <p>Quartier ROHERO I Centre Ville, Tél: +257 69 450 198, Compte BCB No 20974710004</p>
    </div>
</body>
</html>
