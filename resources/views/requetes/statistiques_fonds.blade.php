<!-- resources/views/requetes/statistiques_fonds.blade.php -->
@extends("navbarmodel.navbar")

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Statistiques Fonds Encaissés</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Statistiques Fonds Encaissés</h1>
        <form action="{{ route('requetes.get_statistiques_fonds') }}" method="POST">
            @csrf
            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie" required>
                <option value="scolarite">Scolarité</option>
                <option value="cantine">Cantine</option>
            </select>
            <label for="date_debut">Date Début :</label>
            <input type="date" name="date_debut" id="date_debut" required>
            <label for="date_fin">Date Fin :</label>
            <input type="date" name="date_fin" id="date_fin" required>
            <button type="submit">Lancer la Requête</button>
        </form>
    </div>
@endsection
