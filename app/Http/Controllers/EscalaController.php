<?php

namespace App\Http\Controllers;

use App\AlertaEscala;
use App\DadosEscala;
use App\Escala;
use App\MyUtils;
use App\Sector;
use App\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF;
use Validator;

class EscalaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos')) {
            return view('escala.index')->with('escalas', Escala::where('is_active', 1)->get());

        } elseif (Auth::user()->sector) {
            return view('escala.index')->with('escalas', Escala::where('sector_id', Auth::user()->sector->id)->where('is_active', 1)->get());
        } else if (Auth::check()) {
            return view('escala.index')->with('escalas', Escala::where('user_id', Auth::id())->where('is_active', 1)->get());

        }

    }

    public function todasEscalas()
    {
        return view('escala.all')->with('escalas', Escala::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->getSector() == null) {
            return redirect(route('escala.index'))->with('warning', 'Contacte o administrador para atribuir-lhe um sector');
        }
        return view('escala.create')->with(['sectores' => Sector::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'escalas', 'length' => 7, 'prefix' => 'ESC-']);

        $escala = new Escala();
        $escala->id = $id . '-' . date('Y');
        $escala->tipo_colaborador = $request->tipo_colaborador;
        $escala->tipo = $request->tipo_escala;
        $escala->pedido_de = $request->pedido_de;
        $escala->forma_compensacao = $request->forma_compensacao;
        $escala->motivo = $request->motivo;
        $escala->sector_id = Auth::user()->getSector()->id;
        $escala->user_id = Auth::id();
        $escala->save();

        for ($i = 0; $i < count($request->data_escala); $i++) {
            DadosEscala::create([
                'escala_id' => $escala->id,
                'data_escala' => $request->data_escala[$i],
                'hora_entrada' => $request->hora_entrada[$i],
                'intervalo' => $request->intervalo[$i],
                'hora_final' => $request->hora_final[$i],
                'data_nova_escala' => $request->data_nova_escala[$i],
                'hora_inicio_nova_escala' => $request->hora_inicio_nova_escala[$i],
                'intervalo_nova_escala' => $request->intervalo_nova_escala[$i],
                'hora_fim_nova_escala' => $request->hora_fim_nova_escala[$i],
            ]);
        }

        AlertaEscala::create(['escala_id' => $escala->id]);

        return redirect(route('escala.index'))->with('info', 'Pedido alteração de escala submetida');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Escala  $escala
     * @return \Illuminate\Http\Response
     */
    public function show(Escala $escala)
    {
        if (Auth::user()->hasRole('gestor-recursos-humanos')) {

            if ($escala->estado == "Nao lido") {
                $escala->estado = "Lido";
                $escala->save();
            }
            return view('escala.details', compact('escala'));
        } elseif (Auth::user()->sector) {
            if (Auth::user()->sector->id == $escala->sector->id) {
                return view('escala.details', compact('escala'));
            }
        } else {
            if (Auth::id() == $escala->user->id) {
                return view('escala.details', compact('escala'));
            } else {
                abort(404);
            }
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Escala  $escala
     * @return \Illuminate\Http\Response
     */
    public function edit(Escala $escala)
    {
        return abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Escala  $escala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Escala $escala)
    {
        if (Auth::user()->sector->id == $escala->sector_id) {
            $customAttributes = [
                'parecer_chefe' => '',
            ];
            $rules = [
                'parecer_chefe' => ['required', 'in:Não Autorizo,Autorizo'],
            ];

            Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

            $escala->parecer_chefe = $request->parecer_chefe;
        } elseif (Auth::user()->hasRole('gestor-recursos-humanos')) {

            $customAttributes = [
                'observacao' => 'Observação',
                'parecer_rh' => '',
            ];
            $rules = [
                'observacao' => ['required', 'string', 'min:6'],
                'parecer_rh' => ['required', 'in:Não Reúne Requisitos,Reúne Requisitos'],
            ];

            Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

            $escala->observacoes = $request->observacao;
            $escala->parecer_rh = $request->parecer_rh;

        } else {
            return abort(403);
        }

        if ($escala->parecer_rh != null and $escala->parecer_chefe != null) {
            $escala->estado = "Respondido";
            $escala->is_active = 0;
        }
        $escala->save();

        return redirect(route('escala.show', $escala->id))->with('warning', 'Parecer enviado');
    }

    public function makePDF($escala)
    {
        $escala = Escala::findOrFail($escala);

        $util = new MyUtils();
        $hoje = $util->dateTodayPT();

        $view = \View::make('exports.escala', compact(['escala', 'hoje']))->render();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($escala->id . '.pdf');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Escala  $escala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escala $escala)
    {
        return abort(404);

    }

    public function report(Request $request)
    {

        if (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $escalas = Escala::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->where('user_id', '=', $request->user)->get();

        } elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->user)) {

            $escalas = Escala::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->user)) {

            $escalas = Escala::whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $escalas = Escala::where('user_id', '=', $request->user)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        }

        return \view('escala.data-export', compact('escalas'));
    }
}
