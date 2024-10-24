<!-- resources/views/decaissements/resultats_recherche.blade.php -->

<main class="page-content">
    <div class="container">
        <h2>Résultats de la Recherche</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Numéro de Décaissement</th>
                    <th>Décaisseur</th>
                    <th>Bénéficiaire</th>
                    <th>Type</th>
                    <th>Libellé</th>
                    <th>Montant (FCFA)</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($decaissements as $index => $decaissement)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $decaissement->numero_decaissement }}</td>
                    <td>{{ $decaissement->nom_decaissier }}</td>
                    <td>{{ $decaissement->nom_beneficiaire }}</td>
                    <td>{{ $decaissement->type }}</td>
                    <td>{{ $decaissement->libelle }}</td>
                    <td>{{ number_format($decaissement->montant, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($decaissement->date)->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6">Total</th>
                    <th>{{ number_format($totalMontant, 2) }} FCFA</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</main>

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .table, .table th, .table td {
        border: 1px solid #ddd;
    }

    .table th, .table td {
        padding: 8px;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
    }

    tfoot th {
        text-align: right;
    }
</style>

