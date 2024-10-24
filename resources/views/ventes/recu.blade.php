<link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">


<div class="container">
    <h1>Reçu de Vente</h1>
    <div class="recu">
        <div class="header">
            <img src="{{ $logo }}" alt="Logo de l'école" class="logo">
            <div class="numero-recu">{{ $numero_recu }}</div>
        </div>
        <div class="details">
            <p>Reçu de : {{ $nom_acheteur }}</p>
            <p>Date : {{ $date_enregistrement }}</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $produit => $quantite)
                    @if($quantite > 0)
                    <tr>
                        <td>{{ ucfirst($produit) }}</td>
                        <td>{{ $quantite }}</td>
                        <td>{{ $produit === 'macarons' ? 500 : 2500 }}</td>
                        <td>{{ $quantite * ($produit === 'macarons' ? 500 : 2500) }}</td>
                    </tr>
                    @endif
                    @endforeach
                    <tr>
                        <td colspan="3">Total</td>
                        <td>{{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="signature">
            <p>{{ $signature }}</p>
        </div>
    </div>
</div>

<div class="container">
    <h1>Reçu de Vente</h1>
    <div class="recu">
        <div class="header">
            <img src="{{ $logo }}" alt="Logo de l'école" class="logo">
            <div class="numero-recu">{{ $numero_recu }}</div>
        </div>
        <div class="details">
            <p>Reçu de : {{ $nom_acheteur }}</p>
            <p>Date : {{ $date_enregistrement }}</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $produit => $quantite)
                    @if($quantite > 0)
                    <tr>
                        <td>{{ ucfirst($produit) }}</td>
                        <td>{{ $quantite }}</td>
                        <td>{{ $produit === 'macarons' ? 500 : 2500 }}</td>
                        <td>{{ $quantite * ($produit === 'macarons' ? 500 : 2500) }}</td>
                    </tr>
                    @endif
                    @endforeach
                    <tr>
                        <td colspan="3">Total</td>
                        <td>{{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="signature">
            <p>{{ $signature }}</p>
        </div>
    </div>
</div>


<style>
    /* resources/css/recu.css */

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .recu {
        border: 1px solid #000;
        padding: 20px;
        border-radius: 10px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .logo {
        width: 150px;
        /* Ajustez la taille du logo si nécessaire */
        height: auto;
    }

    .numero-recu {
        font-size: 18px;
        font-weight: bold;
    }

    .details p {
        font-size: 16px;
        margin: 5px 0;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th,
    .table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .signature {
        text-align: right;
        margin-top: 30px;
    }

    .signature p {
        margin: 0;
        font-size: 16px;
        font-style: italic;
    }
</style>