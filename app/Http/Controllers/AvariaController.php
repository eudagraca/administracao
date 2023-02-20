<?php

namespace App\Http\Controllers;

use App;
use App\Avaria;
use App\Fornecedor;
use App\Http\Requests\StoreAvaria;
use App\Http\Requests\ResolucaoAvariaRequest;
use App\Http\Requests\RespostaManutencaoRequest;
use App\ManutencaoResposta;
use App\Material;
use App\Sector;
use App\User;
use App\Tecnico;
use PDF;
use Carbon\Carbon;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\AnotacoesAvaria;
use function GuzzleHttp\Psr7\str;


class AvariaController extends Controller
{
    private $currentDate;
    private $constantante;

    public function __construct()
    {
        $this->constantante = new App\Http\ownClasses\Constantes();
        Carbon::setLocale('pt');
        $this->middleware('auth');
        $this->currentDate = Carbon::now();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::check() and (Auth::user()->hasRole('gestor-manutencao') ||Auth::user()->hasRole('super-admin'))) {
            $avarias = Avaria::whereIn('estado', ['pendente', 'andamento'])->get();
        } else if (Auth::check()) {
            $avarias = Avaria::where('user_id', Auth::user()->id)->get()->sortBy('created_at')
                ->sortBy('foi_lida', 0);
        }
        return view('avarias.index', compact('avarias'));
    }

    public function todasAvarias()
    {
        return view('avarias.todas')->with(['avarias' => Avaria::all(),
                'sectores' => Sector::all(), 'users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $urgencias = array('Alta', 'Média', 'Baixa');
        $naturezas = array('Informática', 'Mecânica', 'Outras');

        $naturezas = Tecnico::where('is_active', 1)->get();

        $sectores = Sector::all();
        return view('avarias.create', compact(['sectores', 'urgencias', 'naturezas']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAvaria $request
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function store(StoreAvaria $request)
    {
        $id = IdGenerator::generate(['table' => 'avarias', 'length' => 6, 'prefix' => 'AV-']);
        $avaria = new Avaria();
        $avaria->id = $id . '-' . date('Y');
        $avaria->descricao = $request->descricao;
        $avaria->sector_id = $request->sector_id;
        $avaria->compartimento = $request->compartimento;
        $avaria->user_id = Auth::id();
        $avaria->localizacao = $request->localizacao;
        $avaria->prioridade = $request->prioridade;
        $avaria->natureza = $request->natureza;
        $avaria->referencia = $request->referencia;

        if($request->prioridade == "alta"){
            $avaria->tempo_prioridade = "menos de 2 Dias";
        } elseif($request->prioridade == "média"){
            $avaria->tempo_prioridade = "menos de 4 Dias";
        } elseif($request->prioridade == "baixa"){
            $avaria->tempo_prioridade = "menos de 5 Dias";
        }

        $avaria->save();
        if ($avaria->prioridade == 'alta' and ($this->currentDate->isWeekend() or $this->isExtraTime($avaria))) {
            $anotacao = new AnotacoesAvaria();
            $anotacao->anotacao = "Avaria de alta prioridade registada por  ". Auth::user()->name . " às " . date('H:i', strtotime($this->currentDate));
            $anotacao->avaria_id = $avaria->id;
            $anotacao->save();
            return $this->showAvariaRequest($avaria, true);
        }
        return redirect('/avaria')->with([
            'print' => $avaria->id,
            'success' => 'Registou uma avaria do  sector de ' . $avaria->sector->name]);
    }

    public function geraPDF($avaria){

        $avaria = Avaria::findOrFail($avaria);

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = PDF::loadView('exports.avaria-pedido-pdf', compact('avaria'));
        $pdf->setPaper('a5', 'landscape')->setWarnings(false);
        return $pdf->stream($avaria->id . '.pdf');
    }

    private function isExtraTime(Avaria $avaria)
    {
        return (($this->currentDate->hour > 17) or ($this->currentDate->hour < 7))
            and ((date('H', strtotime($avaria->created_at)) > 17)
                or (date('H', strtotime($avaria->created_at)) < 7))
            and (Auth::id() == $avaria->user_id)
            and ($this->currentDate->diffInDays($avaria->created_at) < 1);
    }

    public function showAvariaRequest($avaria, $controller)
    {
        if (Auth::check() and Auth::user()->hasRole($this->constantante::GESTOR_MANUTENCAO)) {
            if ($avaria->foi_lida == $this->constantante::NAO_LIDA) {
                $avaria->foi_lida = $this->constantante::LIDA;
                $avaria->save();
            }
        }
        $tecnicos = Tecnico::where('is_active', 1)->where('area', 'like', '%' . $avaria->natureza . '%')->get();
        return \view('avarias.avaria-request', compact(['avaria', 'controller', 'tecnicos']));
    }

    public function read(Avaria $avaria)
    {
        return abort(404);

    }

    /**
     * Display the specified resource.
     *
     * @param Avaria $avaria
     * @return Application|Factory|View
     */
    public function show($avaria)
    {
        $avaria = Avaria::findOrFail($avaria);

        if (Auth::check() and (Auth::user()->hasRole('gestor-manutencao') ||Auth::user()->hasRole('super-admin'))) {
            if ($avaria->fechar){
                return view('avarias.details', compact('avaria'));
            }else {
                if ($avaria->resposta == NULL) {
                    return $this->showAvariaRequest($avaria, false);
                } elseif ($avaria->estado != $this->constantante::ESTADO_AVARIA_CONCLUIDO) {
                    return $this->editBusinessLogic($avaria);
                }
            }
        } elseif (($avaria->prioridade == 'alta') and ($this->currentDate->isWeekend() or $this->isExtraTime($avaria))) {

            if ($avaria->fechar){
                return view('avarias.details', compact('avaria'));
            }else {
                if ($avaria->resposta == NULL) {
                    return $this->showAvariaRequest($avaria, true);
                } elseif ($avaria->estado != $this->constantante::ESTADO_AVARIA_CONCLUIDO) {
                    return $this->editBusinessLogic($avaria);
                }
            }
        } else {
            return $this->showResponse($avaria->id);
        }
    }

    private function editBusinessLogic(Avaria $avaria)
    {
        if (!$avaria->estado == "concluido") {
            return redirect(route('avaria.show', $avaria));
        } else {
            return view('avarias.edit', compact('avaria'));
        }
    }

    /**
     *
     * Live Search
     * @param $avaria
     * @return Application|Factory|View
     */

    public function showResponse($avaria)
    {

        $avaria = Avaria::findOrFail($avaria);

        if (!(Auth::user()->hasRole($this->constantante::GESTOR_MANUTENCAO)) and ($avaria->user_id != Auth::id())) {
            return abort(404);
        } else {
            return view('avarias.resposta-details', compact('avaria'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Avaria $avaria
     * @return Application|Factory|View
     */
    public function edit($avaria)
    {
        $avaria = Avaria::findOrFail($avaria);
        $tecnicos = Tecnico::where('area', 'like', '%' . $avaria->natureza . '%')->get();
        if (Auth::check() and (Auth::user()->hasRole('gestor-manutencao'))) {
            if ($avaria->resposta == NULL) {
                $controller = false;
                return \view('avarias.avaria-request', compact(['avaria', 'controller', 'tecnicos']));
            }
            return $this->editBusinessLogic($avaria);
        } elseif ($avaria->prioridade == 'alta' and ($this->currentDate->isWeekend() or $this->isExtraTime($avaria))) {
            return $this->editBusinessLogic($avaria);
        } else {
            //Ver resposta
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ResolucaoAvariaRequest $request
     * @param Avaria $avaria
     * @return Application|RedirectResponse|Redirector
     */
    public function update(ResolucaoAvariaRequest $request, $avaria)
    {
        // return $request;
        $avaria = Avaria::findOrFail($avaria);
        $custoDoMaterial = 0.0;
        if ($request->nome) {
            if (count($request->nome) == count($request->preco) and (count($request->nome)) > 0) {
                Material::where('avaria_id', $avaria)->delete();
                $controller = 1;
                foreach ($request->nome as $key => $val) {
                     if (preg_match('~[0-9]+~', $request->fornecedor[$key])){
                        $fornecedor_id = explode("-", $request->fornecedor[$key])[1];
                        $fornecedor = Fornecedor::find($fornecedor_id);
                        if($fornecedor != NULL){
                            $material = new Material();
                            $material->nome = $request->nome[$key];
                            $material->fornecedor_id = $fornecedor->id;
                            $material->preco = number_format($request->preco[$key], 2);
                            $material->quatidade = $request->quantidade[$key];
                            $material->nr_requisicao = $request->nr_requisicao[$key];
                            $material->avaria()->associate($avaria);
                            $material->save();
                            $custoDoMaterial += $request->quantidade[$key] * $request->preco[$key];
                        }
                     }
                    $controller++;
                }
            }
        }
        $valorTotal = $custoDoMaterial + $request->mao_obra_final;
        $avaria->valor_total = number_format($valorTotal, 2);
        $avaria->custo_do_material = number_format($custoDoMaterial, 2);
        $avaria->fechar = true;
        $avaria->garantia = $request->garantia.' - '.$request->unidade;
        $avaria->comprovativo = $request->comprovativo;
        $avaria->fill($request->except(['garantia', 'unidade']))->save();

        if ($avaria->estado == "pendente") {
            $message = "A resolução da avaria está pendente";
        } elseif ($avaria->estado == "concluido") {
            $message = "A resolução da avaria está concluída";
        }

        return redirect('/avaria')->with(['info'=> $message, 'printA4' => $avaria->id]);
    }


    public function feedback(Request $request, Avaria $avaria){
        $avaria->estado_requisitante = $request->estado_requisitante;
        $avaria->save();
         return redirect()->back()->with('info', 'Obrigado pelo seu parecer . . . ');
    }

    public function setEstado(Request $request, Avaria $avaria){
        $avaria->estado = $request->estado;
        $avaria->save();
        if ($avaria->estado == "andamento") {
            $message = "A resolução da avaria está em andamento";
        } elseif ($avaria->estado == "pendente") {
            $message = "A resolução da avaria está pendente";
        } elseif ($avaria->estado == "concluido") {
            $message = "A resolução da avaria está concluída";
        }
        return redirect('/avaria')->with('info', $message);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param Avaria $avaria
     * @return Response
     */
    public function destroy(Avaria $avaria)
    {
        return abort(404);

    }

    public function responderSolicitacao(RespostaManutencaoRequest $request, $avaria)
    {
        $avaria = Avaria::findOrFail($avaria);
        $days = 0;
        if($avaria->prioridade == 'alta'){
            $days = 2;
        }elseif($avaria->prioridade == 'média'){
            $days = 4;
        }elseif($avaria->prioridade == 'baixa'){
            $days = 5;
        }

        $maxdays = now()->parse($avaria->created_at)->addDays($days);

         $validation = $this->validate($request, [
            'data_para_resolucao' => 'required|date|before:'. $maxdays->toDateString()
        ]);

        if ((Auth::check() and Auth::user()->hasRole($this->constantante::GESTOR_MANUTENCAO))
            or ($avaria->prioridade == 'alta' and ($this->currentDate->isWeekend() or $this->isExtraTime($avaria)))
        ) {
            $tecnico = Tecnico::findOrFail($request->responsavel);
            $avaria->data_para_resolucao = $request->data_para_resolucao;
            $avaria->responsavel = $tecnico->name;
            $avaria->hora_para_resolucao = $request->hora_para_resolucao;
            $resposta = new ManutencaoResposta();
            $resposta->observacao = $request->observacao;
            $resposta->avaria_id = $avaria->id;
            $resposta->tecnico_id = $request->responsavel;
            $resposta->user_id = Auth::id();
            $avaria->save();
            $resposta->save();

            if (Auth::user()->hasRole($this->constantante::GESTOR_MANUTENCAO)) {
                return redirect('/avaria')->with('info', 'O(a) : ' . $avaria->user->name . ' recebeu a resposta');
            } else {
                return redirect(route('avaria.edit', $avaria->id));
            }

        } else {
            return redirect()->back()->with('info', 'Acesso negado . . . ');

        }
    }

    public function exportAvariaPdf($avaria)
    {
        $avaria = Avaria::findOrFail($avaria);
        $view = \View::make('exports.avaria-pdf', compact('avaria'))->render();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($avaria->id . '.pdf');
    }

    public function report(Request $request)
    {
        /*Todos*/
        if (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and isset($request->tecnico) and isset($request->sucursal)
            and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias  do técnico " . $request->tecnico . " <br> do sector de " . $sector->name .
                " em estado " . $request->estado .
                "<br> submetidas pelo usuário " . $user->name .
                " de " . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $avarias = Avaria::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->where('user_id', '=', $request->user)
                ->where('estado', '=', $request->estado)
                ->where('responsavel', '=', $request->tecnico)
                ->where('localizacao', '=', $request->sucursal)
                ->get();

        } elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and !isset($request->tecnico) and !isset($request->sucursal)
            and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $message = "Relatório de avarias  do sector de " . $sector->name .
                "<br> de " . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $avarias = Avaria::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->tecnico) and !isset($request->sucursal)
            and !isset($request->user)) {

            $message = "Relatório de avarias em estado " . ucfirst($request->estado) .
                " de " . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $avarias = Avaria::where('estado', '=', $request->estado)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and !isset($request->tecnico) and !isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);
            $message = "Relatório de avarias  submetidas por " . $user->name .
                "<br> de " . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $avarias = Avaria::where('user_id', '=', $request->user)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and !isset($request->tecnico) and isset($request->sucursal)
            and !isset($request->user)) {

            $message = "Relatório de avarias ocorridas em "
                . ucfirst($request->sucursal) . " de <br>"
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_final)
            and isset($request->data_inicial) and !isset($request->estado)
            and isset($request->tecnico) and !isset($request->sucursal)
            and !isset($request->user)) {
            $message = "Relatório de avarias do técnico "
                . ucfirst($request->tecnico) . " <br>de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $avarias = Avaria::where('responsavel', '=', $request->tecnico)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        }

        /**
         * Envolvendo sector em Dois a Dois
         */

        /**
         * Sector e estado
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->tecnico) and !isset($request->sucursal)
            and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);

            $message = "Relatório de avarias do sector de "
                . ucfirst($sector->name) . " <br> em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $avarias = Avaria::where('estado', '=', $request->estado)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sector e usuario
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and !isset($request->tecnico) and !isset($request->sucursal)
            and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias do sector de "
                . ucfirst($sector->name) . " <br> submetidas por " . $user->name . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $avarias = Avaria::where('user_id', '=', $request->user)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sector e sucursal
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and !isset($request->tecnico) and isset($request->sucursal)
            and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);

            $message = "Relatório de avarias do sector de "
                . ucfirst($sector->name) . "<br> de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . ucfirst($request->sucursal);
            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sector e técnico
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and isset($request->tecnico) and !isset($request->sucursal)
            and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);

            $message = "Relatório de avarias do técnico " . $request->tecnico . " no <br>sector de "
                . ucfirst($sector->name) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $avarias = Avaria::where('responsavel', '=', $request->tecnico)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        }
        /**
         * Envolvendo Técnico em Dois a Dois
         */

        /**
         * Técnico e Sucursal
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and isset($request->tecnico) and isset($request->sucursal)
            and !isset($request->user)) {

            $message = "Relatório de avarias do técnico " . $request->tecnico . " de <br>"
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('responsavel', '=', $request->tecnico)
                ->where('localizacao', '=', $request->sucursal)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Técnico e Usuário
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and isset($request->tecnico) and !isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);
            $message = "Relatório de avarias do técnico " . $request->tecnico . " submetidas por <br>"
                . $user->name . "  de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $avarias = Avaria::where('responsavel', '=', $request->tecnico)
                ->where('user_id', '=', $request->user)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Técnico e Estado
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and isset($request->tecnico) and !isset($request->sucursal)
            and !isset($request->user)) {

            $message = "Relatório de avarias do técnico " . $request->tecnico . "  em estado <br>"
                . ucfirst($request->estado) . "  de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $avarias = Avaria::where('responsavel', '=', $request->tecnico)
                ->where('estado', '=', $request->estado)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        }

        /**
         * Sucursal Dois a Dois...
         */

        /**
         * Sucursal e Usuário
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and !isset($request->tecnico) and isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias submetidas por " . $user->name . " <br>de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('user_id', '=', $request->user)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sucursal e Estado
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->tecnico) and isset($request->sucursal)
            and !isset($request->user)) {

            $message = "Relatório de avarias em estado " . $request->estado . " <br>de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('estado', '=', $request->estado)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * User e Estado
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->tecnico) and !isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias submetidas por " . $user->name
                . " <br> em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $avarias = Avaria::where('user_id', '=', $request->user)
                ->where('estado', '=', $request->estado)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        }
        /**
         * Sector 3 a 3
         */

        /**
         * Sector estado e usuario
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->tecnico) and !isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);
            $sector = Sector::findOrFail($request->sector);

            $message = "Relatório de avarias do sector " . $sector->name
                . " submetidas por " . $user->name
                . " <br> em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $avarias = Avaria::where('user_id', '=', $request->user)
                ->where('estado', '=', $request->estado)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sector estado e sucursal
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->tecnico) and isset($request->sucursal)
            and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);

            $message = "Relatório de avarias do sector " . $sector->name
                . " <br> em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('estado', '=', $request->estado)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sector estado e técnico
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and isset($request->tecnico) and !isset($request->sucursal)
            and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);

            $message = "Relatório de avarias do técnico " . $request->tecnico . " no sector  <br> " . $sector->name
                . " em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $avarias = Avaria::where('responsavel', '=', $request->tecnico)
                ->where('estado', '=', $request->estado)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sector user e técnico
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and isset($request->tecnico) and !isset($request->sucursal)
            and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias do técnico " . $request->tecnico . " no sector  <br> " . $sector->name
                . " submetidas por " . $user->name . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $avarias = Avaria::where('responsavel', '=', $request->tecnico)
                ->where('user_id', '=', $request->user)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sector user e sucursal
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and !isset($request->tecnico) and isset($request->sucursal)
            and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias do sector  <br> " . $sector->name
                . " submetidas por " . $user->name . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('user_id', '=', $request->user)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sector sucursal e técnico
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and isset($request->tecnico) and isset($request->sucursal)
            and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);

            $message = "Relatório de avarias do técnico " . $request->tecnico . " no sector  <br> " . $sector->name
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('responsavel', '=', $request->tecnico)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Técnico estado e sucursal
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and isset($request->tecnico) and isset($request->sucursal)
            and !isset($request->user)) {


            $message = "Relatório de avarias do técnico " . $request->tecnico .
                "<br> em estado  " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('estado', '=', $request->estado)
                ->where('responsavel', '=', $request->tecnico)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Técnico usuario e sucursal
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and isset($request->tecnico) and isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias do técnico " . $request->tecnico .
                "<br> submetidas por " . $user->name . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('user_id', '=', $request->user)
                ->where('responsavel', '=', $request->tecnico)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         *Sucursal User e estado
         *
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->tecnico) and isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias submetidas por " . $user->name . " em estado "
                . ucfirst($request->estado) . " <br>de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('user_id', '=', $request->user)
                ->where('estado', '=', $request->estado)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         *Sector, Sucursal, User e estado
         *
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and isset($request->tecnico) and isset($request->sucursal)
            and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);

            $message = "Relatório de avarias do técnico " . $request->tecnico . " no <br>sector de "
                . $sector->name . "  em estado "
                . ucfirst($request->estado) . " <br> de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('localizacao', '=', $request->sucursal)
                ->where('sector_id', '=', $request->sector)
                ->where('responsavel', '=', $request->tecnico)
                ->where('estado', '=', $request->estado)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        } /**
         *Sector, Sucursal, User e estado
         *
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and isset($request->tecnico) and !isset($request->sucursal)
            and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias do técnico " . $request->tecnico . "
             <br> submetidas por " . $user->name . "
             no sector de "
                . $sector->name . " em estado <br>"
                . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $avarias = Avaria::where('user_id', '=', $request->user)
                ->where('sector_id', '=', $request->sector)
                ->where('responsavel', '=', $request->tecnico)
                ->where('estado', '=', $request->estado)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         *Sector, Sucursal, User e estado
         *
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and isset($request->tecnico) and isset($request->sucursal)
            and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias do técnico " . $request->tecnico . "
             submetidas por <br> " . $user->name . "
              de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('user_id', '=', $request->user)
                ->where('sector_id', '=', $request->sector)
                ->where('responsavel', '=', $request->tecnico)
                ->where('localizacao', '=', $request->sucursal)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         *Técnico, Sucursal, User e estado
         *
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and isset($request->tecnico) and isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias do técnico " . $request->tecnico . "
             submetidas por <br> " . $user->name . "
              em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final))
                . " em " . $request->sucursal;

            $avarias = Avaria::where('user_id', '=', $request->user)
                ->where('estado', '=', $request->estado)
                ->where('responsavel', '=', $request->tecnico)
                ->where('localizacao', '=', $request->sucursal)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         *Técnico,  User e estado
         *
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and isset($request->tecnico) and !isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $message = "Relatório de avarias do técnico " . $request->tecnico . "
             submetidas por <br> " . $user->name . "
              em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $avarias = Avaria::where('user_id', '=', $request->user)
                ->where('estado', '=', $request->estado)
                ->where('responsavel', '=', $request->tecnico)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and !isset($request->tecnico) and !isset($request->sucursal)
            and !isset($request->user)) {
            $message = "Relatório de avarias de "
                . date('d/m/Y', strtotime($request->data_inicial)) .
                " até "
                . date('d/m/Y', strtotime($request->data_final));
            $avarias = Avaria::whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)->get();
        } else {
            $message = "Relatório de todas avarias até " . date('d/m/Y', strtotime(Carbon::now()));
            $avarias = Avaria::all();
        }

        return \view('avarias.data-export', compact('avarias'));
    }
}
