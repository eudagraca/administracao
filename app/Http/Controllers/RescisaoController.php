<?php

namespace App\Http\Controllers;

use App\PedidoRescisao;
use App\Rescisao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RescisaoController extends Controller
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
            $pedidosR = PedidoRescisao::all();
        } elseif (Auth::check()) {
            $pedidosR = PedidoRescisao::where('user_id', Auth::id())->get();
        } else {
            return redirect('/');
        }

        return view('pedidos-rescisao.index', compact('pedidosR'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $date = Carbon::now();
        // $days = $date->addDays(15);

        // $messages = ['contrato_id.exists' => 'Tentou elaborar uma adenda para  um contrato que não existe'];

        // $customAttributes = [
        //     'contrato_id' => 'Contrato',
        // ];
        // $rules = [
        //     'motivo' => 'required|string|min:10',
        //     'contrato_id' => 'required|exists:contratos,id',
        //     'user_id' => Auth::id()
        // ];

        // Validator::make($request->all(), $rules, $messages)->setAttributeNames($customAttributes)->validate();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rescisao  $rescisao
     * @return \Illuminate\Http\Response
     */
    public function show(Rescisao $rescisao)
    {
        return abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rescisao  $rescisao
     * @return \Illuminate\Http\Response
     */
    public function edit(Rescisao $rescisao)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rescisao  $rescisao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rescisao $rescisao)
    {
        return abort(404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rescisao  $rescisao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rescisao $rescisao)
    {
        return abort(404);
    }
}
