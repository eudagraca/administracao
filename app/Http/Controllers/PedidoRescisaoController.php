<?php

namespace App\Http\Controllers;

use App\PedidoRescisao;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;

class PedidoRescisaoController extends Controller
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
            $pedidosR = PedidoRescisao::where('estado', '=', 'lida')->orWhere('estado', '=', 'nao lida')->get();
        } elseif (Auth::check()) {
            $pedidosR = PedidoRescisao::where('user_id', Auth::id())->get();

        } else {
            return redirect('/');
        }

        return view('pedidos-rescisao.index', compact('pedidosR'));
    }
    public function todos()
    {

        $pedidosR = PedidoRescisao::all();
        return view('pedidos-rescisao.all', compact('pedidosR'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->contrato) {
            return view('forms.rescisao');
        }
        return redirect()->back()->with('error','Você não tem um contrato');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::now();
        $days = $date->addDays(15);

        $messages = ['contrato_id.exists' => 'Tentou elaborar uma adenda para  um contrato que não existe'];

        $customAttributes = [
            'motivo' => 'Motivo',
            'antecedencia' => 'Data',
        ];
        $rules = [
            'motivo' => 'required|string|min:10',
            'antecedencia' => 'required|date',
        ];

        Validator::make($request->all(), $rules, $messages)->setAttributeNames($customAttributes)->validate();

        PedidoRescisao::create([
            'motivo' => $request->motivo,
            'antecedencia' => $request->antecedencia,
            'user_id' => Auth::id()]
        );

        return redirect(route('normal.dashboard'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PedidoRescisao  $pedidoRescisao
     * @return \Illuminate\Http\Response
     */
    public function show(PedidoRescisao $pedidoRescisao)
    {
        if (Auth::check() && Auth::user()->hasRole('gestor-recursos-humanos')) {
            if($pedidoRescisao->estado == 'nao lida' ){
                $pedidoRescisao->estado = 'lida';
                $pedidoRescisao->save();
            }
        }
        return view('pedidos-rescisao.details', compact('pedidoRescisao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PedidoRescisao  $pedidoRescisao
     * @return \Illuminate\Http\Response
     */
    public function edit(PedidoRescisao $pedidoRescisao)
    {
        return abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PedidoRescisao  $pedidoRescisao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidoRescisao $pedidoRescisao)
    {
        $customAttributes = [
            'status' => 'Resposta da rescisão',
        ];
        $rules = [
            'status' => 'required|in:aceite,negada',
        ];

        Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

        $pedidoRescisao->estado = $request->status;
        $pedidoRescisao->save();

        return redirect(route('pedidoRescisao.index'))->with('info', 'Resposta de pedido de rescisão enviada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PedidoRescisao  $pedidoRescisao
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoRescisao $pedidoRescisao)
    {
        return abort(404);
    }



     public function report(Request $request)
    {

        if (isset($request->data_inicial)
            and isset($request->data_final) and isset($request->user)) {

            $user = User::findOrFail($request->user);

            $pedidosR = PedidoRescisao::whereDate('created_at', '>=', $request->data_inicial)
            ->whereDate('created_at', '<=', $request->data_final)
            ->where('user_id', '=', $request->user)->get();

        } elseif (isset($request->data_inicial)
            and isset($request->data_final) and !isset($request->user)) {

            $pedidosR =  PedidoRescisao::whereDate('created_at', '>=', $request->data_inicial)
                ->whereDate('created_at', '<=', $request->data_final)
                ->get();

        } else{
            $pedidosR =  PedidoRescisao::all();
        }
        return \view('pedidos-rescisao.data-export', compact('pedidosR'));
    }
}
