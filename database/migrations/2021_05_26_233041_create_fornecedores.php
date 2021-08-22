<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor', function (Blueprint $table) {
            $table->id();
            $table->string('for_nome');
            $table->string('for_cidade');
            $table->string('for_estado');
            $table->string('for_bairro');
            $table->string('for_rua');
            $table->string('for_numero');
            $table->integer('for_telefone');
            $table->integer('for_celular');
            $table->integer('for_cpf');
            $table->integer('for_cnpj');
            $table->string('for_cep');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedor');
    }
}
