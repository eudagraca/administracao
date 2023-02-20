<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prolongamento extends Model
{
    protected $fillable = [
        'tipo_colaborador', 'tipo_escala',
        'pedido_de', 'forma_compensacao', 'motivo', 'user_id', 'sector_id',
    ];

    public $incrementing = false;


    public function dados()
    {
        return $this->hasOne(DadosProlongamento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
