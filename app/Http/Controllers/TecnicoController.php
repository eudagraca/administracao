<?php

namespace App\Http\Controllers;

use App\Http\Requests\TecnicoRequest;
use App\Tecnico;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TecnicoController extends Controller
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
        $tecnicos = Tecnico::where('is_active', 1)->get();
        return \view('tecnico.index', compact('tecnicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $genders = Storage::get('genders.json');
        $arrayGenders = json_decode($genders);
        return view('tecnico.create')->with('genders', $arrayGenders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TecnicoRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(TecnicoRequest $request)
    {
        Tecnico::create($request->all());
        return redirect(route('tecnico.index'))->with('success', 'Técnico registado');
    }

    /**
     * Display the specified resource.
     *
     * @param Tecnico $tecnico
     * @return Application|Factory|View
     */
    public function show(Tecnico $tecnico)
    {
        return \view('tecnico.details', compact('tecnico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tecnico $tecnico
     * @return Application|Factory|View
     */
    public function edit(Tecnico $tecnico)
    {
        $genders = Storage::get('genders.json');
        $arrayGenders = json_decode($genders);
        return view('tecnico.edit', compact('tecnico'))->with('genders', $arrayGenders);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tecnico $tecnico
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Tecnico $tecnico)
    {
        $tecnico->update($request->all());
        return redirect(route('tecnico.index'))->with('success', 'Acabou de actualizar os dados do técnico');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tecnico $tecnico
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Tecnico $tecnico)
    {
        $tecnico->is_active = 0;
        $tecnico->save();
        return redirect(route('tecnico.index'))->with('success', 'Removeu o(a) técnico(a) '.$tecnico->name);
    }

    public function getTecnico(Request $request){
        $search = $request->tecnico;
        if($search == NULL){
            $tecnicos = Tecnico::all();
        }else{
            $tecnicos = Tecnico::where('name', 'like', '%' .$search. '%')->get();
        }
        $response = array();
        foreach($tecnicos as $tecnico){
            $response[] = array("value"=>$tecnico->id,"label"=>$tecnico->name);
        }
        echo json_encode($response);
        exit;
    }

}
