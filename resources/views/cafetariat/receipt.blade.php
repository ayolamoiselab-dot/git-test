<main class="page-content">
    <div class="container">
        <div class="receipt-header">
            <img src="{{ asset('img/logopoussi_preview_rev_1.png') }}" alt="Logo de l'école" class="school-logo">
            <h2>Reçu de Cafetariat</h2>
        </div>
        <div class="receipt-body">
            <p>Numéro de Reçu: {{ $cafetariat->id }}</p>
            <p>Nom: {{ $cafetariat->nom }}</p>
            <p>Classe: {{ $cafetariat->classe }}</p>
            <p>Type de Paiement: {{ $cafetariat->type_paiement }}</p>
            <p>Montant: {{ $cafetariat->montant }}</p>

            @if($isSemaine)
                <p>Date de Début: {{ $cafetariat->date_debut }}</p>
                <p>Date de Fin: {{ $cafetariat->date_fin }}</p>
            @else
                <p>Date: {{ $cafetariat->date }}</p>
            @endif
        </div>
        <div class="receipt-footer">
            <p class="signature">Signature</p>
        </div>
    </div>
</main>
<link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">

<style>
    .receipt-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .school-logo {
        width: 200px;
    }

    .receipt-body {
        margin-top: 20px;
    }

    .receipt-footer {
        margin-top: 40px;
        text-align: left;
    }

    .signature {
        text-align: right;
        margin-top: 50px;
    }
</style>
