<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PreRequisicaoRequest extends FormRequest
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
            'tipo_viajem'=> 'required',
            'origem'=> 'required',
            'local_id'=> 'required|exists:locals,id',
            'tempo_viajem'=> 'required',
            'prioridade'=> 'required',
            'hora_saida'=> 'required',
            'dia_saida'=> 'required',
            'mercadoria'=> 'required',
            'volume'=> 'required_if:mercadoria,==,Mercadoria',
            'unidade'=> 'required_if:mercadoria,==,Mercadoria',
            'quantidade'=> 'nullable',
            'descricao'=> 'required',
            'sector_id' => 'required|exists:sectors,id',
            "pessoas"    => "nullable|required_if:mercadoria,==,Pessoas|array",
            "pessoas.*"  => "nullable|required_if:mercadoria,==,Pessoas|string|distinct",
        ];
    }

    public function attributes()
    {
        return [
          'sector_id' => 'Sector',
          'dia_saida' => 'Dia de Saída',
          'hora_saida' => 'Hora de Saída',
          'tipo_viajem' => 'Tipo de viajem',
          'tempo_viajem' => 'Tempo de viajem',
        ];
    }
}
