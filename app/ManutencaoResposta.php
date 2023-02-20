<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManutencaoResposta extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'observacao', 'user_id', 'avaria_id', 'esta_lida', 'tecnico_id'
    ];

    public function avaria()
    {
        return $this->belongsTo(Avaria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }
}
