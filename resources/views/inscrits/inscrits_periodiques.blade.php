@extends("navbarmodel.navbar2")
@section("content")

<main class="page-content">
    <div class="container">
        <h2 class="title">Rechercher les Nouveaux Inscrits</h2>

        <form action="{{ route('requetes.inscritsResultat') }}" method="GET">
            <div>
                <label for="date_debut">Date de début :</label>
                <input type="date" id="date_debut" name="date_debut" required>
            </div>
            <div>
                <label for="date_fin">Date de fin :</label>
                <input type="date" id="date_fin" name="date_fin" required>
            </div>
            <div>
                <button type="submit">Lancer la requête</button>
            </div>
        </form>
    </div>
</main>

<style>
    h2.title {
        margin-top: 2rem; /* Ajuste cette valeur pour descendre le titre */
    }
</style>



@endsection