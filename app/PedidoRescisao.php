<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoRescisao extends Model
{
    protected $fillable = [
        'motivo', 'user_id', 'antecedencia', 'foi_lida'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
