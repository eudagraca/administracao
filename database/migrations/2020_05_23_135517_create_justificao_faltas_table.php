<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificaoFaltasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justificao_faltas', function (Blueprint $table) {
            $table->string('id');
            $table->string('tipo_colaborador');
            $table->string('tipo_justificacao');
            $table->string('assunto')->nullable();
            $table->string('forma_compensacao');
            $table->string('motivo');
            $table->string('observacoes')->nullable();
            $table->boolean('is_active')->default(1);
            $table->enum('parecer_chefe', ['Favorável', 'Não Favorável'])->nullable();
            $table->enum('parecer_rh',['Reúne requisitos', 'Não Reúne requisitos'])->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('sector_id')->unsigned();
            $table->primary('id');


            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->foreign('sector_id')->references('id')
                ->on('sectors')->onDelete('cascade');

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
        Schema::dropIfExists('justificao_faltas');
    }
}
