<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\cantine;
use Illuminate\Http\Request;

class FavorisationController extends Controller
{
    // Vue pour sélectionner le type de faveur
    public function index()
    {
        return view('favorisation.index');
    }

    // Liste des élèves en fonction du type et de la classe sélectionnée
    public function listeEleves(Request $request)
{
    $type = $request->type; // 'scolarite' ou 'cantine'
    $classe = $request->classe;

    if ($type == 'scolarite') {
        // Récupérer les élèves dont est_favorise est à false
        $eleves = Eleve::where('classe', $classe)
            ->where(function ($query) {
                $query->whereNull('est_favorise')->orWhere('est_favorise', false);
            })
            ->orderBy('nom', 'asc')
            ->get();
    } else {
        // Récupérer les élèves de la cantine dont est_favorise_cantine est à false
        $eleves = cantine::with('eleve')
            ->whereHas('eleve', function ($query) use ($classe) {
                $query->where('classe', $classe)
                    ->where(function ($query) {
                        $query->whereNull('est_favorise_cantine')->orWhere('est_favorise_cantine', false);
                    });
                    
            })
            ->orderBy('nom', 'asc')
            ->get();
    }

    return view('favorisation.liste', compact('eleves', 'type', 'classe'));
}


    // Favoriser les élèves sélectionnés
    public function favoriser(Request $request)
    {
        $type = $request->type; // 'scolarite' ou 'cantine'
        $ids = $request->ids; // IDs des élèves sélectionnés

        if ($type == 'scolarite') {
            Eleve::whereIn('id_eleve', $ids)->update(['est_favorise' => true]);
        } else {
            cantine::whereIn('id_eleve', $ids)->update(['est_favorise_cantine' => true]);
        }

         // Redirection vers la vue index avec le message de succès
    return redirect()->route('favorisation.index')->with('success', 'Les élèves ont été favorisés avec succès.');
    }

   

    // Enregistrer les modifications
    public function rechercher(Request $request)
    {
        $type = $request->type;
        $nom = $request->nom;
    
        // Si le type est "scolarite", on cherche dans la table Eleve
        if ($type == 'scolarite') {
            // Recherche tous les élèves favorisés dont le nom contient la chaîne recherchée
            $eleves = Eleve::where('nom', 'LIKE', "%{$nom}%")
                ->where('est_favorise', 1) // Vérifie si l'élève est favorisé
                ->get();
        } else {
            // Si le type est "cantine", on cherche dans la table Cantine en fonction du nom de l'élève et si favorisé
            $eleves = cantine::with('eleve')
                ->whereHas('eleve', function ($query) use ($nom) {
                    $query->where('nom', 'LIKE', "%{$nom}%")
                          ->where('est_favorise_cantine', 1); // Vérifie si l'élève est favorisé
                })->get();
        }
    
        // Si aucun élève n'est trouvé, on redirige avec un message d'erreur
        if ($eleves->isEmpty()) {
            return redirect()->back()->with('error', 'Aucun élève favorisé trouvé avec ce nom.');
        }
    
        // Si un seul élève est trouvé, on redirige vers la page de modification
        if ($eleves->count() == 1) {
            $eleve = $eleves->first(); // Passe un seul élève si trouvé
            return view('favorisation.update', compact('eleve', 'type'));
        }
        
        if ($eleves->count() > 1) {
            return view('favorisation.multiple', compact('eleves', 'type'));
        }        
    }
    


public function enregistrerModifications(Request $request)
{
    // Récupérer les données de la requête
    $type = $request->type;
    $id = $request->id_eleve;
    $reduction_fcfa = floatval($request->reduction_fcfa);
    $reduction_pourcentage = floatval($request->reduction_pourcentage);

    // Validation des données
    if ($reduction_fcfa < 0 || $reduction_pourcentage < 0 || $reduction_pourcentage > 100) {
        return redirect()->back()->with('error', 'Les réductions saisies sont invalides.');
    }

    if ($type == 'scolarite') {
        // Trouver l'élève par ID
        $eleve = Eleve::find($id);

        if (!$eleve) {
            return redirect()->back()->with('error', 'Élève non trouvé.');
        }

        // Vérifier que la réduction n'excède pas le total
        if ($reduction_fcfa > $eleve->scolarite_total) {
            return redirect()->back()->with('error', 'La réduction dépasse le montant total de la scolarité.');
        }

        // Appliquer les réductions
        $eleve->reduction_fcfa = $reduction_fcfa;
        $eleve->reduction_pourcentage = $reduction_pourcentage;

        // Recalculer les frais
        $eleve->scolarite_total -= $reduction_fcfa;
        $eleve->scolarite_restante = max(0, $eleve->scolarite_total - $eleve->scolarite_payee);

        $eleve->save();
        return redirect()->back()->with('success','modifications effectuées avec succès!!');

    } elseif ($type == 'cantine') {
        // Trouver l'enregistrement de la cantine par l'ID de l'élève
        $cantine = cantine::where('id_eleve', $id)->first();
    
        if (!$cantine) {
            return redirect()->back()->with('error', 'Enregistrement de cantine non trouvé pour cet élève.');
        }
    
        // Vérifier que la réduction n'excède pas le total
        if ($reduction_fcfa > $cantine->frais_cantine) {
            return redirect()->back()->with('error', 'La réduction dépasse le montant total de la cantine.');
        }
    
        // Appliquer les réductions
        $cantine->reduction_fcfa = $reduction_fcfa;
        $cantine->reduction_pourcentage = $reduction_pourcentage;
    
        // Recalculer les frais
        $cantine->frais_cantine -= $reduction_fcfa;
        $cantine->montant_restant = max(0, $cantine->frais_cantine - $cantine->deja_payee);
    
        $cantine->save();
        return redirect()->back()->with('success','modifications effectuées avec succès!!');
    }
}


public function afficherDetails($id, $type)
{
    if ($type == 'scolarite') {
        $eleve = Eleve::find($id);
    } elseif ($type == 'cantine') {
        $eleve = Cantine::with('eleve')->where('id_eleve', $id)->first();
    }

    if (!$eleve) {
        return redirect()->back()->with('error', 'Élève non trouvé.');
    }

    return view('favorisation.update', compact('eleve', 'type'));
}

public function formFavorises()
{
    $classes = ['toutes', 'maternelle1', 'maternelle2', 'maternelle3', 'cp1', 'cp2', 'ce1', 'ce2', 'cm1', 'cm2'];
    return view('favorisation.form_favorises', compact('classes'));
}


public function listeElevesFavorises(Request $request)
{
    $type = $request->type; // 'scolarite' ou 'cantine'
    $classe = $request->classe;

    if ($classe === 'toutes') {
        if ($type == 'scolarite') {
            $eleves = Eleve::whereNotNull('est_favorise')
                ->where('est_favorise', true)
                ->orderByRaw("
                    FIELD(classe, 'maternelle1', 'maternelle2', 'maternelle3', 'cp1', 'cp2', 'ce1', 'ce2', 'cm1', 'cm2')
                ")
                ->orderBy('nom')
                ->get();
        } else {
            $eleves = cantine::with('eleve') // Charger la relation 'eleve'
                ->whereHas('eleve', function ($query) {
                    $query->whereNotNull('est_favorise_cantine') // Vérifier que l'élève est favorisé
                          ->where('est_favorise_cantine', true);
                })
                ->get()
                ->sortBy([
                    // Trier d'abord par classe dans l'ordre défini
                    fn($item) => array_search(
                        $item->eleve->classe, 
                        ['maternelle1', 'maternelle2', 'maternelle3', 'cp1', 'cp2', 'ce1', 'ce2', 'cm1', 'cm2']
                    ),
                    // Puis par nom de l'élève
                    'eleve.nom'
                ]);
        }
        
    } else {
        if ($type == 'scolarite') {
            $eleves = Eleve::where('classe', $classe)
                ->whereNotNull('est_favorise')
                ->where('est_favorise', true)
                ->orderBy('nom')
                ->get();
        } else {
            $eleves = cantine::with('eleve') // Charger la relation 'eleve'
                ->whereHas('eleve', function ($query) use ($classe) {
                    $query->where('classe', $classe) // Vérifier la classe dans la table eleves
                          ->whereNotNull('est_favorise_cantine') // Vérifier que l'élève est favorisé
                          ->where('est_favorise_cantine', true);
                })
                ->get()
                ->sortBy('eleve.nom'); // Trier par nom des élèves
        }
        
    }

    return view('favorisation.liste_favorises', compact('eleves', 'type', 'classe'));
}


}