<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasDetalhe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_detalhe', function (Blueprint $table) {
            $table->id('cde_id');
            $table->unsignedBigInteger('for_id');
            $table->unsignedBigInteger('com_id');
            $table->string('cde_produto');
            $table->integer('cde_qtde');
            $table->integer('cde_valoritem');
            $table->integer('cde_valortotal');
            $table->string('cde_descricao');
            $table->timestamps();

            $table->foreign('com_id')->references('com_id')->on('compra');
            $table->foreign('for_id')->references('for_id')->on('fornecedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras_detalhe');
    }
}
