<!-- resources/views/cafetariat/success.blade.php -->
@extends("navbarmodel.navbar")
@section("title", "Enregistrement Réussi")
@section("content")

<main class="page-content">
    <div class="container">
        <h2>Enregistrement Réussi</h2>
        <p>Nom: {{ $cafetariat->nom }}</p>
        <p>Classe: {{ $cafetariat->classe }}</p>
        <p>Montant: {{ $cafetariat->montant }}</p>

        @if($cafetariat->type_paiement == 'jour')
            <p>Date: {{ $cafetariat->date }}</p>
        @elseif($cafetariat->type_paiement == 'semaine')
            <p>Date de début: {{ $cafetariat->date_debut }}</p>
            <p>Date de fin: {{ $cafetariat->date_fin }}</p>
        @endif

        <p>Type de paiement: {{ $cafetariat->type_paiement }}</p>
        <a href="{{ url('/cafetariat/recette/' . $cafetariat->id) }}"><button class="btn btn-primary">Générer Fiche Reçu</button></a>
    </div>
</main>

@endsection
