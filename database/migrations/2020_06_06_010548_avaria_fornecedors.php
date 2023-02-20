<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AvariaFornecedors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaria_fornecedors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fornecedor_id')->unsigned();
            $table->string('avaria_id');

            $table->foreign('fornecedor_id')->references('id')
                ->on('fornecedors')->onDelete('cascade');

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
        //
    }
}
