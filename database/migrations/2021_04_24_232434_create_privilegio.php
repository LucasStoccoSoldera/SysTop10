<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilegio', function (Blueprint $table) {
            $table->id();
            $table->char('pri_usuarios', 1);
            $table->char('pri_clientes', 1);
            $table->char('pri_financeiro', 1);
            $table->char('pri_produtos', 1);
            $table->char('pri_estoque', 1);
            $table->char('pri_fornecedores', 1);
            $table->char('pri_detalhes', 1);
            $table->char('pri_logistica', 1);
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
        Schema::dropIfExists('privilegio');
    }
}
