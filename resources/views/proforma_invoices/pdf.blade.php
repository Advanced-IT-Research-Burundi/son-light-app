<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture Proforma</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
            line-height: 1.1;
            margin: 0;
            padding: 10px;
            color: #333;
        }

        .header {
            top: 0;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 1000;
            background-color: white;
        }

        .image {
            font-size: 13px;
            color: white;
            margin: 0 30px;
            text-align: center;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-box {
            background-color: #6aa8fd;
            font-size: 13px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 1rem;
            color: white;
        }

        h4 {
            margin: 80px 0 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        .table2 th,
        .table2 tr,
        .table2 td {
            border: 1px solid black;
            padding: 3px;
            text-align: left;
            max-width: 150px;
            word-wrap: break-word;
        }

        .table2 tr {
            page-break-inside: avoid;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            background-color: white;
            padding: 5px 0;
            z-index: 1000;
        }

        .bar {
            width: 100%;
            height: 4px;
        }



        @media print {
            body {
                margin-top: 120px;
                margin-bottom: 60px;
            }
            h4 {
                margin: 80px 0 20px 0;
            }
            .header {
                display: block;
            }
            body:after {
                content: '';
                display: block;

            }
            .header ~ * {

            }

            .header {
                display: none;
            }
        }

        .red {
            background-color: #c1107a;
        }
        .argent {
            background-color: #c8b570;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="image">
        <img src="images/logo.png" alt="Son Light Logo" style="border-radius: 10%; height: 70px;">
    </div>
    <div class="info-box">
        <table style="border: none; color: white; padding-left: 40px;">
            <tr>
                <td style="border: none; width: 30%; font-size: 13px;">
                    <p><strong>NIF : 4000652612</strong></p>
                    <p><strong>RC : 06190</strong></p>
                </td>
                <td style="border: none; padding-left: 180px;">
                    <p>Travaux d'imprimerie, Fourniture du matériel <br>Bureautique et Informatique, Logistique <br>Locations diverses et commerce général</p>
                </td>
            </tr>
        </table>
    </div>
</div>


<h4 style="color: black; margin-top: 20px;">
    FACTURE PROFORMA du {{ $proforma_invoice->proforma_invoice_date ? $proforma_invoice->proforma_invoice_date->format('d/m/Y') : '____/____/202__' }}
</h4>

<div style="font-size: 12px;">
    <h4 style="padding: 0; margin: 0;">A. Identification du vendeur</h4>
    <p style="padding: 0; margin: 0;">
        <strong>Raison sociale :</strong> SON LIGHT PAPER SERVICES<br>
        <strong>NIF :</strong> 4000652612 <br>
        <strong>RC :</strong> 06190 <br>
        <strong>Tél :</strong> +257 79 881 769 / 69 723 126 <br>
        <strong>Commune :</strong> Mukaza, quartier Rohero2 <br>
        <strong>Avenue :</strong> Avenue de la France <br>
        <strong>Assujetti à la TVA :</strong> Oui [ X ] Non [ ]
        <br><br>
    </p>

    <h4 style="padding: 0; margin: 0;">B. Le Client</h4>
    <p style="padding: 0; margin: 0;">
        <strong>Nom et prénom ou raison sociale :</strong> {{ $proforma_invoice->client?->name }}<br>
        <strong>NIF :</strong> {{ $proforma_invoice->client->nif ?? '_________' }}<br>
        <strong>Résidence à :</strong> {{ $proforma_invoice->client->address ?? 'BUJA' }}<br>
        <strong>Assujetti à la TVA :</strong> Oui [ ] Non [ ]
    </p>
</div>

<table class="table2" style="margin-top: 10px;">
    <thead>
        <tr>
            <th>Ordre</th>
            <th>Nature de l'article ou service</th>
            <th>Unité</th>
            <th>Qté</th>
            <th>PU en FBU</th>
            <th>PVHTVA en FBU</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proforma_invoice->proformaInvoiceList as $detail)
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
            <td colspan="5" style="text-align: left;"><strong>TOTAL</strong></td>
            <td><strong>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: left;"><strong>TVA*</strong></td>
            <td><strong>{{ $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 0, ',', '.') : '' }}</strong></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: left;"><strong>TV-TVAC*</strong></td>
            <td><strong>{{ $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 0, ',', '.') : '' }}</strong></td>
        </tr>
    </tbody>
</table>

<div>
    <p>
        <strong>Mention obligatoire</strong><br>
        <span>NB : Les non assujettis à la TVA ne remplissent pas les deux dernières lignes.</span><br><br>
        <strong>{{$proforma_invoice->price_letter}}</strong>
    </p>
</div>

<div class="footer">
    <div class="colored-bars">
        <div class="bar red"></div>
        <div class="bar argent"></div>
        <p>
            Rohero 2, Av de France N<sup>o</sup> 12, Galerie Kusta Place n<sup>o</sup> E,D,M <br>
            Tél: +257 79 881 769 (Whatsapp) +257 69 723 126 / 79 732 102, <br>
            E-mail: sonlightimprimerie@gmail.com <br>
            <span style="color:red;">Compte BCB N<sup>o</sup> 21604510007</span>
        </p>
    </div>
</div>

</body>
</html>
