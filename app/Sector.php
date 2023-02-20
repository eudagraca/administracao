<?php

namespace App;

use App\Avaria;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_sectors');
    }

    public function avarias()
    {
        return $this->hasMany(Avaria::class);
    }

    public function reuisicoes()
    {
        return $this->hasMany(RequisicaoTransporte::class);
    }
}
