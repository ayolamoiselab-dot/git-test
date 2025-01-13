@extends('navbarmodel.navbar2')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<h3>Plusieurs élèves correspondent à votre recherche :</h3>
<ul>
    @foreach($eleves as $eleve)
        <li>
            <a href="{{ route('favorisation.details', ['id' => $eleve->id_eleve, 'type' => $type]) }}">
                {{ $eleve->nom }} - Classe : {{ $eleve->classe }}
            </a>
        </li>
    @endforeach
</ul>
<style>
      .alert alert-danger {
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }

    .alert alert-success {
        color: green;
        font-weight: bold;
        margin-top: 10px;
    }
</style>
@endsection
