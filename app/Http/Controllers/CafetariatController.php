<?php

// CafetariatController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cafetariat;
use Carbon\Carbon;

class CafetariatController extends Controller
{
    public function showMenu()
    {
        return view('cafetariat.menu');
    }

    public function showForm()
    {
        $classes = ['maternelle1', 'maternelle2', 'maternelle3', 'cp1', 'cp2', 'ce1', 'ce2', 'cm1', 'cm2','PERSONNEL'];
        return view('cafetariat.form', compact('classes'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'classe' => 'required|string|max:255',
            'montant' => 'required|numeric',
            'type_paiement' => 'required|string',
            'date' => $request->type_paiement === 'jour' ? 'required|date' : 'nullable|date',
            'date_debut' => $request->type_paiement === 'semaine' ? 'required|date' : 'nullable|date',
            'date_fin' => $request->type_paiement === 'semaine' ? 'required|date' : 'nullable|date',
        ]);
    
        $cafetariat = new Cafetariat();
        $cafetariat->nom = $validatedData['nom'];
        $cafetariat->classe = $validatedData['classe'];
        $cafetariat->montant = $validatedData['montant'];
        $cafetariat->type_paiement = $validatedData['type_paiement'];
    
        if ($validatedData['type_paiement'] == 'jour') {
            $cafetariat->date = $validatedData['date'];
        } else if ($validatedData['type_paiement'] == 'semaine') {
            $cafetariat->date_debut = $validatedData['date_debut'];
            $cafetariat->date_fin = $validatedData['date_fin'];
        }
    
        $cafetariat->save();
    
        return redirect()->route('cafetariat.success', ['id' => $cafetariat->id]);
    }
    


    public function showSuccess($id)
    {
        $cafetariat = Cafetariat::findOrFail($id);
        return view('cafetariat.success', compact('cafetariat'));
    }

    public function generateReceipt($id)
    {
        $cafetariat = Cafetariat::findOrFail($id);

        // Vérifier le type de paiement et ajuster les données en conséquence
        $isSemaine = $cafetariat->type_paiement === 'semaine';

        return view('cafetariat.receipt', compact('cafetariat', 'isSemaine'));
    }


    public function recettesJour()
    {
        // Récupérer la date actuelle
        $aujourdhui = Carbon::now()->toDateString();

        // Récupérer les enregistrements où 'date' ou 'date_debut' correspond à la date actuelle
        $enregistrements = Cafetariat::where(function ($query) use ($aujourdhui) {
            $query->whereDate('date', $aujourdhui)
                ->orWhereDate('date_debut', $aujourdhui);
        })->get();

        // Grouper les enregistrements par classe
        $enregistrementsParClasse = $enregistrements->groupBy('classe');

        // Calculer le total par classe et le total général
        $totauxParClasse = $enregistrementsParClasse->map(function ($enregistrements, $classe) {
            return $enregistrements->sum('montant');
        });

        $totalGeneral = $totauxParClasse->sum();

        return view('cafetariat.recettes-jour', compact('enregistrementsParClasse', 'totauxParClasse', 'totalGeneral'));
    }


    public function showPeriodForm()
    {
        return view('cafetariat.period_form');
    }

    public function getPeriodRecettes(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date'])->endOfDay();

        $recettes = Cafetariat::whereBetween('created_at', [$startDate, $endDate])->get();
        $total = $recettes->sum('montant');

        return view('cafetariat.period_result', compact('recettes', 'total', 'startDate', 'endDate'));
    }


    public function abonnesJour()
    {
        $aujourdhui = Carbon::now()->toDateString();

        // Récupérer les enregistrements qui ont la date du jour ou qui sont dans l'intervalle de date pour le type semaine
        $abonnesJour = Cafetariat::where(function ($query) use ($aujourdhui) {
            $query->where('type_paiement', 'jour')
                ->whereDate('date', $aujourdhui);
        })->orWhere(function ($query) use ($aujourdhui) {
            $query->where('type_paiement', 'semaine')
                ->whereDate('date_debut', '<=', $aujourdhui)
                ->whereDate('date_fin', '>=', $aujourdhui);
        })->get();

        // Grouper les enregistrements par classe
        $abonnesParClasse = $abonnesJour->groupBy('classe');

        return view('cafetariat.abonnesJour', compact('abonnesParClasse', 'aujourdhui'));
    }
}
