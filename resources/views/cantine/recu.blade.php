<h2>Reçu de paiement pour {{ $eleve->nom }} {{ $eleve->prenom }}</h2>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Montant</th>
        </tr>
    </thead>
    <tbody>
        @foreach($paiements as $paiement)
            <tr>
                <td>{{ $paiement->date_versement }}</td>
                <td>{{ $paiement->montant }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@if($eleve->cantineJournaliere)
    <p>Total payé : {{ $eleve->cantineJournaliere->montant_total_verse }} / {{ $eleve->cantineJournaliere->frais_annuel }}</p>
@else
    <p>Aucun enregistrement de cantine trouvé pour cet élève.</p>
@endif
