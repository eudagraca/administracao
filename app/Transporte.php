<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    protected $fillable = [
        'veiculo', 'marca', 'modelo', 'matricula', 'is_active', 'em_servico'
    ];

    public $timestamps = true;

    public function reuisicoes()
    {
        return $this->hasMany(RequisicaoTransporte::class);
    }
}
