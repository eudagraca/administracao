<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisicoesNegada extends Model
{
    protected $fillable = [
        'user_id', 'pre_requisicao_id'
    ];

    public $timestamps = false;

    public function PreRequisicao(){
        return $this->belongsTo(PreRequisicao::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
