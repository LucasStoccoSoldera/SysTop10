<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    use HasFactory;
    public $table='tipoproduto';

    protected $fillable = [
        'id',
        'tpp_descricao',

    ];

    public function  tipoproduto_produto()
    {
        return $this->belongsTo(Produto::class, 'tpp_id', 'id');
    }
}
