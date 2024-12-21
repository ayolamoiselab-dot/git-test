<!-- resources/views/cafetariat/period_result.blade.php -->


<main class="page-content">
    <div class="card">
        <div class="content">
            <h2 class="title">Résultats des Recettes Périodiques</h2>
            <p>Du {{ $startDate->format('d/m/Y') }} au {{ $endDate->format('d/m/Y') }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Classe</th>
                        <th>Montant</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recettes as $recette)
                    <tr>
                        <td>{{ $recette->nom }}</td>
                        <td>{{ $recette->classe }}</td>
                        <td>{{ $recette->montant }}</td>
                        <td>{{ $recette->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>Total des Fonds Encaissés: {{ $total }} FCFA</h3>
        </div>
    </div>
</main>

<style>
    .page-content {
        padding: 20px;
        background-color: #f9f9f9;
    }

    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
    }

    .card .content {
        text-align: left;
    }

    .card .title {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .card table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .card table th,
    .card table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .card table th {
        background-color: #f2f2f2;
    }

    .card table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .card table tr:hover {
        background-color: #f1f1f1;
    }

    .card h3 {
        margin-top: 20px;
        font-size: 20px;
        text-align: right;
    }

</style>


