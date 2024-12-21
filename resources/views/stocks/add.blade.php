@extends("navbarmodel.navbar2")
@section('content')
    <div class="container">
        <h1>Ajouter du stock</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('addStock') }}" method="POST">
            @csrf
            @foreach ($produits as $produit)
                <div class="form-group">
                    <label for="{{ $produit }}">{{ ucfirst($produit) }}</label>
                    <input type="number" name="{{ $produit }}" id="{{ $produit }}" class="form-control" value="0" required min="0" step="0.01">
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
