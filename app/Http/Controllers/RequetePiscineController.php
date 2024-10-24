<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\piscine;

class RequetePiscineController extends Controller
{
    //
    public function index()
    {
        return view('requetes.piscine');
    }

    public function getImpayes(Request $request)
    {
        $request->validate([
            'classe' => 'required|string',
            'tranche' => 'required|integer|between:1,9'
        ]);

        $classe = $request->input('classe');
        $tranche = $request->input('tranche');
        
        // Récupère les frais de piscine total pour chaque élève dans la classe donnée
        $eleves = Eleve::where('classe', $classe)->get();

        $elevesNotUpToDate = collect(); // Initialise une collection vide

        foreach ($eleves as $eleve) {
            $piscine = piscine::where('id_eleve', $eleve->id_eleve)->first();

            if ($piscine) {
                $frais_total = $piscine->frais_piscine;
                $frais_par_mois = $frais_total / 9;
                $frais_attendu = $frais_par_mois * $tranche;

                if ($piscine->deja_payee < $frais_attendu) {
                    $elevesNotUpToDate->push([
                        'nom' => $eleve->nom,
                        'classe' => $eleve->classe,
                        'frais_piscine' => $frais_total,
                        'deja_payee' => $piscine->deja_payee,
                        'montant_restant' => $frais_total - $piscine->deja_payee
                    ]);
                }
            }
        }

        return view('requetes.piscine_result', [
            'elevesNotUpToDate' => $elevesNotUpToDate
        ]);
    }



    public function selectClasse()
    {
        return view('requetes.select_classe');
    }

    public function effectifpiscine(Request $request)
    {
        $classe = $request->input('classe');
        $eleves = Eleve::join('piscine', 'eleves.id_eleve', '=', 'piscine.id_eleve')
            ->where('eleves.classe', $classe)
            ->orderBy('eleves.nom')
            ->orderBy('eleves.prenom')
            ->get();
    
        return view('requetes.effectif_piscine', compact('eleves', 'classe'));
    }
}
