@extends("navbarmodel.navbar")
@section("content")
    <div class="container">
        <h1>Requête : Versements de Transport</h1>
        <form action="{{ route('requetes.journalieres.transport.result') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">Sélectionnez la date :</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Voir les résultats</button>
        </form>
    </div>
@endsection