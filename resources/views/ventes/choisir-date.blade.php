@extends("navbarmodel.navbar2")

@section('title', 'Choisir une Date')

@section('content')
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="container">
    <h1>Choisir une Date</h1>
    <form action="{{ route('ventes.jour.resultats') }}" method="GET">
        <div class="form-group">
            <label for="date">Sélectionnez une date pour afficher les ventes :</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Voir les ventes</button>
    </form>
</div>
@endsection
