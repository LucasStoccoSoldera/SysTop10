<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorProduto extends Model
{
    use HasFactory;
    public $table='cor_produto';

    protected $fillable = [
        'pro_id'
    ];

    public function cor_produto_produto()
    {
        return $this->hasMany(Produto::class);
    }
}
