<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosEscalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_escalas', function (Blueprint $table) {
            $table->id();
            $table->string('data_escala');
            $table->string('hora_entrada');
            $table->string('intervalo');
            $table->string('hora_final');
            $table->string('data_nova_escala');
            $table->string('hora_inicio_nova_escala');
            $table->string('intervalo_nova_escala');
            $table->string('hora_fim_nova_escala');
            $table->string('escala_id');

            $table->foreign('escala_id')->references('id')
                ->on('escalas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados_escalas');
    }
}
