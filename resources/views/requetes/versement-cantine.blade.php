<!DOCTYPE html>
<html>
<head>
    <title>Versement Cantine du Jour</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Versement Cantine du {{ $date }}</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Classe</th>
                    <th>Montant Versé</th>
                </tr>
            </thead>
            <tbody>
                <!-- Affichage des versements provenant de la table Cantine -->
                @foreach($versementsCantine as $index => $cantine)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $cantine->eleve->nom }}</td>
                    <td>{{ $cantine->eleve->prenom }}</td>
                    <td>{{ $cantine->eleve->classe }}</td>
                    <td>
                        @php
                            $montantVerseAujourdHui = 0;
                            $today = \Carbon\Carbon::parse($date)->toDateString();
                            for ($i = 1; $i <= 8; $i++) {
                                if ($cantine["date_versement$i"] === $today) {
                                    $montantVerseAujourdHui = $cantine["montant$i"];
                                    break;
                                }
                            }
                        @endphp
                        {{ $montantVerseAujourdHui }}
                    </td>
                </tr>
                @endforeach

                <!-- Affichage des versements provenant de la table CantineJour -->
                @foreach($versementsCantineJour as $index => $cantineJour)
                <tr>
                    <td>{{ $versementsCantine->count() + $index + 1 }}</td>
                    <td>{{ $cantineJour->nom }}</td>
                    <td>{{ $cantineJour->prenom }}</td>
                    <td>{{ $cantineJour->classe }}</td>
                    <td>{{ $cantineJour->montant }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total des Montants Versés : {{ $total }}</h3>
    </div>

    <style>
        /* styles.css */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-family: 'Arial', sans-serif;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-family: 'Arial', sans-serif;
        }

        table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        h3 {
            text-align: right;
            color: #333;
            font-family: 'Arial', sans-serif;
            margin-top: 0;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            table th, table td {
                padding: 8px;
            }
        }
    </style>
</body>
</html>
