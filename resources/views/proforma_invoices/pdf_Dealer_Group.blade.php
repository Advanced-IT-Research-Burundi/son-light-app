<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Group</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: black;
            padding-top: 80px;
        }
        .header {
            position: fixed;
            top: -70px;
            left: 0;
            width: 100%;
            z-index: 2;
            margin-bottom: 0;
            padding: 10px 0;
        }
          li{
            list-style: none;
        }
        .dealer {
            color: blue;
            font-weight: 300;
        }

        .group {
            color: red;
            font-weight: 300;
        }

        .header_left {
            float: left;
            padding-left: 8%;
        }

        .header_right {
            float: right;
            text-align: left;
            padding-right: 35%;
        }

        .colored-bars {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
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

        .red {
            background-color: red;
        }

        .bordertitre {
            margin-top: 5px;
            display: flex;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;
             vertical-align: top;

        }
        td{
            max-width: 150px;
            word-wrap: break-word;
         }

        th {
            font-weight: bold;
        }

        .footer {
            position: absolute;
            bottom: 0;
            font-weight: bold;
            font-size: 15px;
            width: 100%;
            text-align: center;
        }

        .border_header {
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
            background-color: blue;
            color: red;
            border-radius: 10px;
            padding: 4px;
            width: 40%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            float: left;
        }

        .date {
            float: right;
        }

        .border-text {
            text-align: left;
            margin-top: 5px;
        }

        .client-title {
            text-align: left;
        }

        @media (max-width: 600px) {
            .header_right {
                padding-left: 10px;
            }

            table {
                font-size: 0.9em;
            }
        }
          .vertical-barr{
            height: 90px;
            width: 3px;
            transform: rotate(15deg);
            border: 2px solid black;
            float: left;
            margin-right: 0px;
            margin-top:50px;
        }
        .liste{
            float: right;
            margin-left: 0px;
        }

    </style>
</head>
<body>
    <div class="header">
        <div class="header_left">
            <p><strong>
            <span class="dealer" style="font-size: 4.5rem;">D</span>EALER <span class="group" style="font-size: 4.5rem;">G</span>ROUP <br>
           <span style="color:blue"> NIF : 4001564154 <br> RC: 27895/20</span>
            </strong></p>
        </div>
        <div class="header_right">
       <div class="vertical-barr"></div>
            <div class="liste">
                <p><br></p>
                <p style="padding:0;margin:0;"> &nbsp;&nbsp;&nbsp;&nbsp; <strong><span style="color: blue;">=></span>Services TICs</strong></p>
                <p style="padding:0;margin:0;"> &nbsp;&nbsp;&nbsp;<strong><span style="color: blue;">=></span>Agro Business</strong></p>
                <p  style="padding:0;margin:0;"> &nbsp;&nbsp;<strong><span style="color: blue;">=></span>Location Véhicule</strong></p>
                <p  style="padding:0;margin:0;"><strong><span style="color: blue;">=></span> Commerce Général</strong></p>

         </div>
        </div>
    </div>

    <div class="colored-bars">
        <div class="bar yellow"></div>
        <div class="bar blue"></div>
        <div class="bar red"></div>
    </div>

    <div class="bordertitre">
        <h4 class="border_header">FACTURE PROFORMA</h4>
        <h4 class="date">Date: Le {{ $proforma_invoice->proforma_invoice_date->format('d/m/Y') }}</h4>
    </div>
    <p><br></p><br>  <p></p>
    <h4 class="client-title" style="padding:0;margin:0;"> <span style=" text-decoration: underline;">CLIENT </span>:{{ $proforma_invoice->client?->name }}</h4>
    <div class="border-text">
        <table>
            <tr>
                <th>Ordre</th>
                <th>Nature de l'article ou du service</th>
                <th>Quantité</th>
                <th>P.U en FBU</th>
                <th>PVHTVA en FBU</th>
            </tr>
            <tbody>
            @foreach($proforma_invoice->proformaInvoiceList as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }} {{$detail->unit}}</td>
                <td>{{ number_format($detail->unit_price, 0) }}</td>
                <td>{{ number_format($detail->total_price, 0) }}</td>
            </tr>
            @endforeach
               <tr>
                    <td colspan="4" style="text-align: left;"><strong>TOTAL HTVA en FBU</strong></td>
                    <td><strong>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 0) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;"><strong>TVA (18%)</strong></td>
                    <td><strong>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 0):'' }}</strong></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;"><strong>TV-TVAC en FBU</strong></td>
                    <td><strong>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 0):'' }}</strong></td>
                </tr>
        </tbody>
        </table>
       <div>
      <p>
          <strong>Mention obligatoire</strong><br>
        <span>NB : Les non assujettis à la TVA ne remplissent les deux dernières lignes.</span> <br> <br>
         <strong>Nous disons {{$proforma_invoice->price_letter}} </strong>
         </p>
    </div>
    </div>

    <div class="footer">

    <div class="colored-bars">
        <div class="bar blue"></div>
        <p>
          Rohero 2, Av de la Mission n0 1, Tél: +257 79 881 769 (Whatsapp) +257 69 723 126, 79 147 290 <br>
          <span style="color:red;"> Compte BANCOBU N<sup>o</sup> 12721620101 <span>
        </p>
    </div>
    </div>
</body>
</html>
