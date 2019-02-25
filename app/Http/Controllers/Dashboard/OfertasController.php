<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use App\User;
use App\Forma;
use App\Oferta;
use App\Sector;
use App\Poblacion;
use App\Provincia;
use App\Asociacion;
use App\Valoracion;
use Illuminate\Http\Request;
use App\Notifications\OfertaNueva;
use App\Http\Requests\OfertaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AsociacionRequest;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\DashBoardController;

class OfertasController extends DashBoardController
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Parent::RolesCheck();
        $provincias=Provincia::all();
        $asociaciones=Asociacion::all();
        $query[]=["ofertas.active" , "<>", null];
        if ($request->input('name')) {
            $query[]=["ofertas.name","LIKE","%{$request->input('name')}%"];
        }
        if ($request->input('cif')) {
            $query[]=["ofertas.cif","LIKE","%{$request->input('cif')}%"];
        }
        if ($request->input('provincia_id')) {
            $query[]=["provincia_id","=",$request->input('provincia_id')];
        }
        if ($request->input('asociacion_id')) {
            $query[]=["asociaciones.id","=",$request->input('asociacion_id')];
        }
        $ofertas = Oferta::select('ofertas.*')->with('asociacion', 'provincia')
                ->join('asociaciones', 'asociaciones.id', '=', 'ofertas.asociacion_id')
                ->join('provincias', 'provincias.id', '=', 'ofertas.provincia_id')
                ->where($query);

        if ($request->get('sort')=="asociacion") {
            $ofertas= $ofertas
                ->orderBy('asociaciones.name', $request->get('direction'));
        } elseif ($request->get('sort')=="provincia") {
            $ofertas= $ofertas
                ->orderBy('provincias.name', $request->get('direction'));
        } elseif ($request->get('sort')=="valoracion") {
            $ofertas= $ofertas
                ->orderBy('ofertas.valoracion', $request->get('direction'));
        } elseif (!$request->get('sort')) {
            $ofertas= $ofertas
                ->orderBy('ofertas.created_at', 'DESC');
        }

        if ($this->isAsesor) {
            $ofertas= $ofertas
            ->whereHas('asociacion', function ($q) {
                $q->whereIn('asociacion_id', Auth::user()->getAsociacionesDelUsario());
            });
        }
        if ($this->isGestor) {
            $ofertas= $ofertas
            ->where('user_id', Auth::user()->id);
        }



        $ofertas= $ofertas->sortable()->paginate(11);
        $busqueda = ($request->input('search')) ? $request : null ;
        $notificaciones =Auth::User()->unreadNotifications->where("type", "App\Notifications\OfertaNueva")->pluck('data')->pluck('oferta_id')->toArray();
        return view('dashboard.ofertas.ofertas')
                ->with(compact(
                    'ofertas',
                    'provincias',
                    'asociaciones',
                    'busqueda',
                    'notificaciones'
                ));
    }

    /**
     * Busqueda de Oferta por Role
     *
     * @return Oferta
     */
    public function search(Request $request)
    {
        Parent::RolesCheck();
        $data = Oferta::select("name")
                        ->where([
                            ["name","LIKE","%{$request->input('query')}%"],
                        ]);
        if ($this->isAsesor) {
            $data= $data
                ->whereHas('asociacion', function ($q) {
                    $q->whereIn('asociacion_id', Auth::user()->getAsociacionesDelUsario());
                });
        }
        if ($this->isGestor) {
            $data= $data
                ->where('user_id', Auth::user()->id);
        }
        $data=$data->get()->pluck('name');
        return response()->json($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Parent::RolesCheck();
        $formasJuridicas=Forma::all();
        $sectores=Sector::all();
        $provincias=Provincia::all();
        if (old('provincia_id')) {
            $poblaciones = Poblacion::where('provincia_id', old('provincia_id'))->get();
        } else {
            $poblaciones=collect();
        }
        $asociaciones = null;
        $oferta = new Oferta();
        $asociacionesDisponibles=Auth::user()->asociacionesDisponiblesByRole();
        $usuariosAsociacion = Auth::user()->usuariosDeMiAsociacion();
        return view('dashboard.ofertas.crear')
        ->with(compact(
            'usuariosAsociacion',
            'formasJuridicas',
            'sectores',
            'provincias',
            'poblaciones',
            'asociacionesDisponibles',
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
        Parent::RolesCheck();
        $oferta = new Oferta();
        $oferta->fill($request->all());
        if ($request->valoracion) {
            $oferta->valoracion = $this->convierteNum($request->valoracion);
        }
        if ($request->endeudamiento) {
            $oferta->endeudamiento = $this->convierteNum($request->endeudamiento);
        }


        if ($this->isAdmin) {
            $oferta->save();
            $this->NotificacionNuevaOferta($oferta);
            return redirect()->route('dashboardOfertas')->with([
                'success'=> true,
                'mensaje'=>__('<strong>'.$oferta->name.'</strong> creada correctamente')
            ]);
        }
        if ($this->isAsesor) {
            $oferta->asociacion_id = Auth::user()->asociaciones->first()->id;
            $oferta->save();
            $this->NotificacionNuevaOferta($oferta);
            return redirect()->route('dashboardOfertas')->with([
                'success'=> true,
                'mensaje'=>__('<strong>'.$oferta->name.'</strong> creada correctamente')
            ]);
        }
        if ($this->isGestor) {
            $oferta->asociacion_id = Auth::user()->asociaciones->first()->id;
            $oferta->user_id = Auth::user()->id;
            if (Auth::user()->permisoOferta($oferta->asociacion_id)) {
                $oferta->save();
                $this->NotificacionNuevaOferta($oferta);
                return redirect()->route('dashboardOfertas')->with([
                    'success'=> true,
                    'mensaje'=>__('<strong>'.$oferta->name.'</strong> creada correctamente')
                ]);
            }
        }

        return redirect()->route('dashboardOfertas')->with(['error'=> true,'mensaje'=>__('No se podido crear la oferta '.$oferta->name)]);
    }

    public function show(Oferta $oferta, Request $request)
    {
        Parent::RolesCheck();
        $errors = Session::get('errors');
        $nueva = false;
        $formasJuridicas=Forma::all();
        $sectores=Sector::all();
        $provincias=Provincia::all();
        if ($request->tab) {
            $tab=$request->tab;
        } else {
            $tab="modificar";
        }
        // if(old('provincia_id')){
        //     $poblaciones = Poblacion::where('provincia_id',old('provincia_id'))->get();
        // }else{

        //     $poblaciones=collect();
        // }
        $notificacion =Auth::User()->unreadNotifications()->where('data->oferta_id', $oferta->id)->get();
        if (in_array($oferta->id, $notificacion->pluck('data')->pluck('oferta_id')->toArray())) {
            $notificacion->markAsRead();
            $nueva = true;
        }
        if ($oferta) {
            $poblaciones = Poblacion::where('provincia_id', $oferta->provincia_id)->get();
            if ($request->old('tab')) {
                $tab=$request->old('tab');
            }

            // dd(Auth::user()->permisoOferta($oferta->id));
            if ($this->isAdmin) {
                $asociacionesDisponibles=Auth::user()->asociacionesDisponiblesByRole();
                $usuariosAsociacion=$asociacionesDisponibles->find($oferta->asociacion->id)->usuarios;
            }
            if ($this->isAsesor) {
                $asociacionesDisponibles=Asociacion::whereIn('id', Auth::user()->getAsociacionesDelUsario())->get();
                if (!empty($asociacionesDisponibles->find($oferta->asociacion_id)->usuarios)) {
                    $usuariosAsociacion=$asociacionesDisponibles->find($oferta->asociacion_id)->usuarios;
                } else {
                    return redirect('dashboard/ofertas');
                }
            }
            if ($this->isGestor || $this->isInversor) {
                if (!Auth::user()->permisoOferta($oferta->asociacion_id)) {
                    return redirect('dashboard/ofertas');
                }
            }
            return view('dashboard.ofertas.detalle')
                ->with(
                    compact(
                        'nueva',
                        'oferta',
                        'tab',
                        'request',
                        'usuariosAsociacion',
                        'formasJuridicas',
                        'sectores',
                        'provincias',
                        'poblaciones',
                        'asociacionesDisponibles'
                    )
                );
        } else {
            abort(404);
        }
    }


    public function update(OfertaRequest $request)
    {
        Parent::RolesCheck();
        $oferta = Oferta::find($request->id);
        $oferta->fill($request->except(['user_id']));
        if ($request->valoracion) {
            $oferta->valoracion = $this->convierteNum($request->valoracion);
        }
        if ($request->endeudamiento) {
            $oferta->endeudamiento = $this->convierteNum($request->endeudamiento);
        }

        if ($request->tab) {
            $tab=$request->tab;
        }
        // dd($oferta, $request->valoracion);
        if ($this->isAdmin && $request->user_id) {
            $oferta->user_id=$request->user_id;
        }
        if ($this->isAsesor && $request->user_id) {
            $asociaciones=Asociacion::whereIn('id', Auth::user()
                            ->getAsociacionesDelUsario())->get();
            if (in_array($request->user_id, $asociaciones->first()->usuarios->pluck('id')->toArray())) {
                $oferta->user_id=$request->user_id;
            } else {
                return redirect('dashboard/ofertas');
            }
        }
        if ($this->isGestor) {
            if (Auth::user()->permisoOferta($oferta->asociacion_id)) {
                $oferta->user_id= Auth::user()->id;
            } else {
                return redirect('dashboard/ofertas');
            }
        }
        if ($this->isInversor) {
            abort(404);
        }
        $oferta->save();
        return redirect()->action('Dashboard\OfertasController@show', ['oferta'=>$oferta,'tab'=>$tab])
        ->with([
            'success'=> true,
            'mensaje'=>__('<strong>'.$oferta->name.'</strong> modificada correctamente')
        ]);
    }

    public function updateEstado(OfertaRequest $request){
        $oferta = Oferta::find($request->id);
        $oferta->approved = $request->input('approved');
        $oferta->save();
        $tab = "estado";
        return redirect()->action('Dashboard\OfertasController@show', ['oferta'=>$oferta,'tab'=>$tab])
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


    public function NotificacionNuevaOferta($oferta)
    {
        $asesores= $oferta->asociacion->asesores();
        Notification::send($asesores, new OfertaNueva($oferta->id));
        Notification::send(User::where('name', 'Admin')->first(), new OfertaNueva($oferta->id));
    }

    public function convierteNUM($valor)
    {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }
}
