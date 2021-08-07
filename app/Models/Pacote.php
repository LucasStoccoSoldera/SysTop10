<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacote extends Model
{
    use HasFactory;
    public $table='pacote';

    protected $fillable = [
        'pac_descricao',
        'pac_dimensao',
    ];
}

