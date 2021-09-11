<?php namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['usu_nome_completo', 'usu_usuario', 'usu_celular', 'usu_cpf', 'car_id','usu_status'];
    protected $hidden = ['usu_senha'];
    protected $primaryKey = 'id';
    protected $table = "usuario";

    public function cargo_user()
    {
        return $this->hasMany(Cargo::class);
    }

}

