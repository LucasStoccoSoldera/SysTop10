<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    use HasFactory;
    public $table='fornecedor';

    protected $fillable = [
        'for_nome',
        'for_estado',
        'for_cidade',
        'for_bairro',
        'for_rua',
        'for_numero',
        'for_produto',
        'for_telefone',
        'for_celular',
        'for_cpf_cnpj',
        'for_cep',
    ];

    public function fornecedor_itemcompra()
    {
        return $this->belongsToOne(Compras_Detalhe::class);
    }
}

