<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cantine extends Model
{
    protected $table = 'cantine';

    protected $primaryKey = 'id_cantine';
    // Autres propriétés et méthodes de votre modèle
    use HasFactory;

    public function eleve()
    {
        return $this->belongsTo(Eleve::class,'id_eleve', 'id_eleve');
    }
    
}
