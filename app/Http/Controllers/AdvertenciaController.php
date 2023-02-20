<?php

namespace App\Http\Controllers;

use App\Advertencia;
use App\Http\Requests\AdvertenciaRequest;
use App\MyUtils;
use App\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use PDF;
use Validator;


class AdvertenciaController extends Controller
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

        if(Auth::user()->hasRole('gestor-recursos-humanos')){
            $advertencias = Advertencia::where('user_id', '=', Auth::id())->orWhere('adversor_id', '=', Auth::id())->orWhere('parecer', '=', 'Pendente')->get();

        }else{
            $advertencias = Advertencia::where('user_id','=', Auth::id())->orWhere('adversor_id', '=', Auth::id())->get();
        }
        return view('advertencia.index', compact('advertencias'));
    }

    public function all()
    {
        $advertencias =  Advertencia::all();
        return view('advertencia.index', compact('advertencias'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('advertencia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertenciaRequest $request)
    {
        $id = IdGenerator::generate(['table' => 'advertencias', 'length' => 6, 'prefix' => 'ADV-']);

        $advertencia = new Advertencia();
        $advertencia->id = $id.'-'.date('Y');
        $advertencia->adversor_id =  Auth::id();
        $advertencia->fill($request->except('_token'));
        $advertencia->save();

        $quantAdv = Advertencia::where('user_id', $request->user_id)->get();

        return  redirect(route('advertencia.index'))->with('warning', 'O(a) '.User::find($request->user_id)->name.' foi advertido(a) pela '.count($quantAdv).'ª vez');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertencia  $advertencia
     * @return \Illuminate\Http\Response
     */
    public function show($advertencia)
    {
        $advertencia = Advertencia::findOrFail($advertencia);
        if((Auth::id() == $advertencia->user_id) and !$advertencia->is_open){
            $advertencia->is_open = 1;
            $advertencia->save();
        }
        return view('advertencia.details',  compact('advertencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertencia  $advertencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertencia $advertencia)
    {
        return abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $advertencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $advertencia)
    {
        $advertencia = Advertencia::findOrFail($advertencia);

        $customAttributes = [
            'parecer' => 'Parecer do Gestor',
        ];
        $rules = [
            'parecer' => 'required|in:Confirmada,Recusada',
        ];

        Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

        $advertencia->parecer = $request->parecer;
        $advertencia->save();

        return redirect(route('advertencia.index'))->with('info', 'A advertência está '. strtolower($request->parecer));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertencia  $advertencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertencia $advertencia)
    {
    return abort(404);

    }

        public function makePDF($id)
    {
        $advertencia = Advertencia::findOrFail($id);
        $util = new MyUtils();
        $hoje = $util->dateTodayPT();
        $contratante = 'Max Vida';

        $quantAdv = Advertencia::where('user_id', $advertencia->user_id)->get();

        $view = \View::make('exports.advertencia', compact(['advertencia', 'quantAdv' ,'hoje']))->render();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica']);
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($advertencia->id . '.pdf');
    }
}
