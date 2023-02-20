<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->string('estado_civil');
            $table->string('nacionalidade');
            $table->string('bi');
            $table->string('tipo_documento');
            $table->string('tipo');
            $table->string('area_formacao');
            $table->enum('tipo_id', ['CPS', 'CT']);
            $table->string('residencia');
            $table->string('habilitacoes');
            $table->date('data_contrato_vigor');
            $table->string('cargo');
            $table->string('salario_bruto');
            $table->date('data_assinatura');
            $table->enum('estado', ['Rescindido', 'Em Contrato', 'Expirado'])->default('Em Contrato');
            $table->timestamps();
            $table->primary('id');
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')->references('id')
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
        Schema::dropIfExists('contratos');
    }
}
