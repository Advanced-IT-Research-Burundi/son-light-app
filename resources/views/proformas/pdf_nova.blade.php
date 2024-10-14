<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nova</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .title {
            color: blue;
            font-size: 24px;
            margin-bottom: 5px;
        }
        header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header_left, .header_right {
            flex: 1;
            margin-right: 20px;
        }
        .header_right {
            margin-right: 0;
        }
        h5 {
            margin: 5px 0;
            font-size: 16px;
        }
        h4 {
            margin: 10px 0;
            font-size: 20px;
        }
        .boder {
            padding: 15px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .date {
            text-align: left;
            margin-left: 80%;
            font-size: 16px;
        }
        footer {
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
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
        @media (max-width: 600px) {
            header {
                flex-direction: column;
            }
            .header_left, .header_right {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header_left">
            <h3 class="title">NOVA TECH BUSINESS</h3>
            <h5>NIF: 4002394858<br>RC: 0049244/23</h5>
        </div>
        <div class="header_right">
            <h5>Centre Fiscal: DPMC</h5>
            <p>Activités:</p>
            <ul>
                <li>Fournitures de Bureau et Informatique</li>
                <li>Travaux d'édition</li>
                <li>Location des Véhicules</li>
                <li>Commerce Divers</li>
            </ul>
            <p>Forme Juridique: SURL</p>
        </div>
    </header>
    <div class="colored-bars">
        <div class="bar blue"></div>
        <div class="bar yellow"></div>
    </div>
    <div class="boder">
        <div class="border_header">
            <h4>FACTURE PROFORMA</h4>
            <h4 class="date">Date:.../.../2024</h4>
        </div>
        <div class="border-text">
            <h4>CLIENT :</h4>
            <table>
                <tr>
                    <th>ORDRE</th>
                    <th>DESIGNATION</th>
                    <th>QTE</th>
                    <th>P.U</th>
                    <th>P.T</th>
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
                    <td colspan="4"><strong>PT TVAC</strong></td>
                    <td></td>
                </tr>
            </table>
            <h4>Mention obligatoire</h4>
            <h4>NB: Les non-assujettis à la TVA ne remplissent pas les deux dernières lignes</h4>
        </div>
    </div>

    <footer>
        <div class="colored-bars">
            <div class="bar blue"></div>
        <p>Adresse: Centre Ville, Mukaza, Rohero I Tél: (+257) 68 020 191 Email: novatechbusiness23@gmail.com</p>
        </div>
    </footer>
</body>
</html>