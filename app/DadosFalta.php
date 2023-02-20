<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosFalta extends Model
{
    protected $fillable = [
        'data_escala', 'hora_inicio_escala', 'intervalo', 'hora_fim_escala', 'hora_inicio_falta', 'hora_fim_falta', 'justificao_falta_id', 'data_rh',
        'hora_inicio_rh', 'intervalo_rh', 'hora_fim_rh'
    ];

    public $timestamps = false;
}
