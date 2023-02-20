<?php

namespace App\Http\Controllers;

use App\Role;
use App\Sector;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.index')->with('users', User::all());
    }

    public function getUser(Request $request)
    {
        $search = $request->user;
        if ($search == null) {
            $users = User::all();
        } else {
            $users = User::where('name', 'like', '%' . $search . '%')->get();
        }
        $response = array();
        foreach ($users as $user) {
            $response[] = array("value" => $user->id, "label" => $user->name);
        }
        echo json_encode($response);
        exit;
    }

    public function edit(User $user)
    {
        return view('auth.edit', compact('user'))->with(['roles' => Role::all(), 'sectores' => Sector::all()]);
    }

    public function show(User $user)
    {
        return view('auth.details', compact('user'));
    }

    public function updatePassword(Request $request)
    {

        $customAttributes = [
            'password' => 'Senha',
        ];
        $rules = [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        Validator::make($request->all(), $rules)->setAttributeNames($customAttributes)->validate();

        // Atualizar usuário
        Auth::user()->update(['password' => Hash::make($request['password'])]);
        return redirect(route('logout'));
    }

    protected function create(Request $data)
    {
        $customAttributes = [
            'id' => 'Requisição',
            'name' => 'Nome',
            'username' => 'Nome de acesso',
            'role' => 'Nível de acesso',
        ];
        $rules = [
            'id' => ['bail|unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'role' => ['required', 'string'],
        ];

        Validator::make($data->all(), $rules)->setAttributeNames($customAttributes)->validate();

        $role = Role::where('slug', $data['role'])->first();

        if ($role) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make(123456),
                'remember_token' => $data['_token'],
            ]);
            $user->roles()->attach($role);
            if ($data->sector) {
                $sector = Sector::where('id', $data->sector)->first();
                if($sector){
                    $user->sector()->attach($sector);
                }
            }
            return redirect('/usuarios')->with('success', "Criou novo usuário com permissões de " . $role->name);
        } else {
            return redirect()->back()->with('error', "Precisa definir um nível de acesso válido ao usuáro")->withInput();

        }

    }

    protected function update(Request $data, $id)
    {

        $data->validate([
            'sector' => ['required', 'integer'],
            'role' => ['required', 'string'],
        ]);

        $role = Role::where('slug', $data['role'])->first();
        $sector = Sector::where('id', $data->sector)->first();

        if ($role) {
            $user = User::find($id);
            $user->roles()->detach($user->roles->first());
            $user->roles()->attach($role);

            // return $user->sectors;

            if ($sector) {
                if ($user->getSector() != $sector && $user->getSector() != null) {
                    $user->sectors()->detach($user->sectors);
                    $user->sectors()->attach($sector);
                } else {
                    $user->sectors()->attach($sector);
                }
                $user->save();
                return redirect('/usuarios')->with('success', "Alterou os dados do usuário com permissões de " . $role->name);
            } else {
                return redirect()->back()->with('error', "Precisa definir um nível de acesso válido ao usuáro")->withInput();

            }
        } else {
            return redirect()->back()->with('error', "Precisa atribuir um sector válido ao usuáro")->withInput();
        }

    }

    protected function registerForm()
    {
        return view('auth.register')->with(['roles' => Role::all(), 'sectores' => Sector::all()]);
    }
}
