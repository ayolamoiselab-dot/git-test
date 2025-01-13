<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    protected $table = 'eleves';

    protected $primaryKey = 'id_eleve';
    // Autres propriétés et méthodes de votre modèle
    use HasFactory;

    public function dernierVersementDate()
    {
        for ($i = 8; $i >= 1; $i--) {
            $dateField = "date_versement$i";
            if (!empty($this->$dateField)) {
                return $this->$dateField;
            }
        }
        return null;
    }

    public function dernierVersementMontant()
    {
        for ($i = 8; $i >= 1; $i--) {
            $montantField = "montant$i";
            if (!empty($this->$montantField)) {
                return $this->$montantField;
            }
        }
        return null;
    }


    protected $fillable = [
        'nom',
        'classe',
        'scolarite_total',
        'scolarite_payee',
        'scolarite_restante',
        'methode_paiement',
        'est_favorise',
        'date_versement1',
        'montant1',
        'date_versement2',
        'montant2',
        'date_versement3',
        'montant3',
        'date_versement4',
        'montant4',
        'date_versement5',
        'montant5',
        'date_versement6',
        'montant6',
        'date_versement7',
        'montant7',
        'date_versement8',
        'montant8',
        'dernier_versement_date',
        'dernier_versement_montant',
        'reduction_fcfa',
        'reduction_pourcentage',
    ];

    public function cantineJournaliere()
    {
        return $this->hasOne(CantineJournaliere::class, 'id_eleve', 'id_eleve');
    }
    

    // Dans le modèle Eleve (app/Models/Eleve.php)

public function cantine()
{
    return $this->belongsTo(Cantine::class,'id_eleve');
}

    
}
