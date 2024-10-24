<!-- resources/views/requetes/index.blade.php -->
@extends("navbarmodel.navbar")
@section("content")
<!DOCTYPE html>
<html>
<head>
    <title>Requêtes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Requêtes</h1></br>
        <div class="requete-categories">
            <h2><mark style="color: red">Scolarité</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.scolarite') }}">-->Verification Tranches Scolarité</a></button></li>
            </ul>

            <h2><mark style="color: red">Compte Journalier</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.journalieres') }}">-->Situations Journalières</a></button></li>
            </ul>

            <h2><mark style="color: red">Cantine</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.cantine') }}">-->Verification Tranches Cantine</a></button></li>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.cantine_effectif') }}">-->Requête Effectif Cantine</a></button></li>
            </ul>

            <h2><mark style="color: red">Transport</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.transport') }}">-->Verification Tranches Transport</a></button></li>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.transport_effectif') }}">-->Requête Effectif Transport</a></button></li>
            </ul>

            <h2><mark style="color: red">Informatique</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.informatique') }}">-->Verification Tranches Informatique</a></button></li>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.informatique_effectif') }}">-->Requête Effectif Informatique</a></button></li>
            </ul>

            <h2><mark style="color: red">Piscine</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.piscine') }}">-->Verification Tranches Piscine</a></button></li>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.piscine') }}">-->Requête Effectif Piscine</a></button></li>
            </ul>

            <h2><mark style="color: red">Effectif</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.eleves_effectif') }}">-->Requête Effectif Élève</a></button></li>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.effectif_nouveaux_inscrits') }}">-->Effectif Total Nouveaux Inscrits</a></button></li>
            </ul>

            <h2><mark style="color: red">Statistiques</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.statistiques_fonds') }}">-->Statistique Périodique Fonds Encaissés</a></button></li>
            </ul>

            <h2><mark style="color: red">Élèves</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.contact_parent') }}">-->Contact Parent</a></button></li>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.choix_type') }}">-->Ajouter un Élève Favorisé</a></button></li>
            </ul>

            <h2><mark style="color: red">INSCRITS</mark></h2>
            <ul>
                <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.inscritsPeriodiques') }}">-->Nouveaux Inscrits</a></button></li>
            </ul>
        </div>
    </div>
@endsection
