@extends("navbarmodel.navbar")

@section('content')
    <div class="container">
        <h1>Enregistrer une Vente</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('ventes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom_acheteur">Nom de l'acheteur:</label>
                <input type="text" id="nom_acheteur" name="nom_acheteur" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="macarons">Macarons:</label>
                <input type="number" id="macarons" name="macarons" class="form-control" required min="0">
            </div>
            <div class="form-group">
                <label for="tshirts">T-Shirts:</label>
                <input type="number" id="tshirts" name="tshirts" class="form-control" required min="0">
            </div>
            <div class="form-group">
                <label for="tissu_bleu">Tissu Bleu:</label>
                <input type="number" id="tissu_bleu" name="tissu_bleu" class="form-control" required min="0" step="0.01">
            </div>
            <div class="form-group">
                <label for="tissu_jaune">Tissu Jaune:</label>
                <input type="number" id="tissu_jaune" name="tissu_jaune" class="form-control" required min="0" step="0.01">
            </div>
            <div class="form-group">
                <label for="date_enregistrement">Date d'enregistrement:</label>
                <input type="date" id="date_enregistrement" name="date_enregistrement" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer la Vente</button>
        </form>
    </div>
@endsection
