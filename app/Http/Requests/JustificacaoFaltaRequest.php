<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JustificacaoFaltaRequest extends FormRequest
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
            'tipo_colaborador' => 'required',
            'tipo_justificacao' => 'required',
            'assunto' => 'nullable',
            'forma_compensacao' => 'required',
            'motivo' => 'required|string|min:5',
            'observacoes' => 'nullable',
            //arrays
            'data_escala' => 'required|array|min:1',
            'hora_inicio_escala' => 'required|array|min:1',
            'intervalo' => 'required|array|min:1',
            'hora_fim_escala' => 'required|array|min:1',
            'hora_inicio_falta' => 'required|array|min:1',
            'hora_fim_falta' => 'required|array|min:1',
        ];
    }
}
