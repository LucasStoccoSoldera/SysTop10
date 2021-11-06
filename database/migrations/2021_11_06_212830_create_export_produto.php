<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_produto', function (Blueprint $table) {
            $table->id();
            $table->integer('pro_id');
            $table->string('mat_id');
            $table->string('tpp_id');
            $table->string('log_id');
            $table->string('pro_nome');
            $table->float('pro_precocusto', 12, 2);
            $table->float('pro_precovenda', 12, 2);
            $table->string('pro_promocao')->nullable();
            $table->string('pro_foto_path');
            $table->char('pro_personalizacao', 3);
            $table->integer('pro_pedidominimo');
            $table->char('pro_terceirizacao', 3);
            $table->string('pro_cor')->nullable();
            $table->string('pro_cor_referencia')->nullable();
            $table->string('pro_dimensao')->nullable();
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
        Schema::dropIfExists('export_produto');
    }
}
