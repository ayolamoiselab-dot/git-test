<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class informatique extends Model
{
    protected $table = 'informatique';

    protected $primaryKey = 'id_info';
    use HasFactory;
}
