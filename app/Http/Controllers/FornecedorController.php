<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Http\Requests\FornecedorRequest;
use Illuminate\Http\Request;

class FornecedorController extends Controller
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
        $fornecedores = Fornecedor::where('is_active', 1)->get();
        return view('fornecedor.index', compact('fornecedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fornecedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedorRequest $request)
    {
        Fornecedor::create($request->all());

        return redirect(route('fornecedor.index'))->with('success', 'Fornecedor registado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        return view('fornecedor.details',compact('fornecedor'));
    }

    public function getFornecedor(Request $request)
    {
        $searchName = $request->fornecedor ;

        $fornecedores = Fornecedor::where('nome', 'like', '%' . $searchName .'%')->get();

        $response = array();
        foreach($fornecedores as $fornecedor){
            $response[] = array("value"=>$fornecedor->id,"label"=>$fornecedor->nome);
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        return view('fornecedor.edit', compact('fornecedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $fornecedor->update($request->all());
        return redirect(route('fornecedor.index'))->with('success', 'Acabou de actualizar os dados do fornecedor');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->is_active = 0;
        $fornecedor->save();
        return redirect(route('fornecedor.index'))->with('success', 'Removeu o(a) técnico(a) ' . $fornecedor->name);

    }
}
