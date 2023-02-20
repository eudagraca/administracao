<?php

namespace App\Http\Controllers;

use App\AlertaJustificacao;
use App\DadosFalta;
use App\Http\Requests\JustificacaoFaltaRequest;
use App\JustificaoFalta;
use App\MyUtils;
use App\Sector;
use App\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Validator;
use PDF;

class JustificaoFaltaController extends Controller
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
            return view('justificacao-falta.index')->with('justificacoes', JustificaoFalta::where('is_active', 1)->get());
        } elseif (Auth::user()->sector) {
            return view('justificacao-falta.index')->with('justificacoes', JustificaoFalta::where('sector_id', Auth::user()->sector->id)->where('is_active', 1)->get());
        } else if (Auth::check()) {
            return view('justificacao-falta.index')->with('justificacoes', JustificaoFalta::where('user_id', Auth::id())->where('is_active', 1)->get());
        }

    }

    public function todasJustificacoes()
    {
        return view('justificacao-falta.all')->with('justificacoes', JustificaoFalta::all());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->getSector() == null) {
            return redirect(route('justificacao.index'))->with('warning', 'Contacte o administrador para atribuir-lhe um sector');
        }
        return view('justificacao-falta.create');
    }

     public function todasEscalas()
    {
        return view('justificacao-falta.all');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JustificacaoFaltaRequest $request)
    {
        // return $request;

        $id = IdGenerator::generate(['table' => 'justificao_faltas', 'length' => 6, 'prefix' => 'JF-']);

        $justificaoFalta = new JustificaoFalta;
        $justificaoFalta->id = $id . '-' . date('Y');
        $justificaoFalta->tipo_colaborador = $request->tipo_colaborador;
        $justificaoFalta->tipo_justificacao = $request->tipo_justificacao;
        $justificaoFalta->assunto = $request->assunto;
        $justificaoFalta->forma_compensacao = $request->forma_compensacao;
        $justificaoFalta->motivo = $request->motivo;
        $justificaoFalta->user_id = Auth::id();
        $justificaoFalta->sector_id = Auth::user()->getSector()->id;
        $justificaoFalta->save();

        AlertaJustificacao::create(
            [
                'justificao_falta_id' => $justificaoFalta->id,
                'fechada' => false,
            ]
        );

        if (count($request->data_escala) > 0) {
            for ($i = 0; $i < count($request->data_escala); $i++) {
                DadosFalta::create(
                    [
                        'data_escala' => $request->data_escala[$i],
                        'hora_inicio_escala' => $request->hora_inicio_escala[$i],
                        'intervalo' => $request->intervalo[$i],
                        'hora_fim_escala' => $request->hora_fim_escala[$i],
                        'hora_inicio_falta' => $request->hora_inicio_falta[$i],
                        'hora_fim_falta' => $request->hora_fim_falta[$i],
                        'justificao_falta_id' => $justificaoFalta->id,
                    ]
                );
            }
        }
        return redirect(route('justificacao.index'))->with('success', 'Pedido submetido');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JustificaoFalta  $justificaoFalta
     * @return \Illuminate\Http\Response
     */
    public function show($justificaoFalta)
    {
        $justificaoFalta = JustificaoFalta::findOrFail($justificaoFalta);
        return view('justificacao-falta.details', compact('justificaoFalta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JustificaoFalta  $justificaoFalta
     * @return \Illuminate\Http\Response
     */
    public function edit($justificaoFalta)
    {
        $justificacao = JustificaoFalta::findOrFail($justificaoFalta);


        $util = new MyUtils();
        $hoje = $util->dateTodayPT();

        $view = \View::make('exports.justificacao', compact(['justificacao', 'hoje']))->render();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($justificacao->id . '.pdf');

    }

    public function parecer($justificaoFalta)
    {
        $justificaoFalta = JustificaoFalta::findOrFail($justificaoFalta);

        $dadosJustificacao = DadosFalta::where('justificao_falta_id', $justificaoFalta->id)->get();

        return view('justificacao-falta.create-pelo-rh', compact(['justificaoFalta', 'dadosJustificacao']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JustificaoFalta  $justificaoFalta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $justificaoFalta)
    {
        $justificaoFalta = JustificaoFalta::findOrFail($justificaoFalta);

        if (Auth::user()->sector->id == $justificaoFalta->sector_id) {

            $customAttributes = [
                'parecer_chefe' => '',
            ];
            $rules = [
                'parecer_chefe' => ['required', 'in:Não Favorável,Favorável'],
            ];

            Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

            $justificaoFalta->parecer_chefe = $request->parecer_chefe;

        }elseif (Auth::user()->hasRole('gestor-recursos-humanos')) {

            $customAttributes = [
                'observacoes' => 'Observações',
                'parecer_rh' => '',
            ];
            $rules = [
                'observacoes' => ['required', 'string', 'min:6'],
                'parecer_rh' => ['required', 'in:Reúne requisitos,Não reúne requisitos'],
            ];

            Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

            $dadosJustificacao = DadosFalta::where('justificao_falta_id', $justificaoFalta->id)->get();

            foreach ($dadosJustificacao as $dados) {
                $dados->data_rh = $request->data_rh;
                $dados->hora_fim_rh = $request->hora_fim_rh;
                $dados->hora_inicio_rh = $request->hora_inicio_rh;
                $dados->intervalo_rh = $request->intervalo_rh;
                $dados->save();
            }

            $justificaoFalta->parecer_rh = $request->parecer_rh;
            $justificaoFalta->observacoes = $request->observacoes;
        }

        if ($justificaoFalta->parecer_rh != null and $justificaoFalta->parecer_chefe != null) {
            $justificaoFalta->is_active = false;
        }
        $justificaoFalta->save();

        return redirect(route('justificacao.show', $justificaoFalta->id))
            ->with('warning', 'Submeteu o seu parecer para o pedido');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JustificaoFalta  $justificaoFalta
     * @return \Illuminate\Http\Response
     */
    public function destroy(JustificaoFalta $justificaoFalta)
    {
        return abort(404);
    }


    public function report(Request $request)
    {

        if (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $justificacoes = JustificaoFalta::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->where('user_id', '=', $request->user)->get();

        } elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->user)) {

            $justificacoes =  JustificaoFalta::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->user)) {

            $justificacoes =  JustificaoFalta::whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $justificacoes =  JustificaoFalta::where('user_id', '=', $request->user)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        }

        return \view('justificacao-falta.data-export', compact('justificacoes'));
    }
}
