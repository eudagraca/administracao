<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransporteRequest;
use App\Transporte;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TransporteController extends Controller
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
        return view('transporte.index')->with('transportes', Transporte::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $veiculos = Storage::get('viaturas.json');
        $arrayVeiculos = json_decode($veiculos);
        return view('transporte.create')->with(['viaturas' => $arrayVeiculos]);
    }

    public function getTransporte(Request $request){
        $search = $request->transporte;
        if($search == NULL){
            $transportes = Transporte::where('esta_disponivel',  true)->get();
        }else{
            $transportes = Transporte::where('modelo', 'like', '%' .$search. '%')
                ->orWhere('marca', 'like', '%' .$search. '%')
                ->orWhere('matricula', 'like', '%' .$search. '%')
                ->get();

        }
        $response = array();
        foreach($transportes as $transporte){
            if ($transporte->esta_disponivel == true) {
                $response[] = array("value" => $transporte->id, "label" => $transporte->marca);
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransporteRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(TransporteRequest $request)
    {
        Transporte::create($request->all());

        return redirect('/transportes')->with('success', "Registou novo " . $request->veiculo);
    }

    /**
     * Display the specified resource.
     *
     * @param Transporte $transporte
     * @return void
     */
    public function show(Transporte $transporte)
    {
        return \view('transporte.details', compact('transporte'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $transporte
     * @return Application|Factory|View
     */
    public function edit($transporte)
    {
        $veiculos = Storage::get('viaturas.json');
        $arrayVeiculos = json_decode($veiculos);

        $transporte = Transporte::findOrFail($transporte);
        return view('transporte.edit', compact('transporte'))->with('viaturas', $arrayVeiculos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $transporte
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $transporte)
    {
        $transporteToUpdate = Transporte::find($transporte);
        $transporteToUpdate->update($request->all());
        return redirect('/transportes')->with('success', 'Actualizou os dados do transporte ' . $request->marca);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Transporte $transporte)
    {
        $transporte->esta_disponivel = false;
        return redirect('/transportes')->with('success', 'Removeu a(o) '.$transporte->veiculo. ' '.$transporte->marca.' '.$transporte->modelo);
    }
}
