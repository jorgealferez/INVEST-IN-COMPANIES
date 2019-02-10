<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use App\User;
use App\Oferta;
use App\Asociacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfertaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OfertasController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            switch (Auth::user()->role()) {
                case 'Admin':
                    $oferta = new Asociacion;
                    $this->asociaciones = $oferta->asociaciones();
                    break;
                case 'Gestor':
                break;
                case 'Asesor':
                    $this->asociaciones=Auth::user()->getAsociacionesDelUsario();
                    break;
            }
            return $next($request);
        });

        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query[]=["active" , "<>", NULL];
        if($request->input('search')) { 
            $query[]=["name","LIKE","%{$request->input('search')}%"];  
        }

             
        $ofertas = Oferta::with('asociacion')
                            ->withCount('inversores')
                            ->where($query);
     
       if (Auth::user()->hasAnyRole(['Gestor','Asesor'])) {
            $ofertas= $ofertas
                        ->whereHas('asociacion', function($q) {
                            $q->whereIn('asociacion_id', $this->asociaciones);
                        });
        }

       if($request->get('sort')=="inversores_count"){
            $ofertas= $ofertas
                         ->orderBy('inversores_count',$request->get('direction'));
       }
       
        $ofertas= $ofertas->sortable()->paginate(5);


        $busqueda = ($request->input('search')) ? $request->input('search') : null ;


        return view('dashboard.ofertas.ofertas')
                ->with(compact('ofertas','busqueda'));
    }

    public function search(Request $request){
        

        $data = Oferta::select("name")
                        ->where([
                            ["name","LIKE","%{$request->input('query')}%"]
                        ]);
        
        if (Auth::user()->hasAnyRole(['Gestor','Asesor'])) {
            $data= $data
                    ->whereHas('asociacion', function($q) {
                        $q->whereIn('asociacion_id', $this->asociaciones);
                    });
        }

        $data=$data->get();
   
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         switch (Auth::user()->role()) {
            case 'Admin':
                    $usuariosAsociacion=Auth::user()->all();
                break;
            case 'Gestor':
            case 'Asesor':
                    $usuariosAsociacion=Auth::user()->getUsersFromThisAsociacion()->get();
                break;
        }
       
        return view('dashboard.ofertas.crear')
        ->with(compact('usuariosAsociacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfertaRequest $request)
    {
        $oferta = new Oferta;
        $oferta->fill($request->all());

        $oferta->save();
        $oferta->asociacion()->save(
            Auth::user()->asociacion()->first()
        );
       
        $oferta->users()->save(User::find($request->usuario));
        return redirect()->route('dashboardOfertas');
    }

    public function show(Oferta $oferta, $tab='usuarios', Request $request)
    {   
        $errors = Session::get('errors');
        if ($oferta) {
            if($request->old('tab')){ $tab=$request->old('tab'); }
            $usuarios = User::whereHas(
                'roles', function($q){
                            $q->whereIn('name', array('Gestor','Asesor'));
                        }
            )->get();
            $rolesLista = Role::with('users')->whereIn('name', array('Gestor','Asesor'))->get();

            $usuariosIDs = $oferta->users->pluck('id')->toArray();
            return view('dashboard.ofertas.detalle')
                ->with(compact('oferta','usuarios','usuariosIDs','tab','rolesLista','request'));
        } else {
            abort(404);
        }
           
      
    }

   
    public function update(AsociacionRequest $request,$tab=null)
    {
        $oferta = \App\Oferta::find($request->id);
        $oferta->fill($request->all());
        $oferta->save();
        $tab="modificar";   
        return redirect()->action('dashboard\AsociacionesController@show',['oferta'=>$oferta])->with('success',true);
        
       
    }



    /**
     * Update Usuarios de la oferta.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function updateUsers(Request $request)
    {
        //
        $oferta = \App\Oferta::find($request->id);
        $oferta->users()->sync($request->usuarios);
        return redirect()->route('dashboardAsociacion',$oferta)->with('success', true);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function delete(Oferta $oferta)
    {
        
        $oferta->fill(['active'=>false]);
        $oferta->save();
               
        return redirect()->route('dashboardAsociaciones')->with('success', true);
    }

}
