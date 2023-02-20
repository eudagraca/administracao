<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCarta extends Model
{
    protected $fillable = [
        'tipo'
    ];

    public $timestamps = false;
}
