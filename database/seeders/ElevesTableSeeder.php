<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eleve;

class ElevesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Eleve::create([
            'nom' => 'Dupont',
            'prenom' => 'Dupont',
            'niveau' => 'primaire',
            'sexe' => 'homme',
            'classe' => 'CP1',
            'contactparent' => '9000000',
            'frais_inscription' => '0',
            'scolarite_total' => 50000,
            'scolarite_payee' => 30000,
            'scolarite_restante' => 20000,
            'methode_paiement' => 'trimestrielle',
            'date_versement1' => '2024-01-10',
            'montant1' => 15000,
            'date_versement2' => '2024-02-15',
            'montant2' => 15000,
        ]);

        Eleve::create([
            'nom' => 'Martin',
            'prenom' => 'Dupont',
            'niveau' => 'primaire',
            'sexe' => 'homme',
            'contactparent' => '9000000',
            'frais_inscription' => '0',
            'classe' => 'CE2',
            'scolarite_total' => 60000,
            'scolarite_payee' => 40000,
            'scolarite_restante' => 20000,
            'methode_paiement' => 'mensuelle',
            'date_versement1' => '2024-01-10',
            'montant1' => 10000,
            'date_versement2' => '2024-02-10',
            'montant2' => 10000,
            'date_versement3' => '2024-03-10',
            'montant3' => 10000,
            
        ]);
    }
}
