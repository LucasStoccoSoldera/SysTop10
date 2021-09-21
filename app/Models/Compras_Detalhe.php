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
        'dim_id',
        'cor_id',
        'cde_produto',
        'cde_qtde',
        'cde_valoritem',
        'cde_valortotal',
        'cde_descricao',
    ];

    public function compra_itemcompra()
    {
        return $this->hasMany(Compras::class);
    }

    public function fornecedor_itemcompra()
    {
        return $this->hasMany(Fornecedores::class);
    }
}

