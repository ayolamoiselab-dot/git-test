@extends('navbarmodel.navbar')
@section('title', '')
@section('content')

<div class="container">
    <h1>Gestion des Versements de Cantine</h1>
    <!-- Formulaire de recherche par nom -->
    <form action="{{ url('/cantine/recherche') }}" method="POST">
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
                <form action="{{ route('cantine.miseajour', $eleve->id_eleve) }}" method="POST" id="update-form">
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
                        <label for="frais_cantine">Frais de Cantine :</label>
                        <input type="number" name="frais_cantine" id="frais_cantine" value="{{ $eleve->frais_cantine }}" class="form-control" readonly>
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

                    <button type="button" class="btn btn-primary" onclick="confirmAccessCode()">Mettre à jour</button>
                </form>
            </div>
        </div>
    @endisset
</div>

<!-- Fenêtre modale pour la saisie de la clé d'accès -->
<div id="accessCodeModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Entrer la clé d'accès</h2>
    <input type="password" id="access-code" maxlength="4" class="form-control" placeholder="Clé d'accès">
    <button class="btn btn-success mt-2" onclick="validateAccessCode()">Valider</button>
    <div id="error-message" class="text-danger mt-2" style="display:none;">Clé incorrecte. Veuillez réessayer.</div>
  </div>
</div>

<!-- Styles CSS pour la modal -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
        text-align: center;
        border-radius: 8px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        margin-top: 10px;
    }

    .text-danger {
        font-size: 14px;
    }



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

<!-- Script JavaScript pour la validation -->
<script>
    function confirmAccessCode() {
        document.getElementById('accessCodeModal').style.display = "block";
    }

    function closeModal() {
        document.getElementById('accessCodeModal').style.display = "none";
    }

    function validateAccessCode() {
        var accessCode = document.getElementById('access-code').value;
        if (accessCode === "7712") {
            document.getElementById('update-form').submit();
        } else {
            document.getElementById('error-message').style.display = "block";
        }
    }
</script>
@endsection
