{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Afro Business Group - Facture Proforma</title>
    <style>
        /* Reset avec dimensions fixes pour PDF */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 30px;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        /* En-tête optimisé */
        .header_info {
            width: 100%;
            margin-bottom: 30px;
            display: block;
        }

        .header_left {
            float: left;
            width: 60%;
        }

        .header_right {
            float: right;
            width: 35%;
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
        }

        .company_info {
            margin-top: 15px;
        }

        .title {
            color: #2E7D32;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .company_details {
            margin: 10px 0;
        }

        .company_details h5 {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }

        /* Liste adaptée pour PDF */
        .liste {
            list-style: none;
            margin: 10px 0;
        }

        .liste li {
            padding-left: 15px;
            position: relative;
            margin: 5px 0;
        }

        .liste li:before {
            content: "•";
            color: #2E7D32;
            position: absolute;
            left: 0;
        }

        /* Conteneur principal */
        .main-content {
            clear: both;
            padding-top: 20px;
        }

        /* Tableau optimisé pour PDF */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 11px;
        }

        th {
            background-color: #2E7D32 !important;
            color: white;
            padding: 4px;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #ddd;
        }

        td {
            padding: 4px;
            border: 1px solid black;
            background-color: white;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        tfoot td {
            background-color: #f5f5f5 !important;
            font-weight: bold;
        }

        /* Note importante */
        .important-notice {
            margin: 20px 0;
            padding: 10px;
            background-color: #FFF8E1;
            border-left: 4px solid #FFA000;
            font-size: 11px;
        }

        /* Pied de page */
        .footer {
            position: fixed;
            bottom: 30px;
            left: 30px;
            right: 30px;
            border-top: 2px solid #2E7D32;
            padding-top: 10px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        /* Clearfix pour les flottants */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Styles spécifiques pour dompdf */
        @page {
            margin-right: 20;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="header_info clearfix">
        <div class="header_left">
            <h1 class="title">AFRO BUSINESS GROUP</h1>
            <div class="company_info">
                <div class="company_details">
                    <h5>NIF : 4002771212</h5>
                    <h5>RC: 0060277/24</h5>
                </div>
                <ul class="liste">
                    <li>Fourniture de Bureau</li>
                    <li>Fourniture des Imprimés</li>
                    <li>Location des Matériels</li>
                    <li>Commerce Général</li>
                </ul>
            </div>
        </div>
        <div class="header_right">
            <h2 class="title">FACTURE PROFORMA</h2>
            <div style="margin-top: 10px;">
                <h5>Date de facturation:<br><strong>{{ $proforma_invoice->created_at->format('d/m/Y') }}</strong></h5>
                <h5>Facturé à :<br><strong>{{ $proforma_invoice->client->name }}</strong></h5>
            </div>
        </div>
    </div>

    <div class="main-content">
        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">ORDRE</th>
                    <th style="width: 30%;">DESIGNATION</th>
                    <th style="width: 10%;">QTE</th>
                    <th style="width: 13%;">PRIX UNIT</th>
                    <th style="width: 13%;">PVHTVA en FBU</th>
                    <th style="width: 13%;">TVA*</th>
                    <th style="width: 13%;">TV-TVAC*</th>
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
                    <td>{{ $proforma_invoice->entreprise->assujeti ? number_format($detail->total_price * $proforma_invoice->tva / 100, 2) : '' }}</td>
                    <td>{{ $proforma_invoice->entreprise->assujeti ? number_format($detail->total_price + ($detail->total_price * $proforma_invoice->tva / 100), 2) : '' }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>Total</strong></td>
                    <td><strong>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 2) }}</strong></td>
                    <td><strong>{{ $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 2) : '' }}</strong></td>
                    <td><strong>{{ $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 2) : '' }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="important-notice">
            <strong>Mention obligatoire</strong><br>
            NB: Les non assujettis à la TVA ne remplissent pas les deux dernières colonnes
        </div>
    </div>

    <div class="footer">
        <p>Rohero 1, Av de Luxembourg</p>
        <p>Tél: +257 79 881 769 (WhatsApp) | +257 69 723 126 | +257 79 732 102</p>
    </div>
</body>
</html> --}}
