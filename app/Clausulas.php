<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clausulas extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'adenda_id', 'paragrafo',
    ];
    public function adenda(){
        return $this->belongsTo(Adenda::class);
    }
}
