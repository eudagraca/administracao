<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisicaoTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicao_transportes', function (Blueprint $table) {
            $table->string('id');

            $table->bigInteger('transporte_id')->unsigned();
            $table->bigInteger('pre_requisicao_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('motorista_id')->unsigned();

            $table->text('observacoes')->nullable(true);
            $table->dateTime('dia_exata');
            $table->timestamps();


            $table->primary('id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->foreign('motorista_id')->references('id')
                ->on('motoristas')->onDelete('cascade');

            $table->foreign('transporte_id')->references('id')
                ->on('transportes')->onDelete('cascade');

            $table->foreign('pre_requisicao_id')->references('id')
                ->on('pre_requisicaos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisicao_transportes');
    }
}
