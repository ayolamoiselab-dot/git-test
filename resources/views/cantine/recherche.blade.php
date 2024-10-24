@extends("navbarmodel.navbar")

@section('content')



<form method="GET" action="{{ route('cantine.rechercher') }}">
    <input type="text" name="nom" placeholder="Nom de l'élève">
    <input type="text" name="prenom" placeholder="Prénom de l'élève">
    <button type="submit">Rechercher</button>
</form>

@if(isset($eleves))
    <ul>
        @foreach($eleves as $eleve)
            <li><a href="{{ route('cantine.paiement', ['id_eleve' => $eleve->id_eleve]) }}">
                {{ $eleve->nom }} {{ $eleve->prenom }} - Classe: {{ $eleve->classe }}
            </a></li>
        @endforeach
    </ul>
@endif
@endsection