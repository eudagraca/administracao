<?php

namespace App\Http\Controllers;

use App;
use App\MyUtils;
use App\Tarefas;
use App\Http\Requests\RequisicaoTransporteRequest;
use App\Local;
use App\Motorista;
use App\RequisicaoTransporte;
use App\Sector;
use App\Transporte;
use App\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Validator;
use PDF;
use App\PreRequisicao;

class RequisicaoTransporteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::check() and Auth::user()->hasRole('gestor-administracao')) {
            return view('transporte.requisicao.index')->with('requisicoes', App\PreRequisicao::where('estado', 'pendente')->where('foi_aceite','!=','negado')->get());
        } else {
            return view('transporte.requisicao.index')->with('requisicoes', App\PreRequisicao::where('user_id', Auth::id())->get());
        }
    }


    public function allRequests()
    {
        return view('transporte.requisicao.all')
            ->with(['preRequisicoes' => App\PreRequisicao::all(),
                'sectores' => Sector::all(), 'users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequisicaoTransporteRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(RequisicaoTransporteRequest $request)
    {
        $status = "";
        if ($request->foi_aceite == "aceite") {

            $requisicao = new RequisicaoTransporte();
            $id = IdGenerator::generate(['table' => 'requisicao_transportes', 'length' => 6, 'prefix' => 'RT-']);
            $requisicao->id = $id . '-' . date('Y');
            $requisicao->user_id = Auth::id();
            $requisicao->dia_exata= date('Y-m-d H:i:s', strtotime("$request->dia_exata $request->hora_exata "));
            $requisicao->fill($request->except(['foi_aceite', 'hora_exata', 'dia_exata']))->save();

            $preRequisicao = App\PreRequisicao::find($request->pre_requisicao_id);
            $preRequisicao->foi_aceite = $request->foi_aceite;
            $preRequisicao->save();

            $transporte = Transporte::find($request->transporte_id);
            $transporte->em_servico = true;
            $transporte->save();

            $motorista = Motorista::find($request->motorista_id);
            $motorista->em_servico = true;
            $motorista->save();

            Tarefas::create([
                'requisicao_transporte_id' => $requisicao->id
            ]);

            $status = "aceite";

        } elseif ($request->foi_aceite == "negado") {
            $preRequisicao = App\PreRequisicao::find($request->pre_requisicao_id);
            $preRequisicao->foi_aceite = $request->foi_aceite;
            $preRequisicao->estado = "negada";
            $preRequisicao->observacoes = $request->observacoes;
            $preRequisicao->save();
            $negada = new App\RequisicoesNegada();
            $negada->user_id = Auth::id();
            $negada->pre_requisicao_id = $preRequisicao->id;
            $negada->save();
            $status = "negada";
        }

        return redirect('/requisicaoTransporte')->with('success', 'Requisição de transporte foi ' . ucfirst($status));
    }

    /**
     * Display the specified resource.
     *
     * @param RequisicaoTransporte $requisicaoTransporte
     * @return void
     */
    public function show(RequisicaoTransporte $requisicaoTransporte)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RequisicaoTransporte $requisicaoTransporte
     * @return Application|Factory|View
     */
    public function edit(RequisicaoTransporte $requisicaoTransporte)
    {
        if (Auth::check() and Auth::user()->hasRole('gestor-administracao')) {
            $requisicao = $requisicaoTransporte;
            if (Auth::id() != $requisicao->user_id) {
                $this->read($requisicao->id);
            }
            return \view('transporte.requisicao.details', compact('requisicao'));
        } else {
            return abort(404);
        }
    }

    public function read($id)
    {
        $requisicao = RequisicaoTransporte::findOrFail($id);
        if ($requisicao->foi_aceite == "nao lida") {
            $requisicao->foi_aceite = "lida";
            $requisicao->save();
        }
    }

    public function gerarPDF($id)
    {

        $preRequisicao = PreRequisicao::where('id', '=', $id)->where('estado', 'entregue')->first();

        if ($preRequisicao != NULL) {
            $view = \View::make('exports.requisicao', compact(['preRequisicao']))->render();
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
            $pdf = App::make('dompdf.wrapper');
            $pdf->setPaper('a4', 'portrait')->setWarnings(false);
            $pdf->loadHTML($view);
            return $pdf->stream($preRequisicao->requisicao->id . '.pdf');
        } else {
            return redirect(route('normal.dashboard'));
        }

    }

    public function exportPreReqPdf($pre)
    {
        $preReq = App\PreRequisicao::findOrFail($pre);
        $date = new MyUtils();
        $hoje = $date->dateTodayPT();
        $view = \View::make('exports.pre-requisicao', compact(['preReq', 'hoje']))->render();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a5', 'landscape')->setWarnings(false);
        $pdf->loadHTML($view);
        return $pdf->stream('Pre-Requisicao' . date('m-Y', strtotime(Carbon::now())) . '-' . $preReq->id . '.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transporte $transporte
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Transporte $transporte)
    {

        $messages = ['id.exists' => 'Tentou responder a uma requisicao que não existe'];

        $customAttributes = [
            'id' => 'Requisição',
            'foi_aceite' => 'Resposta',
            'observacoes_gestor' => 'de Observações',
        ];
        $rules = [
            'id' => 'required|exists:requisicao_transportes,id',
            'foi_aceite' => 'required|in:aceite,negado',
            'observacoes_gestor' => 'required|string|min:5',
        ];

        Validator::make($request->all(), $rules, $messages)->setAttributeNames($customAttributes)->validate();

        $requisicao = RequisicaoTransporte::findOrFail($transporte->id);
        $requisicao->foi_aceite = $request->foi_aceite;
        $requisicao->observacoes_gestor = $request->observacoes_gestor;

        if ($request->foi_aceite == "aceite") {
            $motorista = Motorista::findOrFail($requisicao->motorista_id);
            $motorista->is_active = false;
            $motorista->save();

            $transporte->esta_disponivel = false;
            $transporte->save();
        } else if ($request->foi_aceite == "negado") {
            $requisicao->estado = $request->foi_aceite;
        }
        $requisicao->save();
        $requisicaoStatusName = $request->foi_aceite == 'aceite' ? 'aceitada' : 'negada';
        return redirect('/requisicaoTransporte')->with('success', 'Requisição de transporte ' . $requisicaoStatusName);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RequisicaoTransporte $requisicaoTransporte
     * @return Response
     */
    public function destroy(RequisicaoTransporte $requisicaoTransporte)
    {
        return abort(404);
    }

    public function selectViagem(Request $request)
    {
        $value = $request->get('value');
        $output = '<option disabled selected>Seleccione o destino</option>';

        $locais = Local::where('designacao', $value)->get();
        foreach ($locais as $local) {
            $output .= '<option value="' . $local->id . '">' . $local->name . '</option>';
        }

        return $output;
    }

    public function provinces()
    {
        return json_decode(Storage::get('provincias.json'));
    }

    private function paises()
    {
        return json_decode(Storage::get('paises.json'));
    }

    private function local()
    {
        return json_decode(Storage::get('sucursal.json'));
    }

    public function isEntregue(Request $request)
    {
        $request->validate([
            'id' => ['required|exists:requisicao_transportes,id'],
            'estado' => ['required|in:pendente, entregue'],
        ]);
        $requisicao = RequisicaoTransporte::findOrFail($request->id);
        $requisicao->estado = $request->estado;
        $requisicao->save();
    }

    public function report(Request $request)
    {

        if (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $message = "Relatório de requisições do sector <b>" . $sector->name .
                "</b> em estado <b>" . ucfirst($request->estado) .
                "</b><br> submetidas pelo usuário " . $user->name .
                " de " . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $requisicoes = PreRequisicao::whereHas('requisicao', function ($query) {

            })->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->where('user_id', '=', $request->user)
                ->where('estado', '=', $request->estado)->get();

        }elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and !isset($request->user)){

            $sector = Sector::findOrFail($request->sector);
            $message = "Relatório de requisições  do sector <b>" . $sector->name .
                "</b><br> de " . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $requisicoes = PreRequisicao::whereHas('requisicao', function ($query) {

            })->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->user)) {

            $message = "Relatório de requisições em estado <b>" . ucfirst($request->estado) .
                "</b> de " . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $requisicoes = PreRequisicao::whereHas('requisicao', function ($query) {

            })->where('estado', '=', $request->estado)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);
            $message = "Relatório de requisições  submetidas por <b>" . $user->name .
                "</b><br> de " . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $requisicoes = PreRequisicao::whereHas('requisicao', function ($query) {

            })->where('user_id', '=', $request->user)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        } /**
         * Envolvendo sector em Dois a Dois
         */

        /**
         * Sector e estado
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);

            $message = "Relatório de requisições do sector de <b>"
                . ucfirst($sector->name) . "</b> <br> em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $requisicoes = PreRequisicao::whereHas('requisicao', function ($query) {

            })->where('estado', '=', $request->estado)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } /**
         * Sector e usuario
         */
        elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->estado)
            and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $message = "Relatório de requisições do sector de <b>"
                . ucfirst($sector->name) . "</b> <br> submetidas por " . $user->name . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $requisicoes = PreRequisicao::whereHas('requisicao', function ($query) {

            })->where('user_id', '=', $request->user)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        }/**
         * User e Estado
         */
        elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->estado)
            and !isset($request->tecnico) and !isset($request->sucursal)
            and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $message = "Relatório de requisições submetidas por <b>" . $user->name
                . "</b> <br> em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $requisicoes = PreRequisicao::whereHas('requisicao', function ($query) {

            })->where('user_id', '=', $request->user)
                ->where('estado', '=', $request->estado)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        }/**
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

            $message = "Relatório de requisições do sector " . $sector->name
                . " submetidas por <b>" . $user->name
                . "</b> <br> em estado " . ucfirst($request->estado) . " de "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));

            $requisicoes = PreRequisicao::whereHas('requisicao', function ($query) {

            })->where('user_id', '=', $request->user)
                ->where('estado', '=', $request->estado)
                ->where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        }else if(isset($request->data_inicial) and isset($request->data_final)){


            $message = "Relatório de requisições ocoridas entre "
                . date('d/m/Y', strtotime($request->data_inicial))
                . " até " . date('d/m/Y', strtotime($request->data_final));
            $requisicoes = PreRequisicao::whereHas('requisicao', function ($query) {

            })->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        }else{
            return redirect()->back();
        }

        return \view('transporte.requisicao.data-export', compact('requisicoes'));
    }

}
