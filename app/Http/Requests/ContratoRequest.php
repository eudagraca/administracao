<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContratoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'surname' => 'required|max:50',
            'nacionalidade' => 'required|max:100',
            'bi' => 'required|unique:contratos,bi',
            'residencia' => 'required|string|max:100',
            'habilitacoes' => 'required',
            'data_contrato_vigor' => 'required|date',
            'cargo' => 'required',
            'area_formacao' => 'required',
            'salario_bruto' => 'required',
            'data_assinatura' => 'required|date',
            'estado_civil' => 'required',
            'tipo_documento' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'estado_civil' => 'Estado Civíl',
            'data_assinatura' => 'Data de assinatura',
            'salario_bruto' => 'Salário bruto',
            'cargo' => 'Cargo',
            'habilitacoes' => 'Habilitações',
            'residencia' => 'Residência',
            'bi' => 'N° de BI',
            'data_contrato_vigor' => 'Data de Vigor do contrato',
            'nacionalidade' => 'Nacionalidade',
            'name' => 'Nome',
        ];
    }
}
