@extends("navbarmodel.navbar")
@section('title', 'Gestion des Ventes')

@section('content')
<main class="page-content">
    <div class="card">
        <div class="content">
        <h3><mark style="color: red">Nouvelle Vente</mark></h3>
        <a href="{{ route('ventes.create') }}" class="btn btn-primary">Accéder</a>
        </div>
    </div>
    <div class="card">
        <div class="content">
        <h3><mark style="color: red">Les Ventes du Jour</mark></h3>
        <a href="{{ route('ventes.jour') }}" class="btn btn-primary">Accéder</a>
        </div>
    </div>
    <div class="card">
        <div class="content">
        <h3><mark style="color: red">Ajouter du stock</mark></h3>
        <a href="{{ route('showAddStockForm') }}" class="btn btn-primary">Accéder</a>
        </div>
    </div>

    <div class="card">
        <div class="content">
        <h3><mark style="color: red">Quantites Restantes</mark></h3>
        <a href="{{ route('showRemainingQuantities') }}" class="btn btn-primary">Accéder</a>
        </div>
    </div>
</main>
@endsection

<style>
    .statistics {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        font-size: 50px;
        color: #007bff;
        margin-right: 20px;
    }

    .stat-info h3 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .stat-info p {
        margin: 5px 0 0;
        font-size: 24px;
        font-weight: bold;
        color: #007bff;
    }
</style>
