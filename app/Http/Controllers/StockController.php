<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Vente;

class StockController extends Controller
{
    // Affiche le formulaire pour ajouter du stock
    public function showAddStockForm()
    {
        $produits = ['macarons', 'tshirts', 'tissu_bleu', 'tissu_jaune'];
        return view('stocks.add', compact('produits'));
    }

    // Ajoute du stock
    public function addStock(Request $request)
    {
        $produits = ['macarons', 'tshirts', 'tissu_bleu', 'tissu_jaune'];
        foreach ($produits as $produit) {
            $quantite = $request->input($produit, 0);
            if ($quantite >= 0) {
                Stock::create([
                    'produit' => $produit,
                    'quantite_ajoutee' => $quantite
                ]);
            }
        }
        return redirect()->route('showAddStockForm')->with('success', 'Stock ajouté avec succès');
    }

    // Affiche les quantités restantes
    public function showRemainingQuantities()
    {
        $produits = [
            'macarons' => 'macarons',
            'tshirts' => 'tshirts',
            'tissu_bleu' => 'tissu_bleu',
            'tissu_jaune' => 'tissu_jaune'
        ];

        $quantites_restantes = [];

        foreach ($produits as $produit => $colonne) {
            $quantite_ajoutee = Stock::where('produit', $produit)->sum('quantite_ajoutee');
            $quantite_vendue = Vente::sum($colonne);
            $quantites_restantes[$produit] = $quantite_ajoutee - $quantite_vendue;
        }

        return view('stocks.remaining', compact('quantites_restantes'));
    
    }


    
}
