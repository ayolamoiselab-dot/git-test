<!-- resources/views/requetes/favorise.blade.php -->
@extends("navbarmodel.navbar2")

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Élève Favorisé</title>
</head>
<body>
    <h1>Ajouter Élève Favorisé</h1>
    <form action="{{ route('requetes.addFavorise') }}" method="POST">
        @csrf
        <label for="nom">Nom de l'élève :</label>
        <input type="text" name="nom" id="nom" required>
        <input type="hidden" name="type" value="{{ $type }}">
        <button type="submit">Rechercher</button>
    </form>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="success">
            <p>{{ session('success') }}</p>
        </div>
    @endif



    
</body>
</html>
@endsection
