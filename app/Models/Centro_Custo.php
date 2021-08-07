<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro_Custo extends Model
{
    use HasFactory;
    public $table='centro_custo';

    protected $fillable = [
        'cc_descricao',
    ];
}

