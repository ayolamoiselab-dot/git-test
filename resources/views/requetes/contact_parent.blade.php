<!-- resources/views/requetes/contact_parent.blade.php -->
@extends("navbarmodel.navbar")

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Contact Parent</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Contact Parent</h1>
        <form action="{{ route('requetes.get_contact_parent') }}" method="POST">
            @csrf
            <label for="nom">Nom de l'élève :</label>
            <input type="text" name="nom" id="nom" required>
            <button type="submit">Rechercher</button>
        </form>
    </div>
@endsection
