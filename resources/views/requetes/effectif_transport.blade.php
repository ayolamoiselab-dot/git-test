
<!DOCTYPE html>
<html>

<head>
    <title>Effectif Transport</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="container">
        <h1>Liste effectif Abonnés au Transport classe de: {{ $classe }}</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Quartier</th>
                    <th>Type de Trajet</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eleves as $index => $eleve)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $eleve->nom }}</td>
                    <td>{{ $eleve->prenom }}</td>
                    <td>{{ $eleve->quartier }}</td>
                    <td>{{ $eleve->type_trajet }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <style>
        /* resources/css/styles.css */

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>

</body>

</html>