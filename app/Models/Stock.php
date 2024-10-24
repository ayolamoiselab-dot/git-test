<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'produit',
        'quantite_ajoutee',
        'quantite_restante'
    ];
}
