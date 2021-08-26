<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('cli_nome');
            $table->string('cli_usuario')->unique();
            $table->string('cli_senha');
           $table->timestamps();
            $table->string('cli_cpf_cnpj');
            $table->string('cli_telefone');
            $table->string('cli_celular');
            $table->string('cli_logradouro');
            $table->string('cli_bairro');
            $table->string('cli_n_casa');
            $table->string('cli_cidade');
            $table->char('cli_uf', 2);
            $table->string('cli_complemento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
