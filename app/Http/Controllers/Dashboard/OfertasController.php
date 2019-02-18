<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use App\User;
use App\Forma;
use App\Oferta;
use App\Sector;
use App\Provincia;
use App\Asociacion;
use App\Valoracion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfertaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AsociacionRequest;

class OfertasController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query[]=["ofertas.active" , "<>", NULL];
        if($request->input('search')) {
            $query[]=["ofertas.name","LIKE","%{$request->input('search')}%"];
        }
        $ofertas = Oferta::with('asociacion')
                ->join('asociaciones','asociaciones.id','=','ofertas.asociacion_id')
                ->where($query)
                ->withCount('inversores');

        if($request->get('sort')=="inversores_count"){
            $ofertas= $ofertas
                ->orderBy('inversores_count',$request->get('direction'));
       }elseif($request->get('sort')=="asociaciones"){
            $ofertas= $ofertas
                ->orderBy('asociaciones.name',$request->get('direction'));
        }

       if (Auth::user()->hasAnyRole(['Gestor','Asesor','Inversor'])) {
            switch (Auth::user()->roles()->first()->name) {
                case 'Asesor':
                    $ofertas= $ofertas
                    ->whereHas('asociacion', function($q) {
                        $q->whereIn('asociacion_id', Auth::user()->getAsociacionesDelUsario());
                    });
                break;
                case 'Gestor':
                    $ofertas= $ofertas
                    ->where('user_id',  Auth::user()->id);
                break;
            }
        }


        $ofertas= $ofertas->sortable()->paginate(5);
        $busqueda = ($request->input('search')) ? $request->input('search') : null ;

        return view('dashboard.ofertas.ofertas')
                ->with(compact('ofertas','busqueda'));
    }

    /**
     * Busqueda de Oferta por Role
     *
     * @return Oferta
     */
    public function search(Request $request){
        $data = Oferta::select("name")
                        ->where([
                            ["name","LIKE","%{$request->input('query')}%"]
                        ]);
        switch (Auth::user()->roles()->first()->name) {
            case 'Asesor':
                $data= $data
                ->whereHas('asociacion', function($q) {
                    $q->whereIn('asociacion_id', Auth::user()->getAsociacionesDelUsario());
                });
            break;
            case 'Gestor':
                $data= $data
                ->where('user_id',  Auth::user()->id);
            break;
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
        $formasJuridicas=Forma::all();
        $sectores=Sector::all();
        $provincias=Provincia::all();
        $valoraciones=Valoracion::all();
        $asociaciones = null;
        $oferta = null;
        $asociacionesDisponibles=Auth::user()->asociacionesDisponiblesByRole();
        $usuariosAsociacion = Auth::user()->usuariosDeMiAsociacion();

        return view('dashboard.ofertas.crear')
        ->with(compact(
            'usuariosAsociacion',
            'formasJuridicas',
            'sectores',
            'provincias',
            'asociacionesDisponibles',
            'valoraciones',
            'oferta'
        ));
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
        switch (Auth::user()->roles()->first()->name) {

            case 'Admin':
                $oferta->save();
                return redirect()->route('dashboardOfertas')->with([
                    'success'=> true,
                    'mensaje'=>__('<strong>'.$oferta->name.'</strong> creada correctamente')
                ]);
            break;
            case 'Asesor':
                $oferta->asociacion_id = Auth::user()->asociaciones->first()->id;
                $oferta->save();
                return redirect()->route('dashboardOfertas')->with([
                    'success'=> true,
                    'mensaje'=>__('<strong>'.$oferta->name.'</strong> creada correctamente')
                ]);
            break;
            case 'Gestor':
                $oferta->asociacion_id = Auth::user()->asociaciones->first()->id;
                $oferta->user_id = Auth::user()->id;
                if(Auth::user()->permisoOferta($oferta->asociacion_id)){
                    $oferta->save();
                    return redirect()->route('dashboardOfertas')->with([
                        'success'=> true,
                        'mensaje'=>__('<strong>'.$oferta->name.'</strong> creada correctamente')
                    ]);
                }
            break;
        }

        return redirect()->route('dashboardOfertas')->with(['error'=> true,'mensaje'=>__('No se podido crear la oferta '.$oferta->name)]);
    }

    public function show(Oferta $oferta, $tab='modificar', Request $request)
    {
        // dd($request->user()->authorizeRoles(['Admin', 'Gestor','Asesor']));
        $errors = Session::get('errors');
        $formasJuridicas=Forma::all();
        $sectores=Sector::all();
        $provincias=Provincia::all();
        $valoraciones=Valoracion::all();

        if ($oferta) {
            if($request->old('tab')){ $tab=$request->old('tab'); }

            // dd(Auth::user()->permisoOferta($oferta->id));
           switch (Auth::user()->roles()->first()->name) {
                case 'Admin':
                    $asociacionesDisponibles=Auth::user()->asociacionesDisponiblesByRole();
                    $usuariosAsociacion=$asociacionesDisponibles->find($oferta->asociacion->id)->usuarios;
                    break;
                case 'Asesor':
                    $asociacionesDisponibles=Asociacion::whereIn('id',Auth::user()->getAsociacionesDelUsario())->get();
                    if(!empty($asociacionesDisponibles->find($oferta->asociacion_id)->usuarios)){
                        $usuariosAsociacion=$asociacionesDisponibles->find($oferta->asociacion_id)->usuarios;
                    }else {
                        return redirect('dashboard/ofertas');
                    }
                    break;
                case 'Gestor':
                case 'Inversor':

                    if(!Auth::user()->permisoOferta($oferta->asociacion_id)){
                        return redirect('dashboard/ofertas');
                    }
                break;
            }
            return view('dashboard.ofertas.detalle')
                ->with(
                    compact(
                        'oferta',
                        'tab',
                        'request',
                        'usuariosAsociacion',
                        'formasJuridicas',
                        'sectores',
                        'provincias',
                        'asociacionesDisponibles',
                        'valoraciones'
                    ));
        } else {
            abort(404);
        }


    }


    public function update(AsociacionRequest $request,$tab=null)
    {
        $oferta = \App\Oferta::find($request->id);
        $oferta->fill($request->except('user_id'));
        switch (Auth::user()->roles()->first()->name) {
            case 'Admin':
                $oferta->user_id=$request->user_id;
                break;
            case 'Asesor':
                $asociaciones=Asociacion::whereIn('id',Auth::user()
                            ->getAsociacionesDelUsario())->get();
                if(in_array($request->user_id,$asociaciones->first()->usuarios->pluck('id')->toArray())){
                    $oferta->user_id=$request->user_id;
                }else{
                    return redirect('dashboard/ofertas');
                }

            break;
            case 'Gestor':
                if(Auth::user()->permisoOferta($oferta->asociacion_id)){
                    $oferta->user_id= Auth::user()->id;
                }else{
                    return redirect('dashboard/ofertas');
                }
            break;
            case 'Inversor':
                abort(404);
            break;
        }
        $oferta->save();
        $tab="modificar";
        return redirect()->action('Dashboard\OfertasController@show',['oferta'=>$oferta])
        ->with([
            'success'=> true,
            'mensaje'=>__('<strong>'.$oferta->name.'</strong> modificada correctamente')
        ]);


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

        return redirect()->route('dashboardOfertas') ->with([
            'success'=> true,
            'mensaje'=>__('<strong>'.$oferta->name.'</strong> eliminada correctamente')
        ]);
    }



}
