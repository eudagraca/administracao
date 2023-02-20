<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnotacoesAvariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anotacoes_avarias', function (Blueprint $table) {
            $table->id();
            $table->string('avaria_id');
            $table->string('anotacao');
            $table->enum('foi_lida',['lida', 'não lida'])->default('não lida');

            $table->foreign('avaria_id')->references('id')
                ->on('avarias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anotacoes_avarias');
    }
}
