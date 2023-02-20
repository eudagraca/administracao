<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertaFeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerta_ferias', function (Blueprint $table) {
            $table->id();
            $table->boolean('foi_lida')->default(0);
            $table->bigInteger('feria_id')->unsigned();

            $table->foreign('feria_id')->references('id')
            ->on('ferias')->onDelete('cascade');
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
        Schema::dropIfExists('alerta_ferias');
    }
}
