<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras_Detalhe extends Model
{
    use HasFactory;
    public $table='compras_detalhe';

    protected $fillable = [
        'com_id',
        'for_id',
        'cde_produto',
        'cde_qtde',
        'cde_valoritem',
        'cde_valortotal',
        'cde_descricao',
    ];
}

