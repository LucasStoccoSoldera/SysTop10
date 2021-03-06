<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimensao extends Model
{
    use HasFactory;
    public $table='dimensoes';

    protected $fillable = [
        'dim_descricao',

    ];

    public function dimensao_muitos()
    {
        return $this->belongsTo(Estoque::class, 'dim_id', 'id');
    }

}

