<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogistica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistica', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pac_id');
            $table->unsignedBigInteger('trans_id');
            $table->timestamps();

            $table->foreign('trans_id')->references('id')->on('transportadora');
            $table->foreign('pac_id')->references('id')->on('pacote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logistica');
    }
}
