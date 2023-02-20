<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    public $timestamps = true;
    public $incrementing = false;
    protected $fillable = [
        'name', 'nacionalidade', 'bi', 'residencia', 'estado_civil', 'contrato','area_formacao',
        'habilitacoes', 'data_contrato_vigor', 'cargo', 'salario_bruto', 'data_assinatura', 'estado', 'tipo_documento', 'tipo', 'tipo_id'
    ];

    public function adendas(){
        return $this->hasMany(Adenda::class)->orderBy('created_at', 'DESC');
    }

    public function adenda(){
        return $this->hasMany(Adenda::class)->orderBy('created_at', 'DESC')->first();
    }
    public function rescisoes(){
        return $this->hasMany(Rescisao::class);
    }
    public function clausulaContratos(){
        return $this->hasMany(ClausulaContrato::class);
    }
}
