@extends("navbarmodel.navbar")
@section("title", "Infos")
@section("content")
<!-- Ajouter jQuery pour faciliter les opérations AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<main class="page-content">
    <div class="container">
        <h2>Établir la liste des élèves</h2>

        <!-- Formulaire de sélection du niveau et de la classe -->
        <div class="form-group">
            <label for="niveau">Sélectionnez le niveau :</label>
            <select id="niveau" class="form-control">
                <option value="">--Sélectionnez le niveau--</option>
                <!-- Ajoutez ici les options de niveau -->
                <option value="maternelle">Maternelle</option>
                <option value="primaire">Primaire</option>
                <option value="college">College</option>
                <!-- Vous pouvez ajouter plus d'options de niveau si nécessaire -->
            </select>
        </div>

        <div class="form-group">
            <label for="classe">Sélectionnez la classe :</label>
            <select id="classe" class="form-control" disabled>
                <option value="">--Sélectionnez la classe--</option>
                <!-- Les options de classe seront ajoutées dynamiquement -->
            </select>
        </div>

        <button id="genererListe" class="btn btn-primary" disabled>Générer la liste des élèves</button>

        <!-- Conteneur pour afficher la liste des élèves -->
        <div id="listeEleves" style="margin-top: 20px;">
            <!-- La liste des élèves sera affichée ici -->
        </div>

        <!-- Bouton d'impression -->
        <button id="imprimerListe" class="btn btn-secondary" style="display: none;">Imprimer</button>
    </div>
</main>

<!-- Styles pour l'apparence -->
<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn {
        display: block;
        width: 100%;
        margin-top: 10px;
    }

    #listeEleves {
        margin-top: 20px;
    }
</style>

<!-- Scripts pour la gestion dynamique des sélections -->
<script>
    $(document).ready(function() {
        // Gestion de la sélection du niveau
        $('#niveau').change(function() {
            var niveau = $(this).val();
            var classeSelect = $('#classe');
            classeSelect.prop('disabled', true);
            classeSelect.empty();
            classeSelect.append('<option value="">--Sélectionnez la classe--</option>');

            if (niveau) {
                // Simulation de classes en fonction du niveau
                var classes = {
                    'maternelle': ["maternelle1", "maternelle2", "maternelle3"],
                    'primaire': ['CP1','CP2', 'CE1', 'CE2', 'CM1', 'CM2'],
                    'college': ['6eme', '5eme', '4eme', '3eme']
                };

                if (classes[niveau]) {
                    classes[niveau].forEach(function(classe) {
                        classeSelect.append('<option value="' + classe + '">' + classe + '</option>');
                    });
                    classeSelect.prop('disabled', false);
                }
            }

            $('#genererListe').prop('disabled', true);
            $('#listeEleves').empty();
            $('#imprimerListe').hide();
        });

        // Gestion de la sélection de la classe
        $('#classe').change(function() {
            if ($(this).val()) {
                $('#genererListe').prop('disabled', false);
            } else {
                $('#genererListe').prop('disabled', true);
            }
        });

        // Gestion de la génération de la liste des élèves
        $('#genererListe').click(function() {
            var niveau = $('#niveau').val();
            var classe = $('#classe').val();

            if (niveau && classe) {
                $.ajax({
                    url: '{{ route("infos.listeEleves") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        niveau: niveau,
                        classe: classe
                    },
                    success: function(response) {
                        var eleves = response.eleves;
                        if (eleves.length > 0) {
                            var html = '<h3>Liste des élèves (' + niveau + ' - ' + classe + ')</h3>';
                            html += '<ul>';
                            eleves.forEach(function(eleve, index) {
                                html += '<li>' + (index + 1) + '. ' + eleve.nom + ' ' + eleve.prenom + '</li>';
                            });
                            html += '</ul>';
                            $('#listeEleves').html(html);
                            $('#imprimerListe').show();
                        } else {
                            $('#listeEleves').html('<p>Aucun élève trouvé pour ce niveau et cette classe.</p>');
                            $('#imprimerListe').hide();
                        }
                    },
                    error: function() {
                        $('#listeEleves').html('<p>Une erreur est survenue. Veuillez réessayer.</p>');
                        $('#imprimerListe').hide();
                    }
                });
            }
        });

        // Gestion de l'impression de la liste des élèves
        $('#imprimerListe').click(function() {
            window.print();
        });
    });
</script>
@endsection
