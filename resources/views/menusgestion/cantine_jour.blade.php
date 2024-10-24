@extends("navbarmodel.navbar")

@section('content')
    <div class="container">
        <h1>recettes cantine du Jour</h1>
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
                            <a href="{{ route('ventes.generateReceipt', $vente->id) }}" class="btn btn-secondary">Générer Reçu</a>
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
@endsection
