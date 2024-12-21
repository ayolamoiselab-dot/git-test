<!-- resources/views/requetes/select_eleve.blade.php -->
@extends("navbarmodel.navbar2")

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélectionner Élève</title>
</head>
<body>
    <h1>Sélectionner Élève</h1>
    <form action="{{ route('requetes.selectFavorise') }}" method="POST">
        @csrf
        <label for="eleve_id">Élève :</label>
        <select name="id_eleve" id="id_eleve" required>
            @foreach ($eleves as $eleve)
                <option value="{{ $eleve->id_eleve }}">
                    {{ $eleve->nom }} - {{ $eleve->classe ?? 'Classe non définie' }} - {{ $eleve->scolarite_payee ?? $eleve->deja_payee }} payé
                </option>
            @endforeach
        </select>
        <input type="hidden" name="type" value="{{ $type }}">
        <button type="submit">Ajouter</button>
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
