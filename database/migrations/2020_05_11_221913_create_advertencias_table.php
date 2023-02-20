<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertencias', function (Blueprint $table) {
            $table->string('id');
            $table->boolean('is_open')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('adversor_id')->unsigned();
            $table->text('motivo');
            $table->timestamps();
            $table->primary('id');

            $table->foreign('adversor_id')->references('id')
                ->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('advertencias');
    }
}
