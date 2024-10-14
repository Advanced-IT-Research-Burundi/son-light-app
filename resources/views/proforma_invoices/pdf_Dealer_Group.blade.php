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
            padding: 20px;
            background-color: #ffffff; 
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size:x-large;
            margin-bottom: 2%;
        }

        .dealer {
            color: blue;
            font-weight: bold;
        }

        .group {
            color: red;
            font-weight: bold;
        }

        .header_left {
            margin-left: 10%;
            flex: 2;
        }

        .header_right {
            flex: 2;
            margin-left: 10%;
            text-align: left;
            padding-left: 20px;
        }

        .header_right h3 {
            margin: 5px 0; 
            line-height: 1.5; 
        }

        .header_right h3::before {
            content: "➔ "; 
            color: blue;
        }

        .colored-bars {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
        }

        .bar {
            width: 90%;
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

        footer {
            text-align: center; 
            margin-top: 20px;
            font-weight: bold; 
            text-decoration: overline;
        }

        .border_header {
        margin-left: 4.3%;
        text-align: center; 
        font-size: 1.5em; 
        font-weight: bold;
        background-color: blue; 
        color: red;
        border-radius: 10px; 
        padding: 4px; 
        width: 28%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

        .border-text {
            padding: 20px;
            text-align: left; 
            margin-left: 4%;
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
            margin-left: 10%;
        }
    </style>
</head>
<body>
    <header>
        <div class="header_left">
            <h1><span class="dealer" style=" font-size: 4.5rem;">D</span>EALER <span class="group" style=" font-size: 4.5rem;">G</span>ROUP</h1>
            <h3 class="dealer">NIF : 4001564154 <br> RC: 27895/20</h3>
        </div> 
        <div class="header_right">
            <h3>Informatique</h3>
            <h3>Bureautique</h3>
            <h3>Imprimerie</h3>
            <h3>Agro Business</h3>
            <h3>Location Véhicule</h3>
            <h3>Commerce Général</h3>
            
        </div>  
    </header>
    <div class="colored-bars">
        <div class="bar yellow"></div>
        <div class="bar blue"></div>
        <div class="bar red"></div>
    </div>
    <div class=" bordertitre">
        <h4 class="border_header">FACTURE PROFORMA</h4>
        <h4 class="date">Date:  ......./....../2024</h4>
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
        <p>Rohero 2, Av de la Mission n0 1, Tél: +257 79 881 769 (Whatsapp) +257 69 723 126, 79 147 290</p>
    </footer>
</body>
</html>