<?php

namespace App\Http\Controllers;

use App\Models\CantineJour;
use Illuminate\Http\Request;
use App\Models\recus;
use App\Models\Eleve;
use App\Models\Recusco;
use App\Models\Recucant;
use App\Models\Recutrans;

class RecuController extends Controller
{
    // Afficher le formulaire de recherche
    public function rechercheRecu()
    {
        return view('recus.recherche-recu');
    }

    public function rechercheRecuCant()
    {
        return view('recus.recherche-recu-cant');
    }

    public function rechercheRecuTrans()
    {
        return view('recus.recherche-recu-trans');
    }

    public function rechercheRecuCantJour()
    {
        return view('recus.recherche-recu-cantjour');
    }

    public function resultatRechercheRecu(Request $request)
    {
        $numero_recu = $request->input('numero_recu');

        // Recherche du reçu par numéro
        $recu = Recusco::where('id', $numero_recu)->first();

        // Si le reçu existe, on récupère les infos de l'élève
        if ($recu) {
            $eleve = Eleve::find($recu->id_eleve);

            // Vérifie si l'élève existe
            if ($eleve) {
                // Initialisation du total payé et montant restant
                $total_paye = 0;
                $montant_restant = $recu->montant_restant;

                // Calcul du total payé à ce jour selon le type de reçu
                if ($recu->type == 'scolarite') {
                    $total_paye = $eleve->scolarite_total - $montant_restant;
                } elseif ($recu->type == 'cantine') {
                    // Calcul pour la cantine avec un montant fixe de 165 000
                    $total_paye = 165000 - $montant_restant;
                }

                // Si le montant restant n'est pas défini, s'assurer qu'on affiche 0 au lieu de null
                $montant_restant = $montant_restant ?? 0;

                // Formater le numéro de reçu avec '00' avant l'ID
                $formatted_numero_recu = sprintf('RECSCO000%d', $recu->id);

                // Affichage du reçu avec les informations nécessaires
                return view('recus.afficher-recu', [
                    'numero_recu' => $formatted_numero_recu, // Formaté ici
                    'nom_eleve' => $eleve->nom,
                    'prenom_eleve' => $eleve->prenom,
                    'classe' => $eleve->classe,
                    'montant_verse' => $recu->montant_verse,
                    'type' => $recu->type,
                    //'total_paye' => $total_paye, // Calculé ici
                    //'montant_restant' => $montant_restant, // Affichage du montant restant
                    'statut' => $recu->statut,
                    'date_enregistrement' => $recu->created_at,
                    'signature' => 'Signature de l’administration',
                    'logo' => asset('img/logopoussi_preview_rev_1.png') // Remplacer par le chemin réel du logo
                ]);
            } else {
                return redirect()->back()->with('error', 'Élève non trouvé.');
            }
        } else {
            return redirect()->back()->with('error', 'Reçu non trouvé.');
        }
    }

    public function resultatRechercheRecuCant(Request $request)
    {
        $numero_recu = $request->input('numero_recu');

        // Recherche du reçu par numéro
        $recu = Recucant::where('id', $numero_recu)->first();

        // Si le reçu existe, on récupère les infos de l'élève
        if ($recu) {
            $eleve = Eleve::find($recu->id_eleve);

            // Vérifie si l'élève existe
            if ($eleve) {
                // Initialisation du total payé et montant restant
                $total_paye = 0;
                $montant_restant = $recu->montant_restant;

                // Calcul du total payé à ce jour selon le type de reçu
                if ($recu->type == 'scolarite') {
                    $total_paye = $eleve->scolarite_total - $montant_restant;
                } elseif ($recu->type == 'cantine') {
                    // Calcul pour la cantine avec un montant fixe de 165 000
                    $total_paye = 165000 - $montant_restant;
                }

                // Si le montant restant n'est pas défini, s'assurer qu'on affiche 0 au lieu de null
                $montant_restant = $montant_restant ?? 0;

                // Formater le numéro de reçu avec '00' avant l'ID
                $formatted_numero_recu = sprintf('RECCANT000%d', $recu->id);

                // Affichage du reçu avec les informations nécessaires
                return view('recus.afficher-recu-cant', [
                    'numero_recu' => $formatted_numero_recu, // Formaté ici
                    'nom_eleve' => $eleve->nom,
                    'prenom_eleve' => $eleve->prenom,
                    'classe' => $eleve->classe,
                    'montant_verse' => $recu->montant_verse,
                    'type' => $recu->type,
                    //'total_paye' => $total_paye, // Calculé ici
                    //'montant_restant' => $montant_restant, // Affichage du montant restant
                    'statut' => $recu->statut,
                    'date_enregistrement' => $recu->created_at,
                    'signature' => 'Signature de l’administration',
                    'logo' => asset('img/logopoussi_preview_rev_1.png') // Remplacer par le chemin réel du logo
                ]);
            } else {
                return redirect()->back()->with('error', 'Élève non trouvé.');
            }
        } else {
            return redirect()->back()->with('error', 'Reçu non trouvé.');
        }
    }


    public function resultatRechercheRecuTrans(Request $request)
    {
        $numero_recu = $request->input('numero_recu');

        // Recherche du reçu par numéro
        $recu = Recutrans::where('id', $numero_recu)->first();

        // Si le reçu existe, on récupère les infos de l'élève
        if ($recu) {
            $eleve = Eleve::find($recu->id_eleve);

            // Vérifie si l'élève existe
            if ($eleve) {
                // Initialisation du total payé et montant restant
                $total_paye = 0;
                $montant_restant = $recu->montant_restant;

                // Calcul du total payé à ce jour selon le type de reçu
                if ($recu->type == 'scolarite') {
                    $total_paye = $eleve->scolarite_total - $montant_restant;
                } elseif ($recu->type == 'cantine') {
                    // Calcul pour la cantine avec un montant fixe de 165 000
                    $total_paye = 165000 - $montant_restant;
                }

                // Si le montant restant n'est pas défini, s'assurer qu'on affiche 0 au lieu de null
                $montant_restant = $montant_restant ?? 0;

                // Formater le numéro de reçu avec '00' avant l'ID
                $formatted_numero_recu = sprintf('RECTRANS000%d', $recu->id);

                // Affichage du reçu avec les informations nécessaires
                return view('recus.afficher-recu-trans', [
                    'numero_recu' => $formatted_numero_recu, // Formaté ici
                    'nom_eleve' => $eleve->nom,
                    'prenom_eleve' => $eleve->prenom,
                    'classe' => $eleve->classe,
                    'montant_verse' => $recu->montant_verse,
                    'type' => $recu->type,
                    //'total_paye' => $total_paye, // Calculé ici
                    //'montant_restant' => $montant_restant, // Affichage du montant restant
                    'statut' => $recu->statut,
                    'date_enregistrement' => $recu->created_at,
                    'signature' => 'Signature de l’administration',
                    'logo' => asset('img/logopoussi_preview_rev_1.png') // Remplacer par le chemin réel du logo
                ]);
            } else {
                return redirect()->back()->with('error', 'Élève non trouvé.');
            }
        } else {
            return redirect()->back()->with('error', 'Reçu non trouvé.');
        }
    }

    public function resultatRechercheRecuCantJour(Request $request)
    {
        $numero_recu = $request->input('numero_recu');

        // Recherche du reçu par numéro
        $recu = CantineJour::where('id', $numero_recu)->first();

        // Si le reçu existe, on récupère les infos de l'élève
        if ($recu) {
            $eleve = CantineJour::find($recu->id);

            // Vérifie si l'élève existe
            if ($eleve) {
                // Initialisation du total payé et montant restant
                $total_paye = 0;
                $montant_restant = $recu->montant_restant;

                // Calcul du total payé à ce jour selon le type de reçu
                if ($recu->type == 'scolarite') {
                    $total_paye = $eleve->scolarite_total - $montant_restant;
                } elseif ($recu->type == 'cantine') {
                    // Calcul pour la cantine avec un montant fixe de 165 000
                    $total_paye = 165000 - $montant_restant;
                }

                // Si le montant restant n'est pas défini, s'assurer qu'on affiche 0 au lieu de null
                $montant_restant = $montant_restant ?? 0;

                // Formater le numéro de reçu avec '00' avant l'ID
                $formatted_numero_recu = sprintf('REC000%d', $recu->id);

                // Affichage du reçu avec les informations nécessaires
                return view('recus.afficher-recu-cantjour', [
                    'numero_recu' => $formatted_numero_recu, // Formaté ici
                    'nom_eleve' => $recu->nom,
                    'prenom_eleve' => $recu->prenom,
                    'classe' => $recu->classe,
                    
                    'montant_verse' => $recu->montant,
                    'type' => $eleve->type_paiement,
                    //'total_paye' => $total_paye, // Calculé ici
                    //'montant_restant' => $montant_restant, // Affichage du montant restant
                    'statut' => $recu->statut,
                    'date_enregistrement' => $recu->created_at,
                    'signature' => 'Signature de l’administration',
                    'logo' => asset('img/logopoussi_preview_rev_1.png') // Remplacer par le chemin réel du logo
                ]);
            } else {
                return redirect()->back()->with('error', 'Élève non trouvé.');
            }
        } else {
            return redirect()->back()->with('error', 'Reçu non trouvé.');
        }
    }
}
