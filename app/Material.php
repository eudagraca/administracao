<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Avaria;

class Material extends Model
{
    protected $fillable = [
        'fornecedor_id', 'preco', 'quatidade', 'nome', 'nr_requisicao', 'avaria_id'
    ];

    public $timestamps = false;

     public function avaria()
    {
        return $this->belongsTo(Avaria::class);
    }

     public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
