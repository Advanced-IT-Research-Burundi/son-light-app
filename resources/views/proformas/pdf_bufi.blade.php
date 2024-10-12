<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUFI TECHNOLOGIES - Facture Proforma</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 20px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .company-info {
            display: flex;
            justify-content: space-between;
        }
        .company-details {
            flex: 1;
        }
        .company-services {
            flex: 1;
            text-align: right;
        }
        .company-services ul {
            list-style-type: none;
            padding: 0;
        }
        .company-services li:before {
            content: "• ";
        }
        .invoice-title {
            font-weight: bold;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        .footer {
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">BUFI TECHNOLOGIES</div>
        <div class="company-info">
            <div class="company-details">
                NIF: 4001934464<br>
                RC: 35991/22
            </div>
            <div class="company-services">
                <ul>
                    <li>Imprimerie</li>
                    <li>Informatique</li>
                    <li>Sérigraphie</li>
                    <li>Location de matériels pour les Événements</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="invoice-title">FACTURE PROFORMA DU ....../....../2023</div>

    <div>CLIENT:</div>

    <table>
        <tr>
            <th>Ordre</th>
            <th>Nature de l'article ou service</th>
            <th>Quantité</th>
            <th>PU en FBU</th>
            <th>PVHTVA en FBU</th>
        </tr>
        <tr>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">TOTAL HTVA</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">TVA</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">TV-TVAC</td>
            <td></td>
        </tr>
    </table>

    <div class="footer">
        <p>Mention obligatoire</p>
        <p>NB: Les non assujettis à la TVA ne remplissent pas les deux dernières lignes.</p>
        <p>Quartier ROHERO I Centre Ville, TÉL: +257 69 450 198, Compte BCB N° 20974710004</p>
    </div>
</body>
</html>
