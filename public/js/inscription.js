function calculerScolarite() {
    var classe = document.getElementById("classe").value;
    var montantTotal;

    switch (classe) {
        case "maternelle":
            montantTotal = 125000;
            break;
        case "primaire":
        case "college":
        case "lycee":
            montantTotal = 140000;
            break;
        default:
            montantTotal = 0;
            break;
    }

    var reduction = document.getElementById("reduction").checked;
    if (reduction) {
        montantTotal *= 0.9; // Réduction de 10%
    }

    document.getElementById("scolariteTotal").value = montantTotal.toFixed(2);
}

// Fonction pour générer l'input de "frais d'inscription" ou le faire disparaître en fonction du choix "nouveau" ou "ancien"
function gererFraisInscription() {
    var fraisInscriptionDiv = document.getElementById("fraisInscriptionDiv");
    var nouveauCheckbox = document.getElementById("fraisinscription");

    if (nouveauCheckbox.checked) {
        var fraisInscriptionInput = document.createElement("input");
        fraisInscriptionInput.type = "text";
        fraisInscriptionInput.id = "fraisInscriptionInput";
        fraisInscriptionInput.name = "fraisInscriptionInput";
        fraisInscriptionInput.value = "25000";
        fraisInscriptionInput.readOnly = true;
        fraisInscriptionDiv.appendChild(fraisInscriptionInput);
    } else {
        var fraisInscriptionInput = document.getElementById(
            "fraisInscriptionInput"
        );
        if (fraisInscriptionInput) {
            fraisInscriptionDiv.removeChild(fraisInscriptionInput);
        }
    }
}

// Fonction pour générer la liste des niveaux en fonction de la classe choisie
function genererNiveaux() {
    var classe = document.getElementById("classe").value;
    var niveauxDiv = document.getElementById("niveauxDiv");
    niveauxDiv.innerHTML = "";

    var niveauxSelect = document.createElement("select");
    niveauxSelect.id = "niveauxSelect";
    niveauxSelect.name = "niveau";

    var niveauxOptions;
    switch (classe) {
        case "maternelle":
            niveauxOptions = ["maternelle1", "maternelle2", "maternelle3"];
            break;
        case "primaire":
            niveauxOptions = ["CP1", "CP2", "CE1", "CE2", "CM1", "CM2"];
            break;
        case "college":
            niveauxOptions = ["6eme", "5eme", "4eme", "3eme"];
            break;
    }

    niveauxOptions.forEach(function (option) {
        var niveauOption = document.createElement("option");
        niveauOption.value = option.toLowerCase().replace(" ", "");
        niveauOption.textContent = option;
        niveauxSelect.appendChild(niveauOption);
    });

    niveauxDiv.appendChild(niveauxSelect);
}

document
    .getElementById("fraisinscription")
    .addEventListener("change", gererFraisInscription);
document.getElementById("classe").addEventListener("change", genererNiveaux);
gererFraisInscription();
genererNiveaux();
calculerScolarite();
