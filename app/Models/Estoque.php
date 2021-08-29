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
        'est_qtde',
        'est_status',
        'est_limite',
    ];
}

