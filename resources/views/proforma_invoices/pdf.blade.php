<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture Proforma </title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 10px;
            color: #333;
        }
        .header {
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
            background-color: #e0f7fa;
            font-size: 14px;
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
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #b2ebf2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .footer {
            position: absolute;
            bottom: 0;
            font-size: 10px;
            background-color: #e0f7fa;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
        <div class="header">
            <table>
                <tr style="text-align: center">
                     {{-- <td><img src="{{ asset('images/logo.jpeg') }}" alt="Son Light Logo" class="logo"></td>  --}}
                    <h3>{{ $proforma_invoice->entreprise->name }} </h3>
                </tr>
            </table>
        </div>

    <div class="info-box">
        <table style="border: none;">
            <tr>
                <td style="border: none; width: 30%">
                    <p><strong>NIF :{{$proforma_invoice?->entreprise->nif}} </strong> </p>
                    <p><strong>  RC :{{$proforma_invoice?->entreprise->rc}} </strong></p>
                </td>
                <td style="border: none">
                    <p>{{ $proforma_invoice?->entreprise->description ?? ''}}</p>
                </td>
            </tr>
        </table>

    </div>

    <h2>FACTURE PROFORMA du {{ $proforma_invoice->created_at->format('d/m/Y') }}</h2>

    <div>
        <h4>A. Identification du vendeur</h4>
        <p>
            <strong>Raison sociale :</strong> {{$proforma_invoice?->entreprise->name}}<br>
            <strong>NIF :</strong> {{$proforma_invoice->entreprise->nif}}<br>
            <strong>RC :</strong> {{$proforma_invoice->entreprise->rc}}<br>
            <strong>Tél :</strong> {{$proforma_invoice->entreprise->phone}}<br>
            <strong>Adresse :</strong> {{$proforma_invoice->entreprise->address}}<br>
            {{-- <strong>Avenue :</strong> Avenue de la France<br> --}}
            <strong>Assujetti à la TVA :</strong> Oui [ {{ $proforma_invoice->entreprise->assujeti?'X':' ' }}] Non [{{ $proforma_invoice->entreprise->assujeti?' ':'X' }}]
        </p>

        <h4>B. Le Client</h4>
        <p>
            <strong>Nom et prénom ou raison sociale :</strong> {{ $proforma_invoice->client->name }}<br>
            <strong>NIF :</strong> {{ $proforma_invoice->client->nif ?? '_________' }}<br>
            <strong>Résidence à :</strong> {{ $proforma_invoice->client->address ?? 'BUJA' }}<br>
            <strong>Assujetti à la TVA :</strong> Oui [ {{ $proforma_invoice->client->assujeti?'X':' ' }}] Non [{{ $proforma_invoice->client->assujeti?' ':'X' }}]

        </p>
    </div>

    <table>
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
                <td>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 2) }}</td>
                <td>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 2):'' }}</td>
                <td>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 2):'' }}</td>
            </tr>
        </tfoot>
    </table>
    <div>
        <strong>Mention obligatoire</strong><br>
        <span>NB : Les non assujettis à la TVA ne remplissent les deux dernières colonnes.</span>
    </div>

    <div class="footer">
        <p> {{$proforma_invoice->entreprise->address}} | Tél: {{$proforma_invoice->entreprise->phone}} | E-mail: {{$proforma_invoice->entreprise->email}}</p>
    </div>
</body>
</html>
