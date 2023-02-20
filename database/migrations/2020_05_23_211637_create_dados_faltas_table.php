<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosFaltasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_faltas', function (Blueprint $table) {
            $table->id();
            $table->string('data_escala');
            $table->string('hora_inicio_escala');
            $table->string('intervalo');
            $table->string('hora_fim_escala');
            $table->string('hora_inicio_falta');
            $table->string('hora_fim_falta');
            $table->string('justificao_falta_id');

            $table->string('data_rh')->nullable();
            $table->string('hora_inicio_rh')->nullable();
            $table->string('intervalo_rh')->nullable();
            $table->string('hora_fim_rh')->nullable();

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
        Schema::dropIfExists('dados_faltas');
    }
}
