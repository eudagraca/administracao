<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TecnicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->hasRole('gestor-manutencao');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gender' => 'required|in:Masculino,Femenino,Outro',
            'name' => 'required',
            'area' => 'required',
            'morada' => 'required',
            'pagamento' => 'required|in:cash,cheque,transferência,conta corrente',
            'comprovativo_pagamento' => 'required|in:VD,ISP,Factura',
            'phone' => 'required|unique:tecnicos,phone|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'gender' => 'Sexo',
            'name' => 'Nome',
            'morada' => 'Morada',
            'pagamento' => 'Formas de pagamento',
            'area' => 'Área de trabalho',
            'phone' => 'Telefone',
            'comprovativo_pagamento' => 'Tipo de comprovativo',
        ];
    }
}
