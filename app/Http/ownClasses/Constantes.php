<?php


namespace App\Http\ownClasses;


class Constantes
{
    public const GESTOR_ADMIN = "gestor-administracao";
    public const GESTOR_MANUTENCAO = "gestor-manutencao";
    public const GESTOR_RH = "gestor-recursos-humanos";
    public const SUPER_ADMIN = "super-admin";
    public const USER_NORMAL = "usuario-normal";


    public const LIDA = "lida";
    public const NAO_LIDA = "não lida";
    public const ESTADO_AVARIA_PENDENTE = "pendente";
    public const ESTADO_AVARIA_ANDAMENTO = "andamento";
    public const ESTADO_AVARIA_CONCLUIDO = "concluido";

    public const PRIORIDADE_AVARIA_BAIXA = "baixa";
    public const PRIORIDADE_AVARIA_MEDIA = "média";
    public const PRIORIDADE_AVARIA_ALTA = "alta";


    //Messages
    public const FORNECEDOR_INDICOU = "Fornecedor definido";
    public const MATERIAL_COMPRADO = "Material necessário definido";
    public const DIAGNISTICO_FORNECIDO = "Diagnóstico disponível";
    public const PLANO_DE_REPARACAO = "Plano de reparação defenido";


}
