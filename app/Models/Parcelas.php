<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcelas extends Model
{
    use HasFactory;
    public $table='parcelas';

    protected $fillable = [
        'tpg_id',
        'par_venda',
        'par_conta',
        'par_numero',
        'par_valor',
        'par_status',
        'par_data_pagto',
    ];

    protected $dates = [
        'par_data_pagto',
    ];

    public function tipopagto_parcelas()
    {
        return $this->hasMany(TipoPagto::class);
    }
}
