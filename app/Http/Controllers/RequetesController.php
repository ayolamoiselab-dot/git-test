<?php

namespace App\Http\Controllers;

use App\Models\cantine;
use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\CantineJour;
use App\Models\transport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class RequetesController extends Controller
{
    public function index()
    {
        return view('requetes.index');
    }

    public function scolarite()
    {
        $classes = [
            'maternelle1',
            'maternelle2',
            'maternelle3',
            'cp1',
            'cp2',
            'ce1',
            'ce2',
            'cm1',
            'cm2'
        ];
        return view('requetes.scolarite', compact('classes'));
    }

    public function scolariteResult(Request $request)
    {
        $tranche = $request->input('tranche');
        $classe = $request->input('classe');
        $tri = $request->input('tri'); // Récupérer l'option de tri
    
        $query = Eleve::query();
    
        if (!empty($classe)) {
            $query->where('classe', $classe);
        }
    
        // Ajouter une condition pour trier les résultats
        if ($tri == 'nouveau') {
            $query->where('frais_inscription', 25000);
        } elseif ($tri == 'ancien') {
            $query->where('frais_inscription', 0);
        }
    
        $elevesNotUpToDate = $query->where(function ($query) use ($tranche) {
            $query->where(function ($query) use ($tranche) {
                if ($tranche == 1) {
                    $query->whereRaw('COALESCE(scolarite_payee, 0) < 50000');
                } elseif ($tranche == 2) {
                    $query->whereRaw('COALESCE(scolarite_payee, 0) < 100000');
                } elseif ($tranche == 3) {
                    $query->where(function ($query) {
                        $query->whereRaw('scolarite_total = 140000 AND COALESCE(scolarite_payee, 0) < 140000')
                            ->orWhereRaw('scolarite_total = 125000 AND COALESCE(scolarite_payee, 0) < 125000');
                    });
                }
            });
    
            // Cas des élèves favorisés
            $query->orWhere(function ($query) use ($tranche) {
                if ($tranche == 1) {
                    $query->where('est_favorise', true)
                        ->whereRaw('COALESCE(scolarite_payee, 0) < scolarite_total / 3');
                } elseif ($tranche == 2) {
                    $query->where('est_favorise', true)
                        ->whereRaw('COALESCE(scolarite_payee, 0) < (scolarite_total * 2) / 3');
                } elseif ($tranche == 3) {
                    $query->where('est_favorise', true)
                        ->whereRaw('COALESCE(scolarite_payee, 0) < scolarite_total');
                }
            });
        })
        ->get()
        ->map(function ($eleve) use ($tranche) {
            $eleve->dernier_versement_date = $this->getLastPaymentDate($eleve);
            $eleve->dernier_versement_montant = $this->getLastPaymentAmount($eleve);
    
            // Calcul du reste à payer pour les tranches
            if ($eleve->est_favorise) {
                if ($tranche == 1) {
                    $eleve->restant_a_payer = ($eleve->scolarite_total / 3) - $eleve->scolarite_payee;
                } elseif ($tranche == 2) {
                    $eleve->restant_a_payer = (($eleve->scolarite_total * 2) / 3) - $eleve->scolarite_payee;
                } elseif ($tranche == 3) {
                    $eleve->restant_a_payer = $eleve->scolarite_total - $eleve->scolarite_payee;
                }
            } else {
                if ($tranche == 1) {
                    $eleve->restant_a_payer = 50000 - $eleve->scolarite_payee;
                } elseif ($tranche == 2) {
                    $eleve->restant_a_payer = 100000 - $eleve->scolarite_payee;
                } elseif ($tranche == 3) {
                    $eleve->restant_a_payer = ($eleve->scolarite_total == 140000 ? 140000 : 125000) - $eleve->scolarite_payee;
                }
            }
    
            return $eleve;
        });
    
        // Calcul des totaux
        $totalScolaritePayee = $elevesNotUpToDate->sum('scolarite_payee');
        $totalDernierVersement = $elevesNotUpToDate->sum('dernier_versement_montant');
        $totalRestantAPayer = $elevesNotUpToDate->sum('restant_a_payer');
    
        return view('requetes.scolarite_result', compact('elevesNotUpToDate', 'tranche', 'classe', 'tri', 'totalScolaritePayee', 'totalDernierVersement', 'totalRestantAPayer'));
    }
    



    private function getLastPaymentDate(Eleve $eleve)
    {
        $dates = [
            $eleve->date_versement1,
            $eleve->date_versement2,
            $eleve->date_versement3,
            $eleve->date_versement4,
            $eleve->date_versement5,
            $eleve->date_versement6,
            $eleve->date_versement7,
            $eleve->date_versement9,
        ];

        $dates = array_filter($dates);
        rsort($dates);

        return $dates[0] ?? null;
    }

    private function getLastPaymentAmount(Eleve $eleve)
    {
        $payments = [
            'date_versement1' => $eleve->montant1,
            'date_versement2' => $eleve->montant2,
            'date_versement3' => $eleve->montant3,
            'date_versement4' => $eleve->montant4,
            'date_versement5' => $eleve->montant5,
            'date_versement6' => $eleve->montant6,
            'date_versement7' => $eleve->montant7,
            'date_versement9' => $eleve->montant9,
        ];

        uksort($payments, function ($a, $b) use ($eleve) {
            return strcmp($eleve->$b, $eleve->$a);
        });

        foreach ($payments as $date => $amount) {
            if ($eleve->$date !== null) {
                return $amount;
            }
        }

        return null;
    }

    public function cantine()
    {
        $classes = [
            'maternelle1',
            'maternelle2',
            'maternelle3',
            'cp1',
            'cp2',
            'ce1',
            'ce2',
            'cm1',
            'cm2'
        ];
        return view('requetes.cantine', compact('classes'));
    }

    public function cantineResult(Request $request)
    {
        $tranche = $request->input('tranche');
        $classe = $request->input('classe');
        $tri = $request->input('tri'); // Récupérer l'option de tri
    
        // Création de la requête de base
        $query = cantine::query();
    
        // Filtrer par classe si défini
        if (!empty($classe)) {
            $query->whereHas('eleve', function ($query) use ($classe) {
                $query->where('classe', $classe);
            });
        }
    
        // Ajouter une condition pour trier les résultats
        if ($tri == 'nouveau') {
            $query->whereHas('eleve', function ($query) {
                $query->where('frais_inscription', 25000);
            });
        } elseif ($tri == 'ancien') {
            $query->whereHas('eleve', function ($query) {
                $query->where('frais_inscription', 0);
            });
        }
    
        // Filtrage des élèves non à jour selon la tranche choisie
        $elevesNotUpToDate = $query->where(function ($query) use ($tranche) {
            $query->whereHas('eleve', function ($query) use ($tranche) {
                // Filtrage des élèves favorisés (est_favorise_cantine = true)
                $query->where('est_favorise_cantine', true)
                      ->when($tranche == 1, function ($query) {
                          $query->whereRaw('COALESCE(deja_payee, 0) < frais_cantine / 3');
                      })
                      ->when($tranche == 2, function ($query) {
                          $query->whereRaw('COALESCE(deja_payee, 0) < (frais_cantine * 2) / 3');
                      })
                      ->when($tranche == 3, function ($query) {
                          $query->whereRaw('COALESCE(deja_payee, 0) < frais_cantine');
                      });
    
                // Filtrage des élèves non favorisés (est_favorise_cantine = false)
                $query->orWhere(function ($query) use ($tranche) {
                    $query->where('est_favorise_cantine', false)
                          ->when($tranche == 1, function ($query) {
                              $query->whereRaw('COALESCE(deja_payee, 0) < 55000');
                          })
                          ->when($tranche == 2, function ($query) {
                              $query->whereRaw('COALESCE(deja_payee, 0) < 110000');
                          })
                          ->when($tranche == 3, function ($query) {
                              $query->whereRaw('COALESCE(deja_payee, 0) < 165000');
                          });
                });
            });
        })
        ->with('eleve')  // Charger les élèves associés
        ->get()
        ->map(function ($cantine) use ($tranche) {
            // Récupérer les dernières informations de paiement
            $cantine->dernier_versement_cantine_date = $this->getLastCantinePaymentDate($cantine);
            $cantine->dernier_versement_cantine_montant = $this->getLastCantinePaymentAmount($cantine);
    
            // Calcul du restant à payer pour la tranche sélectionnée
            if ($cantine->eleve->est_favorise_cantine) {
                if ($tranche == 1) {
                    $cantine->restant_a_payer = ($cantine->eleve->frais_cantine / 3) - $cantine->deja_payee;
                } elseif ($tranche == 2) {
                    $cantine->restant_a_payer = ($cantine->eleve->frais_cantine * 2 / 3) - $cantine->deja_payee;
                } elseif ($tranche == 3) {
                    $cantine->restant_a_payer = $cantine->eleve->frais_cantine - $cantine->deja_payee;
                }
            } else {
                // Pour les élèves non favorisés, on applique la logique classique
                $cantine->restant_a_payer = $this->getTrancheAmount($tranche) - $cantine->deja_payee;
            }
    
            return $cantine;
        });
    
        // Calcul des totaux
        $totalScolaritePayee = $elevesNotUpToDate->sum('deja_payee');
        $totalDernierVersement = $elevesNotUpToDate->sum('dernier_versement_cantine_montant');
        $totalRestantAPayer = $elevesNotUpToDate->sum('restant_a_payer'); // Total du restant à payer
    
        return view('requetes.cantine_result', compact(
            'elevesNotUpToDate',
            'tranche',
            'classe',
            'tri',
            'totalScolaritePayee',
            'totalDernierVersement',
            'totalRestantAPayer' // Envoyer le total à la vue
        ));
    }
    

    private function getTrancheAmount($tranche)
    {
        // Montants des tranches
        if ($tranche == 1) {
            return 55000;
        } elseif ($tranche == 2) {
            return 110000;
        } elseif ($tranche == 3) {
            return 165000;
        }

        return 0;
    }


    private function getLastCantinePaymentDate(Cantine $cantine)
    {
        $dates = [
            $cantine->date_versement1,
            $cantine->date_versement2,
            $cantine->date_versement3,
            $cantine->date_versement4,
            $cantine->date_versement5,
            $cantine->date_versement6,
            $cantine->date_versement7,
            $cantine->date_versement9,
        ];

        $dates = array_filter($dates);
        rsort($dates);

        return $dates[0] ?? null;
    }

    private function getLastCantinePaymentAmount(Cantine $cantine)
    {
        $payments = [
            'date_versement1' => $cantine->montant1,
            'date_versement2' => $cantine->montant2,
            'date_versement3' => $cantine->montant3,
            'date_versement4' => $cantine->montant4,
            'date_versement5' => $cantine->montant5,
            'date_versement6' => $cantine->montant6,
            'date_versement7' => $cantine->montant7,
            'date_versement9' => $cantine->montant9,
        ];

        uksort($payments, function ($a, $b) use ($cantine) {
            return strcmp($cantine->$b, $cantine->$a);
        });

        foreach ($payments as $date => $amount) {
            if ($cantine->$date !== null) {
                return $amount;
            }
        }

        return null;
    }



    //
    public function selectType()
    {
        return view('requetes.select_type');
    }

    public function favorise(Request $request)
    {
        $type = $request->input('type');
        return view('requetes.favorise', ['type' => $type]);
    }

    public function addFavorise(Request $request)
    {
        $nom = $request->input('nom');
        $type = $request->input('type');

        if ($type == 'scolarite') {
            $eleves = Eleve::where('nom', 'LIKE', "%$nom%")
                ->where('est_favorise', '<>', 'favorise')
                ->get();
        } elseif ($type == 'cantine') {
            $eleves = Cantine::where('nom', 'LIKE', "%$nom%")
                ->where('est_favorise_cantine', '<>', 'favorise')
                ->get();
        } else {
            return back()->withErrors(['error' => 'Type non reconnu']);
        }

        if ($eleves->isEmpty()) {
            return back()->withErrors(['error' => 'Élève non trouvé ou déjà favorisé']);
        }

        if ($eleves->count() == 1) {
            $eleve = $eleves->first();
            if ($type == 'scolarite' && $eleve->scolarite_payee < 50000) {
                return back()->withErrors(['error' => 'L\'élève n\'a pas encore payé la première tranche de scolarité']);
            } elseif ($type == 'cantine' && $eleve->deja_payee < 55000) {
                return back()->withErrors(['error' => 'L\'élève n\'a pas encore payé la première tranche de cantine']);
            }

            if ($type == 'scolarite') {
                $eleve->est_favorise = 'favorise';
            } elseif ($type == 'cantine') {
                $eleve->est_favorise_cantine = 'favorise';
            }
            $eleve->save();

            return back()->with('success', 'Élève favorisé ajouté avec succès');
        }

        // Si plusieurs élèves ont été trouvés
        return view('requetes.select_eleve', ['eleves' => $eleves, 'type' => $type]);
    }

    public function selectFavorise(Request $request)
    {
        $id = $request->input('id_eleve');
        $type = $request->input('type');

        if ($type == 'scolarite') {
            $eleve = Eleve::find($id);
            if (!$eleve || $eleve->est_favorise == 'favorise') {
                return back()->withErrors(['error' => 'Élève non trouvé ou déjà favorisé']);
            }

            if ($eleve->scolarite_payee < 50000) {
                return back()->withErrors(['error' => 'L\'élève n\'a pas encore payé la première tranche']);
            }

            $eleve->est_favorise = 'favorise';
        } elseif ($type == 'cantine') {
            $eleve = cantine::find($id);
            if (!$eleve || $eleve->est_favorise_cantine == 'favorise') {
                return back()->withErrors(['error' => 'Élève non trouvé ou déjà favorisé']);
            }

            if ($eleve->deja_payee < 55000) {
                return back()->withErrors(['error' => 'L\'élève n\'a pas encore payé la première tranche']);
            }

            $eleve->est_favorise_cantine = 'favorise';
        } else {
            return back()->withErrors(['error' => 'Type de favorisation non reconnu']);
        }

        $eleve->save();

        return redirect()->route('requetes.selectType')->with('success', 'Élève favorisé ajouté avec succès');
    }


    //REQUETES JOURNALIERES

    public function journalieres()
    {
        return view('requetes.journalieres');
    }

    public function versementScolariteDuJour()
    {
        $today = Carbon::today()->toDateString();

        $eleves = Eleve::where(function ($query) use ($today) {
            for ($i = 1; $i <= 9; $i++) {
                $query->orWhereDate("date_versement$i", $today);
            }
        })->orderBy('nom')->get();

        // Calcul du total des montants payés pour le jour courant
        $total = 0;
        foreach ($eleves as $eleve) {
            for ($i = 1; $i <= 9; $i++) {
                if ($eleve["date_versement$i"] === $today) {
                    $total += $eleve["montant$i"];
                }
            }
        }

        return view('requetes.versement_scolarite_du_jour', compact('eleves', 'total'));
    }

    public function versementCantineDuJour()
    {
        $today = Carbon::today()->toDateString();

        $cantinePayments = Cantine::where(function ($query) use ($today) {
            for ($i = 1; $i <= 9; $i++) {
                $query->orWhereDate("cantine.date_versement$i", $today); // Spécifiez explicitement la table
            }
        })
            ->join('eleves', 'cantine.id_eleve', '=', 'eleves.id_eleve')
            ->orderBy('eleves.nom')
            ->select('cantine.*', 'eleves.nom', 'eleves.prenom', 'eleves.classe')
            ->get();

        // Calcul du total des montants payés pour le jour courant
        $total = 0;
        foreach ($cantinePayments as $payment) {
            for ($i = 1; $i <= 9; $i++) {
                if ($payment["date_versement$i"] === $today) {
                    $total += $payment["montant$i"];
                }
            }
        }

        return view('requetes.versement_cantine_du_jour', compact('cantinePayments', 'total'));
    }


    //REQUETES EFFECTIFS

    public function selectClasse()
    {
        return view('requetes.select_classe');
    }

    public function effectifEleves(Request $request)
    {
        $classe = $request->input('classe');

        // Ordre spécifique pour les classes
        $ordreClasses = ['maternelle1', 'maternelle2', 'maternelle3', 'cp1', 'cp2', 'ce1', 'ce2', 'cm1', 'cm2'];

        if ($classe === 'TOUTES LES CLASSES') {
            // Récupérer tous les élèves et les trier manuellement selon l'ordre des classes spécifié
            $eleves = Eleve::whereIn('classe', $ordreClasses)
                ->orderByRaw("FIELD(classe, '" . implode("','", $ordreClasses) . "')")
                ->orderBy('nom')
                ->orderBy('prenom')
                ->get();
        } else {
            // Récupérer seulement les élèves de la classe sélectionnée
            $eleves = Eleve::where('classe', $classe)
                ->orderBy('nom')
                ->orderBy('prenom')
                ->get();
        }

        // Pour chaque élève, on va chercher les paiements de cantine et transport
        foreach ($eleves as $eleve) {
            // Récupérer le total déjà payé et restant pour la cantine
            $cantine = DB::table('cantine')
                ->where('id_eleve', $eleve->id_eleve)
                ->select(DB::raw('SUM(deja_payee) as total_deja_payee'), DB::raw('SUM(montant_restant) as total_restant'))
                ->first();

                $scolarite = DB::table('eleves')
                ->where('id_eleve', $eleve->id_eleve)
                ->select(DB::raw('SUM(scolarite_payee) as total_deja_payee'), DB::raw('SUM(scolarite_restante) as total_restant'))
                ->first();

            // Récupérer le total déjà payé et restant pour le transport
            $transport = DB::table('transport')
                ->where('id_eleve', $eleve->id_eleve)
                ->select(DB::raw('SUM(deja_payee) as total_deja_payee'), DB::raw('SUM(montant_restant) as total_restant'))
                ->first();

            // Ajouter ces informations aux élèves
            $eleve->total_cantine_payee = $cantine->total_deja_payee ?? 0;
            $eleve->total_cantine_restant = $cantine->total_restant ?? 0;
            $eleve->total_transport_payee = $transport->total_deja_payee ?? 0;
            $eleve->total_transport_restant = $transport->total_restant ?? 0;
            $eleve->total_scolarite_payee = $scolarite->total_deja_payee ?? 0;
            $eleve->total_scolarite_restant = $scolarite->total_restant ?? 0;
        }

        return view('requetes.effectif_eleves', compact('eleves', 'classe'));
    }


    public function effectifCantine(Request $request)
    {
        $classe = $request->input('classe');
        $eleves = Eleve::whereIn('id_eleve', function ($query) use ($classe) {
            $query->select('id_eleve')->from('cantine');
        })->where('classe', $classe)->orderBy('nom')->orderBy('prenom')->get();

        return view('requetes.effectif_cantine', compact('eleves', 'classe'));
    }

    public function effectifNouveauxInscrits()
    {
        // Récupérer tous les élèves dont les frais d'inscription sont égaux à 25000
        $nouveauxInscrits = Eleve::where('frais_inscription', 25000)->get();

        // Calculer l'effectif total des nouveaux inscrits
        $totalNouveauxInscrits = $nouveauxInscrits->count();

        // Répartir les élèves par classe
        $repartitionParClasse = $nouveauxInscrits->groupBy('classe');

        return view('requetes.effectif_nouveaux_inscrits', compact('totalNouveauxInscrits', 'repartitionParClasse'));
    }



    //REQUETES CONTACT PARENT & STATISTIQUES

    public function showContactParentForm()
    {
        return view('requetes.contact_parent');
    }

    public function getContactParent(Request $request)
    {
        $nom = $request->input('nom');
        $eleve = Eleve::where('nom', $nom)->first();

        if ($eleve && $eleve->contactparent) {
            return view('requetes.show_contact_parent', ['contactparent' => $eleve->contactparent]);
        } else {
            return view('requetes.show_contact_parent', ['message' => 'Contact parent non trouvé ou non disponible.']);
        }
    }

    public function showStatistiquesForm()
    {
        return view('requetes.statistiques_fonds');
    }

    public function getStatistiquesFonds(Request $request)
    {
        $categorie = $request->input('categorie');
        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');
        $total = 0;

        if ($categorie == 'scolarite') {
            $total = Eleve::whereBetween('date_versement1', [$date_debut, $date_fin])->sum('montant1')
                + Eleve::whereBetween('date_versement2', [$date_debut, $date_fin])->sum('montant2')
                + Eleve::whereBetween('date_versement3', [$date_debut, $date_fin])->sum('montant3')
                + Eleve::whereBetween('date_versement4', [$date_debut, $date_fin])->sum('montant4')
                + Eleve::whereBetween('date_versement5', [$date_debut, $date_fin])->sum('montant5')
                + Eleve::whereBetween('date_versement6', [$date_debut, $date_fin])->sum('montant6')
                + Eleve::whereBetween('date_versement7', [$date_debut, $date_fin])->sum('montant7')
                + Eleve::whereBetween('date_versement9', [$date_debut, $date_fin])->sum('montant9');
        } elseif ($categorie == 'cantine') {
            $total = cantine::whereBetween('date_versement1', [$date_debut, $date_fin])->sum('montant1')
                + cantine::whereBetween('date_versement2', [$date_debut, $date_fin])->sum('montant2')
                + cantine::whereBetween('date_versement3', [$date_debut, $date_fin])->sum('montant3')
                + cantine::whereBetween('date_versement4', [$date_debut, $date_fin])->sum('montant4')
                + cantine::whereBetween('date_versement5', [$date_debut, $date_fin])->sum('montant5')
                + cantine::whereBetween('date_versement6', [$date_debut, $date_fin])->sum('montant6')
                + cantine::whereBetween('date_versement7', [$date_debut, $date_fin])->sum('montant7')
                + cantine::whereBetween('date_versement9', [$date_debut, $date_fin])->sum('montant9');
        }

        return view('requetes.show_statistiques_fonds', compact('total', 'categorie', 'date_debut', 'date_fin'));
    }



    // Formulaire pour sélectionner la date pour scolarité
    public function showDateFormScolarite()
    {
        return view('requetes.date-form-scolarite');
    }

    // Formulaire pour sélectionner la date pour cantine
    public function showDateFormCantine()
    {
        return view('requetes.date-form-cantine');
    }

    // Formulaire pour sélectionner la date pour cantine
    public function showDateFormTransport()
    {
        return view('requetes.date-form-transport');
    }

    // Résultats de scolarité pour une date donnée
    public function scolariteByDate(Request $request)
    {
        $date = $request->input('date');
        $today = Carbon::parse($date)->toDateString();

        $eleves = Eleve::where(function ($query) use ($today) {
            for ($i = 1; $i <= 8; $i++) {
                $query->orWhere("date_versement$i", $today);
            }
        })->get();

        $total = $eleves->reduce(function ($carry, $eleve) use ($today) {
            $montantVerseAujourdHui = 0;
            for ($i = 1; $i <= 8; $i++) {
                if ($eleve["date_versement$i"] === $today) {
                    $montantVerseAujourdHui = $eleve["montant$i"];
                    break;
                }
            }
            return $carry + $montantVerseAujourdHui;
        }, 0);

        return view('requetes.versement-scolarite', compact('eleves', 'total', 'date'));
    }

    // Résultats de cantine pour une date donnée
    // Résultats de cantine pour une date donnée
    // Résultats de cantine pour une date donnée
    public function cantineByDate(Request $request)
    {
        $date = $request->input('date');
        $today = Carbon::parse($date)->toDateString();

        // Requête sur la table Cantine pour récupérer les versements du jour dans les colonnes date_versement1 à date_versement8
        $versementsCantine = Cantine::where(function ($query) use ($today) {
            for ($i = 1; $i <= 8; $i++) {
                $query->orWhere("date_versement$i", $today);
            }
        })->with('eleve') // Charge les informations de l'élève associé
            ->get();

        // Requête sur la table CantineJour pour récupérer les versements du jour
        $versementsCantineJour = CantineJour::where('date_jour', $today)->get();

        // Calcul du total des montants versés aujourd'hui pour la table Cantine
        $totalCantine = $versementsCantine->reduce(function ($carry, $cantine) use ($today) {
            $montantVerseAujourdHui = 0;
            for ($i = 1; $i <= 8; $i++) {
                if ($cantine["date_versement$i"] === $today) {
                    $montantVerseAujourdHui = $cantine["montant$i"];
                    break;
                }
            }
            return $carry + $montantVerseAujourdHui;
        }, 0);

        // Calcul du total des montants versés aujourd'hui pour la table CantineJour
        $totalCantineJour = $versementsCantineJour->sum('montant');

        // Total général
        $total = $totalCantine + $totalCantineJour;

        // Retourne la vue avec les versements des deux tables et le total
        return view('requetes.versement-cantine', compact('versementsCantine', 'versementsCantineJour', 'total', 'date'));
    }


    // Résultats de transport pour une date donnée
    public function transportByDate(Request $request)
    {
        $date = $request->input('date');
        $today = Carbon::parse($date)->toDateString();

        // Requête sur la table Cantine pour récupérer les versements du jour dans les colonnes date_versement1 à date_versement8
        $versements = transport::where(function ($query) use ($today) {
            for ($i = 1; $i <= 8; $i++) {
                $query->orWhere("date_versement$i", $today);
            }
        })->with('eleve') // Charge les informations de l'élève associé
            ->get();

        // Calcul du total des montants versés aujourd'hui
        $total = $versements->reduce(function ($carry, $cantine) use ($today) {
            $montantVerseAujourdHui = 0;
            // Parcourt des colonnes date_versement1 à date_versement8
            for ($i = 1; $i <= 8; $i++) {
                if ($cantine["date_versement$i"] === $today) {
                    $montantVerseAujourdHui = $cantine["montant$i"]; // Récupère le montant correspondant
                    break;
                }
            }
            return $carry + $montantVerseAujourdHui;
        }, 0);

        // Retourne la vue avec les versements et le total
        return view('requetes.versement-transport', compact('versements', 'total', 'date'));
    }
}
