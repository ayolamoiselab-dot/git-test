<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Stock;
use App\Models\Recu;

class VentesController extends Controller
{
    public function index()
    {
        return view('ventes.pageventes');
    }

  /*  public function ventesDuJour()
    {
        // Récupérer toutes les ventes du jour en se basant sur la colonne 'date_enregistrement'
        $ventes = Vente::whereDate('date_enregistrement', now()->toDateString())->get();

        // Calculer les totaux pour chaque produit et le total général
        $totalMacarons = $ventes->sum('macarons');
        $totalTshirts = $ventes->sum('tshirts');
        $totalTissuBleu = $ventes->sum('tissu_bleu');
        $totalTissuJaune = $ventes->sum('tissu_jaune');
        $totalGeneral = $ventes->sum('total');

        // Retourner la vue avec les données compactées
        return view('ventes.jour', compact('ventes', 'totalMacarons', 'totalTshirts', 'totalTissuBleu', 'totalTissuJaune', 'totalGeneral'));
    }*/


    public function create()
    {
        return view('ventes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_acheteur' => 'required|string|max:255',
            'macarons' => 'required|integer|min:0',
            'tshirts' => 'required|integer|min:0',
            'tissu_bleu' => 'required|numeric|min:0',
            'tissu_jaune' => 'required|numeric|min:0',
            'date_enregistrement' => 'nullable|date',
        ]);

        $vente = new Vente();
        $vente->nom_acheteur = $request->nom_acheteur;
        $vente->macarons = $request->macarons;
        $vente->tshirts = $request->tshirts;
        $vente->tissu_bleu = $request->tissu_bleu;
        $vente->tissu_jaune = $request->tissu_jaune;
        $vente->total = ($request->macarons * 500) + ($request->tshirts * 2500) + ($request->tissu_bleu * 2500) + ($request->tissu_jaune * 2500);
        // Affecter la date d'enregistrement ou la date du jour si non renseignée
        $vente->date_enregistrement = $request->date_enregistrement ?? now();
        $vente->save();

        // Mise à jour du stock
        $this->updateStock('Macarons', $request->macarons);
        $this->updateStock('T-Shirts', $request->tshirts);
        $this->updateStock('Tissu Bleu', $request->tissu_bleu);
        $this->updateStock('Tissu Jaune', $request->tissu_jaune);

        // Création du reçu
        $recu = new Recu();
        $recu->vente_id = $vente->id;
        $recu->nom_acheteur = $vente->nom_acheteur;
        $recu->macarons = $vente->macarons;
        $recu->tshirts = $vente->tshirts;
        $recu->tissu_bleu = $vente->tissu_bleu;
        $recu->tissu_jaune = $vente->tissu_jaune;
        $recu->total = $vente->total;
        $recu->save();

        return view('ventes.choisir-date')->with('success', 'Vente enregistrée avec succès.');
    }

    private function updateStock($produit, $quantite_vendue)
    {
        $stock = Stock::where('produit', $produit)->first();
        if ($stock) {
            $stock->quantite_restante -= $quantite_vendue;
            $stock->save();
        }
    }

    public function generateReceipt($id)
    {
        $vente = Vente::findOrFail($id);
        $recu = Recu::where('vente_id', $id)->first();

        $data = [
            'logo' => asset('img/logopoussi_preview_rev_1.png'),
            'numero_recu' => 'REC' . str_pad($recu->id, 5, '0', STR_PAD_LEFT),
            'nom_acheteur' => $vente->nom_acheteur,
            'details' => [
                'macarons' => $vente->macarons,
                'tshirts' => $vente->tshirts,
                'tissu_bleu' => $vente->tissu_bleu,
                'tissu_jaune' => $vente->tissu_jaune,
            ],
            'total' => $vente->total,
            'date_enregistrement' => $vente->created_at->format('d/m/Y'),
            'signature' => 'Signature de l\'administrateur',
        ];

        return view('ventes.recu', $data);
    }

    public function destroy($id)
    {
        // Trouver la vente
        $vente = Vente::findOrFail($id);

        // Supprimer tous les reçus associés à cette vente
        $vente->recus()->delete();

        // Supprimer la vente
        $vente->delete();

        return redirect()->route('ventes.jour')->with('success', 'Vente et reçus associés supprimés avec succès.');
    }





    //vente du jour modifiee
    public function showDateForm()
    {
        return view('ventes.choisir-date');
    }

    public function ventesDuJour(Request $request)
    {
        $date = $request->input('date');

        // Récupérer toutes les ventes correspondant à la date choisie
        $ventes = Vente::whereDate('created_at', $date)->get();

        // Calculer les totaux pour chaque produit et le total général
        $totalMacarons = $ventes->sum('macarons');
        $totalTshirts = $ventes->sum('tshirts');
        $totalTissuBleu = $ventes->sum('tissu_bleu');
        $totalTissuJaune = $ventes->sum('tissu_jaune');
        $totalGeneral = $ventes->sum('total');

        return view('ventes.resultats-ventes', [
            'ventes' => $ventes,
            'date' => $date,
            'totalMacarons' => $totalMacarons,
            'totalTshirts' => $totalTshirts,
            'totalTissuBleu' => $totalTissuBleu,
            'totalTissuJaune' => $totalTissuJaune,
            'totalGeneral' => $totalGeneral,
        ]);
    }
}
