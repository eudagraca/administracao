<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adenda extends Model
{
    public $incrementing = false;
    protected $fillable = [
      'descricao', 'contrato_id', 'numero', 'motivo', 'apartir_de', 'clausula'
    ];

    public $timestamps = true;

    public function contrato(){
        return $this->belongsTo(Contrato::class);
    }

    public function clausulas(){
        return $this->hasMany(Clausulas::class);
    }
}
