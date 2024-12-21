<main class="page-content">
    <div class="container">
        <h2 class="title">Liste des Abonnés du Jour - {{ $aujourdhui }}</h2>

        @foreach($abonnesParClasse as $classe => $abonnes)
            <div class="class-group">
                <h3>Classe: {{ $classe }}</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Montant</th>
                            <th>Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($abonnes as $abonne)
                            <tr>
                                <td>{{ $abonne->nom }}</td>
                                <td>{{ $abonne->montant }}</td>
                                <td>{{ $abonne->type_paiement }}</td>
                                <td>
                                    @if($abonne->type_paiement === 'semaine')
                                        {{ $abonne->date_debut }} - {{ $abonne->date_fin }}
                                    @else
                                        {{ $abonne->date }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</main>

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
}

/* Tableaux en noir et blanc */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 10px;
    text-align: left;
    color: black; /* Texte en noir */
    background-color: white; /* Fond blanc */
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

    /* Éviter les marges lors de l'impression */
    body {
        margin: 0;
        padding: 0;
    }

    /* Rendre les éléments bien visibles */
    h2, h3 {
        color: black !important;
    }
}

</style>
