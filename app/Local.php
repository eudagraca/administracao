<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'designacao', 'endereco', 'is_active'
    ];
}
