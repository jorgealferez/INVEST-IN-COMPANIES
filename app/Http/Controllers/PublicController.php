<?php

namespace App\Http\Controllers;

use App\Oferta;
use App\Provincia;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $provincias=Provincia::all();
        return view('public.home')
        ->with(
            compact(
            'provincias'
            )
        );
    }


    public function buscador(Request $request)
    {
        $provincias=Provincia::all();

        $query[]=["ofertas.active" , "=", 1];

        if($request->input('search')) {
            $query[]=["ofertas.name","LIKE","%{$request->input('search')}%"];
        }
        if($request->input('provincia_id')) {
            $query[]=["ofertas.provincia_id","=",$request->input('provincia_id')];
        }


        $ofertas = Oferta::with('provincia')
                ->leftJoin('provincias','provincias.id','=','ofertas.provincia_id')
                ->leftJoin('sectores','sectores.id','=','ofertas.sector_id')
                ->where($query)
                ->withCount('inversores');



        if($request->get('sort')=="provincia"){
            $ofertas= $ofertas
                ->orderBy('provincias.name',$request->get('direction'));
        }

        if($request->get('sort')=="sector"){
            $ofertas= $ofertas
                ->orderBy('sectores.name',$request->get('direction'));
        }


        $ofertas= $ofertas->sortable()->paginate(5);
        $busqueda = ($request->input('search')) ? $request->input('search') : null ;

        return view('public.buscador')
        ->with(
            compact(
            'request',
            'provincias',
            'ofertas'
            )
        );
    }
}
