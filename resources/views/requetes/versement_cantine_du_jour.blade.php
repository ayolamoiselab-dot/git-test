<!DOCTYPE html>
<html>
<head>
    <title>Versement Cantine du Jour</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Versement Cantine du Jour</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Classe</th>
                    <th>Montant Versé</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cantinePayments as $index => $cantine)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $cantine->nom }}</td>
                        <td>{{ $cantine->prenom }}</td>
                        <td>{{ $cantine->classe }}</td>
                        <td>
                            @php
                                $montantVerseAujourdHui = 0;
                                $today = \Carbon\Carbon::today()->toDateString();
                                for ($i = 1; $i <= 8; $i++) {
                                    // Vérifiez si la date du versement correspond à aujourd'hui
                                    if ($cantine["date_versement$i"] === $today) {
                                        $montantVerseAujourdHui = $cantine["montant$i"];
                                        break; // On sort de la boucle après avoir trouvé le montant d'aujourd'hui
                                    }
                                }
                            @endphp
                            {{ $montantVerseAujourdHui }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total: {{ $total }}</h3>
    </div>

    <style>
        /* styles.css */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

h1 {
    text-align: center;
    color: #333;
    font-family: 'Arial', sans-serif;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    font-family: 'Arial', sans-serif;
}

table th {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #f1f1f1;
}

h3 {
    text-align: right;
    color: #333;
    font-family: 'Arial', sans-serif;
    margin-top: 0;
}

@media (max-width: 600px) {
    .container {
        padding: 10px;
    }

    table th, table td {
        padding: 8px;
    }
}

    </style>
</body>
</html>
