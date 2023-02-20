<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feria extends Model
{
    protected $fillable = [
        'user_id', 'data_termino', 'data_inicio', 'funcao', 'justificacao', 'anos_trabalho', 'substituto_id', 'periodo', 'confirmed'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function substituto(){
        return $this->belongsTo(User::class, 'substituto_id');
    }
}
