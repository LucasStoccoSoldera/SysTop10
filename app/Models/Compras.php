<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;
    public $table='compra';

    protected $fillable = [
        'tpg_id',
        'cc_id',
        'com_data_compra',
        'com_data_pagto',
        'com_valor',
        'com_desconto',
        'com_descricao',
        'com_observacoes',
        'com_parcelas',
    ];

    public function tipopagto_compra()
    {
        return $this->hasMany(TipoPagto::class);
    }

    public function centro_custo_compra()
    {
        return $this->hasMany(Centro_Custo::class);
    }


    public function compra_itemcompra()
    {
        return $this->belongsToOne(Compras_Detalhe::class);
    }
}

