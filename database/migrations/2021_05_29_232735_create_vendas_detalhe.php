<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasDetalhe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas_detalhe', function (Blueprint $table) {
            $table->id('det_id');
            $table->unsignedBigInteger('cor_id');
            $table->unsignedBigInteger('dim_id');
            $table->unsignedBigInteger('pro_id');
            $table->unsignedBigInteger('ven_id');
            $table->integer('det_qtde');
            $table->text('det_descricao');
            $table->String('det_anexo_path');
            $table->float('det_valor_unitario', 2);
            $table->float('det_valor_total', 2);
            $table->timestamps();

            $table->foreign('cor_id')->references('cor_id')->on('cores');
            $table->foreign('dim_id')->references('dim_id')->on('dimensoes');
            $table->foreign('pro_id')->references('pro_id')->on('produto');
            $table->foreign('ven_id')->references('ven_id')->on('vendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas_detalhe');
    }
}
