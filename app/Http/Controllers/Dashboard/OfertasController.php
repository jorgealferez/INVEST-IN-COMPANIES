<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Valoracion;
use App\User;
use App\Sector;
use App\Role;
use App\Provincia;
use App\Poblacion;
use App\Oferta;
use App\Inversion;
use App\Http\Requests\OfertaRequest;
use App\Http\Requests\AsociacionRequest;
use App\Http\Controllers\DashBoardController;
use App\Forma;
use App\Estadoinversor;
use App\Asociacion;

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
        $query=array();
        if (!$this->isAdmin) {
            $query[]=["ofertas.active" , "=", 1];
        }
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
            // dd(Auth::user()->getAsociacionesDelUsario(),Auth::user()->id);
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
        $notificaciones =$this->authUser->unreadNotifications->where("type", "App\Notifications\OfertaNueva")->pluck('data')->pluck('oferta_id')->toArray();
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
            $oferta->NotificacionNuevaOferta();
            return redirect()->route('dashboardOfertas')->with([
                'success'=> true,
                'mensaje'=>__('<strong>'.$oferta->name.'</strong> creada correctamente')
            ]);
        }
        if ($this->isAsesor) {
            $oferta->asociacion_id = Auth::user()->asociaciones->first()->id;
            $oferta->save();
            $oferta->NotificacionNuevaOferta();
            return redirect()->route('dashboardOfertas')->with([
                'success'=> true,
                'mensaje'=>__('<strong>'.$oferta->name.'</strong> creada correctamente')
            ]);
        }
        if ($this->isGestor) {
            $oferta->asociacion_id = Auth::user()->asociaciones->first()->id;
            $oferta->user_id = Auth::user()->id;
            if (Auth::user()->permisoOferta($oferta->user_id)) {
                $oferta->save();
                $oferta->NotificacionNuevaOferta();
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
        $estadosInversor=Estadoinversor::all();
        $sectores=Sector::all();
        $provincias=Provincia::all();
        if ($request->tab) {
            $tab=$request->tab;
        } else {
            $tab="inversores";
        }
        $oferta->load('inversiones', 'provincia', 'poblacion', 'asociacion');
        $oferta->inversiones->load('usuario.roles', 'estado');
        if ($oferta) {
            if (in_array($oferta->id, $this->notifiacionesOfertas->pluck('data')->pluck('oferta_id')->toArray())) {
                $this->notifiacionesOfertas->where('data', ['oferta_id'=>$oferta->id])->markAsRead();
                $nueva = true;
            }
            $poblaciones = Poblacion::where('provincia_id', $oferta->provincia_id)->get();
            if ($request->old('tab')) {
                $tab=$request->old('tab');
            }

            if ($this->isAdmin) {
                $asociacionesDisponibles=$this->authUser->asociacionesDisponiblesByRole();
                $usuariosAsociacion=$asociacionesDisponibles->find($oferta->asociacion->id)->usuarios;
            }
            if ($this->isAsesor && $oferta->active) {
                $asociacionesDisponibles=Asociacion::whereIn('id', Auth::user()->getAsociacionesDelUsario())->get();
                if (!empty($asociacionesDisponibles->find($oferta->asociacion_id)->usuarios)) {
                    $usuariosAsociacion=$asociacionesDisponibles->find($oferta->asociacion_id)->usuarios;
                } else {
                    return redirect('dashboard/ofertas');
                }
            } elseif ($this->isAsesor && $oferta->active==false) {
                return redirect('dashboard/ofertas');
            }
            if ($this->isGestor || $this->isInversor) {
                if (!Auth::user()->permisoOferta($oferta->user_id)) {
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
                        'estadosInversor',
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
        // dd($oferta->valoracion,$this->convierteNum($request->valoracion));
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
            if (Auth::user()->permisoOferta($oferta->user_id)) {
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

    public function updateEstado(OfertaRequest $request)
    {
        $oferta = Oferta::find($request->id);
        $oferta->approved = $request->input('approved');
        $oferta->active = $request->input('active');
        $oferta->save();
        if ($request->input('approved')==true) {
            $oferta->NotificacionOfertaAprobada();
        }
        $tab = "estado";
        return redirect()->action('Dashboard\OfertasController@show', ['oferta'=>$oferta,'tab'=>$tab])
        ->with([
            'success'=> true,
            'mensaje'=>__('<strong>'.$oferta->name.'</strong> modificada correctamente')
        ]);
    }

    public function updateEstadoInversor(OfertaRequest $request)
    {
        $inversion = Inversion::findOrFail($request->id);
        $inversion->estado_id = $request->input('estado_id');
        $inversion->save();
        $tab = "inversores";
        return redirect()->action('Dashboard\OfertasController@show', ['oferta'=>$inversion->oferta_id,'tab'=>$tab])
        ->with([
            'success'=> true,
            'mensaje'=>__('Estado de inversión acutalizado')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function delete(Oferta $oferta, Request $request)
    {
        $oferta->active= $request->input('modalborrar_action');
        $oferta->save();

        return redirect()->route('dashboardOfertas') ->with([
            'success'=> true,
            'mensaje'=>__('<strong>'.$oferta->name.'</strong> modificada correctamente')
        ]);
    }




    public function convierteNUM($valor)
    {
        $valoracion = str_replace(".", "", $valor);

        $valorFinal = str_replace(",", ".", $valoracion);
        return $valorFinal;
    }
}
