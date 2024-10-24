<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Decaissement;
use Carbon\Carbon;

class DecaissementsController extends Controller
{
    //
    public function index()
    {
        return view('decaissements.index');
    }

    public function create()
    {
        return view('decaissements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_decaissier' => 'required|string|max:255',
            'nom_beneficiaire' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'libelle' => 'required|string',
            'date' => 'nullable|date',
            'montant' => 'required|numeric|min:0',
            'preuve' => 'nullable|image|max:2048',
        ]);

        $numero_decaissement = 'DEC-' . strtoupper(uniqid());

        $decaissement = new Decaissement();
        $decaissement->numero_decaissement = $numero_decaissement;
        $decaissement->nom_decaissier = $request->nom_decaissier;
        $decaissement->nom_beneficiaire = $request->nom_beneficiaire;
        $decaissement->type = $request->type;
        $decaissement->libelle = $request->libelle;
        $decaissement->date = $request->date ?? now();
        $decaissement->montant = $request->montant;

        if ($request->hasFile('preuve')) {
            $path = $request->file('preuve')->store('preuves');
            $decaissement->preuve = $path;
        }

        $decaissement->save();

        return redirect()->route('decaissements.success', $decaissement->id)->with('success', 'Décaissement enregistré avec succès.');
    }

    public function success($id)
    {
        $decaissement = Decaissement::findOrFail($id);
        return view('decaissements.success', compact('decaissement'));
    }

    public function show($id)
    {
        $decaissement = Decaissement::findOrFail($id);
        return view('decaissements.show', compact('decaissement'));
    }

    public function decaissementsDuJour()
    {
        $today = now()->format('Y-m-d');
        $decaissements = Decaissement::whereDate('date', $today)->get();
        $totalMontant = $decaissements->sum('montant');

        return view('decaissements.jour', compact('decaissements', 'totalMontant'));
    }


    public function showPeriodForm()
    {
        return view('decaissements.periodiques');
    }

    public function listPeriodDecaissements(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

        $decaissements = Decaissement::whereBetween('date', [$startDate, $endDate])->get();
        $totalMontant = $decaissements->sum('montant');

        return view('decaissements.resultats', compact('decaissements', 'totalMontant', 'startDate', 'endDate'));
    }


    public function showSearchForm()
    {
        return view('decaissements.rechercher');
    }

    public function searchDecaissements(Request $request)
    {
        $query = Decaissement::query();

        if ($request->filled('nom_decaissier')) {
            $query->where('nom_decaissier', 'like', '%' . $request->input('nom_decaissier') . '%');
        }

        if ($request->filled('nom_beneficiaire')) {
            $query->where('nom_beneficiaire', 'like', '%' . $request->input('nom_beneficiaire') . '%');
        }

        if ($request->filled('numero_decaissement')) {
            $query->where('numero_decaissement', 'like', '%' . $request->input('numero_decaissement') . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->input('type') . '%');
        }

        $decaissements = $query->get();
        $totalMontant = $decaissements->sum('montant');

        return view('decaissements.resultats_recherche', compact('decaissements', 'totalMontant'));
    }




    //decaissement du jour modifiée
    // Afficher le formulaire pour rechercher les décaissements d'une date donnée
    public function showByDateForm()
    {
        return view('decaissements.jour');
    }

    // Rechercher les décaissements du jour en fonction de la date saisie
    public function searchByDate(Request $request)
    {
        $date = $request->input('date');

        // Récupérer les décaissements pour cette date
        $decaissements = Decaissement::whereDate('date', $date)->get();

        // Calculer le total des montants
        $totalMontant = $decaissements->sum('montant');

        return view('decaissements.jour', compact('decaissements', 'totalMontant'));
    }

    // Supprimer un décaissement
    public function destroy($id)
    {
        $decaissement = Decaissement::findOrFail($id);
        $decaissement->delete();

        return redirect()->back()->with('success', 'Décaissement supprimé avec succès.');
    }
}
