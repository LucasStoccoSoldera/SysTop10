<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->string('usu_nome_completo');
            $table->string('usu_usuario')->unique();
            $table->integer('usu_celular');
            $table->integer('usu_cpf');
            $table->string('usu_senha');
            $table->timestamp('usu_data_cadastro');
            $table->string('usu_status');
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cargo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
