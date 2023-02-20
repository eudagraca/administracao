<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JustificaoFalta extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'tipo_colaborador', 'tipo_justificacao', 'assunto', 'forma_compensacao',
        'motivo', 'observacoes', 'user_id', 'is_active', 'parecer_rh', 'parecer_chefe', 'sector_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function alertaJustificacao()
    {
        return $this->hasOne(AlertaJustificacao::class);
    }

    public function dados()
    {
        return $this->hasMany(DadosFalta::class);
    }
}
