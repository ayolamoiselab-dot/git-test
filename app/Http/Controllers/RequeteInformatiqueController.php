<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\informatique;

class RequeteInformatiqueController extends Controller
{
    //
    public function index()
    {
        return view('requetes.informatique');
    }

    public function getImpayes(Request $request)
    {
        $request->validate([
            'classe' => 'required|string',
            'tranche' => 'required|integer|between:1,9'
        ]);

        $classe = $request->input('classe');
        $tranche = $request->input('tranche');
        
        // Récupère les frais de informatique total pour chaque élève dans la classe donnée
        $eleves = Eleve::where('classe', $classe)->get();

        $elevesNotUpToDate = collect(); // Initialise une collection vide

        foreach ($eleves as $eleve) {
            $informatique = informatique::where('id_eleve', $eleve->id_eleve)->first();

            if ($informatique) {
                $frais_total = $informatique->frais_informatique;
                $frais_par_mois = $frais_total / 9;
                $frais_attendu = $frais_par_mois * $tranche;

                if ($informatique->deja_payee < $frais_attendu) {
                    $elevesNotUpToDate->push([
                        'nom' => $eleve->nom,
                        'classe' => $eleve->classe,
                        'frais_informatique' => $frais_total,
                        'deja_payee' => $informatique->deja_payee,
                        'montant_restant' => $frais_total - $informatique->deja_payee
                    ]);
                }
            }
        }

        return view('requetes.informatique_result', [
            'elevesNotUpToDate' => $elevesNotUpToDate
        ]);
    }



    public function selectClasse()
    {
        return view('requetes.select_classe');
    }

    public function effectifInformatique(Request $request)
    {
        $classe = $request->input('classe');
        $eleves = Eleve::join('informatique', 'eleves.id_eleve', '=', 'informatique.id_eleve')
            ->where('eleves.classe', $classe)
            ->orderBy('eleves.nom')
            ->orderBy('eleves.prenom')
            ->get();
    
        return view('requetes.effectif_informatique', compact('eleves', 'classe'));
    }
}
