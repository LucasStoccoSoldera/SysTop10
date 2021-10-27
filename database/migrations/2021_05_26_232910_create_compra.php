<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tpg_id');
            $table->unsignedBigInteger('cc_id');
            $table->date('com_data_compra');
            $table->date('com_data_pagto')->nullable();
            $table->string('com_descricao');
            $table->integer('com_desconto')->nullable();
            $table->string('com_parcelas');
            $table->string('com_observacoes')->nullable();
            $table->timestamps();

            $table->foreign('tpg_id')->references('id')->on('tipopagto');
            $table->foreign('cc_id')->references('id')->on('centro_custo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
