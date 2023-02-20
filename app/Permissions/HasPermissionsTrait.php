<?php
namespace App\Permissions;

use App\AumentoRemuneracao;
use App\Avaria;
use App\Contrato;
use App\ManutencaoResposta;
use App\Motorista;
use App\RequisicoesNegada;
use App\RequisicaoTransporte;
use App\Role;
use App\Sector;

trait HasPermissionsTrait
{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function respostas()
    {
        return $this->hasMany(ManutencaoResposta::class);
    }

    public function requisicoes()
    {
        return $this->hasMany(RequisicaoTransporte::class);
    }

    public function requisicaoNegada()
    {
        return $this->hasMany(RequisicoesNegada::class);
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'users_sectors');
    }

    public function sector()
    {
        return $this->hasOne(Sector::class);
    }

    public function avarias()
    {
        return $this->hasMany(Avaria::class);
    }

    public function remuneracoes()
    {
        return $this->hasMany(AumentoRemuneracao::class);
    }

    public function motorista()
    {
        return $this->hasOne(Motorista::class);
    }

    public function contrato()
    {
        return $this->hasOne(Contrato::class);
    }

    public function hasRole($role)
    {
        if ($this->roles()->first()->slug == $role) {
            return true;
        }
        return false;
    }

    public function getSector()
    {
        return $this->sectors()->first();
    }
}
