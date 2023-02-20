<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FeriaRequest extends FormRequest
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
            'funcao' => 'required|max:100',
            'anos_trabalho' => 'required|numeric',
            'periodo' => 'required|in:Anos,Meses',
            'data_inicio' => 'required|date',
            'data_termino' => 'required|date|after:data_inicio',
            'user' => 'required|exists:users,id',
        ];
    }


    public function attributes(){
        return [
            'funcao' => 'Função',
            'anos_trabalho' => 'Anos de trabalho',
            'data_inicio' => 'Data inicial',
            'data_termino' => 'Data de término',
            'user' => 'Substituto',
        ];
    }
}
