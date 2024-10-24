<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu {{ $numero_recu }}</title>
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

</head>

<body>
    <div class="receipt">
        <div class="header">
            <img src="{{ $logo }}" alt="Logo de l'école" class="logo">
            <div class="receipt-number">Reçu n° {{ $numero_recu }}</div>
        </div>
        <div class="details">
            <p>Reçu de : {{ $nom_eleve }}</p>
            <p>Classe : {{ $classe }}</p>
            <p>Montant versé aujourd'hui : {{ $montant_verse }} </p>
            <p>Pour : {{ $type }}</p>
            <p>Total payé à ce jour : {{ $total_paye }}</p>
            <p>Montant restant : {{ $montant_restant }}</p>
            <p>statut : {{ $statut }}</p>
            <p>Date d'enregistrement : {{ $date_enregistrement }}</p>
        </div>
        <div class="signature">
            <p>{{ $signature }}</p>
        </div>
    </div>

    <!-- Ajoutez ce code juste avant la balise </body> -->
    <div class="print-button-container">
        <button onclick="window.print()" class="print-button">Imprimer</button>
        <button onclick="downloadPDF()" class="print-button">Télécharger</button>
    </div>


    <script>
        function downloadPDF() {
            var element = document.querySelector('.receipt'); // Sélectionne l'élément du reçu
            var opt = {
                margin:       1,
                filename:     'recu_{{ $numero_recu }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(element).set(opt).save();
        }
    </script>
    


    <style>
        /* receipt.css */

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .receipt {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            max-height: 100px;
            background-color: #ffffff;
            /* Fond de l'image en blanc */

        }

        .receipt-number {
            font-size: 18px;
            font-weight: bold;
        }

        .details {
            margin-bottom: 30px;
        }

        .details p {
            margin: 10px 0;
            font-size: 16px;
        }

        .signature {
            text-align: right;
            margin-top: 40px;
        }

        .signature p {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #333333;
        }

        /* receipt.css */

        /* Style pour le bouton d'impression */
        .print-button-container {
            text-align: center;
            margin-top: 20px;
        }

        .print-button {
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        /* Cacher le bouton lors de l'impression */
        @media print {
            .print-button-container {
                display: none;
            }
        }
    </style>
</body>

</html>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu {{ $numero_recu }}</title>
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}">
</head>

<body>
    <div class="receipt">
        <div class="header">
            <img src="{{ $logo }}" alt="Logo de l'école" class="logo">
            <div class="receipt-number">Reçu n° {{ $numero_recu }}</div>
        </div>
        <div class="details">
            <p>Reçu de : {{ $nom_eleve }}</p>
            <p>Classe : {{ $classe }}</p>
            <p>Montant de la tranche versé aujourd'hui : {{ $montant_verse }} </p>
            <p>Pour : {{ $type }}</p>
            <p>Total payé à ce jour : {{ $total_paye }}</p>
            <p>Montant restant : {{ $montant_restant }}</p>
            <p>statut : {{ $statut }}</p>
            <p>Date d'enregistrement : {{ $date_enregistrement }}</p>
        </div>
        <div class="signature">
            <p>{{ $signature }}</p>
        </div>
    </div>

    <!-- Ajoutez ce code juste avant la balise </body> -->
    <div class="print-button-container">
        <button onclick="window.print()" class="print-button">Imprimer</button>
    </div>


    <style>
        /* receipt.css */

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .receipt {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dcdcdc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            max-height: 100px;
            background-color: #ffffff;
            /* Fond de l'image en blanc */

        }

        .receipt-number {
            font-size: 18px;
            font-weight: bold;
        }

        .details {
            margin-bottom: 30px;
        }

        .details p {
            margin: 10px 0;
            font-size: 16px;
        }

        .signature {
            text-align: right;
            margin-top: 40px;
        }

        .signature p {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #333333;
        }

        /* receipt.css */

        /* Style pour le bouton d'impression */
        .print-button-container {
            text-align: center;
            margin-top: 20px;
        }

        .print-button {
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        /* Cacher le bouton lors de l'impression */
        @media print {
            .print-button-container {
                display: none;
            }
        }
    </style>
</body>

</html>