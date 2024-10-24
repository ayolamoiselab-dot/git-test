<!DOCTYPE html>
<html>
<head>
    <title>Résultats Requêtes Scolarité</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @php
    $libelleTranche = $tranche == 1 ? 'Première Tranche' : ($tranche == 2 ? 'Deuxième Tranche' : 'Troisième Tranche');
    $libelleTri = $tri == 'nouveau' ? 'Nouveaux Élèves' : ($tri == 'ancien' ? 'Anciens Élèves' : 'Général');
    @endphp

    <div class="container">
        <h1>
            LISTE DES NON À JOUR SCOLARITE POUR LA {{ $libelleTranche }} 
            ({{ $libelleTri }}) 
            ANNÉE SCOLAIRE 2024-2025 
            Classe : {{ $classe }}
        </h1>  

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th> <!-- Numérotation -->
                    <th>Nom</th>
                    <th>Classe</th>
                    <th>Total Scolarité</th>
                    <th>Déjà Payée</th>
                    <th>Restant à Complèter</th>
                    <th>Date du Dernier Versement</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($elevesNotUpToDate as $index => $eleve)
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Numéro de ligne -->
                        <td>{{ $eleve->nom }} @if($eleve->est_favorise == 'favorise')<sup>favorisé</sup>@endif</td>
                        <td>{{ $eleve->classe }}</td>
                        <td>{{ $eleve->scolarite_total }}</td>
                        <td>{{ $eleve->scolarite_payee }}</td>
                        <td>{{ $eleve->restant_a_payer }}</td>
                        <td>{{ $eleve->dernier_versement_date }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th>{{ $totalScolaritePayee }}</th>
                    <th>{{ $totalRestantAPayer }}</th>
                    
                </tr>
            </tfoot>
            
        </table>
    </div>

    <style>
        /* public/css/app.css */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:hover {
            background-color: #f1f1f1;
        }

         /* public/css/app.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
}

.container {
    max-width: 900px;
    margin: 30px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.table th {
    background-color: #f2f2f2;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

.table-striped tbody tr:hover {
    background-color: #f1f1f1;
}

.table tfoot th, .table tfoot td {
    font-weight: bold;
    text-align: right;
}

    </style>
</body>
</html>
