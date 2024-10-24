<!-- resources/views/cafetariat/form.blade.php -->
@extends("navbarmodel.navbar")
@section("title", "Nouvel Enregistrement Cafetariat")
@section("content")

<main class="page-content">
    <div class="container">
        <h2>Nouvel Enregistrement</h2>
        <form action="{{ url('/cafetariat/enregistrer') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="classe">Classe :</label>
                <select name="classe" id="classe" class="form-control" required>
                    @foreach($classes as $classe)
                        <option value="{{ $classe }}">{{ $classe }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="type_paiement">Type de Paiement :</label>
                <select name="type_paiement" id="type_paiement" class="form-control" required>
                    <option value="jour">Jour</option>
                    <option value="semaine">Semaine</option>
                </select>
            </div>
            <div class="form-group date-fields">
                <label for="date">Date (obligatoire) :</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="form-group week-fields" style="display: none;">
                <label for="date_debut">Date de Début :</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control">
            </div>
            <div class="form-group week-fields" style="display: none;">
                <label for="date_fin">Date de Fin :</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control">
            </div>
            <div class="form-group">
                <label for="montant">Montant :</label>
                <input type="number" name="montant" id="montant" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</main>

<script>
document.getElementById('type_paiement').addEventListener('change', function() {
    var type = this.value;
    var dateField = document.getElementById('date');
    var weekFields = document.querySelectorAll('.week-fields');

    if (type === 'jour') {
        // Afficher le champ "date" et le rendre requis
        dateField.closest('.form-group').style.display = 'block';
        dateField.setAttribute('required', 'required');

        // Masquer les champs "date_debut" et "date_fin" et retirer l'attribut requis
        weekFields.forEach(function(field) {
            field.style.display = 'none';
            field.querySelector('input').removeAttribute('required');
        });
    } else if (type === 'semaine') {
        // Masquer le champ "date" et retirer l'attribut requis
        dateField.closest('.form-group').style.display = 'none';
        dateField.removeAttribute('required');

        // Afficher les champs "date_debut" et "date_fin" et les rendre requis
        weekFields.forEach(function(field) {
            field.style.display = 'block';
            field.querySelector('input').setAttribute('required', 'required');
        });
    }
});

</script>

@endsection
