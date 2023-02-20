<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertaJustificacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerta_justificacaos', function (Blueprint $table) {
            $table->id();
            $table->string('justificao_falta_id');
            $table->boolean('fechada')->default(0);

            $table->foreign('justificao_falta_id')->references('id')
                ->on('justificao_faltas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerta_justificacaos');
    }
}
