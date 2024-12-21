
<main class="page-content">
    <div class="container">
        <h2>Fiche de Décaissement</h2>
        <div class="fiche">
            <div class="header">
                <div class="logo">
                    <img src="{{ asset('img/logopoussi_preview_rev_1.png') }}" alt="Logo de l'école" class="logo">
                </div>
                <div class="info">
                    <p><strong>Numéro de Décaissement :</strong> {{ $decaissement->numero_decaissement }}</p>
                    <p><strong>Date :</strong> {{ $decaissement->date }}</p>
                </div>
            </div>
            <div class="details">
                <p><strong>Décaisseur :</strong> {{ $decaissement->nom_decaissier }}</p>
                <p><strong>Bénéficiaire / Entreprise :</strong> {{ $decaissement->nom_beneficiaire }}</p>
                <p><strong>Type de Décaissement :</strong> {{ $decaissement->type }}</p>
                <p><strong>Libellé :</strong> {{ $decaissement->libelle }}</p>
                <p><strong>Montant :</strong> {{ number_format($decaissement->montant, 2) }} FCFA</p>
                @if($decaissement->preuve)
                <p><strong>Preuve :</strong> <a href="{{ Storage::url($decaissement->preuve) }}" target="_blank">Voir la preuve</a></p>
                @endif
            </div>
            <div class="footer">
                <p><strong>Signature :</strong> ___________________________</p>
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




