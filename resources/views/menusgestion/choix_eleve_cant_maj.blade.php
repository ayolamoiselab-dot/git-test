@extends('navbarmodel.navbar')
@section('title', 'Choix de l\'élève')
@section('content')
<div class="container">
    <h1>Choisissez un élève</h1>
    <p>Plusieurs élèves correspondent à votre recherche. Veuillez choisir un élève.</p>
    <ul>
        @foreach ($eleves as $eleve)
            <li>
                <form action="{{ url('/recherche-cantine-maj') }}" method="POST">
                    @csrf
                    <input type="hidden" name="nom" value="{{ $eleve->nom }}">
                    <input type="hidden" name="prenom" value="{{ $eleve->prenom }}">
                    <button type="submit" class="btn btn-link">{{ $eleve->nom }} {{ $eleve->prenom }}</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
