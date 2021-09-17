<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    public $table='produto';

    protected $fillable = [
        'mat_id',
        'tpp_id',
        'log_id',
        'pro_nome',
        'pro_precocusto',
        'pro_precovenda',
        'pro_promocao',
        'pro_foto_path',
        'pro_personalizacao',
        'pro_pedidominimo',
        'pro_terceirizacao',
    ];

    public function material_produto()
    {
        return $this->hasMany(Material_Base::class);
    }

    public function tipoproduto_produto()
    {
        return $this->hasMany(TipoProduto::class);
    }

    public function logistica_produto()
    {
        return $this->hasMany(Logistica::class);
    }

    public function dimensoes_produto()
    {
        return $this->hasMany(Dimensao::class);
    }


    public function produto_muitos()
    {
        return $this->belongsToMany(Estoque::class, Venda::class, CorProduto::class, DimensaoProduto::class);
    }

}

