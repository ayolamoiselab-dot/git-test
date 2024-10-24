<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decaissement extends Model
{
    protected $table = 'decaissements';
    use HasFactory;

    protected $dates = ['date'];
}
