<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FornecedorRequest extends FormRequest
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
            'nome' => 'required',
            'endereco' => 'required',
            'contacto' => 'required',
            'nuit' => 'required|unique:fornecedors,nuit|numeric',
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
        ];
    }
}
