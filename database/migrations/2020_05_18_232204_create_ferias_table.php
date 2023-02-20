<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ferias', function (Blueprint $table) {
            $table->id();
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->bigInteger('user_id')->unsigned();;
            $table->bigInteger('substituto_id')->unsigned();;
            $table->integer('anos_trabalho');
            $table->string('funcao');
            $table->string('justificacao')->nullable();
            $table->enum('estado', ['lida', 'nao lida', 'aceite', 'negada'])->default('nao lida');
            $table->enum('periodo', ['Meses','Anos']);
            $table->enum('confirmed', ['Sim', 'Nao', 'Pendente'])->default('Pendente');
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->foreign('substituto_id')->references('id')
                ->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ferias');
    }
}
