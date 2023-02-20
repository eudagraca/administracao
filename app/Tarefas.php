<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarefas extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'status', 'requisicao_transporte_id', 'start_at', 'end_at'
    ];

    public function requisicaoTransporte(){
        return $this->belongsTo(RequisicaoTransporte::class);
    }
}
