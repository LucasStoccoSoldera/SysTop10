<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    use HasFactory;
    public $table='caixa';

    protected $fillable = [
        'cax_descricao',
        'cax_operacao',
        'cax_valor',
        'cax_ctpagar',
        'cax_ctreceber',
    ];
    protected $casts = [
        'cax_data' => 'datetime',
    ];
}
