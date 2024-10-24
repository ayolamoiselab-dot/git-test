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

        .totals-row {
            font-weight: bold;
            background-color: #dcdcdc;
        }

        /* Aligner les cellules du bas */
        .totals-row td {
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>Liste non à jour Cantine Tranche {{ $tranche }} Classe : {{ $classe }} ANNÉE SCOLAIRE 2024-2025</h1>

    @if($elevesNotUpToDate->isEmpty())
        <p>Aucun élève trouvé.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th> <!-- Numérotation -->
                    <th>Nom</th>
                    <th>Classe</th>
                    <th>Cantine Total</th>
                    <th>Cantine Payée</th>
                    <th>Restant à completer</th>
                    
                    <th>Date Dernier Versement</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach($elevesNotUpToDate as $index => $eleve)
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Affiche le numéro -->
                        <td>{{ $eleve->nom }}</td>
                        <td>{{ $eleve->eleve->classe }}</td>
                        <td>{{ $eleve->frais_cantine }}</td>
                        <td>{{ $eleve->deja_payee }}</td>
                        <td>{{ $eleve->restant_a_payer }}</td>
                       
                        <td>{{ $eleve->dernier_versement_cantine_date }}</td>
                     
                    </tr>
                @endforeach

                <!-- Ajouter une ligne pour afficher les totaux correctement alignés -->
                <tr class="totals-row">
                    <td colspan="4" style="text-align: left;">Totaux</td>
                    <td>{{ $totalScolaritePayee }} FCFA</td>
                    <td>{{ $totalRestantAPayer }} FCFA</td> <!-- Cellule vide pour laisser un espace sous "Restant à completer" -->
                    <td></td> <!-- Cellule vide pour laisser un espace sous "Cantine Restante" -->
                    <td></td> <!-- Cellule vide pour laisser un espace sous "Dernier Versement Date" -->
                   
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>
