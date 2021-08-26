<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportadora extends Model
{
    use HasFactory;
    public $table='transportadora';

    protected $fillable = [
        'trans_nome',
        'trans_telefone',
        'trans_celular',
        'trans_limite_transporte',
    ];
}
