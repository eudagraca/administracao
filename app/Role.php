<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    public $timestamps = false;
    protected $tabel = "roles";

    protected $fillable = [
        'slug', 'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }
}
