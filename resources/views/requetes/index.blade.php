@extends("navbarmodel.navbar2")
@section("content")
<!DOCTYPE html>
<html>
<head>
    <title>Requêtes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Conteneur principal */
        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-family: 'Arial', sans-serif;
        }

        /* Titre principal */
        .container h1 {
            font-size: 28px;
            text-align: center;
            color: #0056b3;
            margin-bottom: 20px;
        }

        /* Titre des catégories */
        .requete-categories h2 {
            font-size: 22px;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #e63946;
            border-bottom: 2px solid #e63946;
            display: inline-block;
            padding-bottom: 5px;
        }

        /* Liste des boutons */
        .requete-categories ul {
            list-style: none;
            padding-left: 0;
        }

        /* Boutons et liens */
        .requete-categories li {
            margin: 10px 0;
        }

        .requete-categories a {
            text-decoration: none;
            color: #0056b3;
            font-size: 16px;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .requete-categories a:hover {
            color: #003d80;
            transform: translateX(5px);
        }

        .requete-categories .btn {
            padding: 10px 15px;
            background-color: #ffffff;
            border: 2px solid #0056b3;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .requete-categories .btn:hover {
            background-color: #0056b3;
            color: #ffffff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .container h1 {
                font-size: 24px;
            }

            .requete-categories h2 {
                font-size: 18px;
            }

            .requete-categories a {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Requêtes</h1>
        <div class="requete-categories">
            <h2>Scolarité</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.scolarite') }}">--> Verification Tranches Scolarité</a></button></li>
            </ul>

            <h2>Compte Journalier</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.journalieres') }}">--> Situations Journalières</a></button></li>
            </ul>

            <h2>Cantine</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.cantine') }}">--> Verification Tranches Cantine</a></button></li>
                <li><button class="btn"><a href="{{ route('requetes.cantine_effectif') }}">--> Requête Effectif Cantine</a></button></li>
            </ul>

            <h2>Transport</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.transport') }}">--> Verification Tranches Transport</a></button></li>
                <li><button class="btn"><a href="{{ route('requetes.transport_effectif') }}">--> Requête Effectif Transport</a></button></li>
            </ul>

            <h2>Informatique</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.informatique') }}">--> Verification Tranches Informatique</a></button></li>
                <li><button class="btn"><a href="{{ route('requetes.informatique_effectif') }}">--> Requête Effectif Informatique</a></button></li>
            </ul>

            <h2>Piscine</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.piscine') }}">--> Verification Tranches Piscine</a></button></li>
                <li><button class="btn"><a href="{{ route('requetes.piscine') }}">--> Requête Effectif Piscine</a></button></li>
            </ul>

            <h2>Effectif</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.eleves_effectif') }}">--> Requête Effectif Élève</a></button></li>
                <li><button class="btn"><a href="{{ route('requetes.effectif_nouveaux_inscrits') }}">--> Effectif Total Nouveaux Inscrits</a></button></li>
            </ul>

            <h2>Statistiques</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.statistiques_fonds') }}">--> Statistique Périodique Fonds Encaissés</a></button></li>
            </ul>

            <h2>Élèves</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.contact_parent') }}">--> Contact Parent</a></button></li>
                <li><button class="btn"><a href="{{ route('requetes.choix_type') }}">--> Ajouter un Élève Favorisé</a></button></li>
            </ul>

            <h2>INSCRITS</h2>
            <ul>
                <li><button class="btn"><a href="{{ route('requetes.inscritsPeriodiques') }}">--> Nouveaux Inscrits</a></button></li>
            </ul>
        </div>
    </div>
</body>
@endsection
