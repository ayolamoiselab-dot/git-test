<!-- resources/views/requetes/show_statistiques_fonds.blade.php -->
@extends("navbarmodel.navbar2")

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
        <p>Total encaissé pour la catégorie {{ $categorie }} du {{ $date_debut }} au {{ $date_fin }} : {{ $total }} FCFA</p>
    </div>
@endsection
