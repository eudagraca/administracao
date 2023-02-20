<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertencia extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'user_id', 'is_open', 'motivo', 'adversor_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function adversor(){
        return $this->belongsTo(User::class, 'adversor_id');
    }
}
