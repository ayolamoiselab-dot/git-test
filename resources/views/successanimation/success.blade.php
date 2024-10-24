


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <!-- Inclure des styles CSS pour l'animation et le message de succès -->
    <link rel="stylesheet" href="{{ asset('css/success.css') }}">
</head>
<body>
    <div class="success-container">
        <!-- Animation du rond coché en vert -->
        <div class="circle-animation">
            <div class="checkmark"></div>
        </div>
        <!-- Message de succès -->
        <h1>Succès !</h1>
        
    </div>

    <div class="container">
        <h1>Transaction réussie !</h1>
        <p>La transaction a été enregistrée avec succès.</p>
        <a href="{{ route('receipt.generate', ['id_eleve' => $eleve->id_eleve, 'type' => $type]) }}" class="btn btn-primary">Générer un reçu</a>
    </div>

   <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (confirm('Voulez-vous générer un reçu ?')) {
                window.location.href = "{{ route('receipt.generate', ['id_eleve' => $eleve->id_eleve, 'type' => $type]) }}";
            }
        });
        </script>
    -->
</body>
</html>



