<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoasRequisicao extends Model
{
    protected $fillable = [
        'nome', 'pre_requisicao_id',
    ];

    public $timestamps = false;

    public function preRequisicao(){
        return $this->belongsTo(PreRequisicao::class);
    }


}
