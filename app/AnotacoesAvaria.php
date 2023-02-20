<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnotacoesAvaria extends Model
{
    protected $fillable = [
        'anotacao', 'avaria_id'
    ];

    public $timestamps = false;

    public function avaria(){

        return  $this->belongsTo(Avaria::class);
    }
}
