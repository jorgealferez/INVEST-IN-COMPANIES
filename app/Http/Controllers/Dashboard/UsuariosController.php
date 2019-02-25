<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use App\User;
use App\Poblacion;
use App\Asociacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioRequest;
use App\Notifications\OfertaSinAprobar;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\DashBoardController;
use Illuminate\Foundation\Auth\RegistersUsers;

class UsuariosController extends DashBoardController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function __construct()
    {
        //
        // \Carbon::setLocale(config('app.locale'));
    }

    /**
     *
     * Listado de usuarios excepto uno mismo
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Parent::RolesCheck();
        // $query[]=["active" , "<>", NULL];
        if ($this->isAdmin){
            $query[]=['id','<>',Auth::user()->id];
         } else {
            $query=array();
        }
        if($request->input('name')) {
            $query[]=[DB::raw("CONCAT(name, ' ', surname)"), 'LIKE', "%".$request->input('name')."%"];
        }
        if($request->input('email')) {
            $query[]=["email","LIKE","%{$request->input('email')}%"];
        }
        if($request->input('phone')) {
            $query[]=["phone","LIKE","%{$request->input('phone')}%"];
        }
        if($request->input('asociacion_id')) {
            $usuarios = User::with('asociaciones','roles')->where($query)
            ->whereHas('asociaciones', function ($query) use ( $request) {
                $query->where('asociaciones.id', '=', $request->input('asociacion_id'));
            });

        }else{
            $usuarios = User::with('asociaciones','roles')->where($query)->orderBy('created_at','DESC');
        }

        if($request->get('asociacion')=="inversores_count"){
            $usuarios= $usuarios
            ->orderBy('asociaciones.name',$request->get('direction'));
       }else if($request->get('sort')=="asociaciones_count"){
            $usuarios= $usuarios
                        ->orderBy('asociacion_count',$request->get('direction'));

       }
        if ($this->isAsesor) {
            $usuarios= $usuarios
            ->whereHas('asociaciones', function($q) {
                $q->whereIn('asociaciones.id', Auth::user()->getAsociacionesDelUsario());
            });
        }
       $usuarios= $usuarios->sortable()->paginate(10);

       $asociacionesDisponibles=Auth::user()->asociacionesDisponiblesByRole();
        $busqueda = ($request->input('search')) ? $request : null ;

        return view('dashboard.usuarios.usuarios')
                ->with(compact('usuarios','busqueda','asociacionesDisponibles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         Parent::RolesCheck();
        $asociaciones=[];
        if ($this->isAsesor) {
            $roles=Role::all('id','name')->whereIn('name', ['Asesor','Gestor']);
            $asociaciones = Asociacion::find(auth()->user()->getAsociacionesDelUsario()->first());

            if($asociaciones==null){
                return redirect()->route('dashboardUsuarios')->with(['error'=>true,'mensaje'=>  __('No puedes crear usuarios hasta tener una asociación asignada') ]);
            }
        }else{
            $roles=Role::all('id','name');
        }


            return view('dashboard.usuarios.crear',['roles'=>$roles]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
         Parent::RolesCheck();
        $usuario = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);
        if ($this->isAsesor) {
            $asociacion =   Asociacion::find(auth()->user()->getAsociacionesDelUsario()->first()) ;
            $usuario->asociaciones()->save($asociacion);
        }

        $usuario
            ->roles()
            ->attach(Role::find($request->role));

        $usuario->sendEmailVerificationNotification(); // Enviamos email de confirmación de cuenta

        return redirect()->route('dashboardUsuarios')->with(['success'=>true,'mensaje'=>  __('Usuario creado correctamente') ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asociacion  $asociacion
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario, $tab='modificar', Request $request)
    {
         Parent::RolesCheck();
        if($usuario->id<>Auth::user()->id){
            $errors = Session::get('errors');

            if(isset($errors) && $errors->has('role')){
                $tab="roles";
            }else {
                $tab="modificar";
            }
            if ($usuario) {
                $roles=Role::all('id','name');

                $action = action('Dashboard\UsuariosController@update', ['id' => $usuario->id]);
                return view('dashboard.usuarios.detalle')
                    ->with(compact('usuario','roles','tab','action'));
            } else {
                abort(404);
            }
        }else{
            // SI EL USUARIO COINCIDE REDIRIJO
            return redirect()->route('perfilUsuario');
        }


    }

    public function profile(UsuarioRequest $request)
    {
         Parent::RolesCheck();
        $usuario = Auth::user();
        if ($usuario && $usuario->active) {
            $action = action('Dashboard\UsuariosController@profileUpdate', ['id' => $usuario->id]);
            return view('dashboard.usuarios.profile')
                ->with(compact('usuario','action'));
        } else {
            abort(404);
        }

    }



    public function profileUpdate(UsuarioRequest $request)
    {
         Parent::RolesCheck();
        $usuario = Auth::user();
        if ($usuario && $usuario->active) {
            $user = User::find($request->id);
            $user->fill($request->all());
            $user->save();
            return redirect()->route('perfilUsuario')->with([
                'success'=> true,
                'mensaje'=>__('<strong>'.$user->name.'</strong> modificado correctamente')
            ]);
        } else {
                abort(404);
        }


    }

    public function update(UsuarioRequest $request)
    {
         Parent::RolesCheck();
        $user = User::find($request->id);
        $user->fill($request->all());
        $user->active = ($request['active']=="on") ? 1 : 0;
        $user->save();
        return redirect()->route('dashboardUsuario',$user)->with([
            'success'=> true,
            'mensaje'=>__('<strong>'.$user->name.'</strong> modificado correctamente')
        ]);


    }

    public function updateRol(UsuarioRequest $request)
    {  Parent::RolesCheck();
        $user = User::find($request->id);

        $user->roles()->detach();
        $user
            ->roles()
            ->attach(Role::find($request->role));

        $tab="roles";
        return redirect()->action('Dashboard\UsuariosController@show',['usuario'=>$user,'tab'=>$tab])->with([
            'success'=> true,
            'mensaje'=>__('El perfil de <strong>'.$user->name.'</strong> se ha modificado correctamente')
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asociacion  $asociacion
     * @return \Illuminate\Http\Response
     */
    public function delete(User $usuario)
    {
        $relationMethods = ['asociacion'];
        foreach ($relationMethods as $relationMethod) {
            if ($usuario->$relationMethod()->count() > 0) {
                return redirect()->route('dashboardUsuarios')->with(['error'=> true,'mensaje'=>__('No se puede eliminar el usuario '.$usuario->name)]);
            }
        }
        $usuario->fill(['active'=>false]);
        $usuario->save();

        return redirect()->route('dashboardUsuarios')->with([
            'success'=> true,
            'mensaje'=>__('El usuario se ha eliminado correctamente')
        ]);
    }

    public function search(Request $request){
        $data = User::select("name")
                ->where([
                    ["name","LIKE","%{$request->input('query')}%"]
                ])
                ->get();

        return response()->json($data);
    }

    public function searchUsuariosByAsociacion(Request $request){


        if( !empty( $request->except('asociacion') ) && $request->input('asociacion')!=null){
            $data['usuarios'] = Asociacion::Find($request->input('asociacion'))
            ->usuarios->pluck('name','id');
            $data['status']=true;
            return response()->json($data);
        }else{
            return response()->json(['status'=>false]);

        }
    }


    public function searchpoblacionesbyprovincia(Request $request){


        if( $request->input('provincia_id')!=null){
            $data['poblaciones'] = Poblacion::where('provincia_id',$request->input('provincia_id'))
            ->pluck('name','id');
            $data['status']=true;
            return response()->json($data);
        }else{
            return response()->json(['status'=>false]);

        }
    }

}
