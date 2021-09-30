<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;
    public $table='estoque';

    protected $fillable = [
        'pro_id',
        'dim_id',
        'cor_id',
        'est_status',
        'est_data',
        'est_time',
        'est_limite',
    ];

    public function dimensoes_estoque()
    {
        return $this->hasMany(Dimensao::class);
    }

    public function cores_estoque()
    {
        return $this->hasMany(Cor::class);
    }

    public function estoque_produto()
    {
        return $this->hasMany(Produto::class);
    }
}

