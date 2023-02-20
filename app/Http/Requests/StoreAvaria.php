<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAvaria extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'bail|unique:avarias',
            'descricao' => 'required',
            'natureza' => 'required',
            'referencia' => 'nullable|string|max:250',
            'prioridade' => 'required|in:alta,baixa,média',
            'localizacao' => 'required|string|in:Matema Sede,Sucursal Cidade,Sucursal Moatize',
            'sector_id' => 'required|exists:sectors,id',
        ];

    }


    public function attributes(){
        return [
            'descricao' => 'Descrição',
            'prioridade' => 'Prioridade',
            'natureza' => 'Categoria',
            'referencia' => 'Referência a avaria',
            'sector_id' => 'Sector',
            'localizacao' => 'Localização',
        ];
    }
}
