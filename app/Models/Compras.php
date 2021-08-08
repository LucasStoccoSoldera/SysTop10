<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;
    public $table='compra';

    protected $fillable = [
        'cde_id',
        'tpg_id',
        'cc_id',
        'com_data_compra',
        'com_data_pagto',
        'com_valor',
        'com_qtde',
        'com_desconto',
        'com_observacoes',
        'com_parcelas',
    ];
}

