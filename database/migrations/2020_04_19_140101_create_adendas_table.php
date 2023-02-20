<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adendas', function (Blueprint $table) {
            $table->string('id');
            $table->string('contrato_id');
            $table->string('motivo');
            $table->string('descricao');
            $table->string('clausula');
            $table->integer('numero');
            $table->date('apartir_de');
            $table->timestamps();
            $table->primary('id');

            $table->foreign('contrato_id')->references('id')
                ->on('contratos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adendas');
    }
}
