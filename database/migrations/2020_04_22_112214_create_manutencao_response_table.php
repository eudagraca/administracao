<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManutencaoResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutencao_respostas', function (Blueprint $table) {
            $table->id();
            $table->longText('observacao')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->string('avaria_id');
            $table->timestamps();

            $table->bigInteger('tecnico_id')->unsigned();
            $table->foreign('tecnico_id')->references('id')
                ->on('tecnicos')->onDelete('cascade');

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('manutencao_response');
    }
}
