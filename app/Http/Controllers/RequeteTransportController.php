<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transport;
use App\Models\Eleve;

class RequeteTransportController extends Controller
{
    //

    public function index()
    {
        return view('requetes.transport');
    }

    public function getImpayes(Request $request)
    {
        $request->validate([
            'classe' => 'required|string',
            'tranche' => 'required|integer|between:1,9'
        ]);

        $classe = $request->input('classe');
        $tranche = $request->input('tranche');
        
        // Récupère les frais de transport total pour chaque élève dans la classe donnée
        $eleves = Eleve::where('classe', $classe)->get();

        $elevesNotUpToDate = collect(); // Initialise une collection vide

        foreach ($eleves as $eleve) {
            $transport = transport::where('id_eleve', $eleve->id_eleve)->first();

            if ($transport) {
                $frais_total = $transport->frais_transport;
                $frais_par_mois = $frais_total / 9;
                $frais_attendu = $frais_par_mois * $tranche;

                if ($transport->deja_payee < $frais_attendu) {
                    $elevesNotUpToDate->push([
                        'nom' => $eleve->nom,
                        'classe' => $eleve->classe,
                        'frais_transport' => $frais_total,
                        'deja_payee' => $transport->deja_payee,
                        'restant' => $frais_total - $transport->deja_payee
                    ]);
                }
            }
        }

        return view('requetes.transport_result', [
            'elevesNotUpToDate' => $elevesNotUpToDate
        ]);
    }



    public function selectClasse()
    {
        return view('requetes.select_classe');
    }

    public function effectifTransport(Request $request)
    {
        $classe = $request->input('classe');
        $eleves = Eleve::join('transport', 'eleves.id_eleve', '=', 'transport.id_eleve')
            ->where('eleves.classe', $classe)
            ->orderBy('eleves.nom')
            ->orderBy('eleves.prenom')
            ->select('eleves.*', 'transport.quartier', 'transport.type_trajet')
            ->get();
    
        return view('requetes.effectif_transport', compact('eleves', 'classe'));
    }

}
