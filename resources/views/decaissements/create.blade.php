@extends("navbarmodel.navbar")
@section("title", "Nouveau Décaissement")
@section("content")
<main class="page-content">
    <div class="container">
        <h2>Nouveau Décaissement</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('decaissements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nom_decaissier">Nom du Décaisseur</label>
                <input type="text" class="form-control" id="nom_decaissier" name="nom_decaissier" required>
            </div>
            <div class="form-group">
                <label for="nom_beneficiaire">Nom du Bénéficiaire / Entreprise</label>
                <input type="text" class="form-control" id="nom_beneficiaire" name="nom_beneficiaire" required>
            </div>
            <div class="form-group">
                <label for="type">Type de Décaissement</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="Facture">Facture</option>
                    <option value="Ravitaillement Cantine">Ravitaillement Cantine</option>
                    <option value="Dépenses Cafétariat">Dépenses Cafétariat</option>
                    <option value="Divers">Divers</option>
                </select>
            </div>
            <div class="form-group">
                <label for="libelle">Libellé</label>
                <textarea class="form-control" id="libelle" name="libelle" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <div class="form-group">
                <label for="montant">Montant</label>
                <input type="number" class="form-control" id="montant" name="montant" required>
            </div>
            <div class="form-group">
                <label for="preuve">Preuve / Reçu (facultatif)</label>
                <input type="file" class="form-control" id="preuve" name="preuve">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</main>
@endsection
