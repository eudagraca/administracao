<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescisaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    //  */
    public function up()
    {
        Schema::create('rescisaos', function (Blueprint $table) {
            $table->id();
            $table->string('contrato_id');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('contrato_id')->references('id')
                ->on('contratos')->onDelete('cascade');

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
        Schema::dropIfExists('rescisaos');
    }
}
