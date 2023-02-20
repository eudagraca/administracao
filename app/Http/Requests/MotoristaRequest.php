<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MotoristaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('gestor-administracao');
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
            'surname' => 'required|max:100',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:100',
            'gender' => 'required',
            'username' => 'required|unique:users,username|string',
        ];
    }

    public function attributes()
    {
        return [
            'licence_number' => 'Número da carta de Condução',
            'phone' => 'Telefone',
            'gender' => 'Sexo',
            'name' => 'Nome',
            'address' => 'Morada',
            'surname' => 'Apelido',
            'username' => 'Nome de acesso ao sistema',
        ];
    }
}
