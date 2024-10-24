<?php

// app/Models/CantineJour.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CantineJour extends Model
{
    use HasFactory;

    protected $table = 'cantine_jour';

    protected $fillable = [
        'nom', 
        'prenom', 
        'classe', 
        'type_paiement', 
        'montant', 
        'date_jour', 
        'date_debut', 
        'date_fin'
    ];
}

