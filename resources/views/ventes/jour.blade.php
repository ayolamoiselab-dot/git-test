
    <div class="container">
        <h1>Ventes du Jour</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ route('ventes.create') }}" class="btn btn-primary">Enregistrer une Vente</a>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de l'acheteur</th>
                    <th>Macarons</th>
                    <th>T-Shirts</th>
                    <th>Tissu Bleu</th>
                    <th>Tissu Jaune</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventes as $vente)
                    <tr>
                        <td>{{ $vente->id }}</td>
                        <td>{{ $vente->nom_acheteur }}</td>
                        <td>{{ $vente->macarons }}</td>
                        <td>{{ $vente->tshirts }}</td>
                        <td>{{ $vente->tissu_bleu }}</td>
                        <td>{{ $vente->tissu_jaune }}</td>
                        <td>{{ $vente->total }}</td>
                        <td>
                            <!-- Bouton pour générer le reçu -->
                            <a href="{{ route('ventes.generateReceipt', $vente->id) }}" class="btn btn-secondary">Générer Reçu</a>

                            <!-- Icône de poubelle pour la suppression -->
                            <form action="{{ route('ventes.destroy', $vente->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $vente->id }}">
                                @csrf
                                @method('DELETE')
                                <!-- Icône de poubelle -->
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $vente->id }})">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="2">Totaux</th>
                    <th>{{ $totalMacarons }}</th>
                    <th>{{ $totalTshirts }}</th>
                    <th>{{ $totalTissuBleu }}</th>
                    <th>{{ $totalTissuJaune }}</th>
                    <th>{{ $totalGeneral }}</th>
                    <th></th>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(venteId) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette vente ?")) {
                // Soumettre le formulaire correspondant si l'utilisateur confirme
                document.getElementById('delete-form-' + venteId).submit();
            }
        }
    </script>

<style>
    /* Styles globaux */
body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Style pour le bouton principal */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Styles pour le tableau */
.table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.table thead th {
    background-color: #007bff;
    color: white;
    padding: 12px;
    text-align: left;
    border-bottom: 2px solid #0056b3;
}

.table tbody td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Style pour les totaux */
.table tfoot th {
    background-color: #007bff;
    color: white;
    padding: 12px;
    text-align: left;
}

.table tfoot td {
    background-color: #f1f1f1;
}

/* Boutons d'action */
.btn-secondary, .btn-danger {
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 14px;
    color: white;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn-secondary {
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.btn-danger {
    background-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Icône pour la suppression et génération de reçu */
button.btn-danger {
    background-color: transparent;
    border: none;
    color: #dc3545;
    font-size: 20px;
    cursor: pointer;
    transition: color 0.3s ease;
}

button.btn-danger:hover {
    color: #c82333;
}

/* Styles spécifiques à l'impression */
@media print {
    .btn, .btn-secondary, .btn-danger {
        display: none;
    }

    /* Supprimer les marges et ombres lors de l'impression */
    .container {
        box-shadow: none;
        margin: 0;
        padding: 0;
    }
}

</style>