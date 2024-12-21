@extends('navbarmodel.navbar2')
@section('title', 'Gestion de la Cantine')
@section('content')

<main class="page-content">
    <div class="search-bar">
        <form method="POST" action="{{ url('/recherche-cantine') }}">
            @csrf
            <input type="text" name="nom" placeholder="Rechercher par nom d'élève" required>
            <input type="text" name="prenom" placeholder="Rechercher par prénom (optionnel)">
            <button type="submit">Rechercher</button>
        </form>
    </div>

    @if(isset($erreur))
    <div class="alert alert-danger">
        {{ $erreur }}
    </div>
@endif

    @if (isset($eleve))
        <div class="eleve-info">
            <div>
                <label for="nom">Nom complet:</label>
                <input type="text" id="nom" name="nom" value="{{ $eleve->nom }}" readonly>
            </div>
            <div>
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" value="{{ $eleve->prenom }}" readonly>
            </div>
            <p><strong>Niveau:</strong> {{ $eleve->niveau }}</p>
            <p><strong>Classe:</strong> {{ $eleve->classe }}</p>
        </div>
        <div class="cantine-form">
            <form method="POST" action="{{ url('/enregistrer-cantine') }}">
                @csrf
                <input type="hidden" name="id_eleve" value="{{ $eleve->id_eleve }}">
                <div>
                    <label>Frais de cantine</label>
                    <input type="number" name="frais_cantine" required>
                </div>

                <h3>Tranches de Paiement</h3>
                @for ($i = 1; $i <= 9; $i++)
                    <div>
                        <label for="date_versement{{ $i }}">Date de Versement {{ $i }}</label>
                        <input type="date" name="date_versement{{ $i }}" id="date_versement{{ $i }}" class="form-control">
                    </div>
                    <div>
                        <label for="montant{{ $i }}">Montant {{ $i }}</label>
                        <input type="number" name="montant{{ $i }}" id="montant{{ $i }}" class="form-control">
                    </div>
                @endfor
                <button type="submit">Enregistrer</button>
            </form>
        </div>
    @endif
</main>

<!-- Styles pour la gestion de la cantine -->
<style>
    .search-bar {
        margin-bottom: 20px;
    }

    .search-bar input {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 200px;
    }

    .search-bar button {
        padding: 10px 20px;
        border: none;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .alert alert-danger {
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }
    .eleve-info {
        margin-bottom: 20px;
    }

    .eleve-info div {
        margin-bottom: 10px;
    }

    .eleve-info label {
        display: block;
        margin-bottom: 5px;
    }

    .eleve-info input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #e9ecef;
    }

    .cantine-form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .cantine-form div {
        margin-bottom: 10px;
    }

    .cantine-form label {
        display: block;
        margin-bottom: 5px;
    }

    .cantine-form input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .cantine-form button {
        margin-top: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>



@endsection
