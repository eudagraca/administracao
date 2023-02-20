<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('area');
            $table->string('phone');
            $table->boolean('is_active')->default(1);
            $table->enum('gender', ['Masculino', 'Femenino', 'Outro']);
            $table->enum('pagamento',['cash', 'cheque','transferência','conta corrente'])->nullable(true);
            $table->enum('comprovativo_pagamento',['ISP', 'VD','Factura'])->nullable(true);
            $table->string('morada');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tecnicos');
    }
}
