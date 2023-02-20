<?php

namespace App\Http\Requests;

use App\Http\ownClasses\Constantes;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RespostaManutencaoRequest extends FormRequest
{
    /**
     * RespostaManutencaoRequest constructor.
     */
    private $date;
    private $constantante;

    public function __construct()
    {
        $this->date = Carbon::now();
        $this->constantante = new Constantes();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return ((Auth::check() and Auth::user()->hasRole($this->constantante::GESTOR_MANUTENCAO))
            or ($this->date->isWeekend() or (date('H', strtotime($this->date->hour)) > 17)
                or (date('H', strtotime($this->date->hour)) < 7)));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'criacao' => 'required',
            'data_para_resolucao' => 'required|date|after_or_equal:criacao',
            'hora_para_resolucao' => 'required',
            'responsavel' => 'required|exists:tecnicos,id',
            'observacao' => 'string'
        ];
    }

    public function attributes()
    {
        return [
            'criacao' => 'Data de submissão',
            'data_para_resolucao' => 'Data para resolução',
            'hora_para_resolucao' => 'Horas para resolução',
            'responsavel' => 'Responsável da resolução',
            'observacao' => 'De Observeções',
        ];
    }
}
