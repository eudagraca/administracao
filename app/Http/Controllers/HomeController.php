<?php

namespace App\Http\Controllers;

use App\Advertencia;
use App\AumentoRemuneracao;
use App\Avaria;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('motorista')){
            return $this->motoristaDashboard();
        }else{
            return $this->normalDashboard();
        }
    }

    public function motoristaDashboard()
    {
        return view('layouts.motorista-dashboard');
    }

    public function normalDashboard()
    {
        return view('layouts.normal-dashboard');
    }

    public function adminDashBoard()
    {
        $advertencias = Advertencia::all();
        $aumentosR = AumentoRemuneracao::all();
        $avarias = Avaria::all();
        $avariasCon = Avaria::where('estado', '!=', 'concluido')->get();
        return view('layouts.dashboard', compact('advertencias', 'aumentosR',
        'avarias', 'avariasCon'));
    }
}
