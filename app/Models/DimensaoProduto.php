<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimensaoProduto extends Model
{
    use HasFactory;
    public $table='dimensao_produto';

    public function dimensao_produto_produto()
    {
        return $this->hasMany(Produto::class);
    }
}
