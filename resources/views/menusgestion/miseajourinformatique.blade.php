@extends('navbarmodel.navbar2')
@section('title', '')
@section('content')

<div class="container">
    <h1>Gestion des Versements de l'informatique</h1>
    <!-- Formulaire de recherche par nom -->
    <form action="{{ route('informatique.recherche') }}" method="POST">
        @csrf
        <input type="text" name="nom" placeholder="Nom de l'élève">
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    @if(isset($erreur))
    <div class="alert alert-danger">
        {{ $erreur }}
    </div>
@endif

    <!-- Affichage des informations de l'élève -->
    @isset($eleve)
        <div class="cardscosco">
            <div class="cardsco-body">
                <h5 class="cardsco-title">Informations sur l'élève</h5>
                <form action="{{ route('informatique.miseajour', $eleve->id_eleve) }}" method="POST">
                    @csrf
                    
                    
                    <!-- Champs du formulaire -->
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom" id="nom" value="{{ $eleve->nom }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" name="prenom" id="prenom" value="{{ $eleve->prenom }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="frais_transport">Frais de transport :</label>
                        <input type="number" name="frais_informatique" id="frais_informatique" value="{{ $eleve->frais_informatique }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="deja_payee">Total déjà payé :</label>
                        <input type="number" name="deja_payee" id="deja_payee" value="{{ $eleve->deja_payee }}" class="form-control" readonly>
                    </div>

                    <!-- Affichage des versements déjà effectués et inputs pour les versements non encore effectués -->
                    <h3>Tranches de Paiement</h3>
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="form-group">
                            <label for="date_versement{{ $i }}">Date de Versement {{ $i }}</label>
                            <input type="date" name="date_versement{{ $i }}" id="date_versement{{ $i }}" value="{{ $eleve->{'date_versement'.$i} }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="montant{{ $i }}">Montant {{ $i }}</label>
                            <input type="number" name="montant{{ $i }}" id="montant{{ $i }}" value="{{ $eleve->{'montant'.$i} }}" class="form-control">
                        </div>
                    @endfor

                    <div class="form-group">
                        <label for="montant_restant">Montant Restant :</label>
                        <input type="number" name="montant_restant" id="montant_restant" value="{{ $eleve->montant_restant }}" class="form-control" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    @endisset
</div>

<style>
    .cardsco {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .cardsco .content {
        padding: 20px;
    }
    .cardsco .title {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }
    .cardscosco .btn {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .cardscosco .btn:hover {
        background-color: #45a049;
    }

    .alert alert-danger {
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }
</style>




@endsection
