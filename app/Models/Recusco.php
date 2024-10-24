<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recusco extends Model
{
    protected $table = 'recusco';

    protected $primaryKey = 'id';
    // Autres propriétés et méthodes de votre modèle
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'id',
        'id_eleve',
        'type',
        'montant_verse',
        'mntant_restant',
        'statut'
        
    ];

}
