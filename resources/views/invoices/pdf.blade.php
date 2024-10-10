<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture  {{ $invoice->number }}</title>
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
                    <h3>{{ $invoice->proforma->order->entreprise->name }} </h3>
                </tr>
            </table>
        </div>

    <div class="info-box">
        <table style="border: none;">
            <tr>
                <td style="border: none; width: 30%">
                    <p><strong>NIF :{{$invoice->proforma?->order?->entreprise->nif}} </strong> </p>
                    <p><strong>  RC :{{$invoice->proforma?->order?->entreprise->rc}} </strong></p>
                </td>
                <td style="border: none">
                    <p>{{ $invoice->proforma?->order?->entreprise->description ?? ''}}</p>
                </td>
            </tr>
        </table>

    </div>

    <table style="margin: 0; padding: 0; border: none">
        <tr>
            <td style="border: none"><h2 style="margin: 0; padding: 0;">FACTURE No  </h2></td>
            <td style="text-align: right; border: none">Le {{ $invoice->proforma->created_at->format('d - m - Y') }}</td>
        </tr>
    </table>

    <div>
        <h4 style="margin: 0; padding: 0;">A. Identification du vendeur</h4>
        <p>
            <strong>Raison sociale :</strong> {{$invoice->proforma?->order?->entreprise->name}}<br>
            <strong>NIF :</strong> {{$invoice->proforma->order->entreprise->nif}}<br>
            <strong>RC :</strong> {{$invoice->proforma->order->entreprise->rc}}<br>
            <strong>Tél :</strong> {{$invoice->proforma->order->entreprise->phone}}<br>
            <strong>Adresse :</strong> {{$invoice->proforma->order->entreprise->address}}<br>
            {{-- <strong>Avenue :</strong> Avenue de la France<br> --}}
            <strong>Assujetti à la TVA :</strong> Oui [ {{ $invoice->proforma->order->entreprise->assujeti?'X':' ' }}] Non [{{ $invoice->proforma->order->entreprise->assujeti?' ':'X' }}]
        </p>

        <h4 style="margin: 0; padding: 0;">B. Le Client</h4>
        <p>
            <strong>Nom et prénom ou raison sociale :</strong> {{ $invoice->proforma->order->client->name }}<br>
            <strong>NIF :</strong> {{ $invoice->proforma->order->client->nif ?? '_________' }}<br>
            <strong>Résidence à :</strong> {{ $invoice->proforma->order->client->address ?? 'BUJA' }}<br>
            <strong>Assujetti à la TVA :</strong> Oui [ {{ $invoice->proforma->order->client->assujeti?'X':' ' }}] Non [{{ $invoice->proforma->order->client->assujeti?' ':'X' }}]

        </p>style="margin: 0; padding: 0;
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
            @foreach($invoice->proforma->order->detailOrders as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }}</td>
                <td>{{ number_format($detail->total_price, 2) }}</td>
                <td>{{ $invoice->proforma->order->entreprise->assujeti?number_format($detail->total_price * $invoice->proforma->order->tva / 100, 2):'' }}</td>
                <td>{{ $invoice->proforma->order->entreprise->assujeti?number_format($detail->total_price + ($detail->total_price * $invoice->proforma->order->tva / 100), 2):'' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: left;"><strong>Total</strong></td>
                <td>{{ number_format($invoice->proforma->order->detailOrders->sum('total_price'), 2) }}</td>
                <td>{{ $invoice->proforma->order->entreprise->assujeti?number_format($invoice->proforma->order->detailOrders->sum('total_price') * $invoice->proforma->order->tva / 100, 2):'' }}</td>
                <td>{{ $invoice->proforma->order->entreprise->assujeti?number_format($invoice->proforma->order->detailOrders->sum('total_price') * (1 + $invoice->proforma->order->tva / 100), 2):'' }}</td>
            </tr>
        </tfoot>
    </table>
    <div>
        <strong>Mention obligatoire</strong><br>
        <span>NB : Les non assujettis à la TVA ne remplissent les deux dernières colonnes.</span>
    </div>

    <div class="footer">
        <p> {{$invoice->proforma->order->entreprise->address}} | Tél: {{$invoice->proforma->order->entreprise->phone}} | E-mail: {{$invoice->proforma->order->entreprise->email}}</p>
    </div>
</body>
</html>
