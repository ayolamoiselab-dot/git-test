@extends('navbarmodel.navbar2')

@section('content')
<div class="form-container">
    <h3>Sélectionner le type et la classe</h3>
    <form action="{{ route('favorisation.get.favorises') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Type de faveur :</label>
            <select name="type" required>
                <option value="scolarite">Scolarité</option>
                <option value="cantine">Cantine</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Classe :</label>
            <select name="classe" required>
                @foreach($classes as $classe)
                    <option value="{{ $classe }}">{{ ucfirst($classe) }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit">Afficher la liste</button>
    </form>
</div>

<style>
    /* Conteneur principal du formulaire */
    .form-container {
        width: 100%;
        max-width: 500px;
        margin: 40px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
    }

    /* Titre */
    .form-container h3 {
        text-align: center;
        font-size: 24px;
        color: #0056b3;
        margin-bottom: 20px;
    }

    /* Groupes de champs */
    .form-group {
        margin-bottom: 20px;
    }

    /* Labels */
    .form-group label {
        display: block;
        font-size: 16px;
        color: #333;
        margin-bottom: 8px;
    }

    /* Inputs et sélections */
    .form-group select, .form-group input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        transition: border-color 0.3s;
    }

    /* Style au focus */
    .form-group select:focus, .form-group input:focus {
        border-color: #0056b3;
        outline: none;
        background-color: #ffffff;
    }

    /* Bouton */
    button[type="submit"] {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        color: #ffffff;
        background-color: #0056b3;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
        background-color: #003d80;
    }

    /* Réactivité pour petits écrans */
    @media (max-width: 768px) {
        .form-container {
            padding: 15px;
        }

        .form-container h3 {
            font-size: 20px;
        }

        .form-group label {
            font-size: 14px;
        }

        .form-group select, .form-group input {
            font-size: 14px;
        }

        button[type="submit"] {
            font-size: 14px;
        }
    }
</style>
@endsection
