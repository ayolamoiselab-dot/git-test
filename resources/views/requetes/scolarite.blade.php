@extends("navbarmodel.navbar2")
@section("content")
<!DOCTYPE html>
<html>
<head>
    <title>Requête Scolarité</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Requête Scolarité</h1>
        <form action="{{ route('requetes.scolarite.result') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="tranche">Tranche:</label>
                <select name="tranche" id="tranche" class="form-control">
                    <option value="1">Première Tranche</option>
                    <option value="2">Deuxième Tranche</option>
                    <option value="3">Troisième Tranche</option>
                </select>
            </div>
            <div class="form-group">
                <label for="classe">Classe:</label>
                <select name="classe" id="classe" class="form-control">
                    <option value="">Toutes les Classes</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe }}">{{ $classe }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Partie ajoutée pour le tri des résultats -->
            <div class="form-group">
                <label for="tri">Trier les résultats par :</label>
                <select name="tri" id="tri" class="form-control">
                    <option value="general">Général</option>
                    <option value="nouveau">Nouveau</option>
                    <option value="ancien">Ancien</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lancer la Requête</button>
        </form>
    </div>


    
</body>
</html>
@endsection
