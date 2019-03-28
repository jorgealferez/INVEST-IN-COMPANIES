<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use App\User;
use App\Oferta;
use App\Inversion;
use App\Asociacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\DashBoardController;
use Illuminate\Support\Facades\DB;

class BoardController extends DashBoardController
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */


    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Parent::RolesCheck();
        
        if ($this->isAdmin) {
            $numAsociaciones = Asociacion::where('active', '1')->count();
            $numOfertas = Oferta::where('active', '1')->count();
            $numInversiones = Inversion::count();
            $numInversores = Role::with('users')->where('name', 'Inversor')->first()->users()->count();
            
            $inversiones = Inversion::take(5)->orderBy('created_at', 'DESC')->get();

            $contactosEmpresasNuevas =Auth ::User()->notifications()->where('type', 'App\Notifications\Generico\ContactoEmpresaNueva')->paginate(3);
            $usuarios = User::with('asociaciones', 'roles')->where('active', '1')->take(5)->orderBy('created_at', 'DESC')->get();
            $asociaciones = Asociacion::with('ofertas')->where('active', '1')->take(5)->orderBy('created_at', 'DESC')->get();
            $ofertas = Oferta::with('inversiones', 'asociacion')->where('active', '1')->take(5)->orderBy('created_at', 'DESC')->get();
        } elseif ($this->isAsesor) {
            $asociacionesUsuario = Auth::user()->getAsociacionesDelUsario();
            
            $ofertas = Oferta::with('inversiones', 'asociacion')->whereHas('asociacion', function ($q) use ($asociacionesUsuario) {
                $q->whereIn('asociacion_id', $asociacionesUsuario);
            })->orderBy('created_at', 'DESC')->get();
            $numOfertas = $ofertas->count();
            $ofertasaprobadas = $ofertas->where('approved', 1)->count();
            
            $inversiones = Inversion::whereIn('oferta_id', $ofertas->pluck('id')->toArray())->get();
            $numInversiones = $inversiones->count();

            // $usuarios =  DB::table('asociacion_user')->whereIn('asociacion_id', $asociacionesUsuario)->get();
            
            if ($asociacionesUsuario->isNotEmpty()) {
                $usuarios =  Asociacion::find($asociacionesUsuario->first())->usuarios()->take(5)->orderBy('created_at', 'DESC')->get();
                $numUsuarios =  $usuarios->count();
            } else {
                $usuarios =collect();
                $numUsuarios = 0;
            }
    
            $ofertas = $ofertas->take(5);
           
            $numInversores = $inversiones->count();
            $inversiones = $inversiones->take(5);
        } elseif ($this->isGestor) {
            $asociacionesUsuario = Auth::user()->getAsociacionesDelUsario();
            
            $ofertas = Oferta::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            $numOfertas = $ofertas->count();
            $ofertasaprobadas = $ofertas->where('approved', 1)->count();

            if ($asociacionesUsuario->isNotEmpty()) {
                $usuarios =  Asociacion::find($asociacionesUsuario->first())->usuarios()->take(5)->orderBy('created_at', 'DESC')->get();
                $numUsuarios =  $usuarios->count();
            } else {
                $usuarios =collect();
                $numUsuarios = 0;
            }
           
            
            $inversiones = Inversion::whereIn('oferta_id', $ofertas->pluck('id')->toArray())->get();
            
            $numInversiones = $inversiones->count();
            $ofertas = $ofertas->take(5);
            $inversiones = $inversiones->take(5);
        } elseif ($this->isInversor) {
            return redirect()->route('dashboardInversiones');
        }
        

        
        

        return view('dashboard.dashboard')->with(
            compact(
                'numAsociaciones',
                'numOfertas',
                'numInversiones',
                'numInversores',
                'inversiones',
                'ofertasaprobadas',
                'ofertasNoaprobadas',
                'contactosEmpresasNuevas',
                'usuarios',
                'numUsuarios',
                'ofertas',
                'asociaciones'
            )
        );
    }


    public function borrarNotificacion(Request $request)
    {
        if ($request->input('notificacion_id')!=null) {
            Auth::User()->notifications()->where('id', $request->input('notificacion_id'))->delete();

            $data['status']=true;
            return response()->json($data);
        } else {
            return response()->json(['status'=>false]);
        }
    }

    public function getElementosDashboard($type)
    {
        Parent::RolesCheck();
        switch ($type) {
            case 'solicitudesEmpresa':
                $elementos =Auth::User()->notifications()->where('type', 'App\Notifications\Generico\ContactoEmpresaNueva')->paginate(5);
                $view = View::make('dashboard.dashboard.solicitudesEmpresa')->with('elementos', $elementos);

                break;

            case 'inversores':
                if ($this->isAdmin) {
                    $inversiones = Inversion::orderBy('created_at', 'DESC');
                } elseif ($this->isAsesor) {
                    $asociacionesUsuario = Auth::user()->getAsociacionesDelUsario();

                    $ofertas = Oferta::with('inversiones', 'asociacion')->whereHas('asociacion', function ($q) use ($asociacionesUsuario) {
                        $q->whereIn('asociacion_id', $asociacionesUsuario);
                    })->orderBy('created_at', 'DESC')->get();
                    $inversiones = Inversion::whereIn('oferta_id', $ofertas->pluck('id')->toArray())->orderBy('created_at', 'DESC');
                } elseif ($this->isGestor) {
                    $ofertas = Oferta::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
                    $inversiones = Inversion::whereIn('oferta_id', $ofertas->pluck('id')->toArray())->orderBy('created_at', 'DESC');
                }
                
                //
                $inversiones= $inversiones->paginate(5);
                $view = View::make('dashboard.dashboard.inversores')->with('inversiones', $inversiones);

                break;
        }
        

        
        return $view;
        exit;
    }
}
