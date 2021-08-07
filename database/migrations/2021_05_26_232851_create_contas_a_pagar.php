<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasAPagar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_a_pagar', function (Blueprint $table) {
            $table->id('con_id');
            $table->unsignedBigInteger('tpg_id');
            $table->unsignedBigInteger('cc_id');
            $table->string('con_descricao');
            $table->char('con_tipo');
            $table->float('con_valor', 2);
            $table->float('con_valor_final', 2);
            $table->string('con_parcelas');
            $table->date('con_data_venc');
            $table->date('con_data_pag');
            $table->timestamps();

            $table->foreign('tpg_id')->references('tpg_id')->on('tipopagto');
            $table->foreign('cc_id')->references('cc_id')->on('centro_custo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_a_pagar');
    }
}
