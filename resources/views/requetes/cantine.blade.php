@extends("navbarmodel.navbar2")

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requête Cantine</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f7f7f7;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }

        select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        select:focus, button:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            form {
                padding: 15px;
            }

            select, button {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <h1>Requête Cantine</h1>
    <form action="{{ route('requetes.cantineResult') }}" method="POST">
        @csrf
        <label for="tranche">Tranche :</label>
        <select name="tranche" id="tranche">
            <option value="1">1ère Tranche</option>
            <option value="2">2ème Tranche</option>
            <option value="3">3ème Tranche</option>
        </select>
        
        <label for="classe">Classe :</label>
        <select name="classe" id="classe">
            <option value="">Toutes les classes</option>
            @foreach ($classes as $classe)
                <option value="{{ $classe }}">{{ ucfirst($classe) }}</option>
            @endforeach
        </select>

        <label for="tri">Trier les résultats par :</label>
        <select name="tri" id="tri">
            <option value="general">Général</option>
            <option value="nouveau">Nouveau</option>
            <option value="ancien">Ancien</option>
        </select>

        <button type="submit">Rechercher</button>
    </form>
</body>
</html>
@endsection
