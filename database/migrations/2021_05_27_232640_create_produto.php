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
            $table->string('pro_nome');
            $table->float('pro_precocusto', 12, 2);
            $table->float('pro_precovenda', 12, 2);
            $table->string('pro_promocao')->nullable();
            $table->string('pro_foto_path');
            $table->char('pro_personalizacao', 3);
            $table->integer('pro_pedidominimo');
            $table->char('pro_terceirizacao', 3);
            $table->longText('pro_descricao');
            $table->timestamps();

            $table->foreign('mat_id')->references('id')->on('material');
            $table->foreign('log_id')->references('id')->on('logistica');
            $table->foreign('tpp_id')->references('id')->on('tipoproduto');
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
