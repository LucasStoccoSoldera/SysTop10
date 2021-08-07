<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_Base extends Model
{
    use HasFactory;
    public $table='material';

    protected $fillable = [
        'mat_descricao',

    ];
}
