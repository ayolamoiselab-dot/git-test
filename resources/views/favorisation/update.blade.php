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

<h2>Rechercher un élève</h2>
<form action="{{ route('favorisation.rechercher') }}" method="GET" class="search-form">
    @csrf
    <label for="nom">Nom de l'élève :</label>
    <input type="text" name="nom" id="nom" required placeholder="Ex: Doe">
    
    <label for="type">Type :</label>
    <select name="type" id="type" required>
        <option value="scolarite">Scolarité</option>
        <option value="cantine">Cantine</option>
    </select>
    
    <button type="submit">Rechercher</button>
</form>

@if(isset($eleves) && $eleves->count() > 1)
    <h3>Plusieurs élèves correspondent à votre recherche :</h3>
    <ul>
        @foreach($eleves as $eleve)
            <li>
                <a href="{{ route('favorisation.rechercher', ['nom' => $eleve->nom, 'type' => $type, 'id' => $eleve->id_eleve]) }}">
                    {{ $eleve->nom }} - Classe : {{ $eleve->classe }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
@if(isset($eleve) && $eleve)
    @if(
        ($type == 'scolarite' && isset($eleve->est_favorise) && $eleve->est_favorise) || 
        ($type == 'cantine' && isset($eleve->est_favorise_cantine) && $eleve->est_favorise_cantine)
    )
        <h2>Modifier les réductions</h2>
        <form action="{{ route('favorisation.enregistrer') }}" method="POST" class="edit-form">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="id_eleve" value="{{ $eleve->id_eleve }}">

            <label>Nom :</label>
            <input type="text" value="{{ $eleve->nom }}" disabled>

            <label>Classe :</label>
            @if($type == 'scolarite')
                <input type="text" value="{{ $eleve->classe }}" disabled>
            @elseif($type == 'cantine')
                <input type="text" value="{{ $eleve->eleve->classe ?? 'Classe non disponible' }}" disabled>
            @endif

            @if($type == 'scolarite')
                <label>Frais normal (Scolarité) :</label>
                <input type="number" value="{{ $eleve->scolarite_total }}" disabled id="frais_normal">
            @elseif($type == 'cantine')
                <label>Frais normal (Cantine) :</label>
                <input type="number" value="{{ $eleve->frais_cantine }}" disabled id="frais_normal">
            @endif

            <label>Réduction (FCFA) :</label>
            <input type="decimal" name="reduction_fcfa" id="reduction_fcfa" placeholder="Saisir la réduction en FCFA">
            
            <label>Réduction (%) :</label>
            <input type="decimal" name="reduction_pourcentage" id="reduction_pourcentage" placeholder="Saisir la réduction en %">
            
            <button type="submit">Enregistrer</button>
        </form>
    @else
        <p>
            @if($type == 'scolarite')
                Cet élève n'est pas favorisé pour la scolarité.
            @elseif($type == 'cantine')
                Cet élève n'est pas favorisé pour la cantine.
            @endif
        </p>
    @endif
@endif

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f9f9f9;
    }
    .search-form, .edit-form {
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }
    input, select, button {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }
    button {
        background-color: #007BFF;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
    .alert {
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<script>
    const fcfaInput = document.getElementById('reduction_fcfa');
    const pourcentageInput = document.getElementById('reduction_pourcentage');
    const fraisNormal = document.getElementById('frais_normal')?.value;

    // Conversion automatique entre FCFA et Pourcentage
    fcfaInput?.addEventListener('input', () => {
        const total = parseFloat(fraisNormal || 0);
        if (total > 0) {
            pourcentageInput.value = ((fcfaInput.value / total) * 100).toFixed(2);
        }
    });

    pourcentageInput?.addEventListener('input', () => {
        const total = parseFloat(fraisNormal || 0);
        if (total > 0) {
            fcfaInput.value = ((pourcentageInput.value / 100) * total).toFixed(2);
        }
    });
</script>

@endsection
