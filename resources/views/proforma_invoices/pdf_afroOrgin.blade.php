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
        }
        .header_right {
            float: right;
             margin-right: 30px;
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
            padding: 4px;
            text-align: center;
            vertical-align: top;

        }
        td{
            max-width: 150px;
            word-wrap: break-word;
         }

        .date {
            text-align: left;
           float: right;
            font-size: 16px;
            padding: 0;
            margin: 0;
            color:green;
        }

        .fact{
            padding: 0;
            margin: 0;
            float: left;
            color:green;
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
            margin-top:2px;
        }
        .header_left ,.
        @media (max-width: 400px) {
            header {
                flex-direction: column;
            }

        }
           .vertical-barr{
            height: 150px;
            transform: rotate(15deg);
            border: 4px solid green;
            float: left;
            margin-right: 5px;
            margin-top:-10px;
            margin-right:70px;
        }
        .liste{
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
            <h5 style="margin: 0; padding: 0">Centre Fiscal: DPMC</h5>
            <p style="margin: 0; padding: 0"><strong>Activités:</strong></p>
            <div style="padding-left: 40px">
                <ul style="margin: 0; padding: 0">
                    <li style="margin: 0; padding: 0">Fourniture de Bureau</li>
                    <li style="margin: 0; padding: 0">Fourniture des Imprimés</li>
                    <li style="margin: 0; padding: 0">Location des Matériels</li>
                    <li style="margin: 0; padding: 0">Commerce Général</li>
                </ul>
            </div>

            <p style="margin: 0; padding: 0"><strong>Forme Juridique</strong> SURL</p>
        </div>
     </div>
    </div>
    <br><br><br><br><br><br> <br>
    <div class="boder">
           <div class="colored-bars">
               <div class="bar yellow"></div>
               <div class="bar blue"></div>
           </div>
        <div class="border_header">
            <br>
            <h4 class="fact">FACTURE PROFORMA </h4>
            <h4 class="date">Date: Le  {{ $proforma_invoice->proforma_invoice_date ? $proforma_invoice->proforma_invoice_date->format('d/m/Y') : '____/____/202__' }}</h4>

        </div>

        <div class="border-text">
            <h5 style="padding-top: 15px">CLIENT :  {{ $proforma_invoice->client?->name }}</h5>
            <table>
                <tr>
                    <th>ORDRE</th>
                    <th>DESIGNATION</th>
                    <th>Unité</th>
                    <th>QTE</th>
                    <th>P.U en FBU</th>
                    <th>P.T en FBU</th>
                </tr>
                @foreach($proforma_invoice->proformaInvoiceList as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product_name }}</td>
                  <td>{{$detail->unit}}</td>
                <td>{{ $detail->quantity }} {{$detail->unit}} </td>
                <td>{{ number_format($detail->unit_price, 2) }}</td>
                <td>{{ number_format($detail->total_price, 2) }}</td>
            </tr>
             @endforeach
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>PRIX TOTAL en FBU</strong></td>
                    <td><strong>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 0) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>TVA(18%)</strong></td>
                    <td><strong>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 2):'' }}</strong></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: left;"><strong>PT TVAC en FBU</strong></td>
                    <td><strong>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 0):'' }}</strong></td>
                </tr>
            </table>
              <div>
      <p>
          <strong>Mention obligatoire</strong><br>
        <span>NB : Les non assujettis à la TVA ne remplissent les deux dernières lignes.</span> <br> <br>
         <strong>Nous disons {{$proforma_invoice->price_letter}} </strong>
         </p>
    </div>
        </div>
    </div>

    <div class="footer">
       <div class="colored-bars">
            <div class="bar yellow"></div>
            <div class="bar blue"></div>
              <p>Adresse: Bujumbura-Burundi, Rohero 1, Avenue de Luxembourg, Tél: +257 79 881 769 (WhatsApp) | +257 69 723 126 | +257 79 732 102
               <span style="color:blue;"> Compte BCB N<sup>o</sup>  21729480005 <span>
            </p>
        </div>

    </div>
</body>
</html>
