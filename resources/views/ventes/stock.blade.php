@extends("navbarmodel.navbar2")
@section('title', 'Gestion des Stocks')

@section('content')
@if (session('success'))
<div class="error-message">
    {{ session('erreur') }}
</div>
@endif

<h1>Gestion des Stocks</h1>

<form action="{{ route('ventes.stock.update') }}" method="POST">
    @csrf
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Quantité en stock</th>
                <th>Ajouter/Réduire quantité</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $index => $stock)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stock->produit }}</td>
                    <td>{{ $stock->quantite }}</td>
                    <td>
                        <input type="number" name="stocks[{{ $stock->id }}]" value="0">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit">Mettre à jour les stocks</button>
</form>
@endsection

<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f4f4f4;
}
</style>
