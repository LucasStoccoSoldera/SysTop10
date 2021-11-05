<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    public $table='vendas';

    protected $fillable = [
        'tpg_id',
        'log_id',
        'cli_id',
        'ven_status',
        'ven_desconto',
        'ven_parcelas',
        'ven_data_pagto',
    ];

    protected $dates = [
        'ven_data_pagto',
    ];

    public function tipopagto_venda()
    {
        return $this->hasMany(TipoPagto::class);
    }

    public function logistica_venda()
    {
        return $this->hasMany(Logistica::class);
    }

    public function cliente_venda()
    {
        return $this->hasMany(Cliente::class);
    }

    public function venda_itemvenda()
    {
        return $this->belongsToOne(Venda_Detalhe::class);
    }
}

