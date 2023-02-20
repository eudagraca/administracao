<?php

namespace App\Http\Controllers;

use App\Sector;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SectorController extends Controller
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
        $users = User::all();
        $sectores = Sector::all();
        return view('sector.index', compact('sectores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('sector.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        // return $request;
        $sector = new Sector();
        $sector->name = $request->name;
        $user = User::findOrFail($request->user_id);
        if ($user) {
            $sector->user_id = $request->user_id;
            $sector->save();
            return redirect('/sector')->with('success', 'Com sucesso registou o sector de ' . $request->name);

        } else {
            return redirect()->back()->with('error', 'Tentou atribuir a responsbilidade a um usuário que não existe')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit($sector)
    {
        $sector = Sector::findOrFail($sector);
        $users = User::all();
        return view('sector.edit', compact(['sector', 'users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sector)
    {

        $sector = Sector::findOrFail($sector);
        $user = User::findOrFail($request->user_id);
        if ($user) {
            $sector->user_id = $request->user_id;
            $sector->name = $request->name;
            $sector->save();
            return redirect('/sector')->with('success', 'Com sucesso actualizou os dados do sector ' . $request->name);
        } else {
            return redirect()->back()->with('error', 'Tentou atribuir a responsbilidade a um usuário que não existe')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        return abort(404);
    }

    public function getSector(Request $request){
        $search = $request->sector;
        if($search == NULL){
            $sectores = Sector::all();
        }else{
            $sectores = Sector::where('name', 'like', '%' .$search. '%')->get();
        }
        $response = array();
        foreach($sectores as $sector){
            $response[] = array("value"=>$sector->id,"label"=>$sector->name);
        }
        echo json_encode($response);
        exit;
    }
}
