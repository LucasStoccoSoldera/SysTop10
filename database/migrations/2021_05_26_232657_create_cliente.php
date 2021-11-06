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
            $table->string('cli_cpf_cnpj')->nullable();
            $table->string('cli_telefone')->nullable();
            $table->string('cli_celular')->nullable();
            $table->string('cli_cep')->nullable();
            $table->string('cli_logradouro')->nullable();
            $table->string('cli_bairro')->nullable();
            $table->string('cli_n_casa')->nullable();
            $table->string('cli_cidade')->nullable();
            $table->char('cli_uf', 2)->nullable();
            $table->string('cli_complemento')->nullable();
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
