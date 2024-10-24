<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CantineJournaliere extends Model
{
    protected $table = 'cantine_journaliere';
    protected $fillable = ['id_eleve', 'frais_annuels', 'montant_total_verse', 'montant_restant', 'statut'];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'id_eleve');
    }

    public function paiements()
    {
        return $this->hasMany(PaiementsJournaliers::class, 'id_cantine_journaliere');
    }
}
