<?php

// App\Models\Cafetariat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafetariat extends Model
{
    protected $table = 'cafetariat';
    protected $primaryKey = 'id';
    use HasFactory;

    protected $fillable = [
        'nom',
        'classe',
        'date',
        'montant',
    ];
}

