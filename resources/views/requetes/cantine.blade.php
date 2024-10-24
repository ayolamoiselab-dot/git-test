@extends("navbarmodel.navbar")

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requête Cantine</title>
</head>
<body>
    
    <h1>Requête Cantine</h1>
    <form action="{{ route('requetes.cantineResult') }}" method="POST">
        @csrf
        <label for="tranche">Tranche :</label>
        <select name="tranche" id="tranche">
            <option value="1">1ère Tranche (55 000)</option>
            <option value="2">2ème Tranche (110 000)</option>
            <option value="3">3ème Tranche (165 000)</option>
        </select>
        
        <label for="classe">Classe :</label>
        <select name="classe" id="classe">
            <option value="">Toutes les classes</option>
            @foreach ($classes as $classe)
                <option value="{{ $classe }}">{{ ucfirst($classe) }}</option>
            @endforeach
        </select>

        <!-- Partie ajoutée pour le tri des résultats -->
        <label for="tri">Trier les résultats par :</label>
        <select name="tri" id="tri">
            <option value="general">Général</option>
            <option value="nouveau">Nouveau</option>
            <option value="ancien">Ancien</option>
        </select>

        <button type="submit">Rechercher</button>
    </form>
</body>
</html>
@endsection
