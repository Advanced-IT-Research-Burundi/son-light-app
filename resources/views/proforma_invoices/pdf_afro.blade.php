<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afro Business Group</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: black;
            background-color: #ffffff; 
        }
       
        header {
            margin-bottom: 20px;
            text-align: center;
        }
        
        .title {
            color: green;
            font-size: 1.5rem;
            font-weight: 400;
            margin: 0;
        }

        .header_info {
            justify-content: space-between;
            align-items: flex-start;
           width: 100%;
        }

        .header_left {
            text-align: left;
            float: left;
        }

        .header_right {
            text-align: left;
            float: right;
        }

        .header_right h3 {
            font-size: 2rem;
            margin: 10px 0;
        }

        .header_right h6 {
            margin: 5px 0; 
            font-weight: normal;
        }

        .header_left h4, .header_left h5 {
            margin: 5px 0;
        }

        .liste {
            list-style-type: symbols(circle);
            padding: 0;
        }

        .liste li {
            margin: 5px 0;
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

        .green { background-color: green; }
        .border_header {
            text-align: center; 
            font-size: 1.5em; 
            font-weight: bold;
            background-color: green; 
            color: white;
            border-radius: 10px; 
            padding: 10px; 
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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
            background-color: green;
            font-weight: bold; 
            color: white;
        }
        .footer {
            position: absolute;
            bottom: 0;
            font-size: 15px;
            width: 100%;
            text-align: center;
        }
        @media (max-width: 600px) {
            .header_info {
                flex-direction: column;
                align-items: flex-start; 
            }

            .header_right {
                text-align: left; 
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header_info">
            <div class="header_left">
                <h3 class="title">AFRO BUSINESS GROUP</h3>
                <h5>NIF : 4002771212</h5>
                <h5>RC: 0060277/24</h5>
                <ul class="liste">
                    <li>Fourniture de Bureau</li>
                    <li>Fourniture des Imprimes</li>
                    <li>Location des Materiels</li>
                    <li>Commerce Général</li>
                </ul>
            </div> 
            <div class="header_right">
                <h3 class="title">FACTURE PROFORMA</h3>
                <h5>Date de facturation: <strong> Le {{ $proforma_invoice->created_at->format('d/m/Y') }}</strong></h5>
                <h5><strong>Facturé à : {{ $proforma_invoice->client->name }}</strong></h5>
            </div> 
        </div> 
    </header>
    <br><br><br><br><br><br><br><br><br><br>
    <div class="border-text">
        <table>
            <tr>
                <th>ORDRE</th>
                <th>DESIGNATION</th>
                <th>QTE</th>
                <th>PRIX UNIT</th>
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
        <div class="colored-bars">
            <div class="bar green"></div>
            <p>Rohero 1, Av de Luxambourg, Tél: +257 79 881 769 (Whatsapp) +257 69 723 126, 79 732 102</p>
        </div>
    </div>
</body>
</html>