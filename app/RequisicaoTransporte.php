<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisicaoTransporte extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'dia_exata', 'hora_exata', 'observacoes', 'foi_aceite',
        'transporte_id', 'motorista_id', 'pre_requisicao_id', 'user_id',
    ];

    public $timestamps = true;

    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }

    public function preRequisicao()
    {
        return $this->belongsTo(PreRequisicao::class);
    }

    public function transporte()
    {
        return $this->belongsTo(Transporte::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarefa(){
        return $this->hasOne(Tarefas::class);
    }
}
