<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nova</title>
    <style>
        body {
            font-family: Arial, sans-serif;

            margin-top: 0;
        }
        .title {
            color: blue;
            font-size: 24px;
            margin: 0;
            padding: 0;
        }
        header {
            margin-bottom: 10px;
        }
        .header_left {
            margin-right: 10px;
            float: left;
        }
        .header_right {
            margin-right: 0;
            float: right;
        }
        h5 {
            font-size: 16px;
        }
        h4 {
            font-size: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .date {
            text-align: left;
           float: right;
            font-size: 16px;
            padding: 0;
            margin: 0;
        }

        .fact{
            padding: 0;
            margin: 0;
            float: left;
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
        .header_left ,.
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
        <div class="border_header">
            <br>
            <h4 class="fact">FACTURE PROFORMA</h4>
            <h4 class="date">Date: Le {{ $proforma_invoice->created_at->format('d/m/Y') }}</h4>

        </div>

        <div class="border-text">
            <h5 style="padding-top: 15px">CLIENT :  {{ $proforma_invoice->client->name }}</h5>
            <table>
                <tr>
                    <th>ORDRE</th>
                    <th>DESIGNATION</th>
                    <th>QTE</th>
                    <th>P.U</th>
                    <th>P.T</th>
                </tr>
                @foreach($proforma_invoice->proformaInvoiceList as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }}</td>
                <td>{{ number_format($detail->total_price, 2) }}</td>
            </tr>
             @endforeach
                <tr>
                    <td colspan="4" style="text-align: left;"><strong>PRIX TOTAL</strong></td>
                    <td><strong>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 2) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;"><strong>TVA</strong></td>
                    <td><strong>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 2):'' }}</strong></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;"><strong>PT TVAC</strong></td>
                    <td><strong>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 2):'' }}</strong></td>
                </tr>
            </table>
            <h6>Mention obligatoire</h6>
            <h6>NB: Les non-assujettis à la TVA ne remplissent pas les deux dernières lignes</h6>
        </div>
    </div>

    <div class="footer">
       <div class="colored-bars">
            <div class="bar blue"></div>
            <p>Adresse: Centre Ville, Mukaza, Rohero I Tél: (+257) 68 020 191 Email: novatechbusiness23@gmail.com</p>
        </div>

    </div>
</body>
</html>
