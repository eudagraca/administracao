<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertaEscala extends Model
{
     public $fillable = [
        'foi_lida', 'escala_id'
    ];

    public function escala(){
        return $this->belongsTo(Escala::class);
    }
}
