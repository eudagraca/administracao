<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosProlongamento extends Model
{
    protected $fillable = [
        'data_prolongamento', 'hora_inicio_prolongamento', 'hora_fim_prolongamento',
        'prolongamento_id'
    ];

    public $timestamps = false;

    public function prolongamento()
    {
        return $this->belongsTo(Prolongamento::class);
    }
}
