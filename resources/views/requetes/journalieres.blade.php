<!-- resources/views/requetes/journalieres.blade.php -->
@extends("navbarmodel.navbar")
@section("content")
<!DOCTYPE html>
<html>
<head>
    <title>Requêtes Journalières</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Requêtes Journalières</h1>
        <ul>
            <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.journalieres.scolarite') }}">Versement Scolarité du Jour</a></button></li>
            <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.journalieres.cantine') }}">Versement Cantine du Jour</a></button></li>
            <li><button type="submit" class="btn btn-link"><a href="{{ route('requetes.journalieres.transport') }}">Versement Transport du Jour</a></button></li>
        </ul>
    </div>
@endsection
