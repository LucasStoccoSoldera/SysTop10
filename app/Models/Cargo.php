<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    public $table='cargo';

    protected $fillable = [
        'car_descricao',
        'pri_id',
    ];

    public function privilegio_cargo()
    {
        return $this->hasMany(Privilegio::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class,  'car_id', 'id');
    }
}
