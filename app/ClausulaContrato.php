<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClausulaContrato extends Model
{
     protected $fillable = [
        'nr_clausula', 'descricao_clausula', 'clausula', 'contrato_id'
    ];

    public function contrato(){
        return  $this->belongsTo(Contrato::class);
    }
}
