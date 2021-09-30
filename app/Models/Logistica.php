<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistica extends Model
{
    use HasFactory;
    public $table='logistica';

    protected $fillable = [
        'pac_id',
        'trans_id',
    ];

    public function transportadora_logistica()
    {
        return $this->hasMany(Transportadora::class, 'pac_id');
    }

    public function pacote_logistica()
    {
        return $this->hasMany(Pacote::class, 'trans_id');
    }

    public function logistica_produto()
    {
       // return $this->belongsToOne(Produto::class);
    }
}

