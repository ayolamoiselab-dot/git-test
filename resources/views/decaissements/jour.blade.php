@extends("navbarmodel.navbar")
@section('title', 'Décaissements du Jour')

@section('content')
<main class="page-content">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container">
        <h2>Rechercher les Décaissements du Jour</h2>
        
        <!-- Formulaire pour entrer la date -->
        <form action="{{ route('decaissements.jour.search') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">Choisir la date :</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        @if(isset($decaissements))
            <h2 class="mt-4">Résultats des Décaissements</h2>
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
                        <th>Actions</th>
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
                            <td>
                                <!-- Icône de poubelle pour la suppression avec demande de code d'accès -->
                                <form action="{{ route('decaissements.destroy', $decaissement->id) }}" method="POST" id="delete-form-{{ $decaissement->id }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $decaissement->id }})">
                                        🗑️
                                    </button>
                                </form>
                            </td>
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
        @endif
    </div>
</main>

<!-- JavaScript pour la confirmation de suppression avec code d'accès -->
<script>
    function confirmDelete(decaissementId) {
        // Demander à l'utilisateur d'entrer un code d'accès
        const code = prompt("Entrez la clé d'accès de suppression (4 chiffres) :");

        // Valider si le code est correct (ici 9421)
        if (code === "9421") {
            // Si correct, soumettre le formulaire de suppression
            document.getElementById('delete-form-' + decaissementId).submit();
        } else {
            // Si incorrect, afficher un message d'erreur
            alert("Clé d'accès incorrecte. Suppression annulée.");
        }
    }
</script>

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

    .btn-danger {
        color: white;
        background-color: red;
        border: none;
        cursor: pointer;
    }

    .btn-danger:hover {
        background-color: darkred;
    }
</style>
@endsection
