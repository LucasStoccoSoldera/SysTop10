<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tpg_id');
            $table->BigInteger('par_venda');
            $table->BigInteger('par_conta');
            $table->Integer('par_numero');
            $table->Integer('par_valor');
            $table->string('par_status');
            $table->date('par_data_pagto');
            $table->timestamps();

            $table->foreign('tpg_id')->references('id')->on('tipopagto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcelas');
    }
}
