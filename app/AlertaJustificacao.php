<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertaJustificacao extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'justificao_falta_id', 'fechada'
    ];

    public function justificaoFalta()
    {
        return $this->belongsTo(JustificaoFalta::class);
    }
}
