<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaixa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixa', function (Blueprint $table) {
            $table->id('cax_id');
            $table->timestamp('cax_data');
            $table->string('cax_descricao');
            $table->char('cax_operacao');
            $table->float('cax_valor', 2);
            $table->float('cax_ctpagar', 2);
            $table->float('cax_ctreceber', 2);
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
        Schema::dropIfExists('caixa');
    }
}
