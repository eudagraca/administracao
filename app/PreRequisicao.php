<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreRequisicao extends Model
{

    protected $fillable = [
        'tipo_viajem', 'origem','destino','tempo_viajem','prioridade','hora_saida','dia_saida', 'local_id',
        'mercadoria','volume','quantidade','estado','foi_aceite','sector_id', 'user_id', 'unidade'
    ];

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function local(){
        return $this->belongsTo(Local::class);
    }

    public function pessoas(){
        return $this->hasMany(PessoasRequisicao::class, 'pre_requisicao_id');
    }

    public function requisicao(){
        return $this->hasOne(RequisicaoTransporte::class);
    }

    public function requisicaoNegada(){
        return $this->hasOne(RequisicoesNegada::class);
    }

}
