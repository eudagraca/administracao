<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalas', function (Blueprint $table) {
            $table->string('id');
            $table->bigInteger('sector_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->enum('tipo_colaborador', ['Efectivo', 'Prestador']);
            $table->enum('tipo', ['Alteração de escala', 'Prolongamento de turno']);
            $table->enum('pedido_de', ['Colaborador', 'Chefe do sector', 'Direcção', 'Recursos Humanos']);
            $table->text('motivo')->nullable();;
            $table->text('observacoes')->nullable();
            $table->enum('forma_compensacao', ['Alteração de turno / Escala', 'Horas extras', 'Trabalho voluntário']);
            $table->primary('id');
            $table->string('parecer_rh')->nullable();
            $table->boolean('is_active')->default(1);
            $table->enum('estado', ['Lido','Recebido','Nao lido','Respondido'])->default('Nao lido');
            $table->string('parecer_chefe')->nullable();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->foreign('sector_id')->references('id')
            ->on('sectors')->onDelete('cascade');

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
        Schema::dropIfExists('escalas');
    }
}
