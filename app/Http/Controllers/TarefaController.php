<?php

namespace App\Http\Controllers;

use App\Motorista;
use App\PreRequisicao;
use App\RequisicaoTransporte;
use App\Tarefas;
use App\Transporte;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TarefaController extends Controller
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
        $tarefas = Tarefas::whereHas('requisicaoTransporte', function (Builder $query) {
            $query->whereHas('preRequisicao', function (Builder $builder) {
                $builder->orderBy('prioridade', 'ASC');
            })->where('motorista_id', Auth::user()->motorista->id);
        })->where('status', 0)->get();
        return view('motorista.tarefa.index')->with('minhasTarefas', $tarefas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    public function concluidas()
    {
        return abort(404);

        return Tarefas::where('status', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $tarefa = Tarefas::findOrFail($id);
        $requisicao = RequisicaoTransporte::findOrFail($tarefa->requisicao_transporte_id);
        $preRequisicao = PreRequisicao::findOrFail($requisicao->pre_requisicao_id);
        return view('motorista.tarefa.details', compact(['preRequisicao', 'tarefa']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $preRequisicao = PreRequisicao::findOrFail($request->pre_requisicao);

        $preRequisicao->estado = $request->estado;
        $preRequisicao->save();
        $transporte = Transporte::findOrFail($preRequisicao->requisicao->transporte->id);


        if ($request->estado == 'entregue') {
            Tarefas::findOrFail($id)
                ->update(['status' => 1,
                    'end_at' => Carbon::now()
                ]);


            $motoriata = Motorista::findOrFail(Auth::user()->motorista->id);
            $motoriata->em_servico = false;
            $motoriata->save();


            $transporte = Transporte::findOrFail($preRequisicao->requisicao->transporte->id);
            $transporte->em_servico = false;
            $transporte->save();

        } elseif ($request->estado == 'andamento') {
            Tarefas::findOrFail($id)
                ->update(['start_at' => Carbon::now()
                ]);
        }

        return redirect(route('tarefa.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        return abort(404);
    }
}
