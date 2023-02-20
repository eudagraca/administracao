<?php

namespace App\Http\Controllers;

use App\Despensa;
use Illuminate\Http\Request;

class DespensaController extends Controller
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
        return abort(404);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Despensa  $despensa
     * @return \Illuminate\Http\Response
     */
    public function show(Despensa $despensa)
    {
        return abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Despensa  $despensa
     * @return \Illuminate\Http\Response
     */
    public function edit(Despensa $despensa)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Despensa  $despensa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Despensa $despensa)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Despensa  $despensa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despensa $despensa)
    {
        return abort(404);
    }
}
