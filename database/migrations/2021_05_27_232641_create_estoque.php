<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pro_id');
            $table->unsignedBigInteger('dim_id');
            $table->unsignedBigInteger('cor_id');
            $table->integer('est_qtde');
            $table->string('est_status');
            $table->integer('est_limite');
            $table->timestamps();

            $table->foreign('dim_id')->references('id')->on('dimensoes');
            $table->foreign('cor_id')->references('id')->on('cores');
            $table->foreign('pro_id')->references('id')->on('produto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estoque');
    }
}
