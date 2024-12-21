@extends("navbarmodel.navbar2")
@section('title', 'rechercher reçu')
@section("content")
<main class="page-content">
    <div class="container">
        <h2>Rechercher un Reçu/Transaction</h2>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('recherche.recu.result.cant') }}" method="GET">
            <div class="form-group">
                <label for="numero_recu">Numéro de reçu :</label>
                <input type="text" name="numero_recu" id="numero_recu" class="form-control" placeholder="Entrez le numéro du reçu">
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </div>
</main>


@endsection
