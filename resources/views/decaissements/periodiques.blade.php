<!-- resources/views/decaissements/periodiques.blade.php -->
@extends("navbarmodel.navbar2")
@section("title", "Liste des Décaissements Périodiques")
@section("content")
<main class="page-content">
    <div class="container">
        <h2>Rechercher les Décaissements Périodiques</h2>
        <form action="{{ url('/decaissements/periodiques/resultats') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="start_date">Date de Début :</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">Date de Fin :</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </div>
</main>




@endsection
