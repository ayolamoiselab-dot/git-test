<!-- resources/views/requetes/select_type.blade.php -->
@extends("navbarmodel.navbar")

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir Type de Favorisation</title>
</head>
<body>
    <h1>Choisir Type de Favorisation</h1>
    <form action="{{ route('requetes.favorise') }}" method="POST">
        @csrf
        <label for="type">Type :</label>
        <select name="type" id="type" required>
            <option value="scolarite">Scolarité</option>
            <option value="cantine">Cantine</option>
        </select>
        <button type="submit">Continuer</button>
    </form>
</body>
</html>
@endsection
