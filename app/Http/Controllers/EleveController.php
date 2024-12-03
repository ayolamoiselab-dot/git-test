<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\recus;
use App\Models\Recusco;
use App\Models\Recucant;
use App\Models\Recutrans;
use App\Models\cantine;
use App\Models\transport;
use App\Models\informatique;
use App\Models\piscine;
use App\Models\musique;
use Illuminate\Support\Facades\DB; // Ajoutez cette ligne
use Illuminate\Support\Facades\Auth;


class EleveController extends Controller
{
    public function enregistrer(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'contactparent' => 'required|string|max:30',
            'sexe' => 'required|string',
            'classe' => 'required|string',
            'niveau' => 'required|string',
            'methode_paiement' => 'required|string',
            'date_inscription' => 'nullable|date',
            'libelle' => 'nullable|string|max:255',
        ]);

        // Vérifier si l'élève existe déjà dans la base de données
        $eleveExistant = Eleve::where('nom', $request->nom)
            ->where('prenom', $request->prenom)
            ->first();

        if ($eleveExistant) {
            return view('inscription.formulaire', ['erreur' => 'cet élève existe déjà merci.']);
        }

        // Si l'élève n'existe pas encore, créer un nouvel enregistrement
        $eleve = new Eleve();
        $eleve->nom = $request->nom;
        $eleve->prenom = $request->prenom;
        $eleve->sexe = $request->sexe;
        $eleve->niveau = $request->classe;
        $eleve->classe = $request->niveau;
        $eleve->contactparent = $request->contactparent;
        $eleve->methode_paiement = $request->methode_paiement;

        if ($request->hasFile('dossier')) {
            $dossierPath = $request->file('dossier')->store('dossiers', 'public');
            $eleve->dossier = $dossierPath;
        }

        $eleve->frais_inscription = $request->has('fraisinscription') ? 25000 : 0;

        $scolariteTotale = $request->scolariteTotal ?? 0;

        $eleve->scolarite_total = $scolariteTotale;
        $eleve->date_inscription = $request->date_inscription ?: now(); // Si pas de date, on utilise la date du jour
        $eleve->libelle = $request->libelle; // Peut être vide

        $eleve->save();

        // Création du reçu si frais d'inscription est de 25000
        if ($eleve->frais_inscription == 25000) {
            $recu = new Recusco();
            $recu->id_eleve = $eleve->id_eleve;
            $recu->type = 'Frais d\'inscription';
            $recu->montant_verse = 25000;
            $recu->montant_restant = 0;
            $recu->statut = 'soldé';

            $recu->updated_at = now();
            $recu->save();
        }

        return redirect()->route('scolarite.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'frais d\'inscription'])->with('success', 'Scolarité mise à jour avec succès.');
    }





    public function recherche(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        // Rechercher les élèves en fonction du nom et éventuellement du prénom
        $query = Eleve::where('nom', 'like', "%$nom%");

        if (!empty($prenom)) {
            $query->where('prenom', 'like', "%$prenom%");
        }

        $eleves = $query->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.scolarite', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_sco', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.scolarite', ['erreur' => 'élève non trouvé.']);
        }
    }

    public function miseAJour(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);

        $eleve->nom = $request->nom;
        $eleve->prenom = $request->prenom;
        $eleve->libelle = $request->libelle;
        $eleve->scolarite_total = $request->scolarite_total;
        $eleve->methode_paiement = $request->methode_paiement;

        $dateVersementDefault = null;
        $montantDefault = 0;
        $montantTotalTranches = 0;
        $nombreTranches = 9;
        $montantVerseAujourdHui = 0;

        for ($i = 1; $i <= $nombreTranches; $i++) {
            $dateVersement = $request->input("date_versement$i", $dateVersementDefault);
            $montant = $request->input("montant$i", $montantDefault);

            $eleve->{"date_versement$i"} = $dateVersement;
            $eleve->{"montant$i"} = $montant;

            if ($montant !== $montantDefault) {
                $montantTotalTranches += $montant;
                // Vérifier si la date de versement est aujourd'hui
                if ($dateVersement == date('Y-m-d')) {
                    $montantVerseAujourdHui += $montant;
                }
            }
        }

        $eleve->scolarite_payee = $montantTotalTranches;
        $eleve->scolarite_restante = max(0, $eleve->scolarite_total - $montantTotalTranches);

        $eleve->save();

        if ($montantVerseAujourdHui > 0) {
            $recu = new Recusco();
            $recu->id_eleve = $eleve->id_eleve;
            $recu->type = 'scolarite';
            $recu->montant_verse = $montantVerseAujourdHui;
            $recu->montant_restant = $eleve->scolarite_restante;
            $recu->statut = $eleve->scolarite_restante == 0 ? 'soldé' : 'non soldé';
            $recu->user_id = Auth::id(); // Associe l'utilisateur connecté
            $recu->updated_at = now();
            $recu->save();
        }

        return redirect()->route('scolarite.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'scolarite'])->with('success', 'Scolarité mise à jour avec succès.');
    }



    public function afficherTableauDeBord()
    {
        $nombreTotalEleves = Eleve::count();
        $montantTotalScolaritesPayees = Eleve::sum('scolarite_payee');

        return view('menusgestion.listmenus', compact('nombreTotalEleves', 'montantTotalScolaritesPayees'));
    }

    public function listeEleves(Request $request)
    {
        $niveau = $request->niveau;
        $classe = $request->classe;

        $eleves = Eleve::where('niveau', $niveau)
            ->where('classe', $classe)
            ->orderBy('nom', 'asc')
            ->get();

        return response()->json(['eleves' => $eleves]);
    }


    public function rechercheCantine(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        // Rechercher les élèves en fonction du nom et éventuellement du prénom
        $query = Eleve::where('nom', 'like', "%$nom%");

        if (!empty($prenom)) {
            $query->where('prenom', 'like', "%$prenom%");
        }

        $eleves = $query->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.cantine', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.cantine', ['erreur' => 'élève non trouvé.']);
        }
    }


    public function rechercheTransport(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        // Rechercher les élèves en fonction du nom et éventuellement du prénom
        $query = Eleve::where('nom', 'like', "%$nom%");

        if (!empty($prenom)) {
            $query->where('prenom', 'like', "%$prenom%");
        }

        $eleves = $query->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.transport', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_transport', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.transport', ['erreur' => 'élève non trouvé.']);
        }
    }

    public function recherchePiscine(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        // Rechercher les élèves en fonction du nom et éventuellement du prénom
        $query = Eleve::where('nom', 'like', "%$nom%");

        if (!empty($prenom)) {
            $query->where('prenom', 'like', "%$prenom%");
        }

        $eleves = $query->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.piscine', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_piscine', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.piscine', ['erreur' => 'élève non trouvé.']);
        }
    }

    public function rechercheMusique(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        // Rechercher les élèves en fonction du nom et éventuellement du prénom
        $query = Eleve::where('nom', 'like', "%$nom%");

        if (!empty($prenom)) {
            $query->where('prenom', 'like', "%$prenom%");
        }

        $eleves = $query->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.musique', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_musique', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.musique', ['erreur' => 'élève non trouvé.']);
        }
    }

    public function rechercheInformatique(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        // Rechercher les élèves en fonction du nom et éventuellement du prénom
        $query = Eleve::where('nom', 'like', "%$nom%");

        if (!empty($prenom)) {
            $query->where('prenom', 'like', "%$prenom%");
        }

        $eleves = $query->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.informatique', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_informatique', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.informatique', ['erreur' => 'élève non trouvé.']);
        }
    }




    public function enregistrerCantine(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'id_eleve' => 'required|exists:eleves,id_eleve',
            'frais_cantine' => 'required|numeric',
            // Validation des tranches de paiement
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        // Récupérer l'élève depuis la base de données
        $eleve = Eleve::find($request->id_eleve);

        // Vérifier si un enregistrement de cantine existe déjà pour cet élève
        $cantineExistante = DB::table('cantine')
            ->where('id_eleve', $request->id_eleve)
            ->first();

        if ($cantineExistante) {
            return view('menusgestion.cantine', ['erreur' => 'cet enregistrement de cantine existe déjà pour cet élève.']);
        }

        // Calculer le montant restant et le statut
        $montantTotalVerse = 0;
        $montantRestant = $request->frais_cantine;
        $montantVerseAujourdHui = 0;
        $aujourdhui = now()->toDateString();

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                if ($dateVersement == $aujourdhui) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            // Enregistrement des tranches dans la base de données
            DB::table('cantine')->updateOrInsert(
                ['id_eleve' => $request->id_eleve],
                [
                    'nom' => $eleve->nom,
                    'prenom' => $eleve->prenom,
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_cantine' => $request->frais_cantine,
                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }

        // Création du reçu avec le montant versé aujourd'hui
        Recucant::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'cantine',
            'montant_verse' => $montantVerseAujourdHui,
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);

        return redirect()->route('cantine.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'cantine'])->with('success', 'Paiement de cantine enregistré avec succès.');
    }

    public function enregistrerTransport(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'id_eleve' => 'required|exists:eleves,id_eleve',
            'quartier' => 'required|string',
            'tarif_mois' => 'required|numeric',
            'type_trajet' => 'required|string|in:aller,retour,aller-retour',
            // Validation des tranches de paiement
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        // Récupérer l'élève depuis la base de données
        $eleve = Eleve::find($request->id_eleve);

        // Calcul du frais de transport annuel
        $frais_transport = $request->tarif_mois * 9;

        // Vérifier si un enregistrement de transport existe déjà pour cet élève
        $transportExistant = DB::table('transport')
            ->where('id_eleve', $request->id_eleve)
            ->first();

        if ($transportExistant) {
            return view('menusgestion.transport', ['erreur' => 'cet enregistrement de transport existe déjà pour cet élève.']);
        }

        // Calculer le montant restant et le statut
        $montantTotalVerse = 0;
        $montantRestant = $frais_transport;
        $montantVerseAujourdHui = 0;
        $aujourdhui = now()->toDateString();

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                if ($dateVersement == $aujourdhui) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            // Enregistrement des tranches dans la base de données
            DB::table('transport')->updateOrInsert(
                ['id_eleve' => $request->id_eleve],
                [
                    'nom' => $eleve->nom,
                    'prenom' => $eleve->prenom,
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_transport' => $frais_transport,
                    'quartier' => $request->quartier,
                    'type_trajet' => $request->type_trajet,
                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }

        // Création du reçu avec le montant versé aujourd'hui
        Recutrans::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'transport',
            'montant_verse' => $montantVerseAujourdHui,
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);

        return redirect()->route('transport.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'transport'])->with('success', 'Paiement de transport enregistré avec succès.');
    }

    public function enregistrerPiscine(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'id_eleve' => 'required|exists:eleves,id_eleve',

            'tarif_mois' => 'required|numeric',

            // Validation des tranches de paiement
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        // Récupérer l'élève depuis la base de données
        $eleve = Eleve::find($request->id_eleve);

        // Calcul du frais de transport annuel
        $frais_piscine = $request->tarif_mois * 9;

        // Vérifier si un enregistrement de transport existe déjà pour cet élève
        $piscineExistant = DB::table('piscine')
            ->where('id_eleve', $request->id_eleve)
            ->first();

        if ($piscineExistant) {
            return view('menusgestion.piscine', ['erreur' => 'cet enregistrement de piscine existe déjà pour cet élève.']);
        }

        // Calculer le montant restant et le statut
        $montantTotalVerse = 0;
        $montantRestant = $frais_piscine;
        $montantVerseAujourdHui = 0;
        $aujourdhui = now()->toDateString();

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                if ($dateVersement == $aujourdhui) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            // Enregistrement des tranches dans la base de données
            DB::table('piscine')->updateOrInsert(
                ['id_eleve' => $request->id_eleve],
                [
                    'nom' => $eleve->nom,
                    'prenom' => $eleve->prenom,
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_piscine' => $frais_piscine,


                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }
        recus::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'piscine',
            'montant_verse' => $montantVerseAujourdHui, // Utiliser le montant versé aujourd'hui
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);

        return redirect()->route('piscine.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'piscine'])->with('success', 'Paiement de piscine enregistré avec succès.');
    }


    public function enregistrerMusique(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'id_eleve' => 'required|exists:eleves,id_eleve',

            'tarif_mois' => 'required|numeric',

            // Validation des tranches de paiement
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        // Récupérer l'élève depuis la base de données
        $eleve = Eleve::find($request->id_eleve);

        // Calcul du frais de transport annuel
        $frais_musique = $request->tarif_mois * 9;

        // Vérifier si un enregistrement de transport existe déjà pour cet élève
        $musiqueExistant = DB::table('musique')
            ->where('id_eleve', $request->id_eleve)
            ->first();

        if ($musiqueExistant) {
            return view('menusgestion.musique', ['erreur' => 'cet enregistrement de musique existe déjà pour cet élève.']);
        }

        // Calculer le montant restant et le statut
        $montantTotalVerse = 0;
        $montantRestant = $frais_musique;
        $montantVerseAujourdHui = 0;
        $aujourdhui = now()->toDateString();

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                if ($dateVersement == $aujourdhui) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            // Enregistrement des tranches dans la base de données
            DB::table('musique')->updateOrInsert(
                ['id_eleve' => $request->id_eleve],
                [
                    'nom' => $eleve->nom,
                    'prenom' => $eleve->prenom,
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_musique' => $frais_musique,


                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }
        recus::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'musique',
            'montant_verse' => $montantVerseAujourdHui, // Utiliser le montant versé aujourd'hui
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);


        return redirect()->route('musique.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'musique'])->with('success', 'Paiement de musique enregistré avec succès.');
    }



    public function enregistrerInformatique(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'id_eleve' => 'required|exists:eleves,id_eleve',

            'tarif_mois' => 'required|numeric',

            // Validation des tranches de paiement
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        // Récupérer l'élève depuis la base de données
        $eleve = Eleve::find($request->id_eleve);

        // Calcul du frais de transport annuel
        $frais_informatique = $request->tarif_mois * 9;

        // Vérifier si un enregistrement de transport existe déjà pour cet élève
        $informatiqueExistant = DB::table('informatique')
            ->where('id_eleve', $request->id_eleve)
            ->first();

        if ($informatiqueExistant) {
            return view('menusgestion.informatique', ['erreur' => 'cet enregistrement informatique existe déjà pour cet élève.']);
        }


        // Calculer le montant restant et le statut
        $montantTotalVerse = 0;
        $montantRestant = $frais_informatique;
        $montantVerseAujourdHui = 0;
        $aujourdhui = now()->toDateString();

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                if ($dateVersement == $aujourdhui) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            // Enregistrement des tranches dans la base de données
            DB::table('informatique')->updateOrInsert(
                ['id_eleve' => $request->id_eleve],
                [
                    'nom' => $eleve->nom,
                    'prenom' => $eleve->prenom,
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_informatique' => $frais_informatique,


                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }



        // Création du reçu avec le montant versé aujourd'hui
        recus::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'informatique',
            'montant_verse' => $montantVerseAujourdHui,
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);

        return redirect()->route('informatique.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'informatique'])->with('success', 'Paiement d\'informatique enregistré avec succès.');
    }



    public function rechercheCantinemiseajour(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        $eleve = cantine::where('nom', 'like', "%$nom%");
        //$cantine = DB::table('cantine')->where('id_eleve', $eleve->id_eleve)->first();
        if (!empty($prenom)) {
            $eleve->where('prenom', 'like', "%$prenom%");
        }
        $eleves = $eleve->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.miseajourcantine', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_cant_maj', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.miseajourcantine', ['erreur' => 'élève non trouvé.']);
        }

        if ($request->isMethod('get')) {
            // Vous pouvez renvoyer la vue sans résultat ou avec des informations par défaut
            return view('menusgestion.miseajourcantine');
        }
    }

    public function rechercheTransportmiseajour(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        $eleve = transport::where('nom', 'like', "%$nom%");
        //$cantine = DB::table('cantine')->where('id_eleve', $eleve->id_eleve)->first();
        if (!empty($prenom)) {
            $eleve->where('prenom', 'like', "%$prenom%");
        }
        $eleves = $eleve->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.miseajourtransport', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_trans_maj', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.miseajourtransport', ['erreur' => 'élève non trouvé.']);
        }

        if ($request->isMethod('get')) {
            // Vous pouvez renvoyer la vue sans résultat ou avec des informations par défaut
            return view('menusgestion.miseajourtransport');
        }
    }


    public function rechercheMusiquemiseajour(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        $eleve = musique::where('nom', 'like', "%$nom%");
        //$cantine = DB::table('cantine')->where('id_eleve', $eleve->id_eleve)->first();
        if (!empty($prenom)) {
            $eleve->where('prenom', 'like', "%$prenom%");
        }
        $eleves = $eleve->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.miseajourmusique', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_musique_maj', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.miseajourmusique', ['erreur' => 'élève non trouvé.']);
        }

        if ($request->isMethod('get')) {
            // Vous pouvez renvoyer la vue sans résultat ou avec des informations par défaut
            return view('menusgestion.miseajourmusique');
        }
    }

    public function recherchePiscinemiseajour(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        $eleve = piscine::where('nom', 'like', "%$nom%");
        //$cantine = DB::table('cantine')->where('id_eleve', $eleve->id_eleve)->first();
        if (!empty($prenom)) {
            $eleve->where('prenom', 'like', "%$prenom%");
        }
        $eleves = $eleve->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.miseajourpiscine', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_piscine_maj', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.miseajourpiscine', ['erreur' => 'élève non trouvé.']);
        }

        if ($request->isMethod('get')) {
            // Vous pouvez renvoyer la vue sans résultat ou avec des informations par défaut
            return view('menusgestion.miseajourpiscine');
        }
    }

    public function rechercheInformatiquemiseajour(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom ?? '';

        $eleve = informatique::where('nom', 'like', "%$nom%");
        //$cantine = DB::table('cantine')->where('id_eleve', $eleve->id_eleve)->first();
        if (!empty($prenom)) {
            $eleve->where('prenom', 'like', "%$prenom%");
        }
        $eleves = $eleve->get();

        if ($eleves->count() == 1) {
            // Un seul élève trouvé, rediriger directement
            $eleve = $eleves->first();
            return view('menusgestion.miseajourinformatique', compact('eleve'));
        } elseif ($eleves->count() > 1) {
            // Plusieurs élèves trouvés, demander à l'utilisateur de choisir
            return view('menusgestion.choix_eleve_info_maj', compact('eleves', 'nom', 'prenom'));
        } else {
            // Aucun élève trouvé
            return view('menusgestion.miseajourinformatique', ['erreur' => 'élève non trouvé.']);
        }

        if ($request->isMethod('get')) {
            // Vous pouvez renvoyer la vue sans résultat ou avec des informations par défaut
            return view('menusgestion.miseajourinformatique');
        }
    }


    public function miseAJourCantine(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);

        $request->validate([
            'frais_cantine' => 'required|numeric',
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        $montantTotalVerse = 0;
        $montantRestant = $request->frais_cantine;
        $montantVerseAujourdHui = 0;

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                // Vérifier si la date de versement est aujourd'hui
                if ($dateVersement == date('Y-m-d')) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            DB::table('cantine')->updateOrInsert(
                ['id_eleve' => $id],
                [
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_cantine' => $request->frais_cantine,
                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }

        Recucant::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'cantine',
            'montant_verse' => $montantVerseAujourdHui, // Utiliser le montant versé aujourd'hui
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);

        return redirect()->route('cantine.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'cantine'])->with('success', 'Cantine mise à jour avec succès.');
    }


    public function miseAJourTransport(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);

        $request->validate([
            'frais_transport' => 'required|numeric',
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        $montantTotalVerse = 0;
        $montantRestant = $request->frais_transport;
        $montantVerseAujourdHui = 0;

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                // Vérifier si la date de versement est aujourd'hui
                if ($dateVersement == date('Y-m-d')) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            DB::table('transport')->updateOrInsert(
                ['id_eleve' => $id],
                [
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_transport' => $request->frais_transport,
                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }

        Recutrans::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'transport',
            'montant_verse' => $montantVerseAujourdHui, // Utiliser le montant versé aujourd'hui
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);

        return redirect()->route('transport.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'transport'])->with('success', 'transport mise à jour avec succès.');
    }

    public function miseAJourMusique(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);

        $request->validate([
            'frais_musique' => 'required|numeric',
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        $montantTotalVerse = 0;
        $montantRestant = $request->frais_musique;
        $montantVerseAujourdHui = 0;

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                // Vérifier si la date de versement est aujourd'hui
                if ($dateVersement == date('Y-m-d')) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            DB::table('musique')->updateOrInsert(
                ['id_eleve' => $id],
                [
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_musique' => $request->frais_musique,
                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }

        recus::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'musique',
            'montant_verse' => $montantVerseAujourdHui, // Utiliser le montant versé aujourd'hui
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);

        return redirect()->route('musique.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'musique'])->with('success', 'musique mise à jour avec succès.');
    }

    public function miseAJourPiscine(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);

        $request->validate([
            'frais_piscine' => 'required|numeric',
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        $montantTotalVerse = 0;
        $montantRestant = $request->frais_piscine;
        $montantVerseAujourdHui = 0;

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                // Vérifier si la date de versement est aujourd'hui
                if ($dateVersement == date('Y-m-d')) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            DB::table('piscine')->updateOrInsert(
                ['id_eleve' => $id],
                [
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_piscine' => $request->frais_piscine,
                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }

        recus::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'piscine',
            'montant_verse' => $montantVerseAujourdHui, // Utiliser le montant versé aujourd'hui
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);

        return redirect()->route('piscine.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'piscine'])->with('success', 'piscine mise à jour avec succès.');
    }

    public function miseAJourInformatique(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);

        $request->validate([
            'frais_informatique' => 'required|numeric',
            'date_versement*' => 'nullable|date',
            'montant*' => 'nullable|numeric',
        ]);

        $montantTotalVerse = 0;
        $montantRestant = $request->frais_informatique;
        $montantVerseAujourdHui = 0;

        for ($i = 1; $i <= 9; $i++) {
            $montant = $request->input("montant$i", 0);
            $dateVersement = $request->input("date_versement$i", null);

            if ($montant > 0 && $dateVersement) {
                $montantTotalVerse += $montant;
                $montantRestant -= $montant;
                // Vérifier si la date de versement est aujourd'hui
                if ($dateVersement == date('Y-m-d')) {
                    $montantVerseAujourdHui += $montant;
                }
            }

            DB::table('informatique')->updateOrInsert(
                ['id_eleve' => $id],
                [
                    "date_versement$i" => $dateVersement,
                    "montant$i" => $montant,
                    'frais_informatique' => $request->frais_informatique,
                    'deja_payee' => $montantTotalVerse,
                    'montant_restant' => $montantRestant,
                    'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
                    'updated_at' => now(),
                ]
            );
        }

        recus::create([
            'id_eleve' => $eleve->id_eleve,
            'type' => 'informatique',
            'montant_verse' => $montantVerseAujourdHui, // Utiliser le montant versé aujourd'hui
            'montant_restant' => $montantRestant,
            'statut' => $montantRestant <= 0 ? 'soldé' : 'non soldé',
        ]);

        return redirect()->route('informatique.success', ['id_eleve' => $eleve->id_eleve, 'type' => 'informatique'])->with('success', 'informatique mise à jour avec succès.');
    }

    // Dans EleveController.php

    // EleveController.php

    public function generateReceipt($id_eleve, $type)
    {
        // Récupérer les informations de l'élève
        $eleve = Eleve::findOrFail($id_eleve);
    
        // Initialiser les variables pour les montants
        $montantVerseAujourdHui = 0;
        $totalPaye = 0;
        $montantRestant = 0;
        $statut = "";
        $types = "";
    
        // Initialiser la variable $recus
        $recus = null;
    
        // Déterminer les montants en fonction du type
        if ($type === 'scolarite') {
            $recus = Recusco::where('id_eleve', $id_eleve)
                ->where('type', 'scolarite')
                ->orderBy('created_at', 'desc')
                ->first();
    
            if ($recus) {
                $montantVerseAujourdHui = $recus->montant_verse;
                $totalPaye = $eleve->scolarite_payee;
                $montantRestant = $eleve->scolarite_restante;
                $statut = $recus->statut;
                $types = $recus->type;
            }
        } elseif ($type === 'cantine') {
            $recus = Recucant::where('id_eleve', $id_eleve)
                ->where('type', 'cantine')
                ->orderBy('created_at', 'desc')
                ->first();
    
            if ($recus) {
                $montantVerseAujourdHui = $recus->montant_verse;
                $totalPaye = DB::table('cantine')->where('id_eleve', $id_eleve)->value('deja_payee');
                $montantRestant = DB::table('cantine')->where('id_eleve', $id_eleve)->value('montant_restant');
                $statut = $recus->statut;
                $types = $recus->type;
            }
        }elseif ($type === 'piscine') {
            $recus = recus::where('id_eleve', $id_eleve)
                ->where('type', 'piscine')
                ->orderBy('created_at', 'desc')
                ->first();

            if ($recus) {
                $montantVerseAujourdHui = $recus->montant_verse;
                $totalPaye = DB::table('piscine')->where('id_eleve', $id_eleve)->value('deja_payee');
                $montantRestant = DB::table('piscine')->where('id_eleve', $id_eleve)->value('montant_restant');
                $statut = $recus->statut;
                $types = $recus->type;
            }
        } elseif ($type === 'musique') {
            $recus = recus::where('id_eleve', $id_eleve)
                ->where('type', 'musique')
                ->orderBy('created_at', 'desc')
                ->first();

            if ($recus) {
                $montantVerseAujourdHui = $recus->montant_verse;
                $totalPaye = DB::table('musique')->where('id_eleve', $id_eleve)->value('deja_payee');
                $montantRestant = DB::table('musique')->where('id_eleve', $id_eleve)->value('montant_restant');
                $statut = $recus->statut;
                $types = $recus->type;
            }
        }elseif ($type === 'informatique') {
            $recus = recus::where('id_eleve', $id_eleve)
                ->where('type', 'informatique')
                ->orderBy('created_at', 'desc')
                ->first();

            if ($recus) {
                $montantVerseAujourdHui = $recus->montant_verse;
                $totalPaye = DB::table('informatique')->where('id_eleve', $id_eleve)->value('deja_payee');
                $montantRestant = DB::table('informatique')->where('id_eleve', $id_eleve)->value('montant_restant');
                $statut = $recus->statut;
                $types = $recus->type;
            }
        }elseif ($type === 'transport') {
            $recus = Recutrans::where('id_eleve', $id_eleve)
                ->where('type', 'transport')
                ->orderBy('created_at', 'desc')
                ->first();

            if ($recus) {
                $montantVerseAujourdHui = $recus->montant_verse;
                $totalPaye = DB::table('transport')->where('id_eleve', $id_eleve)->value('deja_payee');
                $montantRestant = DB::table('transport')->where('id_eleve', $id_eleve)->value('montant_restant');
                $statut = $recus->statut;
                $types = $recus->type;
            }
        } 
        // Ajouter d'autres types comme frais d'inscription, transport, etc.
    
        // Générer le numéro de reçu unique avec un préfixe personnalisé selon le type
        $numeroRecu = '';
        if ($recus) {
            switch ($type) {
                case 'scolarite':
                    $numeroRecu = 'RECSCO' . str_pad($recus->id, 5, '0', STR_PAD_LEFT);
                    break;
                case 'cantine':
                    $numeroRecu = 'RECCAN' . str_pad($recus->id, 5, '0', STR_PAD_LEFT);
                    break;
                case 'frais d\'inscription':
                    $numeroRecu = 'RECINS' . str_pad($recus->id, 5, '0', STR_PAD_LEFT);
                    break;
                case 'transport':
                    $numeroRecu = 'RECTRS' . str_pad($recus->id, 5, '0', STR_PAD_LEFT);
                    break;
                case 'informatique':
                    $numeroRecu = 'RECINF' . str_pad($recus->id, 5, '0', STR_PAD_LEFT);
                    break;
                case 'piscine':
                    $numeroRecu = 'RECPSC' . str_pad($recus->id, 5, '0', STR_PAD_LEFT);
                    break;
                case 'musique':
                    $numeroRecu = 'RECMUS' . str_pad($recus->id, 5, '0', STR_PAD_LEFT);
                    break;
                default:
                    $numeroRecu = 'REC' . str_pad($recus->id, 5, '0', STR_PAD_LEFT);
            }
        } else {
            $numeroRecu = 'REC00000';
        }
        
        $signatureUtilisateur = $recus->user ? $recus->user->name : 'Signature de l\'administrateur'; // Assurez-vous que 'name' existe dans la table users

        // Créer les données du reçu
        $data = [
            'logo' => asset('img/logopoussi_preview_rev_1.png'),
            'numero_recu' => $numeroRecu,
            'nom_eleve' => $eleve->nom . ' ' . $eleve->prenom,
            'classe' => $eleve->classe,
            'montant_verse' => $montantVerseAujourdHui,
            'total_paye' => $totalPaye,
            'montant_restant' => $montantRestant,
            'date_enregistrement' => $recus ? $recus->created_at->format('d/m/Y') : '',
            //'signature' => 'Signature de l\'administrateur',
            'signature' => $signatureUtilisateur,
            'statut' => $statut,
            'type' => $types,
        ];
    
        // Retourner la vue du reçu avec les données
        return view('recus', $data);
    }
    



    // EleveController.php

    public function successPage($id_eleve, $type)
    {
        $eleve = Eleve::findOrFail($id_eleve);
        return view('successanimation.success', compact('eleve', 'type'));
    }


    // CantineController.php

    public function successPage2($id_eleve, $type)
    {
        $eleve = Eleve::findOrFail($id_eleve);
        return view('successanimation.success', compact('eleve', 'type'));
    }

    public function successPage3($id_eleve, $type)
    {
        $eleve = Eleve::findOrFail($id_eleve);
        return view('successanimation.success', compact('eleve', 'type'));
    }

    public function successPageInfo($id_eleve, $type)
    {
        $eleve = Eleve::findOrFail($id_eleve);
        return view('successanimation.success', compact('eleve', 'type'));
    }

    public function successPagePiscine($id_eleve, $type)
    {
        $eleve = Eleve::findOrFail($id_eleve);
        return view('successanimation.success', compact('eleve', 'type'));
    }

    public function successPageMusique($id_eleve, $type)
    {
        $eleve = Eleve::findOrFail($id_eleve);
        return view('successanimation.success', compact('eleve', 'type'));
    }



    //cantine jour
    public function indexcantjour()
    {
        return view('menusgestion.cantine_jour');
    }


            //requetes nouveaux inscrits

    public function afficherFormulaireInscritsPeriodiques()
    {
        // Affiche la vue pour entrer les dates
        return view('inscrits.inscrits_periodiques');
    }

    public function rechercheInscrits(Request $request)
    {
        // Valider les dates de début et de fin
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        // Récupérer les dates
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');

        // Rechercher les élèves inscrits dans cet intervalle et dont les frais d'inscription sont différents de 0
        $eleves = Eleve::whereBetween('date_inscription', [$dateDebut, $dateFin])
            ->where('frais_inscription', '!=', 0)
            ->get();

        // Calculer le total
        $totalInscrits = $eleves->count();
        $totalFrais = $totalInscrits * 25000;

        // Retourner la vue avec les résultats
        return view('inscrits.resultats_inscrits', compact('eleves', 'totalInscrits', 'totalFrais'));
    }
}
