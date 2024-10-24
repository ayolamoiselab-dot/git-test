<!-- resources/views/cafetariat/period_form.blade.php -->

@extends("navbarmodel.navbar")
@section("title", "Recherche des Recettes Périodiques")
@section("content")

<main class="page-content">
    
        <div class="container">
            <h2 class="title">Recherche des Recettes Périodiques</h2>
            <form method="POST" action="{{ route('cafetariat.recettes.periodiques.result') }}">
                @csrf
                <div class="form-group">
                    <label for="start_date">Date de Début :</label>
                    <input type="date" id="start_date" name="start_date" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Date de Fin :</label>
                    <input type="date" id="end_date" name="end_date" required>
                </div>
                <button type="submit" class="btn">Rechercher</button>
            </form>
        </div>
    
</main>

@endsection
