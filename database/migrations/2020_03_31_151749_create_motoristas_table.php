<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotoristasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motoristas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->bigInteger('phone');
            $table->boolean('is_active')->default(1);
            $table->boolean('em_servico')->default(0);
            $table->string('address');
            $table->enum('gender',['Masculino', 'Femenino', 'Outro']);
            $table->string('licence_number')->nullable();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            //FOREIGN KEY CONSTRAINTS
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motoristas');
    }
}
