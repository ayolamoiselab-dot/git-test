<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaiementsJournaliers extends Model
{
    protected $table = 'paiements_journaliers';
    protected $fillable = ['id_cantine_journaliere', 'montant', 'date_versement'];

    public function cantineJournaliere()
    {
        return $this->belongsTo(CantineJournaliere::class, 'id_cantine_journaliere');
    }
}
