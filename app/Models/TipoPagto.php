<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagto extends Model
{
    use HasFactory;
    public $table='tipopagto';

    protected $fillable = [
        'tpg_descricao',
    ];

    public function tipopagto_muitos()
    {
        return $this->belongsToMany(Compras::class, Contas_a_Pagar::class, Contas_a_Receber::class, Venda::class, Parcelas::class);
    }
}
