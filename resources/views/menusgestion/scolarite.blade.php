@extends('navbarmodel.navbar')
@section('title', '')
@section('content')
    <div class="container">
        <h1>Gestion de la Scolarité</h1>
        <!-- Formulaire de recherche par nom -->
        <form action="{{ url('/scolarite-recherche') }}" method="POST">
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
                    <form action="{{ url('/scolarite-miseajour', $eleve->id_eleve) }}" method="POST" id="updateForm">
                        @csrf
                        <input type="hidden" name="_method" value="POST">
                        
                        <!-- Champs du formulaire -->
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" id="nom" value="{{ $eleve->nom }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prenom :</label>
                            <input type="text" name="prenom" id="prenom" value="{{ $eleve->prenom }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="libelle">Libelle :</label>
                            <input type="text" name="libelle" id="libelle" value="{{ $eleve->libelle }}" class="form-control">
                        </div>

                        <!-- Boucle des versements -->
                        @for ($i = 1; $i <= 9; $i++)
                            <div class="form-group">
                                <label for="date_versement{{ $i }}">Date de versement pour la tranche {{ $i }} :</label>
                                <input type="date" name="date_versement{{ $i }}" id="date_versement{{ $i }}" value="{{ $eleve["date_versement$i"] ?? '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="montant{{ $i }}">Montant versé pour la tranche {{ $i }} :</label>
                                <input type="number" name="montant{{ $i }}" id="montant{{ $i }}" value="{{ $eleve["montant$i"] ?? '' }}" class="form-control">
                            </div>
                        @endfor

                        <div class="form-group">
                            <label for="scolarite_total">Scolarité totale :</label>
                            <input type="text" name="scolarite_total" id="scolarite_total" value="{{ $eleve->scolarite_total }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="scolarite_payee">Scolarité déjà payée :</label>
                            <input type="text" name="scolarite_payee" id="scolarite_payee" value="{{ $eleve->scolarite_payee }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="scolarite_restante">Scolarité restante :</label>
                            <input type="text" name="scolarite_restante" id="scolarite_restante" value="{{ $eleve->scolarite_restante }}" class="form-control">
                        </div>

                        <!-- Champ de confirmation avant soumission -->
                        <div class="form-group">
                            <label for="confirmation_code">Entrez le code de confirmation :</label>
                            <input type="text" id="confirmation_code" maxlength="4" class="form-control" required>
                        </div>

                        <!-- Bouton de mise à jour avec confirmation -->
                        <button type="submit" class="btn btn-primary" id="updateButton">Mettre à jour</button>
                    </form>
                </div>
            </div>
        @endisset
    </div>

    <script>
        document.getElementById('updateForm').addEventListener('submit', function(event) {
            var confirmationCode = document.getElementById('confirmation_code').value;

            // Vérifie que le code est exactement "9421"
            if (confirmationCode !== "9421") {
                alert("Code de confirmation incorrect");
                event.preventDefault(); // Empêche la soumission si le code est incorrect
            }
        });
    </script>

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

        .alert.alert-danger {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
@endsection
