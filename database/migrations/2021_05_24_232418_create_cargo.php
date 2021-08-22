<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pri_id');
            $table->string('car_descricao');
            $table->timestamps();

            $table->foreign('pri_id')->references('id')->on('privilegio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargo');
    }
}
