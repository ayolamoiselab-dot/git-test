<!-- resources/views/cafetariat/recettes-jour.blade.php -->

<main class="page-content">
    <div class="container">
        <!-- Titre avec date dynamique -->
        <h2>Situation Cafetariat du {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h2>

        @foreach($enregistrementsParClasse as $classe => $enregistrements)
            <div class="classe-section">
                <h3>Classe: {{ $classe }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enregistrements as $enregistrement)
                            <tr>
                                <td>{{ $enregistrement->nom }}</td>
                                <td>{{ $enregistrement->type_paiement }}</td>
                                <td>{{ $enregistrement->montant }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>Total pour {{ $classe }}</strong></td>
                            <td><strong>{{ $totauxParClasse[$classe] }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach

        <div class="total-general">
            <h3>Total Général des Fonds Encaissés Aujourd'hui: {{ $totalGeneral }}</h3>
        </div>
    </div>
</main>

<!-- Lien vers le CSS d'impression -->
<link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">

<!-- Style CSS amélioré pour une impression présentable -->
<style>
    /* Conteneur principal */
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Style pour les titres */
    h2, h3 {
        color: black;
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center; /* Centrer les titres */
    }

    /* Tableaux bien espacés */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        table-layout: fixed; /* Fixer la largeur des colonnes */
    }

    th, td {
        padding: 12px;
        text-align: left;
        word-wrap: break-word; /* Forcer le passage à la ligne pour éviter le débordement */
    }

    th {
        background-color: #f2f2f2; /* Couleur de fond pour l'entête */
        font-weight: bold;
    }

    /* Ajouter une bordure autour du tableau */
    table, th, td {
        border: 1px solid black;
    }

    /* Styles d'impression pour forcer la simplicité */
    @media print {
        /* Supprimer tous les arrière-plans */
        * {
            background-color: white !important;
            color: black !important;
        }

        /* S'assurer que tout est en noir et blanc avec des bordures visibles */
        table, th, td {
            border: 1px solid black;
            background-color: white;
        }

        /* Éviter les marges trop importantes lors de l'impression */
        body {
            margin: 0;
            padding: 0;
        }

        /* Ajouter des marges spécifiquement pour l'impression */
        @page {
            margin: 20mm;
        }

        /* Rendre les éléments bien visibles et éviter les débordements */
        h2, h3 {
            color: black !important;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .table {
            page-break-inside: avoid; /* Éviter que les tableaux soient coupés sur plusieurs pages */
        }
    }
</style>



