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
            padding: 20px;
            background-color: #ffffff; 
            margin-left: 5%;
        }
       
        header {
            margin-bottom: 20px;
            text-align: center;
        }
        
        .title {
            color: green;
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
        }

        .header_info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
           width: 100%;
        }

        .header_left {
            text-align: left;
            font-weight: 400;
            flex: 3; 
            padding-right: 20px;
        }

        .header_right {
            text-align: left;
            flex: 2;
            padding-left: 20px; 
        }

        .header_right h1 {
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
            list-style-type: none;
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

        footer {
            text-align: center; 
            margin-top: 20px;
            font-weight: bold; 
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
                <h1 class="title">AFRO BUSINESS GROUP</h1>
                <h4>NIF : 4002771212</h4>
                <h4>RC: 0060277/24</h4>
                <h4>Nos Services:</h4>
                <ul class="liste">
                    <li>Fourniture de Bureau</li>
                    <li>Fourniture des Imprimes</li>
                    <li>Location des Materiels</li>
                    <li>Commerce Général</li>
                </ul>
            </div> 
            <div class="header_right">
                <h1 class="title">FACTURE PROFORMA</h1>
                <h6>Date de facturation: <strong>11/10/2024</strong></h6>
                <h6><strong>Facturé à :</strong></h6>
            </div> 
        </div> 
    </header>
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
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
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
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6"><strong>TOTAL</strong></td>
                <td></td>
            </tr>
        </table>
        <h4>Mention obligatoire</h4>
        <h4>NB: Les non assujettis à la TVA ne remplissent les deux dernières lignes</h4>
    </div>

    <footer>
        <div class="colored-bars">
            <div class="bar green"></div>
            <p>Rohero 1, Av de Luxambourg, Tél: +257 79 881 769 (Whatsapp) +257 69 723 126, 79 732 102</p>
        </div>
    </footer>
</body>
</html>