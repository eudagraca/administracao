<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreRequisicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_requisicaos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_viajem', ['Local', 'Nacional', 'Internacional']);
            $table->string('origem');
            $table->bigInteger('local_id')->unsigned();
            $table->string('tempo_viajem');
            $table->enum('prioridade', ['Alta', 'Média', 'Baixa']);
            $table->time('hora_saida');
            $table->date('dia_saida');
            $table->enum('mercadoria', ['Mercadoria', 'Pessoas']);
            $table->string('volume')->nullable(true);
            $table->integer('quantidade')->default(0)->nullable(true);
            $table->enum('estado', ['pendente','andamento', 'entregue', 'atrasada'])->default('pendente');
            $table->enum('foi_aceite', ['lida', 'não lida', 'aceite', 'negado'])->default('nao lida');
            $table->text('observacoes')->nullable(true);
            $table->bigInteger('sector_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');


            $table->foreign('sector_id')->references('id')
                ->on('sectors')->onDelete('cascade');

            $table->foreign('local_id')->references('id')
                ->on('locals')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_requisicaos');
    }
}
