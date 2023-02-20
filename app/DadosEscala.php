<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosEscala extends Model
{
    protected $fillable = [
        'data_escala', 'hora_entrada', 'intervalo', 'hora_final',
        'data_nova_escala', 'hora_inicio_nova_escala', 'intervalo_nova_escala',
        'hora_fim_nova_escala', 'escala_id'
    ];

    public $timestamps = false;

    public function escala()
    {
        return $this->belongsTo(Escala::class);
    }
}
