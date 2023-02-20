<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotoristaRequest;
use App\Motorista;
use App\Role;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MotoristaController extends Controller
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
        return view('motorista.index')->with('motoristas', Motorista::where('is_active', 1)->get());
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
        return view('motorista.create')->with('genders', $arrayGenders);
    }

    public function getMotorista(Request $request){
        $search = $request->motorista;
        if($search == NULL){
            $motoristas = Motorista::where('is_active', true)->get();
        }else{
            $motoristas = Motorista::where('name', 'like', '%' .$search. '%')
                ->where('is_active', true)
                ->get();
        }
        $response = array();
        foreach($motoristas as $motorista){
            $response[] = array("value"=>$motorista->id,"label"=>$motorista->name);
        }
        echo json_encode($response);
        exit;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param MotoristaRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(MotoristaRequest $request)
    {
        $role = Role::where('slug','motorista')->first();

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make(123456),
            'remember_token' => $request->_token_token
        ]);
        $user->roles()->attach($role);

        $motorista = new Motorista();
        $motorista->fill($request->except('username', '_token'));
        $user->motorista()->save($motorista);
        return redirect('/motorista')->with('success', "Registou novo motorista");
    }

    /**
     * Display the specified resource.
     *
     * @param Motorista $motorista
     * @return void
     */
    public function show($motorista)
    {
        $motorista = Motorista::findOrFail($motorista);
        return view('motorista.details', compact('motorista'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Motorista $motorista
     * @return Application|Factory|View
     */
    public function edit($motorista)
    {
        $genders = Storage::get('genders.json');
        $arrayGenders = json_decode($genders);
        $motorista = Motorista::findOrFail($motorista);
        return view('motorista.edit', compact('motorista'))->with('genders', $arrayGenders);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Motorista $motorista
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $motorista)
    {
        $motoristaToUpdate = Motorista::findOrFail($motorista);
        $motoristaToUpdate->update($request->all());
        return redirect('/motorista')->with('success', 'Acabou de actualizar os dados do motorista');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $motorista = Motorista::findOrFail($id)->update([
            'is_active'=> false,
        ]);
        $motorista = Motorista::find($id);
        $user = User::findOrFail($motorista->user_id)->update([
            'is_active'=> false,
        ]);

        return redirect(route('motorista.index'))->with('success', 'Acabou de remover o motorista '.$motorista->name);
    }
}
