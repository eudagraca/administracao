<?php

namespace App\Http\Controllers;

use App\AlertaProlongamento;
use App\DadosProlongamento;
use App\MyUtils;
use App\Prolongamento;
use App\Sector;
use App\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF;
use Validator;


class ProlongamentoController extends Controller
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
            return view('prolongamento.index')->with('prolongamentos', Prolongamento::where('is_active', 1)->get());
        } elseif (Auth::user()->sector) {
            return view('prolongamento.index')->with('prolongamentos', Prolongamento::where('sector_id', Auth::user()->sector->id)->where('is_active', 1)->get());
        } else if (Auth::check()) {
            return view('prolongamento.index')->with('prolongamentos', Prolongamento::where('user_id', Auth::id())->where('is_active', 1)->get());
        }
    }

    public function todosProlongamentos()
    {
        return view('prolongamento.all')->with('prolongamentos', Prolongamento::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->getSector()) {
            return view('prolongamento.create');
        }

        return redirect()->back()->with('warning', 'Não tem acesso a esta funcionalidade por não estar vinculado a um sector');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = IdGenerator::generate(['table' => 'prolongamentos', 'length' => 7, 'prefix' => 'PRL-']);

        $prolongamento = new Prolongamento();
        $prolongamento->id = $id . '-' . date('Y');
        $prolongamento->tipo_colaborador = $request->tipo_colaborador;
        $prolongamento->tipo = $request->tipo_escala;
        $prolongamento->pedido_de = $request->pedido_de;
        $prolongamento->forma_compensacao = $request->forma_compensacao;
        $prolongamento->motivo = $request->motivo;
        $prolongamento->sector_id = Auth::user()->getSector()->id;
        $prolongamento->user_id = Auth::id();
        $prolongamento->save();

        for ($i = 0; $i < count($request->data_prolongamento); $i++) {
            DadosProlongamento::create([
                'prolongamento_id' => $prolongamento->id,
                'data_prolongamento' => $request->data_prolongamento[$i],
                'hora_inicio_prolongamento' => $request->hora_inicio_prolongamento[$i],
                'hora_fim_prolongamento' => $request->hora_fim_prolongamento[$i],
            ]);
        }

        AlertaProlongamento::create(['prolongamento_id' => $prolongamento->id]);

        return redirect(route('prolongamento.index'))->with('info', 'Pedido prolongamento submetido');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prolongamento  $prolongamento
     * @return \Illuminate\Http\Response
     */
    public function show(Prolongamento $prolongamento)
    {
        if (Auth::user()->hasRole('gestor-recursos-humanos')) {
            if ($prolongamento->estado == "Nao lido") {
                $prolongamento->estado = "Lido";
                $prolongamento->save();
            }
        }
        return view('prolongamento.details', compact('prolongamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prolongamento  $prolongamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Prolongamento $prolongamento)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prolongamento  $prolongamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prolongamento $prolongamento)
    {
        if (Auth::user()->sector->id == $prolongamento->sector_id) {

            $customAttributes = [
                'parecer_chefe' => '',
            ];
            $rules = [
                'parecer_chefe' => ['required', 'in:Não Autorizo,Autorizo'],
            ];

            Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();
            $prolongamento->parecer_chefe = $request->parecer_chefe;

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

            $prolongamento->observacoes = $request->observacao;
            $prolongamento->parecer_rh = $request->parecer_rh;

        }else{
            return abort(403);
        }

        if ($prolongamento->parecer_rh != null and $prolongamento->parecer_chefe != null) {
            $prolongamento->estado = "Respondido";
            $prolongamento->is_active = 0;
        }

        $prolongamento->save();

        return redirect(route('prolongamento.show', $prolongamento->id))->with('warning', 'Parecer enviado');
    }

    public function makePDF($prolongamento)
    {
        $prolongamento = Prolongamento::findOrFail($prolongamento);

        $util = new MyUtils();
        $hoje = $util->dateTodayPT();

        $view = \View::make('exports.prolongamento', compact(['prolongamento', 'hoje']))->render();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($prolongamento->id . '.pdf');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prolongamento  $prolongamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prolongamento $prolongamento)
    {
        return abort(404);
    }

        public function report(Request $request)
    {

        if (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $message = "Relatório de prolongamento do sector <b>" . $sector->name .
            "</b><br> submetidas pelo usuário " . $user->name .
            " de " . date('d/m/Y', strtotime($request->data_inicial))
            . " até " . date('d/m/Y', strtotime($request->data_final));

            $prolongamentos = Prolongamento::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->where('user_id', '=', $request->user)->get();

        } elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $message = "Relatório de prolongamento do sector <b>" . $sector->name .
            "</b><br> de " . date('d/m/Y', strtotime($request->data_inicial))
            . " até " . date('d/m/Y', strtotime($request->data_final));

            $prolongamentos = Prolongamento::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->user)) {

            $message = "Relatório de prolongamento de " . date('d/m/Y', strtotime($request->data_inicial)) . " até " . date('d/m/Y', strtotime($request->data_final));
            $prolongamentos = Prolongamento::whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->user)) {

            $user = User::findOrFail($request->user);
            $message = "Relatório de prolongamento submetidas por <b>" . $user->name .
            "</b><br> de " . date('d/m/Y', strtotime($request->data_inicial))
            . " até " . date('d/m/Y', strtotime($request->data_final));

            $prolongamentos = Prolongamento::where('user_id', '=', $request->user)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        }

        return \view('prolongamento.data-export', compact('prolongamentos'));
    }
}
