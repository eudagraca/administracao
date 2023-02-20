<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasRequisicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas_requisicaos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pre_requisicao_id')->unsigned();
            $table->string('nome');
            $table->foreign('pre_requisicao_id')->references('id')
                ->on('pre_requisicaos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas_requisicaos');
    }
}
