<?php

namespace App\Http\Controllers;

use App\ClausulaContrato;
use App\Contrato;
use App\Http\Requests\ContratoRequest;
use App\MyUtils;
use App\Rescisao;
use App\Role;
use App\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use PDF;
use WGenial\NumeroPorExtenso\NumeroPorExtenso;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $contratos = Contrato::where('estado', '!=', 'Rescindido')->get();
        return view('contrato.index', compact('contratos'));
    }


    public function todos()
    {
        $contratos = Contrato::all();
        return view('contrato.all', compact('contratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $estados_civil = Storage::get('estado_civil.json');
        // return $estados_civil;
        $estados = json_decode($estados_civil);
        $nacionalidade = Storage::get('nacionalidades.json');
        $nacionalidades = json_decode($nacionalidade);
        $habilitacoesJS = Storage::get('habilitacoes.json');
        $habilitacoes = json_decode($habilitacoesJS);
        $contratosJS = Storage::get('tiposDeContratos.json');
        $tiposContrato = json_decode($contratosJS);
        $tipo_documentosJS = Storage::get('documentosID.json');
        $cargosJS = Storage::get('cargos.json');
        $cargos = json_decode($cargosJS);
        $areasJS = Storage::get('areasFormacao.json');
        $areas = json_decode($areasJS);
        $tipo_documentos = json_decode($tipo_documentosJS);
        return view('contrato.create-ct', compact(['estados',
        'cargos','areas', 'tipo_documentos', 'nacionalidades', 'habilitacoes', 'tiposContrato']));
    }

    public function createCps()
    {
        $estados_civil = Storage::get('estado_civil.json');
        $estados = json_decode($estados_civil);
        $nacionalidade = Storage::get('nacionalidades.json');
        $nacionalidades = json_decode($nacionalidade);
        $habilitacoesJS = Storage::get('habilitacoes.json');
        $habilitacoes = json_decode($habilitacoesJS);
        $contratosJS = Storage::get('tiposDeContratos.json');
        $tiposContrato = json_decode($contratosJS);
        $cargosJS = Storage::get('cargos.json');
        $cargos = json_decode($cargosJS);
        $areasJS = Storage::get('areasFormacao.json');
        $areas = json_decode($areasJS);
        $tipo_documentosJS = Storage::get('documentosID.json');
        $tipo_documentos = json_decode($tipo_documentosJS);
        return view('contrato.create-cps', compact(['estados','areas',
        'cargos','tipo_documentos', 'nacionalidades', 'habilitacoes', 'tiposContrato']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContratoRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(ContratoRequest $request)
    {


        // return $request;

        $tipo = "";
        $tipo_id = "";
        // if (count($request->nr_clausula) > 0 and count($request->descricao_clausula) > 0
        //     and count($request->nr_clausula) > 0) {

        if ($request->input('tipo') == 'CT') {
            $id = IdGenerator::generate(['table' => 'contratos', 'length' => 6, 'prefix' => 'CT-']);
            $tipo = "Contrato de Trabalho";
            $tipo_id = "CT";
        } elseif ($request->input('tipo') == 'CPS') {
            $id = IdGenerator::generate(['table' => 'contratos', 'length' => 6, 'prefix' => 'CPS-']);

            $tipo = "Contrato de Prestação de Serviço";
            $tipo_id = "CPS";
        }

        $contrato = new Contrato();
        $contrato->id = $id;
        $contrato->name = $request->name . ' ' . $request->surname;

        $role = Role::where('slug', 'usuario-normal')->first();

        $formatedName = strtolower(trim(preg_replace('/[\s-]+/', '', preg_replace('/[^A-Za-z0-9-]+/', '', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $request->surname))))), ''));

        $formatedSurname = strtolower(trim(preg_replace('/[\s-]+/', '', preg_replace('/[^A-Za-z0-9-]+/', '', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', substr($request->name, 0, 2)))))), ''));
        $oldUser = User::where('username', '=', $formatedName . '.' . $formatedSurname)->first();

        if($oldUser != NULL){
            $formatedSurname = $formatedSurname.'0'.$oldUser->id;
        }
        $user = User::create([
            'name' => $request->name . ' ' . $request->surname,
            'username' => $formatedName . '.' . $formatedSurname,
            'password' => Hash::make(123456),
            'remember_token' => $request->_token_token,
        ]);
        $user->roles()->attach($role);

        $contrato->user_id = $user->id;
        $contrato->tipo = $tipo;
        $contrato->tipo_id = $tipo_id;
        $contrato->fill($request->except('tipo', 'name'))->save();

        // for ($i=0; $i < count($request->nr_clausula); $i++) {
        //     ClausulaContrato::create(
        //         [
        //             'nr_clausula' => $request->nr_clausula[$i],
        //             'descricao_clausula' => $request->descricao_clausula[$i],
        //             'clausula' => $request->clausula[$i],
        //             'contrato_id' => $contrato->id,
        //         ]);
        // }

        return redirect(route('contrato.index'))->with('success', 'Contrado de ' . $request->contrato . ' registado');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param Contrato $contrato
     * @return Application|Factory|View
     */
    public function show($contrato)
    {
        $contrato = Contrato::findOrFail($contrato);
        return view('contrato.details', compact('contrato'));
    }

    public function contratoPeloUsuario($id)
    {
        $contrato = Contrato::where('user_id', $id)->first();
         if($contrato){
             return view('contrato.details', compact('contrato'));
         }else{
             return redirect()->back()->with('warning', 'Este usuário não tem contrato');
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contrato $contrato
     * @return void
     */
    public function edit($contrato)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contrato $contrato
     * @return void
     */
    public function update(Request $request, $contrato)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contrato $contrato
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($contrato)
    {
        $contrato = Contrato::findOrFail($contrato);

        if ($contrato->estado == 'Rescindido') {
            return redirect(route('contrato.show', $contrato))->with('error', 'Não pode rescindir um contrato que já está rescindido');
        } else if ($contrato != null) {
            Rescisao::create([
                'contrato_id' => $contrato->id,
                'user_id' => Auth::id(),
            ]);

            $contrato->estado = 'Rescindido';
            $user = User::find($contrato->user_id);
            $user->is_active = 0;
            $user->save();
            $contrato->save();
            return redirect(route('contrato.show', $contrato))->with('success', 'Rescindiu o contrato com ' . $contrato->name);
        } else {
            return redirect(route('contrato.show', $contrato))->with('error', 'Tentou rescindir um contrato que não existe');
        }
    }

    public function search(Request $request)
    {}

    public function makePDFIndividual($id)
    {
        $contrato = Contrato::findOrFail($id);
        $extenso = $this->dinheiroCompleto($contrato->salario_bruto);

        $date = new MyUtils();
        $data = $date->dateTodayPT();
        $mes = date('F', strtotime($contrato->created_at));
        $dia = date('d', strtotime($contrato->created_at));
        $ano = date('Y', strtotime($contrato->created_at));
        $mes = substr($mes, 0, 3);
        $dataVigor = $date->dataPT($ano, $mes, $dia);
        $contratante = 'Max Vida';


        $view = \View::make('exports.contrato-base', compact(['contrato',
        'dataVigor', 'contratante', 'extenso', 'data']))->render();
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($contrato->name . ' ' . $contrato->id . '.pdf');
    }

    public function dinheiroCompleto($salario)
    {
        $extenso = new NumeroPorExtenso;
        $extenso = $extenso->converter($salario);

        if (strpos($extenso, 'reais') !== false) {
            $extenso = str_replace("reais", "meticais", $extenso);
        } elseif (strpos($extenso, 'real') !== false) {
            $extenso = str_replace("real", "metical", $extenso);
        }
        return $extenso;
    }

}
