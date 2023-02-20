<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'name', 'gender', 'morada', 'area', 'phone', 'pagamento', 'is_active', 'comprovativo_pagamento'
    ];

    public function respostas(){
        return $this->hasMany(ManutencaoResposta::class);
    }
}
