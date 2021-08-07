<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistica extends Model
{
    use HasFactory;
    public $table='caixa';

    protected $fillable = [
        'pac_id',
        'trans_id',
    ];
}

