<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContasAReceber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_a_receber', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tpg_id');
            $table->string('rec_descricao');
            $table->string('rec_ven_id')->nullable();
            $table->date('rec_data')->nullable();
            $table->float('rec_valor', 12, 2);
            $table->float('rec_valor_final', 12, 2);
            $table->string('rec_parcelas');
            $table->string('rec_status');
            $table->timestamps();

            $table->foreign('tpg_id')->references('id')->on('tipopagto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_a_receber');
    }
}
