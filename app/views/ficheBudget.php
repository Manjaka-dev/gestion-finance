<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau Budget</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <section>

        <h1>Fiche Budgétaire</h1>

        <table>
            <tr>
                <th rowspan="2">Rubrique</th>
                <th colspan="3">P1</th>
                <th colspan="3">P2</th>
                <th colspan="2">Somme</th>
            </tr>
            <tr>
                <th>Prev</th>
                <th>Real</th>
                <th>Écart</th>
                <th>Prev</th>
                <th>Real</th>
                <th>Écart</th>
                <th>Prev Total</th>
                <th>Real Total</th>
            </tr>

            <?php
            $rubriques = [
                ['nom' => 'Alimentation'],
                ['nom' => 'Transport'],
                ['nom' => 'Logement']
            ];

            foreach ($rubriques as $rubrique) {
                $prevP1 = 1000;
                $realP1 = 900;
                $ecartP1 = $prevP1 - $realP1;

                $prevP2 = 1200;
                $realP2 = 1100;
                $ecartP2 = $prevP2 - $realP2;

                $prevTotal = $prevP1 + $prevP2;
                $realTotal = $realP1 + $realP2;

                echo "<tr>
                <td>{$rubrique['nom']}</td>
                <td>$prevP1</td>
                <td>$realP1</td>
                <td>$ecartP1</td>
                <td>$prevP2</td>
                <td>$realP2</td>
                <td>$ecartP2</td>
                <td>$prevTotal</td>
                <td>$realTotal</td>
            </tr>";
            }
            ?>
        </table>
    </section>

</body>

</html>
