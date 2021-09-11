<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    use HasFactory;
    public $table='tipoproduto';

    protected $fillable = [
        'tpp_descricao',

    ];

    public function  tipoproduto_produto()
    {
        return $this->belongsToOne(Produto::class);
    }
}
