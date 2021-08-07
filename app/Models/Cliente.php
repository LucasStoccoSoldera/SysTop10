<?php namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['cli_nome', 'cli_usuario', 'cli_cpf', 'cli_cnpj', 'cli_telefone', 'cli_celular','cli_logradouro', 'cli_bairro', 'cli_n_casa', 'cli_cidade', 'cli_uf', 'cli_complemento',];
    protected $hidden = ['cli_senha'];
    protected $primaryKey = 'cli_id';
    protected $table = "cliente";

}

