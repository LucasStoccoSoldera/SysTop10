<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contas_a_Pagar extends Model
{
    use HasFactory;
    public $table='contas_a_pagar';

    protected $fillable = [
        'tpg_id',
        'cc_id',
        'con_descricao',
        'con_tipo',
        'con_valor',
        'con_valor_final',
        'con_data_venc',
        'con_parcelas',
        'con_data_pag',
        'con_status',
        'con_compra',
    ];

    protected $dates = [
        'con_data_pag',
    ];

    public function tipopagto_contas_a_pagar()
    {
        return $this->hasMany(TipoPagto::class);
    }

    public function centro_custo_contas_a_pagar()
    {
        return $this->hasMany(Centro_Custo::class);
    }
}

