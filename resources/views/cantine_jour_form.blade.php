<!-- resources/views/cantine_jour_form.blade.php -->

<form action="{{ route('cantine_jour.store') }}" method="POST">
    @csrf
    <div>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
    </div>
    <div>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>
    </div>
    <div>
        <label for="classe">Classe:</label>
        <select id="classe" name="classe" required>
            <option value="maternelle1">Maternelle 1</option>
            <option value="maternelle2">Maternelle 2</option>
            <option value="maternelle3">Maternelle 3</option>
            <option value="cp1">CP 1</option>
            <option value="cp2">CP 2</option>
            <option value="ce1">CE 1</option>
            <option value="ce2">CE 2</option>
            <option value="cm1">CM 1</option>
            <option value="cm2">CM 2</option>
            <option value="personnel">LE PERSONNEL</option>
        </select>
    </div>
    <div>
        <label for="type_paiement">Type de paiement:</label>
        <select id="type_paiement" name="type_paiement" required>
            <option value="jour">Jour</option>
            <option value="semaine">Semaine</option>
        </select>
    </div>
    <div>
        <label for="montant">Montant:</label>
        <input type="number" id="montant" name="montant" required>
    </div>

    <!-- Affichage dynamique des champs de date en fonction du type de paiement -->
    <div id="dates_jour" style="display:none;">
        <p>Date: {{ now()->format('d/m/Y') }}</p>
    </div>
    <div id="dates_semaine" style="display:none;">
        <label for="date_debut">Date de début:</label>
        <input type="date" id="date_debut" name="date_debut">
        <label for="date_fin">Date de fin:</label>
        <input type="date" id="date_fin" name="date_fin">
    </div>

    <button type="submit">Enregistrer</button>
</form>

<style>
    /* Insérez ici le CSS précédemment généré */
    /* Général */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 500px;
    width: 100%;
}

/* Titre */
form h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: #5cb85c;
}

/* Champs de formulaire */
div {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
input[type="number"],
input[type="date"],
select {
    width: calc(100% - 12px);
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="number"]:focus,
input[type="date"]:focus,
select:focus {
    border-color: #5cb85c;
}

/* Sections date conditionnelles */
#dates_jour p {
    font-size: 16px;
    color: #333;
    margin-top: 10px;
}

#dates_semaine label {
    margin-top: 10px;
}

/* Bouton */
button[type="submit"] {
    display: block;
    width: 100%;
    padding: 12px;
    background-color: #5cb85c;
    color: white;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #4cae4c;
}

</style>

<script>
    document.getElementById('type_paiement').addEventListener('change', function() {
        if (this.value === 'jour') {
            document.getElementById('dates_jour').style.display = 'block';
            document.getElementById('dates_semaine').style.display = 'none';
        } else if (this.value === 'semaine') {
            document.getElementById('dates_jour').style.display = 'none';
            document.getElementById('dates_semaine').style.display = 'block';
        }
    });
</script>
