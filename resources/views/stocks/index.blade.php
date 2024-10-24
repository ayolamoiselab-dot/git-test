@extends("navbarmodel.navbar")

@section('content')
    <div class="container">
        <h1>Gestion des Stocks</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ route('stocks.create') }}" class="btn btn-primary">Ajouter du Stock</a>
        <form action="{{ route('stocks.update') }}" method="POST" class="mt-3">
            @csrf
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produit</th>
                        <th>Quantité en stock</th>
                        <th>Ajouter/Réduire</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td>{{ $stock->id }}</td>
                            <td>{{ $stock->produit }}</td>
                            <td>{{ $stock->quantite_restante }}</td>
                            <td>
                                <input type="number" name="stocks[{{ $stock->id }}]" value="0" min="0">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Mettre à jour les stocks</button>
        </form>
    </div>
@endsection
