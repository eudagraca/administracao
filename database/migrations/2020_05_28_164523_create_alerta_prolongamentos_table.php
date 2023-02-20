<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertaProlongamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerta_prolongamentos', function (Blueprint $table) {
            $table->id();
            $table->boolean('foi_lida')->default(0);
            $table->string('prolongamento_id');
            $table->foreign('prolongamento_id')->references('id')
                ->on('prolongamentos')->onDelete('cascade');
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
        Schema::dropIfExists('alerta_prolongamentos');
    }
}
