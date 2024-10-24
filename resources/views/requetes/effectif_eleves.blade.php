<!-- resources/views/requetes/effectif_eleves.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Effectif Élèves</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="container">
        <h1>Liste effectif de la classe de: {{ $classe }}</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Classe</th>
                    <th>Scolarité Payée</th>
                    <th>Scolarité Restante</th>
                    <th>Cantine Payée</th>
                    <th>Cantine Restante</th>
                    <th>Transport Payé</th>
                    <th>Transport Restant</th>
                    <th>Total Payé</th>
                    <th>Total Restant</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eleves as $index => $eleve)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $eleve->nom }}</td>
                    <td>{{ $eleve->prenom }}</td>
                    <td>{{ $eleve->classe }}</td>
                    <td>{{ $eleve->total_scolarite_payee }}</td>
                    <td>{{ $eleve->total_scolarite_restant }}</td>
                    <td>{{ $eleve->total_cantine_payee }}</td>
                    <td>{{ $eleve->total_cantine_restant }}</td>
                    <td>{{ $eleve->total_transport_payee }}</td>
                    <td>{{ $eleve->total_transport_restant }}</td>
                    <td>{{ $eleve->total_cantine_payee + $eleve->total_transport_payee + $eleve->total_scolarite_payee }}</td>
                    <td>{{ $eleve->total_cantine_restant + $eleve->total_transport_restant + $eleve->total_scolarite_restant }}</td>
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
