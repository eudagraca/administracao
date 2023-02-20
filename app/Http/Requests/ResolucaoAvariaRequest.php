<?php

namespace App\Http\Requests;

use App\Http\ownClasses\Constantes;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ResolucaoAvariaRequest extends FormRequest
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
            'diagnostico' => 'required_if:estado,==,concluido|string|max:1000|nullable',
            'plano_reparacao' => 'required_if:estado,==,concluido|string|max:1000|nullable',
            'plano_prevencao' => 'required_if:estado,==,concluido|string|max:1000|nullable',
            'unidade' => 'required',
            'garantia' => 'required_if:estado,==,concluido|string|max:1000|nullable',
//            'responsavel' => 'string|max:1000',
            'fornecedor_servico' => 'required_if:estado,==,concluido|string|nullable',
            'estado' => 'string|in:pendente,concluido',
            'localizacao' => 'string|in:Matema Sede,Sucursal Cidade,Sucursal Moatize',
            'mao_obra_final' => 'required_if:estado,==,concluido|numeric|nullable',
            'mao_obra_inicial' => 'required_if:estado,==,concluido|numeric|nullable',
//            'valor_total' => 'required_if:estado,==,concluido|numeric|nullable',
//            'custo_do_material' => 'required_if:estado,==,concluido|numeric|nullable',
            'minutos_duracao' =>'required_if:estado,==,concluido|numeric|nullable',
            'horas_duracao' =>'required_if:estado,==,concluido|numeric|nullable',
            'comprovativo' => 'required',
        ];
    }

    public function attributes()
    {
        return [
          'estado'=>'Estado da avaria',
          'valor_total'=>'Valor total',
          'custo_do_material'=>'Custo do material',
          'mao_obra_final'=>'Mão de obra final',
          'mao_obra_inicial'=>'Mão de obra inicial',
          'responsavel'=>'Custo do material',
          'pagamento'=>'Pagamento',
           'garantia'=>'Garantia',
          'plano_prevencao'=>'Plano de prevenção',
          'plano_reparacacao'=>'Plano de reparacao',
          'diagnostico'=>'Diagnóstico',
          'fornecedor_servico' => 'Fornecedor de Serviço',
          'comprovativo' => 'Comprovativo',

        ];
    }
}
