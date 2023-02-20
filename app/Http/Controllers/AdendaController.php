<?php

namespace App\Http\Controllers;

use App\Adenda;
use App\Clausulas;
use App\Contrato;
use App\MyUtils;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Validator;
use PDF;

class AdendaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return abort(404);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $contrato
     * @return Application|Factory|View
     */
    public function create()
    {
        return abort(404);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $messages = ['contrato_id.exists' => 'Tentou elaborar uma adenda para  um contrato que não existe'];

        $customAttributes = [
            'contrato_id' => 'Contrato',
            'apartir_de' => 'Data em que entra em vigor',
            'clausula' => 'Cláusula',
            'descricao' => 'Descrição',
            'motivo' => 'Motivo',
        ];
        $rules = [
            'contrato_id' => 'required|exists:contratos,id',
            'apartir_de' => 'required',
            "clausula"    => "required",
            'descricao'  => "required",
            'motivo'  => "required",
        ];

        Validator::make($request->all(), $rules, $messages)->setAttributeNames($customAttributes)->validate();

        $contrato = Contrato::find($request->contrato_id);

        $id = IdGenerator::generate(['table' => 'adendas', 'length' => 3, 'prefix' => 'AD']);

        $numeroAndendas = Adenda::where('contrato_id', $contrato->id)->get();
        $adenda = new Adenda();

        $adenda->id = $id.'-'.$contrato->id;

        $adenda->contrato_id = $contrato->id;
        $adenda->apartir_de = $request->apartir_de;
        $adenda->clausula = $request->clausula;
        $adenda->descricao = $request->descricao;
        $adenda->motivo = $request->motivo;
        $adenda->numero = count($numeroAndendas) + 1;
        $adenda->save();

        return redirect(route('contrato.show', $contrato->id))->with('success', 'Registou uma adenda para este contrato');
    }

    /**
     * Display the specified resource.
     *
     * @param Adenda $adenda
     * @return Application|Factory|View
     */
    public function show($adenda)
    {
        $adenda = Adenda::findOrFail($adenda);
        return \view('adenda.details', compact('adenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $contrato
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit($contrato)
    {
        $contrato = Contrato::findOrFail($contrato);
//        if ($contrato->estado == 'Rescindido'){
//            return redirect()->back()->with('error', 'Este contrato já foi rescindido');
//        }
        return view('adenda.create', compact('contrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Adenda $adenda
     * @return Response
     */
    public function update(Request $request, $adenda)
    {
        return abort(404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Adenda $adenda
     * @return Response
     */
    public function destroy($adenda)
    {
        return abort(404);

    }

    public function makePDF($id)
    {
        $adenda = Adenda::findOrFail($id);
        $util = new MyUtils();
        $data = $util->dateTodayPT();
        $mes = date('F', strtotime($adenda->apartir_de));
        $dia = date('d', strtotime($adenda->apartir_de));
        $ano = date('Y', strtotime($adenda->apartir_de));
        $mes = substr($mes, 0, 3);
        $dataVigor = $util->dataPT($ano, $mes, $dia);
        $hoje = $util->dateTodayPT();
        $contratante = 'Max Vida';
        $numExt = $util->getNumberExt($adenda->numero);

        $view = \View::make('exports.contrato-adenda', compact(['adenda', 'numExt', 'dataVigor', 'hoje']))->render();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($adenda->id . '.pdf');
    }

}
