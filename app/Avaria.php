<?php

namespace App;

use App\Material;
use Illuminate\Database\Eloquent\Model;

class Avaria extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'descricao', 'sector_id', 'data_para_resolucao', 'user_id', 'plano_reparacao', 'localizacao',
        'plano_prevencao', 'estado', 'prioridade' , 'natureza', 'diagnostico', 'mao_obra_inicial',
        'mao_obra_final', 'proximo_passo', 'hora_para_resolucao', 'compartimento', 'comprovativo',
        'horas_duracao', 'minutos_duracao', 'referencia',
        'fornecedor_servico', 'responsavel', 'foi_lida', 'garantia', 'valor_total' , 'custo_do_material', 'tempo_prioridade', 'forma_pagamento', 'observacao'
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function materiais()
    {
        return $this->hasMany(Material::class);
    }

    public function anotacoes()
    {
        return $this->hasMany(AnotacoesAvaria::class);
    }

   public function resposta()
    {
        return $this->hasOne(ManutencaoResposta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
