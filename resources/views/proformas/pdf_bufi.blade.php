<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUFI</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: black;
            padding: 20px;
        }

        header {
            background-color: #f9e79f; 
            border: 1px solid black;
            border-radius: 15px; 
            padding: 5px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .header_left{
            margin-left: 10%;
            font-weight: 900;
            font-size: xx-large;
        }

        .title {
            font-size: 4.5rem;
            font-weight: bold;
            margin: 0;
            text-decoration: underline; 
        }

        .header_info {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin: 20px 0;
        }

        .header_info div {
            flex: 1;
            text-align: left; 
        }

        .header_info h5 {
            margin: 5px 0;
            font-size: 1em;
            text-align: left; 
        }

        .header_right {
            font-weight: 600;
            font-size: x-large;
            text-align: left; 
        }
        .header_right li::before {
            content: "➔ "; 
            color: black;
        }

        .header_right ul {
            list-style: none;
            padding: 0;
            margin: 0;
            margin-left: -20%;
        }

        .header_right li {
            margin: 5px 0;
        }

        .border_header {
            margin: 20px 0;
            text-align: left;
            font-size: 1.8em;
            font-weight: bold;
            color: #333;
        }

        .border-text {
            padding: 20px;
            text-align: left; 
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
            background-color: #f8f8f8;
        }

        footer {
            text-align: center; 
            margin-top: 20px;
            color: red;
        }

        @media print {
            body {
                padding: 0;
            }

            header, .border-text, footer {
                page-break-inside: avoid;
            }

            .header_info {
                display: block;
            }

            .header_info div {
                text-align: left; 
                margin: 10px 0;
            }
        }

        @media (max-width: 600px) {
            .header_info {
                flex-direction: column;
                align-items: flex-start;
            }

            .header_info div {
                text-align: left; 
                margin: 10px 0;
            }

            table {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1 class="title">BUFI TECHNOLOGIES</h1>
        <div class="header_info">
            <div class="header_left">
                <h5>NIF: 4001934464</h5>
                <h5>RC: 35991/22</h5>
            </div>
            <div class="header_right">
                <ul>
                    <li>Imprimerie</li>
                    <li>Informatique</li>
                    <li>Sérigraphie</li>
                    <li>Location des matériels pour les Evénements</li>
                </ul>
            </div>
        </div>
    </header>

    <div class="border_header">
        <h4>FACTURE PROFORMA DU ...../....../2024</h4>
    </div>
    
    <div class="border-text">
        <h4 style="text-decoration: underline;">CLIENT :</h4>
        <table>
            <tr>
                <th>ORDRE</th>
                <th>Nature de l'article ou service</th>
                <th>Quantité</th>
                <th>P.U en FBU</th>
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
                <td colspan="4"><strong>PRIX TOTAL</strong></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"><strong>TVA</strong></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"><strong>TV-TVAC</strong></td>
                <td></td>
            </tr>
        </table>
        <h4>Mention obligatoire</h4>
        <h4>NB: Les non assujettis à la TVA ne remplissent les deux dernières lignes</h4>
    </div>

    <footer>
        <p>Quartier ROHERO I Centre Ville, Tél: +257 69 450 198, Compte BCB No 20974710004</p>
    </footer>
</body>
</html>