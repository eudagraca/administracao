<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avarias', function (Blueprint $table) {
            $table->string('id');
            $table->longText('descricao');
            $table->longText('referencia')->nullable(true);;
            $table->string('fornecedor_servico')->nullable();
            $table->bigInteger('sector_id')->unsigned();
            $table->dateTime('data_para_resolucao')->nullable(true);
            $table->time('hora_para_resolucao')->nullable(true);
            $table->string('responsavel')->nullable(true);
            $table->bigInteger('user_id')->unsigned();
            $table->longText('plano_reparacao')->nullable(true);
            $table->longText('plano_prevencao')->nullable(true);
            $table->longText('proximo_passo')->nullable(true);
            $table->enum('foi_lida', ['não lida', 'lida'])->default('não lida');
            $table->enum('prioridade', ['alta', 'baixa', 'média'])->default('baixa');
            $table->string('natureza')->nullable(true);;
            $table->string('compartimento')->nullable(true);
            $table->boolean('fechar')->default(false)->nullable(true);
            $table->enum('estado',['pendente', 'concluido'])->default('pendente');
            $table->enum('estado_requisitante',['não concluida', 'concluida'])->default('não concluida');
            $table->longText('diagnostico')->nullable(true);
            $table->string('garantia')->nullable(true);
            $table->string('mao_obra_inicial')->nullable(true);;
            $table->string('mao_obra_final')->nullable(true);;
            $table->string('valor_total')->nullable(true);;
            $table->string('custo_do_material')->default(0)->nullable(true);;
            $table->integer('horas_duracao')->nullable(true)->default(0)->nullable(true);;
            $table->integer('minutos_duracao')->nullable(true)->default(0)->nullable(true);;
            $table->enum('localizacao',['Matema Sede', 'Sucursal Cidade','Sucursal Moatize'])->nullable(true);
            $table->enum('comprovativo',['Factura', 'VD','ISP'])->nullable(true);
            $table->string('forma_pagamento')->nullable(true);
            $table->string('tempo_prioridade')->nullable(true);
            $table->text('observacao')->nullable(true);
            $table->timestamps();
            $table->primary('id');

            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avarias');
    }
}
