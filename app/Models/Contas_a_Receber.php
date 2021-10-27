<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contas_a_Receber extends Model
{
    use HasFactory;
    public $table='contas_a_receber';

    protected $fillable = [
        'tpg_id',
        'rec_descricao',
        'rec_ven_id',
        'rec_valor',
        'rec_valor_final',
        'rec_parcelas',
        'rec_status',
        'rec_data',
    ];

    public function tipopagto_contas_a_receber()
    {
        return $this->hasMany(TipoPagto::class);
    }
}
