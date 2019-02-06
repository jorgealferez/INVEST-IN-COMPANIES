<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use App\User;
use App\Asociacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AsociacionRequest;

class AsociacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $asociaciones = Asociacion::where('active',1)->orderBy('updated_at', 'desc')->get();
        // dd($asociaciones);
        return view('dashboard.asociaciones.asociaciones')
                ->with(compact('asociaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.asociaciones.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AsociacionRequest $request)
    {
        //
        // $asociacion = new Asociacion;
        // $asociacion->fill($request->all());
        // dd($request->all());
        // $asociacion->save();
        $asociacion = new Asociacion;
        $asociacion->fill($request->all());

        $asociacion->save();
        return redirect()->route('dashboardAsociaciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asociacion  $asociacion
     * @return \Illuminate\Http\Response
     */
    public function show(Asociacion $asociacion, $tab='usuarios', Request $request)
    {   
        $errors = Session::get('errors');
        if ($asociacion && $asociacion->active) {
           
            $usuarios = User::where(['active'=>1])
            ->whereHas(
                'roles', function($q){
                            $q->whereIn('name', array('Gestor','Asesor'));
                        }
            )->get();
            $rolesLista = Role::with('users')->whereIn('name', array('Gestor','Asesor'))->get();
// dd($roles->first()->users()->first()->name);

            $usuariosIDs = $asociacion->users->pluck('id')->toArray();
            return view('dashboard.asociaciones.detalle')
                ->with(compact('asociacion','usuarios','usuariosIDs','tab','rolesLista'));
        } else {
            abort(404);
        }
           
      
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asociacion  $asociacion
     * @return \Illuminate\Http\Response
     */
    public function update(AsociacionRequest $request,$tab=null)
    {
        $asociacion = \App\Asociacion::find($request->id);
        $asociacion->fill($request->all());
        $asociacion->save();
        $tab="modificar"; 
        // return redirect()->back()->with('success', true);   
        return redirect()->action('dashboard\AsociacionesController@show',['asociacion'=>$asociacion,'tab'=>$tab])->with('success',true);
        
       
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
        $asociacion->users()->sync($request->usuarios);
        return redirect()->route('dashboardAsociacion',$asociacion)->with('success', true);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asociacion  $asociacion
     * @return \Illuminate\Http\Response
     */
    public function delete(Asociacion $asociacion)
    {
        
        $asociacion->fill(['active'=>false]);
        $asociacion->save();
               
        return redirect()->route('dashboardAsociaciones')->with('success', true);
    }
}
