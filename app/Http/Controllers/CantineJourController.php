<?php

// app/Http/Controllers/CantineJourController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CantineJour;

class CantineJourController extends Controller
{
    public function showForm()
    {
        return view('cantine_jour_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'classe' => 'required|string|max:255',
            'type_paiement' => 'required|in:jour,semaine',
            'montant' => 'required|numeric|min:0',
        ]);

        // En fonction du type de paiement, on remplit les champs de dates
        if ($request->type_paiement == 'jour') {
            $date_jour = now(); // Date du jour pour le paiement journalier
            CantineJour::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'classe' => $request->classe,
                'type_paiement' => $request->type_paiement,
                'montant' => $request->montant,
                'date_jour' => $date_jour,
            ]);
        } elseif ($request->type_paiement == 'semaine') {
            $request->validate([
                'date_debut' => 'required|date',
                'date_fin' => 'required|date|after_or_equal:date_debut',
            ]);

            CantineJour::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'classe' => $request->classe,
                'type_paiement' => $request->type_paiement,
                'montant' => $request->montant,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
            ]);
        }

        // Générer un reçu
        return redirect()->route('cantine_jour.receipt', ['id' => CantineJour::latest()->first()->id]);
    }

    public function generateReceipt($id)
    {
        $decaissement = CantineJour::findOrFail($id);

        return view('cantine_jour_receipt', compact('decaissement'));
    }
}
