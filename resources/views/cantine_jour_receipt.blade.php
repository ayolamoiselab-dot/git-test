<!-- resources/views/cantine_jour_receipt.blade.php -->

<main class="page-content">
    <div class="container">
        <h2>Reçu de Cantine Jour</h2>
        <div class="fiche">
            <div class="header">
                <div class="logo">
                    <img src="{{ asset('img/logopoussi_preview_rev_1.png') }}" alt="Logo de l'école">
                </div>
                <div class="info">
                    <p><strong>Numéro de Reçu :</strong> REC{{ str_pad($decaissement->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Date :</strong> {{ $decaissement->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="details">
                <p><strong>Nom et Prénom :</strong> {{ $decaissement->nom }} {{ $decaissement->prenom }}</p>
                <p><strong>Classe :</strong> {{ $decaissement->classe }}</p>
                <p><strong>Type de Paiement :</strong> {{ ucfirst($decaissement->type_paiement) }}</p>
                <p><strong>Montant :</strong> {{ number_format($decaissement->montant, 2) }} FCFA</p>

                @if($decaissement->type_paiement == 'semaine')
                    <p><strong>Période :</strong> du {{ \Carbon\Carbon::parse($decaissement->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($decaissement->date_fin)->format('d/m/Y') }}</p>
                @endif
            </div>
            <div class="signature">
                <p>Signature : ____________________</p>
            </div>
        </div>
    </div>
</main>
<main class="page-content">
    <div class="container">
        <h2>Fiche de Cantine</h2>
        <div class="fiche">
            <div class="header">
                <div class="logo">
                    <img src="{{ asset('img/logopoussi_preview_rev_1.png') }}" alt="Logo de l'école">
                </div>
                <div class="info">
                    <p><strong>Numéro de Reçu :</strong> REC{{ str_pad($decaissement->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Date :</strong> {{ $decaissement->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="details">
                <p><strong>Nom et Prénom :</strong> {{ $decaissement->nom }} {{ $decaissement->prenom }}</p>
                <p><strong>Classe :</strong> {{ $decaissement->classe }}</p>
                <p><strong>Type de Paiement :</strong> {{ ucfirst($decaissement->type_paiement) }}</p>
                <p><strong>Montant :</strong> {{ number_format($decaissement->montant, 2) }} FCFA</p>

                @if($decaissement->type_paiement == 'semaine')
                    <p><strong>Période :</strong> du {{ \Carbon\Carbon::parse($decaissement->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($decaissement->date_fin)->format('d/m/Y') }}</p>
                @endif
            </div>
            <div class="signature">
                <p>Signature : ____________________</p>
            </div>
        </div>
    </div>
</main>
<link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">

<style>
    .fiche {
        background-color: #fff; /* Arrière-plan blanc */
        border: 1px solid #000;
        padding: 20px;
        margin-top: 20px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .logo img {
        max-width: 200px;
    }
    .info {
        text-align: right;
    }
    .details p {
        margin: 5px 0;
    }
    .footer {
        text-align: right;
        margin-top: 20px;
    }
</style>

