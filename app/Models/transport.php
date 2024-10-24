<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transport extends Model
{
    protected $table = 'transport';

    protected $primaryKey = 'id_transport';
    // Autres propriétés et méthodes de votre modèle
    use HasFactory;

    public function eleve()
{
    return $this->belongsTo(Eleve::class, 'id_eleve');
}


}
