<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertaFeria extends Model
{
    public $fillable = [
        'foi_lida', 'feria_id'
    ];

    public function feria(){
        return $this->belongsTo(Feria::class);
    }
}
