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
            $table->id('est_id');
            $table->unsignedBigInteger('dim_id');
            $table->unsignedBigInteger('cor_id');
            $table->integer('est_qtde');
            $table->char('est_status', 1);
            $table->integer('est_limite');
            $table->timestamps();

            $table->foreign('dim_id')->references('dim_id')->on('dimensoes');
            $table->foreign('cor_id')->references('cor_id')->on('cores');
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
