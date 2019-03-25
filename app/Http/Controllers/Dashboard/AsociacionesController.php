<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Notifications\Asociaciones\AsociacionNueva;
use App\Http\Requests\AsociacionRequest;
use App\Http\Controllers\DashBoardController;
use App\Asociacion;

class AsociacionesController extends DashBoardController
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Parent::RolesCheck();
        $query=array();
        if (!$this->isAdmin) {
            $query[]=["asociaciones.active" , "=", 1];
        }
        if ($request->input('name')) {
            $query[]=["name","LIKE","%{$request->input('name')}%"];
        }
        if ($request->input('phone')) {
            $query[]=["phone","LIKE","%{$request->input('phone')}%"];
        }
        if ($request->input('email')) {
            $query[]=["email","LIKE","%{$request->input('email')}%"];
        }
        if ($request->input('address')) {
            $query[]=["address","LIKE","%{$request->input('address')}%"];
        }
        $asociaciones = Asociacion::where($query);
        if ($this->isAsesor || $this->isGestor) {
            $asociaciones=$asociaciones
                ->whereIn('id', Auth::user()->getAsociacionesDelUsario());
        }
        $asociaciones->sortable(['created_at'=> 'desc'])
        ->withCount('ofertas');


        if ($request->get('sort')=="ofertas_count") {
            $asociaciones= $asociaciones
                ->orderBy('ofertas_count', $request->get('direction'));
        }
        $asociaciones= $asociaciones->sortable()->paginate(5);
        $notificaciones =Auth::User()->unreadNotifications->where("type", "App\Notifications\AsociacionNueva")->pluck('data')->pluck('asociacion_id')->toArray();
        $busqueda = ($request->input('search')) ? $request : null ;
        return view('dashboard.asociaciones.asociaciones')
                ->with(
                    compact(
                        'asociaciones',
                        'busqueda',
                        'notificaciones'
                    )
                );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        Parent::RolesCheck();

        $asociacion = new Asociacion();
        return view('dashboard.asociaciones.crear')->with(compact(
            'asociacion'
        ));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AsociacionRequest $request)
    {
        $asociacion = new Asociacion;
        $asociacion->fill($request->all());
        $asociacion->save();

        $asociacion->NotificacionNuevaAsociacion();
        return redirect()->route('dashboardAsociaciones')->with([
            'success'=> true,
            'mensaje'=>__('Asociación creada correctamente')
        ]);
    }

    public function show(Asociacion $asociacion, $tab='usuarios', Request $request)
    {
        Parent::RolesCheck();
        $nueva = false;
        $errors = Session::get('errors');
        if ($asociacion) {
            if (in_array($asociacion->id, $this->notifiacionesAsociaciones->pluck('data')->pluck('asociacion_id')->toArray())) {
                $this->notifiacionesAsociaciones->where('data', ['asociacion_id'=>$asociacion->id])->markAsRead();
                $nueva = true;
            }
            if (($this->isGestor || $this->isInversor || $this->isAsesor) && $asociacion->active) {
                if (!in_array(Auth::user()->id, $asociacion->usuarios()->get()->pluck('id')->toArray())) {
                    return redirect('dashboard/asociaciones');
                }
            } elseif (($this->isGestor || $this->isInversor || $this->isAsesor) && !$asociacion->active) {
                return redirect('dashboard/asociaciones');
            }
            if ($request->old('tab')) {
                $tab=$request->old('tab');
            } elseif ($request->tab) {
                $tab=$request->tab;
            }
            $usuarios = User::whereHas(
                'roles',
                function ($q) {
                    $q->whereIn('name', array('Gestor','Asesor'));
                }
            )->get();
            $rolesLista = Role::with('users')->whereIn('name', array('Gestor','Asesor'))->get();
            $usuariosIDs = $asociacion->usuarios->pluck('id')->toArray();

            return view('dashboard.asociaciones.detalle')
                ->with(compact(
                    'nueva',
                    'asociacion',
                    'usuarios',
                    'usuariosIDs',
                    'tab',
                    'rolesLista',
                    'request'
                ));
        } else {
            abort(404);
        }
    }


    public function update(AsociacionRequest $request, $tab=null)
    {
        Parent::RolesCheck();
        $asociacion = \App\Asociacion::find($request->id);
        $asociacion->fill($request->all());
        $asociacion->save();
        if ($request->tab) {
            $tab=$request->tab;
        }
        // return redirect()->back()->with('success', true);
        return redirect()->action('Dashboard\AsociacionesController@show', ['asociacion'=>$asociacion,'tab'=>$tab])->with([
            'success'=> true,
            'mensaje'=>__('Asociación modificada correctamente')
        ]);
    }



    /**
     * Update Usuarios de la asociacion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asociacion  $asociacion
     * @return \Illuminate\Http\Response
     */
    public function updateUsers(Request $request)
    {
        //
        $asociacion = \App\Asociacion::find($request->id);
        $asociacion->usuarios()->sync($request->usuarios);
        return redirect()->route('dashboardAsociacion', $asociacion)->with([
            'success'=> true,
            'mensaje'=>__('Usuarios de la asociación actualizados correctamente')
        ]);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asociacion  $asociacion
     * @return \Illuminate\Http\Response
     */
    public function delete(Asociacion $asociacion, Request $request)
    {
        $asociacion->active= $request->input('modalborrar_action');
        $asociacion->save();

        return redirect()->route('dashboardAsociaciones')->with([
            'success'=> true,
            'mensaje'=>__('<strong>'.$asociacion->name.'</strong> eliminada correctamente')
        ]);
    }





    public function search(Request $request)
    {
        $query[]=["name","LIKE","%{$request->input('query')}%"];
        if (Auth::user()->hasAnyRole(["Asesor","Gestor"])) {
        }

        $asociaciones = Asociacion::select("name");
        switch (Auth::user()->roles()->first()->name) {
            case 'Gestor':
                $query[]=["id","=", Auth::user()->getAsociacionesDelUsario()];
            break;
            case 'Asesor':
                $asociaciones=$asociaciones
                ->whereIn('id', Auth::user()->getAsociacionesDelUsario());

            break;
        }
        $data= $asociaciones->where($query)->get();
        return response()->json($data);
    }
}
