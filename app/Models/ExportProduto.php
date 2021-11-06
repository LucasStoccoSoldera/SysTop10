<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportProduto extends Model
{
    use HasFactory;
    public $table='export_produto';

    protected $fillable = [
        'pro_id',
        'mat_id',
        'tpp_id',
        'log_id',
        'pro_nome',
        'pro_precocusto',
        'pro_precovenda',
        'pro_promocao',
        'pro_foto_path',
        'pro_personalizacao',
        'pro_pedidominimo',
        'pro_terceirizacao',
        'pro_cor',
        'pro_cor_referencia',
        'pro_dimensao',
    ];
}
