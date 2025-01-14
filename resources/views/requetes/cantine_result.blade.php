<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la Requête Cantine</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .totals-row {
            font-weight: bold;
            background-color: #dcdcdc;
        }

        .totals-row td {
            text-align: right;
        }

        .favorise {
            color: red;
            font-size: 0.9em;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            font-size: 1.2em;
            color: #666;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f7f7;
        }

        table {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Custom button for printing */
        .print-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
            text-align: center;
        }

        .print-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Liste non à jour Cantine Tranche {{ $tranche }} Classe : {{ $classe }} ANNÉE SCOLAIRE 2024-2025</h1>

    @if($elevesNotUpToDate->isEmpty())
        <p>Aucun élève trouvé.</p>
    @else
        <a href="#" class="print-btn" onclick="window.print()">Imprimer</a>
        <table>
            <thead>
                <tr>
                    <th>#</th> <!-- Numérotation -->
                    <th>Nom</th>
                    <th>Classe</th>
                    <th>Cantine Total</th>
                    <th>Cantine Payée</th>
                    <th>Restant à Compléter</th>
                    <th>Date Dernier Versement</th>
                </tr>
            </thead>
            <tbody>
                @foreach($elevesNotUpToDate as $index => $eleve)
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Affiche le numéro -->
                        <td>
                            {{ $eleve->nom }}
                            @if($eleve->est_favorise_cantine)
                                <span class="favorise">(est favorisé)</span>
                            @endif
                        </td>
                        <td>{{ $eleve->eleve->classe }}</td>
                        <td>{{ $eleve->frais_cantine }} FCFA</td>
                        <td>{{ $eleve->deja_payee }} FCFA</td>
                        <td>{{ $eleve->restant_a_payer }} FCFA</td>
                        <td>{{ $eleve->dernier_versement_cantine_date }}</td>
                    </tr>
                @endforeach

                <!-- Ajouter une ligne pour afficher les totaux correctement alignés -->
                <tr class="totals-row">
                    <td colspan="4" style="text-align: left;">Totaux</td>
                    <td>{{ $totalScolaritePayee }} FCFA</td>
                    <td>{{ $totalRestantAPayer }} FCFA</td>
                    <td></td> <!-- Cellule vide pour laisser un espace sous "Dernier Versement Date" -->
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>
