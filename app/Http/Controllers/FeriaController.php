<?php

namespace App\Http\Controllers;

use App\AlertaFeria;
use App\Feria;
use App\Http\Requests\FeriaRequest;
use App\MyUtils;
use App\Sector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF;
use Validator;

class FeriaController extends Controller
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
        $feriaP = Feria::where('estado', '=', 'aceite')->where('confirmed', '=', 'Pendente')->where('substituto_id', '=', Auth::id())->get();

        if (Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos')) {
            return view('ferias.index')->with([
                'feriaP' => $feriaP,
                'ferias' => Feria::whereDate('data_termino', '>=', Carbon::now())->where('confirmed', '=', 'Pendente')->where('estado', '!=', 'negada')->get()]);
        } else {

            return view('ferias.index')->with([
                'feriaP' => $feriaP,
                'ferias' => Feria::where('user_id', '=', Auth::id())->orWhere('substituto_id', '=', Auth::id())
                ->get()]);
        }
    }

    public function todasFerias()
    {

        return view('ferias.all')->with('ferias', Feria::all());
    }

    public function substituicoes()
    {
        $feriaP = Feria::where('estado', '=', 'aceite')->where('confirmed', '=', 'Pendente')->where('substituto_id', '=', Auth::id())->get();

        return view('ferias.index')->with([
            'feriaP' => $feriaP,
            'ferias' => Feria::where('substituto_id', Auth::id())->where('estado', '=', 'aceite')->get(),
            'title' => 'Lista de solicitações de substituição']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ferias.create')->with(['sectores' => Sector::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeriaRequest $request)
    {
        $feria = new Feria();
        $feria->user_id = Auth::id();
        $feria->substituto_id = $request->user;
        $feria->anos_trabalho = $request->anos_trabalho;
        $feria->funcao = $request->funcao;
        $feria->data_inicio = $request->data_inicio;
        $feria->data_termino = $request->data_termino;
        $feria->periodo = $request->periodo;
        $feria->save();

        AlertaFeria::create(['feria_id' => $feria->id]);

        return redirect(route('feria.index'))->with('success', 'Pedido de férias enviado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ferias  $ferias
     * @return \Illuminate\Http\Response
     */
    public function show($feria)
    {
        $feria = Feria::findOrFail($feria);

        if (Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos')) {
            if ($feria->estado == 'nao lida') {
                $feria->estado = 'lida';
                $feria->save();
            }
        }
        return view('ferias.details', compact('feria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ferias  $ferias
     * @return \Illuminate\Http\Response
     */
    public function edit($feria)
    {
        // make PDF

        $feria = Feria::findOrFail($feria);
        $util = new MyUtils();
        $hoje = $util->dateTodayPT();
        $contratante = 'Max Vida';

        $view = \View::make('exports.carta-ferias', compact(['feria', 'hoje']))->render();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a5', 'landscape')->setWarnings(false);

        $pdf->loadHTML($view);
        return $pdf->stream('Féria - ' . $feria->user->name . ' ' . Carbon::now()->year() . '.pdf');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ferias  $ferias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $feria)
    {
        $feria = Feria::findOrFail($feria);

        if ((Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos')) and $feria->estado == 'lida' || $feria->estado == 'nao lida') {

            $customAttributes = [
                'estado' => 'Resposta',
                'justificacao' => 'Justificação',
            ];

            $rules = [
                'estado' => 'required|in:negada,aceite',
                'justificacao' => 'required_if:estado,==,negada',
            ];

            Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();


            $feria->estado = $request->estado;
            $feria->justificacao = $request->justificacao;
            $feria->save();

            if ($request->estado == 'negada') {
                $estado = 'negado';
            } elseif ($request->estado == 'aceite') {
                $estado = 'aceite';
            }
            return redirect('/feria')->with('info', 'Pedido de fárias de ' . $feria->user->name . ' foi ' . $estado);
        } elseif ($feria->estado == 'aceite' and $feria->substituto_id == Auth::id()) {
            $customAttributes = [
                'confirmed' => 'Confirmação',
            ];

            $rules = [
                'confirmed' => 'required|in:Sim,Nao',
            ];

            Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

            $feria->confirmed = $request->confirmed;
            $feria->save();

            if ($request->confirmed == 'Nao') {
                $estado = 'Negou';
            } elseif ($request->confirmed == 'Sim') {
                $estado = 'Aceitou';
            }

            return redirect('/feria')->with('info', $estado.' substituir ' . $feria->user->name . ' em seu periodo de fárias');

        }else{
            return redirect('/feria')->with('info', 'Solicitação desconhecida');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ferias  $ferias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feria $ferias)
    {
        return abort(404);

    }
}
