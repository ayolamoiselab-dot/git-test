<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $table = 'ventes';
    use HasFactory;

    protected $fillable = [
        'nom_acheteur',
        'nombre_maccarons',
        'nombre_tshirts',
        'metres_tissu_bleu',
        'metres_tissu_jaune',
        'total_paye'
    ];


    public function recus()
{
    return $this->hasMany(Recu::class);
}
}
