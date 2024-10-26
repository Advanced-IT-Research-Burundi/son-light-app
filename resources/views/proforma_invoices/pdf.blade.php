<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture Proforma </title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            line-height: 1.1;
            margin: 10px;
            color: #333;
            margin-top:-30px;
        }
        .header {
            font-size: 13px;
            color:white;
            margin-right: 30px;
            margin-left: 30px;
            text-align: center;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            width: 120px;
            height: auto;
        }
        .info-box {
            background-color: #6aa8fd;
             font-size: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: left;

        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
        }
        .table2 th,
        .table2 tr,
        .table2 td {
            border: 1px solid black;
            padding: 3px;
            text-align: left;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
             font-size: 14px;
        }
          .bar {
            width: 100%;
            height: 4px; 
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
            <img src="images/logo.png" alt="Son Light Logo" style="border-radius: 10%; height:100px; ">
        </div>

    <div class="info-box">
        <table style="border: none; color:white;padding-left: 40px;">
        <tr style="text-align: center">    
                </tr>
            <tr>
                <td style="border: none; width: 30%;font-size: 16px;">
                
                    <p><strong>NIF : 4000652612 </strong> </p>
                    <p><strong>  RC : 06190 </strong></p>
                </td>
                <td style="border: none;padding-left: 120px;">
                    <p>Travaux d'imprimerie, Fourniture du matériel <br> Bureautique et Informatique, Logistique <br> Lacations diverses et commerce général </p>
                </td>
            </tr>
        </table>

    </div>

    <h2 style="color:red;">FACTURE PROFORMA du {{ $proforma_invoice->created_at->format('d/m/Y') }}</h2>

    <div style=" font-size: 14px;" >
        <h3>A. Identification du vendeur</h3>
        <p>
            <strong>Raison sociale : </strong> SON LIGHT PAPER SERVICES<br>
            <strong>NIF :</strong> 4000652612 <br>
            <strong>RC :</strong> 06190 <br>
            <strong>Tél :</strong> +257 79 881 769 / 69 723 126 <br>
            <strong>Commune :</strong> Mukaza, quartier Rohero2 <br>
            <strong>Avenue :</strong> Avenue de la France <br>
            <strong>Assujetti à la TVA :</strong> Oui [ X ] Non [  ]
        </p>

        <h3>B. Le Client</h3>
        <p>
            <strong>Nom et prénom ou raison sociale :</strong> {{ $proforma_invoice->client->name }}<br>
            <strong>NIF :</strong> {{ $proforma_invoice->client->nif ?? '_________' }}<br>
            <strong>Résidence à :</strong> {{ $proforma_invoice->client->address ?? 'BUJA' }}<br>
            <strong>Assujetti à la TVA :</strong> Oui [ {{ $proforma_invoice->client->assujeti?'X':' ' }}] Non [{{ $proforma_invoice->client->assujeti?' ':'X' }}]

        </p>
    </div>

    <table class="table2">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Nature de l'article ou service</th>
                <th>Qté</th>
                <th>PU en FBU</th>
                <th>PVHTVA en FBU</th>
                <th>TVA*</th>
                <th>TV-TVAC*</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proforma_invoice->proformaInvoiceList as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 0) }}</td>
                <td>{{ number_format($detail->total_price, 0) }}</td>
                <td>{{ $proforma_invoice->entreprise->assujeti?number_format($detail->total_price * $proforma_invoice->tva / 100, 0):'' }}</td>
                <td>{{ $proforma_invoice->entreprise->assujeti?number_format($detail->total_price + ($detail->total_price * $proforma_invoice->tva / 100), 0):'' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: left;"><strong>Total</strong></td>
                <td>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 2) }}</td>
                <td>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 0):'' }}</td>
                <td>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 0):'' }}</td>
            </tr>
        </tfoot>
    </table>
    <div>
        <strong>Mention obligatoire</strong><br>
        <span>NB : Les non assujettis à la TVA ne remplissent les deux dernières colonnes.</span>
    </div>

    <div class="footer">
         <div class="colored-bars">
            <div class="bar red"></div>
            <div class="bar argent"></div>
        <p>Rohero 2, Av de France N<sup>o</sup> 12, Galerie Kusta Place n<sup>o</sup> E,D,M <br> Tél: +257 79 881 769 (Whatsapp) +257 69 723 126 / 79 732 102, <br>
         E-mail: sonlightimprimerie@gmail.com <br>
          <span style="color:red;"> Compte BCB N<sup>o</sup> 21604510007 <span></p>
    </div> </div>
</body>
</html>
