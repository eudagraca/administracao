<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('fornecedor');
            $table->integer('quatidade');
            $table->double('preco', 8, 2);
            $table->string('nome');
            $table->string('avaria_id');
            $table->string('nr_requisicao')->nullable();
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
        Schema::dropIfExists('materials');
    }
}
