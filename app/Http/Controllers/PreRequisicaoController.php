<?php

namespace App\Http\Controllers;

use App\Avaria;
use App\Http\Requests\PreRequisicaoRequest;
use App\Motorista;
use App\PessoasRequisicao;
use App\PreRequisicao;
use App\RequisicaoTransporte;
use App\Sector;
use App\Transporte;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PreRequisicaoController extends Controller
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
            return view('transporte.requisicao.index')->with('requisicoes', PreRequisicao::where('estado','!=', 'entregue')->where('estado', '!=', 'negada')->where('foi_aceite','!=','negado')->get());
        } else {
            return view('transporte.requisicao.index')->with('requisicoes', PreRequisicao::where('user_id', Auth::id())->get());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $naoLidas = Avaria::where('foi_lida', 0)->get();
        $sectores = Sector::all();
        $transportesOn = Transporte::where('is_active', true)->get();
        $motoristasOn = Motorista::where('is_active', true)->get();

        $transportes = Transporte::orderBy('marca', 'asc')->get();
        $motoristas = Motorista::orderBy('name', 'asc')->get();

        $tiposDeViajem = array('Local', 'Nacional', 'Internacional');

        $sucursais = json_decode(Storage::get('sucursal.json'));

        return view('transporte.pre.create', compact(['naoLidas', 'sectores','sucursais', 'motoristas', 'transportes', 'tiposDeViajem']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PreRequisicaoRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(PreRequisicaoRequest $request)
    {
        $preRequisicao = new PreRequisicao();
        $preRequisicao->user_id = Auth::id();
        if ($request->mercadoria == "Pessoas") {
            $preRequisicao->volume = null;
            $preRequisicao->quantidade = count($request->pessoas);
        } elseif ($request->mercadoria == "Mercadoria") {
            $request->pessoas = array();
        }
        $preRequisicao->fill($request->except('pessoas'));

        $preRequisicao->save();

        if (count($request->pessoas) > 0 and (!empty($request->pessoas[0]))) {

            foreach ($request->pessoas as $pessoa) {
                $acompanhante = new PessoasRequisicao();
                $acompanhante->nome = $pessoa;
                $acompanhante->preRequisicao()->associate($preRequisicao);
                $acompanhante->save();

            }
        }
        return redirect(route('requisicaoTransporte.index'))->with(['success', 'Requisição Feita', 'open' => $preRequisicao->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param PreRequisicao $preRequisicao
     * @return Response
     */
    public function show(PreRequisicao $preRequisicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PreRequisicao $preRequisicao
     * @return Application|Factory|View
     */
    public function edit($preRequisicao)
    {
        $preRequisicao = PreRequisicao::findOrFail($preRequisicao);

        if ($preRequisicao->foi_aceite == "não lida"){
            $transportes = Transporte::where('em_servico', 0)->orderBy('marca', 'asc')->get();
            $motoristas = Motorista::where('em_servico', 0)->orderBy('name', 'asc')->get();
            return \view('transporte.requisicao.create', compact(['preRequisicao', 'transportes', 'motoristas']));
        }elseif ($preRequisicao->foi_aceite == "lida"){
            $transportes = Transporte::where('em_servico', 0)->orderBy('marca', 'asc')->get();
            $motoristas = Motorista::where('em_servico', 0)->orderBy('name', 'asc')->get();
            return \view('transporte.requisicao.create', compact(['preRequisicao', 'transportes', 'motoristas']));
        } elseif ($preRequisicao->foi_aceite == "negado") {
            return view('transporte.requisicao.details-negada', compact('preRequisicao'));
        }else{
            return view('transporte.requisicao.details', compact('preRequisicao'));
        }
    }


    public function read($preRequisicao)
    {
        $preRequisicao = PreRequisicao::findOrFail($preRequisicao);
        if (Auth::user()->hasRole('gestor-administracao')) {
            if ($preRequisicao->foi_aceite == "n達o lida") {
                $preRequisicao->foi_aceite = "lida";
                $preRequisicao->save();
            }
        }
        return redirect(route('preRequest.edit', $preRequisicao));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PreRequisicao $preRequisicao
     * @return Response
     */
    public function update(Request $request, PreRequisicao $preRequisicao)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PreRequisicao $preRequisicao
     * @return Response
     */
    public function destroy(PreRequisicao $preRequisicao)
    {
        return abort(404);

    }
}
