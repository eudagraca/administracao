<?php

namespace App\Http\Requests;

use App\Http\ownClasses\Constantes;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAvaria extends FormRequest
{
    private $date;
    private $constantante;

    /**
     * UpdateAvaria constructor.
     */
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
            'id' => 'bail|unique:avarias',
            'observacao' => '->nullable',
            'proximo_passo' => 'nullable|string|max:255',
            'diagnostico' => 'nullable|string|max:350',
            'mao_obra_inicial' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})',
            'localizacao' => 'required|string|in:Matema Sede,Sucursal Cidade,Sucursal Moatize',
            'mao_obra_final' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})',
        ];

    }


    public function attributes(){
        return [
            'descricao' => 'Descrição',
            'mao_obra_final' => 'Mão de Obra final',
            'proximo_passo' => 'Prxóximo passo',
            'mao_obra_inicial' => 'Mão de Obra inicial',
            'observacao' => 'Observação',
            'fornecedor_servico' => 'Fornecedor de Serviço',
            'localizacao' => 'Localização',
        ];
    }
}
