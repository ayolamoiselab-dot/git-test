<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultat</title>
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
</head>

<body>

<main class="page-content">
    <div class="container">
        <h2 class="title">Résultats des Nouveaux Inscrits</h2>

        @if($eleves->isEmpty())
            <p>Aucun élève trouvé dans cet intervalle de dates.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Classe</th>
                        <th>Date d'Inscription</th>
                        <th>Frais d'Inscription</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eleves as $index => $eleve)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $eleve->nom }}</td>
                            <td>{{ $eleve->prenom }}</td>
                            <td>{{ $eleve->classe }}</td>
                            <td>{{ $eleve->date_inscription }}</td>
                            <td>{{ $eleve->frais_inscription }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p><strong>Total d'inscrits :</strong> {{ $totalInscrits }}</p>
            <p><strong>Total des frais d'inscription (25000f par élève) :</strong> {{ $totalFrais }}f</p>
        @endif
    </div>
</main>

<!-- Ajoutez ce code juste avant la balise </body> -->
<div class="print-button-container">
    <button onclick="window.print()" class="print-button">Imprimer</button>
    <button onclick="downloadPDF()" class="print-button">Télécharger</button>
</div>

<script>
    function downloadPDF() {
        var opt = {
            margin:       1,
            filename:     'resultat.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().set(opt).save();
    }
</script>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    table th {
        background-color: #f4f4f4;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .print-button-container {
        margin-top: 20px;
    }

    .print-button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        margin-right: 10px;
        font-size: 16px;
    }

    .print-button:hover {
        background-color: #45a049;
    }

    @media print {
        .print-button-container {
            display: none;
        }
    }
</style>

</body>

</html>
