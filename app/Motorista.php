<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    protected $fillable = [
        'name', 'surname', 'address', 'phone', 'licence_number', 'gender', 'user_id', 'em_servico'
    ];
    public $timestamps = true;

    public function reuisicoes()
    {
        return $this->hasMany(RequisicaoTransporte::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
