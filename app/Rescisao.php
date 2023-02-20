<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rescisao extends Model
{
    protected $fillable = [
      'contrato_id', 'user_id'
    ];

    public $timestamps = true;

    public function contrato(){
        return $this->belongsTo(Contrato::class);
    }
}
