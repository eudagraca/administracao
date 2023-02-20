<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosProlongamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_prolongamentos', function (Blueprint $table) {
            $table->id();
            $table->string('data_prolongamento');
            $table->string('hora_fim_prolongamento');
            $table->string('hora_inicio_prolongamento');
            $table->string('prolongamento_id');

            $table->foreign('prolongamento_id')->references('id')
                ->on('prolongamentos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados_prolongamentos');
    }
}
