<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tpg_id');
            $table->unsignedBigInteger('log_id');
            $table->unsignedBigInteger('cli_id');
            $table->timestamp('ven_data');
            $table->date('ven_data_pagto');
            $table->string('ven_parcelas');
            $table->string('ven_status');
            $table->float('ven_desconto', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('tpg_id')->references('id')->on('tipopagto');
            $table->foreign('log_id')->references('id')->on('logistica');
            $table->foreign('cli_id')->references('id')->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
