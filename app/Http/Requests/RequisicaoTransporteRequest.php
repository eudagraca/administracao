<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RequisicaoTransporteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() and Auth::user()->hasRole('gestor-administracao');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transporte_id' => 'required_if:foi_aceite,==,aceite|exists:transportes,id',
            'motorista_id' => 'required_if:foi_aceite,==,aceite|exists:motoristas,id',
            'observacoes' => 'required_if:foi_aceite,==,negada',
            'hora_exata' => 'required_if:foi_aceite,==,aceite',
            'dia_exata' => 'required_if:foi_aceite,==,aceite',
            'user_id'=>'required_if:foi_aceite,==,aceite|exists:users,id',
            'pre_requisicao_id'=>'required_if:foi_aceite,==,aceite|exists:pre_requisicaos,id',
            'foi_aceite'=>'required|in:aceite,negado'
        ];
    }

    public function attributes()
    {
        return [
            'observacoes'=>'Observações',
            'dia_exata'=>'Hora de saída',
            'hora_exata'=>'Hora de saída',
            'motorista_id' =>'Motorista',
            'transporte_id' => 'Transporte',
            'user_id' => 'Usuário',
            'foi_aceite' => 'Estado da requisição',
        ];
    }
}
