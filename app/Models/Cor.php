<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    use HasFactory;
    public $table='cores';

    protected $fillable = [
        'cor_nome',
        'cor_hex_especial',
    ];

    public function cor_muitos()
    {
        return $this->belongsToMany(Estoque::class, Produto::class, Venda::class);
    }
}

