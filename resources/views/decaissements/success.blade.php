@extends("navbarmodel.navbar2")
@section("title", "Décaissement Réussi")
@section("content")
<main class="page-content">
    <div class="container">
        <h2>Décaissement Réussi</h2>
        <p>Le décaissement a été enregistré avec succès.</p>
        <p><strong>Numéro de Décaissement :</strong> {{ $decaissement->numero_decaissement }}</p>
        <a href="{{ route('decaissements.show', $decaissement->id) }}" class="btn btn-primary">Générer la Fiche de Décaissement</a>
    </div>
</main>



@endsection

