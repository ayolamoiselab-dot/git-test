<div class="container">
    <h1>Effectif Total des Nouveaux Inscrits</h1>

    <p>Total des Nouveaux Inscrits : <strong>{{ $totalNouveauxInscrits }}</strong></p>

    <h2>Répartition par Classe</h2>

    @foreach($repartitionParClasse as $classe => $eleves)
    <h3>{{ $classe }}</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prénom</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eleves as $index => $eleve)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $eleve->nom }}</td>
                <td>{{ $eleve->prenom }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
</div>

<style>
    .container {
        margin-top: 20px;
    }

    h1,
    h2,
    h3 {
        color: #333;
    }

    .table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }
</style>