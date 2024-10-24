<!-- resources/views/requetes/select_classe.blade.php -->
@extends("navbarmodel.navbar")

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Choisir Classe</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Choisir Classe</h1>
        <form action="{{ url()->current() }}" method="POST">
            @csrf
            <label for="classe">Classe :</label>
            <select name="classe" id="classe" required>
                <option value="TOUTES LES CLASSES">TOUTES LES CLASSES</option>
                <option value="maternelle1">Maternelle 1</option>
                <option value="maternelle2">Maternelle 2</option>
                <option value="maternelle3">Maternelle 3</option>
                <option value="cp1">CP1</option>
                <option value="cp2">CP2</option>
                <option value="ce1">CE1</option>
                <option value="ce2">CE2</option>
                <option value="cm1">CM1</option>
                <option value="cm2">CM2</option>
            </select>
            <button type="submit">Lancer la Requête</button>
        </form>
    </div>
@endsection
