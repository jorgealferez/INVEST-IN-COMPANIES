<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\RegistersUsers;

class UsuariosController extends Controller
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
    /**
     * Listado de usuarios excepto uno mismo
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $query[]=["active" , "<>", NULL];
        $query[]=['id','<>',Auth::user()->id];
        if($request->input('search')) { 
            $query[]=["name","LIKE","%{$request->input('search')}%"];  
        }
        $usuarios = User::withCount('asociacion','inversores')->where($query);

        if($request->get('sort')=="inversores_count"){
            $usuarios= $usuarios
                         ->orderBy('inversores_count',$request->get('direction'));
       }else if($request->get('sort')=="asociaciones_count"){
            $usuarios= $usuarios
                        ->orderBy('asociacion_count',$request->get('direction'));

       }
       $usuarios= $usuarios->sortable()->paginate(15);

        $busqueda = ($request->input('search')) ? $request->input('search') : null ;
        return view('dashboard.usuarios.usuarios')
                ->with(compact('usuarios','busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles=Role::all('id','name');
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
        $usuario = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);
        
        $usuario
            ->roles()
            ->attach(Role::find($request->role));

        $usuario->sendEmailVerificationNotification(); // Enviamos email de confirmación de cuenta
        
        return redirect()->route('dashboardUsuarios')->with(['success'=>true,'email'=> $usuario->email]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asociacion  $asociacion
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario, $tab='modificar', Request $request)
    {   
        if($usuario->id<>Auth::user()->id){
            $errors = Session::get('errors');

            if(isset($errors) && $errors->has('role')){
                $tab="roles"; 
            }else {
                $tab="modificar"; 
            }
            if ($usuario && $usuario->active) {
                $roles=Role::all('id','name');
                return view('dashboard.usuarios.detalle')
                    ->with(compact('usuario','roles','tab'));
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

        $usuario = Auth::user();
        if ($usuario && $usuario->active) {
            return view('dashboard.usuarios.profile')
                ->with(compact('usuario'));
        } else {
            abort(404);
        }

    }


   
    public function profileUpdate(UsuarioRequest $request)
    {
       
        $user = User::find($request->id);
        $user->fill($request->all());
        $user->save();
        return redirect()->route('perfilUsuario')->with('success',true);
        
       
    }
   
    public function update(UsuarioRequest $request)
    {
       
        $user = User::find($request->id);
        $user->fill($request->all());
        $user->save();
        return redirect()->route('dashboardUsuario',$user)->with('success',true);
        
       
    }
   
    public function updateRol(UsuarioRequest $request)
    {
       
        $user = User::find($request->id);
        
        $user->roles()->detach();
        $user
            ->roles()
            ->attach(Role::find($request->role));
        
        $tab="roles"; 
        return redirect()->action('dashboard\UsuariosController@show',['usuario'=>$user,'tab'=>$tab])->with('success',true);
        
       
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
               
        return redirect()->route('dashboardUsuarios')->with('success', true);
    }

    public function search(Request $request){
        $data = User::select("name")
                ->where([
                    ["name","LIKE","%{$request->input('query')}%"]
                ])
                ->get();
   
        return response()->json($data);
    }

}
