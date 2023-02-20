<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TransporteRequest extends FormRequest
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
            'modelo' => 'required|max:255',
            'veiculo' => 'required|max:100',
            'matricula' => 'required|unique:transportes|max:255',
            'marca' => 'required|string|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'veiculo' => 'Veículo',
            'modelo' => 'Modelo',
            'marca' => 'Marca',
            'matricula' => 'Matrícula',
            'color' => 'Cor',
        ];
    }
}
