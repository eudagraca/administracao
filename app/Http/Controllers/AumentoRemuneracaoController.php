<?php

namespace App\Http\Controllers;

use App\AumentoRemuneracao;
use App\Sector;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use PDF;

class AumentoRemuneracaoController extends Controller
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
            return view('pedido-remuneracao.index')->with('remuneracoes', AumentoRemuneracao::where('estado', 'Pendente')->orWhere('estado', 'Enviada')->get());
        } elseif (Auth::check()) {
            return view('pedido-remuneracao.index')->with('remuneracoes', AumentoRemuneracao::where('user_id', Auth::id())->get());
        }
    }


    public function todas()
    {

        return view('pedido-remuneracao.all')->with('remuneracoes', AumentoRemuneracao::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->getSector() == null) {
            return redirect(route('remuneracao.index'))->with('warning', 'Contacte o administrador para atribuir-lhe um sector');
        }

        return view('pedido-remuneracao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customAttributes = [
            'motivacao' => 'Motivação',
        ];
        $rules = [
            'motivacao' => ['required', 'string', 'min:6'],
        ];

        Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

        AumentoRemuneracao::create([
            'sector_id' => Auth::user()->getSector()->id,
            'user_id' => Auth::id(),
            'motivacao' => $request->motivacao
        ]);

        return redirect(route('remuneracao.index'))->with('success', 'Pedido de remuneração enviado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AumentoRemuneracao  $aumentoRemuneracao
     * @return \Illuminate\Http\Response
     */
    public function show($aumentoRemuneracao)
    {
        $aumentoRemuneracao = AumentoRemuneracao::find($aumentoRemuneracao);
        return view('pedido-remuneracao.details')->with('remuneracao', $aumentoRemuneracao);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AumentoRemuneracao  $aumentoRemuneracao
     * @return \Illuminate\Http\Response
     */
    public function edit($aumentoRemuneracao)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AumentoRemuneracao  $aumentoRemuneracao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $aumentoRemuneracao)
    {
        $aumentoRemuneracao = AumentoRemuneracao::findOrFail($aumentoRemuneracao);
        $customAttributes = [
            'estado' => 'Resposta do pedido',
        ];
        $rules = [
            'estado' => ['required', 'in:Autorizado,Não Autorizado'],
        ];

        Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

        $aumentoRemuneracao->estado = $request->estado;
        $aumentoRemuneracao->save();

        return redirect(route('remuneracao.show', $aumentoRemuneracao->id))->with('info', 'Parecer enviado como: '.strtolower($request->estado));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AumentoRemuneracao  $aumentoRemuneracao
     * @return \Illuminate\Http\Response
     */
    public function destroy(AumentoRemuneracao $aumentoRemuneracao)
    {
        return abort(404);

    }


     public function report(Request $request)
    {

        if (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->user)) {

            $sector = Sector::findOrFail($request->sector);
            $user = User::findOrFail($request->user);

            $remuneracoes = AumentoRemuneracao::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->where('user_id', '=', $request->user)->get();

        } elseif (isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->user)) {

            $remuneracoes =  AumentoRemuneracao::where('sector_id', '=', $request->sector)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->user)) {

            $remuneracoes =  AumentoRemuneracao::whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } elseif (!isset($request->sector) and isset($request->data_inicial)
            and isset($request->data_final) and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $remuneracoes =  AumentoRemuneracao::where('user_id', '=', $request->user)
                ->whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();
        }

        return \view('pedido-remuneracao.data-export', compact('remuneracoes'));
    }
}
