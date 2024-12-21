<!-- resources/views/decaissements/rechercher.blade.php -->
@extends("navbarmodel.navbar2")
@section("title", "Rechercher un Décaissement")
@section("content")
<main class="page-content">
    <div class="container">
        <h2>Rechercher un Décaissement</h2>
        <form action="{{ url('/decaissements/rechercher/resultats') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom_decaissier">Nom du Décaisseur :</label>
                <input type="text" name="nom_decaissier" id="nom_decaissier" class="form-control">
            </div>
            <div class="form-group">
                <label for="nom_beneficiaire">Nom du Bénéficiaire :</label>
                <input type="text" name="nom_beneficiaire" id="nom_beneficiaire" class="form-control">
            </div>
            <div class="form-group">
                <label for="numero_decaissement">Numéro de Décaissement :</label>
                <input type="text" name="numero_decaissement" id="numero_decaissement" class="form-control">
            </div>
            <div class="form-group">
                <label for="type">Type :</label>
                <input type="text" name="type" id="type" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </div>
</main>




@endsection
