<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\CantineJournaliere;
use App\Models\PaiementsJournaliers;
use DB;

class CantineJournaliereController extends Controller
{
    public function rechercherEleve(Request $request)
    {
        $eleves = Eleve::where('nom', 'LIKE', '%' . $request->nom . '%')
            ->orWhere('prenom', 'LIKE', '%' . $request->prenom . '%')
            ->get();

        return view('cantine.recherche', compact('eleves'));
    }

    public function afficherFormulairePaiement($id_eleve)
    {
        $eleve = Eleve::findOrFail($id_eleve);
        $cantineJournaliere = CantineJournaliere::where('id_eleve', $id_eleve)->first();

        return view('cantine.paiement', compact('eleve', 'cantineJournaliere'));
    }

    public function enregistrerPaiement(Request $request, $id_eleve)
    {
        $cantineJournaliere = CantineJournaliere::where('id_eleve', $id_eleve)->first();

        // Si l'élève n'a pas de frais de cantine enregistrés, on crée une entrée
        if (!$cantineJournaliere) {
            $cantineJournaliere = new CantineJournaliere();
            $cantineJournaliere->id_eleve = $id_eleve;
            $cantineJournaliere->frais_cantine = $request->frais_cantine;
            $cantineJournaliere->montant_restant = $request->frais_cantine;
        }

        // Calcul des nouveaux montants
        $montantVerse = $request->montant;
        $cantineJournaliere->montant_total_verse += $montantVerse;
        $cantineJournaliere->montant_restant -= $montantVerse;
        
        if ($cantineJournaliere->montant_restant <= 0) {
            $cantineJournaliere->statut = 'soldé';
        }

        // Enregistrer le paiement journalier
        PaiementsJournaliers::create([
            'id_cantine_journaliere' => $cantineJournaliere->id,
            'montant' => $montantVerse,
            'date_versement' => now(),
        ]);

        // Sauvegarder les informations dans la table 'cantine_journaliere'
        $cantineJournaliere->save();

        // Rediriger vers une page avec le reçu
        return redirect()->route('cantine.recu', ['id_eleve' => $id_eleve]);
    }

    public function genererRecu($id_eleve)
    {
        $eleve = Eleve::findOrFail($id_eleve);
        $paiements = PaiementsJournaliers::whereHas('cantineJournaliere', function ($query) use ($id_eleve) {
            $query->where('id_eleve', $id_eleve);
        })->get();

        return view('cantine.recu', compact('eleve', 'paiements'));
    }
}

