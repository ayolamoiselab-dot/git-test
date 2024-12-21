<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\Cantine;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Vérifie le rôle de l'utilisateur
        $user = auth()->user();

        // Date actuelle (serveur)
        $today = Carbon::now()->toDateString();

        // Données pour le tableau de bord
        $totalEleves = Eleve::count();
        $totalScolarite = Eleve::sum('scolarite_payee');
        $totalCantine = Cantine::sum('deja_payee');

        // Calcul des montants encaissés aujourd'hui (scolarité)
        $scolariteToday = 0;
        foreach (Eleve::all() as $eleve) {
            for ($i = 1; $i <= 9; $i++) {
                $dateField = "date_versement$i";
                $montantField = "montant$i";

                if ($eleve->$dateField === $today) {
                    $scolariteToday += $eleve->$montantField;
                }
            }
        }

        // Calcul des montants encaissés aujourd'hui (cantine)
        $cantineToday = 0;
        foreach (Cantine::all() as $cantine) {
            for ($i = 1; $i <= 9; $i++) {
                $dateField = "date_versement$i";
                $montantField = "montant$i";

                if ($cantine->$dateField === $today) {
                    $cantineToday += $cantine->$montantField;
                }
            }
        }

        // Préparer les données pour le graphique "Scolarité"
        $scolariteParMois = $this->calculerMontantsParMois(Eleve::all(), 'montant', 'date_versement');
        // Préparer les données pour le graphique "Cantine"
        $cantineParMois = $this->calculerMontantsParMois(Cantine::all(), 'montant', 'date_versement');
        //dd($scolariteParMois, $cantineParMois);
        // Retourne la vue principale avec les données
        return view('menusgestion.listmenus', [
            'totalEleves' => $totalEleves,
            'totalScolarite' => $totalScolarite,
            'totalCantine' => $totalCantine,
            'scolariteToday' => $scolariteToday,
            'cantineToday' => $cantineToday,
            'scolariteParMois' => $scolariteParMois,
            'cantineParMois' => $cantineParMois,
            'scolariteData' => json_encode(array_values($scolariteParMois)),
            'cantineData' => json_encode(array_values($cantineParMois)),
            'user' => $user
        ]);
    }


    private function calculerMontantsParMois($records, $montantPrefix, $datePrefix, $maxVersements = 9)
    {
        $montantsParMois = [];

        foreach ($records as $record) {
            for ($i = 1; $i <= $maxVersements; $i++) {
                $montantField = $montantPrefix . $i;
                $dateField = $datePrefix . $i;

                if (!empty($record->$montantField) && !empty($record->$dateField)) {
                    $date = \Carbon\Carbon::parse($record->$dateField);
                    $moisAnnee = $date->format('Y-m'); // Format : "2024-12"

                    if (!isset($montantsParMois[$moisAnnee])) {
                        $montantsParMois[$moisAnnee] = 0;
                    }

                    $montantsParMois[$moisAnnee] += $record->$montantField;
                }
            }
        }

        ksort($montantsParMois); // Tri par mois/année
        return $montantsParMois;
    }
}
