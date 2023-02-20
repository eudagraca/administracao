<?php

namespace App\Http\Controllers;

use App\Sector;
use App\TipoCarta;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Ramsey\Uuid\Type\Integer;

class CartaController extends Controller
{

    public function __construct()
    {

//        return abort(404);
       $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index()
    {
        return view('tipo-carta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return \view('tipo-carta.create')->with(['tipos'=> TipoCarta::all(), 'sectores'=> Sector::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */

    //    TODO remove on production
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|unique:tipo_cartas|min:3|max:100',
        ]);

        $delimiter = '-';
        $tipo = new TipoCarta();
        $tipo->tipo = $request->tipo;
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $request->tipo))))), $delimiter));
        $tipo->slug = $slug;
        $tipo->save();
        return redirect('/carta')->with('success', 'Tipo de carta registado');
    }

    /**
     * Display the specified resource.
     *
     * @param TipoCarta $tipoCarta
     * @return Response
     */
    public function show($tipoCarta)
    {
        return abort(404);

    }


    public function verEscalas($escala)
    {
        return abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TipoCarta $tipoCarta
     * @return Response
     */
    public function edit(TipoCarta $tipoCarta)
    {
        return abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Integer $tipoCarta
     * @return Response
     */
    public function update(Request $request, $tipoCarta)
    {
        return abort(404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TipoCarta $tipoCarta
     * @return Response
     */
    public function destroy(TipoCarta $tipoCarta)
    {
        return abort(404);

    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            if ($request->search == ''){
                $tipos = TipoCarta::all();
            }else{
                $tipos = TipoCarta::where('tipo', 'LIKE', '%' . $request->search . "%")->get();
            }
            if ($tipos) {
                foreach ($tipos as $key => $tipo) {
                    $output .=
                        '<div>
                            <a href="#"
                               class="uk-card uk-card-small uk-border-rounded uk-card-default uk-box-shadow-hover-large stretched-link text-decoration-none uk-card-body">
                                <h5>' . $tipo->tipo . '</h5>
                            </a>
                        </div>';
                }
                return Response($output);
            }
        }
    }
}
