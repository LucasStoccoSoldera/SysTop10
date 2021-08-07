<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda_Detalhe extends Model
{
    use HasFactory;
    public $table='vendas_detalhe';

    protected $fillable = [
        'cor_id',
        'dim_id',
        'pro_id',
        'ven_id',
        'det_qtde',
        'det_descricao',
        'det_anexo_path',
        'det_valor_unitario',
        'det_valor_total',
    ];
}

