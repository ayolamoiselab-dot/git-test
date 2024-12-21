@extends("navbarmodel.navbar2")

@section('content')
<div class="container">
    <h1>Quantités restantes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité restante</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quantites_restantes as $produit => $quantite)
                <tr>
                    <td>{{ ucfirst($produit) }}</td>
                    <td>{{ $quantite }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
