<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertaProlongamento extends Model
{
     public $fillable = [
        'foi_lida', 'prolongamento_id'
    ];

    public function prolongamento(){
        return $this->belongsTo(Prolongamento::class);
    }
}
