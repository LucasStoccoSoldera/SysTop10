<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    use HasFactory;
    public $table='notificacao';

    protected $fillable = [
        'not_tipo',
        'not_descricao',
    ];

    public function cargo_notificacao()
    {
        return $this->hasMany(Cargo::class);
    }
}
