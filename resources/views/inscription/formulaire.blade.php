@extends('navbarmodel.navbar2')
@section('title', 'Inscription')
@section('content')

@if(isset($erreur))
<div class="alert alert-danger">
    {{ $erreur }}
</div>
@endif

    <form action="{{ route('enregistrer_eleve') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="status">Statut:</label><br>
        <input type="checkbox" id="fraisinscription" name="fraisinscription" value="nouveau">
        <label for="nouveau">Nouveau</label><br>
        <input type="checkbox" id="ancien" name="status" value="ancien">
        <label for="ancien">Ancien</label><br>
        
        <div id="fraisInscriptionDiv"><!--<label for="INSCRIPTION">Frais Inscription</label>--></div>

        <label for="nom">Nom de l'élève :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="sexe">Sexe:</label><br>
        <select id="sexe" name="sexe" required>
            <option value="masculin">MASCULIN</option>
            <option value="feminin">FEMININ</option>
        </select><br>

        <label for="dossier">Dossier (PDF):</label><br>
        <input type="file" id="dossier" name="dossier" accept=".pdf"><br>

        <label for="classe">Niveau :</label>
        <select id="classe" name="classe" onchange="calculerScolarite()">
            <option value="maternelle">Maternelle</option>
            <option value="primaire">Primaire</option>
            <option value="college">Collège</option>
        </select>

        <label for="niveauxSelect">Classe :</label>
        <div id="niveauxDiv"></div>

        <label for="contactparent">Contact Parent:</label><br>
        <input type="text" id="contactparent" name="contactparent" required><br>

        <label for="scolariteTotal">Scolarité totale :</label>
        <input type="text" id="scolariteTotal" name="scolariteTotal" readonly><br>

        <label for="methode_paiement">Méthode de Paiement :</label><br>
        <select id="methode_paiement" name="methode_paiement" required>
            <option value="trimestrielle">Trimestrielle</option>
            <option value="mensuelle">Mensuelle</option>
        </select><br>

          <!-- Nouveau champ pour la date d'inscription -->
          <label for="date_inscription">Date d'inscription :</label>
          <input type="date" id="date_inscription" name="date_inscription"><br>
  
          <!-- Nouveau champ pour le libellé -->
          <label for="libelle">Libellé :</label>
          <input type="text" id="libelle" name="libelle"><br>

        <label for="reduction">Réduction :</label>
        <input type="checkbox" id="reduction" name="reduction" onchange="calculerScolarite()"> 10(%)

        <input type="submit" value="Enregistrer">
    </form>

    <script src="{{ asset('js/inscription.js') }}"></script>

    <style>
         .alert alert-danger {
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }
    </style>




@endsection
