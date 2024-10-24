<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recu extends Model
{
    protected $table = 'recu';

    protected $primaryKey = 'id';
    // Autres propriétés et méthodes de votre modèle
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        
        'vente_id',
        'nom_acheteur',
        'macarons',
        'tshirts',
        'tissu_bleu',
        'tissu_jaune',
        'total'
        
    ];
}
