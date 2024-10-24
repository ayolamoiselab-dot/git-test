@extends("navbarmodel.navbar")

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requête piscine</title>
</head>
<body>
    <h1>Requête Piscine</h1>
    <form action="{{ route('requetes.piscine_impayes') }}" method="POST">
        @csrf
        <label for="classe">Classe:</label>
        <input type="text" id="classe" name="classe" required>

        <label for="tranche">Tranche (1-9):</label>
        <input type="number" id="tranche" name="tranche" min="1" max="9" required>

        <button type="submit">Rechercher</button>
    </form>
</body>
</html>
@endsection