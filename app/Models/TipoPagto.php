<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagto extends Model
{
    use HasFactory;
    public $table='tipopagto';

    protected $fillable = [
        'tpg_descricao',
    ];
}
