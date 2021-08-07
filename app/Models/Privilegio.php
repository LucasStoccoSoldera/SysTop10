<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilegio extends Model
{
    use HasFactory;
    public $table='privilegio';

    protected $fillable = [
        'pri_usuarios',
        'pri_clientes',
        'pri_financeiro',
        'pri_produtos',
        'pri_estoque',
        'pri_fornecedores',
        'pri_detalhes',
        'pri_logistica',
    ];
}

