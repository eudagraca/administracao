<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AumentoRemuneracao extends Model
{

    protected $fillable = [
        'user_id', 'motivacao', 'estado', 'sector_id'
    ];

    public function user(){
        return  $this->belongsTo(User::class);
    }

    public function sector(){
        return  $this->belongsTo(Sector::class);
    }
}
