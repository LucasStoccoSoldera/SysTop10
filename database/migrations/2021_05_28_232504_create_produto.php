<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mat_id');
            $table->unsignedBigInteger('tpp_id');
            $table->unsignedBigInteger('log_id');
            $table->unsignedBigInteger('dim_id');
            $table->string('pro_nome');
            $table->float('pro_precocusto', 2);
            $table->float('pro_precovenda', 2);
            $table->string('pro_promocao');
            $table->string('pro_foto_path');
            $table->char('pro_personalizacao', 1);
            $table->integer('pro_pedidominimo');
            $table->char('pro_terceirizacao', 1);
            $table->timestamps();

            $table->foreign('mat_id')->references('id')->on('material');
            $table->foreign('tpp_id')->references('id')->on('tipoproduto');
            $table->foreign('log_id')->references('id')->on('logistica');
            $table->foreign('dim_id')->references('id')->on('dimensoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto');
    }
}
