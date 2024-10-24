<!-- resources/views/requetes/transport_result.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la Requête Piscine</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Résultats de la Requête Piscine</h1>

    @if(empty($elevesNotUpToDate))
        <p>Aucun élève trouvé.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Classe</th>
                    <th>Frais Total</th>
                    <th>Total Payé</th>
                    <th>Montant Restant</th>
                </tr>
            </thead>
            <tbody>
                @foreach($elevesNotUpToDate as $eleve)
                    <tr>
                        <td>{{ $eleve['nom'] }}</td>
                        <td>{{ $eleve['classe'] }}</td>
                        <td>{{ $eleve['frais_piscine'] }}</td>
                        <td>{{ $eleve['deja_payee'] }}</td>
                        <td>{{ $eleve['montant_restant'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
