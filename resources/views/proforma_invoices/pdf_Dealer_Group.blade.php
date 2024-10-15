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
            background-color: #ffffff; 
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size:large;
            margin-bottom: 2%;
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
        }

        .header_right {
            float: right;
            margin-left: 0%;
            text-align: left;
            padding-right: 5%;
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
            margin-top: -2%;
            background-color: yellow;
        }

        .blue {
            background-color: blue;
        }

        .red {
            background-color: red;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left; 
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
            text-decoration: overline;
        }

        .border_header {
        margin-left: 0%;
        text-align: center; 
        font-size: 1.5em; 
        font-weight: bold;
        background-color: blue; 
        color: red;
        border-radius: 10px; 
        padding: 4px; 
        width: 40%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

        .border-text {
            float: left;
            padding: 20px;
            text-align: left; 
            margin-left: 0%;
        }

        @media (max-width: 600px) {
            .header_right {
                padding-left: 10px; 
            }

            table {
                font-size: 0.9em; 
              
            }
        }
        .bordertitre{
            display: flex;
        }
        .date{
            float: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header_left">
            <p><strong>
            <span class="dealer" style=" font-size: 4.5rem;">D</span>EALER <span class="group" style=" font-size: 4.5rem;">G</span>ROUP <br>
            NIF : 4001564154 <br> RC: 27895/20
            </strong></p>
        </div> 
        <div class="header_right">
           <p>
           <ul>
                <li><strong>Informatique</strong></li>
                <li><strong>Bureautique</strong></li>
                <li> <strong>Imprimerie</strong></li>
                <li> <strong>Agro Business</strong></li>
                <li><strong>Location Véhicule</strong></li>
                <li> <strong>Commerce Général</strong></li>
            </ul>  
           </p>  
        </div>  
    </div>
    <br><br><br><br><br><br><br><br><br>
    <div class="colored-bars">
        <div class="bar yellow"></div>
        <div class="bar blue"></div>
        <div class="bar red"></div>
    </div>
    <div class=" bordertitre">
        <h4 class="border_header">FACTURE PROFORMA</h4>
        <h4 class="date">Date: Le {{ $proforma_invoice->created_at->format('d/m/Y') }}</h4>
    </div>
    
    <div class="border-text">
        <h4 style="text-decoration: underline;">CLIENT : {{ $proforma_invoice->client->name }}</h4>
        <table>
            <tr>
                <th>ORDRE</th>
                <th>Nature de l'article ou service</th>
                <th>Quantité</th>
                <th>P.U en FBU</th>
                <th>PVHTVA en FBU</th>
                <th>TVA*</th>
                <th>TV-TVAC*</th>
            </tr>
            <tbody>
            @foreach($proforma_invoice->proformaInvoiceList as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }}</td>
                <td>{{ number_format($detail->total_price, 2) }}</td>
                <td>{{ $proforma_invoice->entreprise->assujeti?number_format($detail->total_price * $proforma_invoice->tva / 100, 2):'' }}</td>
                <td>{{ $proforma_invoice->entreprise->assujeti?number_format($detail->total_price + ($detail->total_price * $proforma_invoice->tva / 100), 2):'' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: left;"><strong>Total</strong></td>
                <td><strong>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 2) }}</strong></td>
                <td><strong>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 2):'' }}</strong></td>
                <td><strong>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 2):'' }}</strong></td>
            </tr>
        </tfoot>
        </table>
        <p><strong>Mention obligatoire <br>
        NB: Les non assujettis à la TVA ne remplissent les deux dernières lignes
        </strong></p>
    </div>

    <div class="footer">
        <p>Rohero 2, Av de la Mission n0 1, Tél: +257 79 881 769 (Whatsapp) +257 69 723 126, 79 147 290</p>
    </div>
</body>
</html>