@extends("navbarmodel.navbar2")

@section('content')

<h2>Paiement pour {{ $eleve->nom }} {{ $eleve->prenom }}</h2>

<form method="POST" action="{{ route('cantine.enregistrer', ['id_eleve' => $eleve->id_eleve]) }}">
    @csrf
    <label>Frais annuels de cantine :</label>
    <input type="number" name="frais_cantine" value="{{ $cantineJournaliere->frais_cantine ?? '' }}" required>

    <label>Montant à payer aujourd'hui :</label>
    <input type="number" name="montant" value="1500" required>

    <button type="submit">Enregistrer Paiement</button>
</form>




@endsection