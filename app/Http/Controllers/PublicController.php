<?php
namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Oferta;
use App\Sector;
use App\Inversion;
use App\Poblacion;
use App\Provincia;
use App\Asociacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\NuevaEmpresaRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Generico\ContactoEmpresaNueva;

class PublicController extends Controller
{
    public $precios;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->precios = collect([
            (object)['value' => 1, 'name' => '< 10.000 €'],
            (object)['value' => 2, 'name' => '10.000 – 25.000 €'],
            (object)['value' => 3, 'name' => '25.000 – 50.000 €'],
            (object)['value' => 4, 'name' => '50.000 – 100.000 €'],
            (object)['value' => 5, 'name' => '100.000 – 250.000 €'],
            (object)['value' => 6, 'name' => '250.000 – 500.000 €'],
            (object)['value' => 7, 'name' => '500.000 – 1.000.000 €'],
            (object)['value' => 8, 'name' => '> 1.000.000 €'],
        ]);
        

        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $provincias=Provincia::all();
        $sectores=Sector::all();
        $asociaciones=Asociacion::all();
        $precios = $this->precios;

        if (Auth::check()) {
            $inversiones = Auth::User()->inversiones->pluck('oferta_id')->toArray();
            $invitado = 0;
        } else {
            $inversiones = array();
            $invitado = 1;
        }

        

        return view('public.home')
        ->with(
            compact(
                'request',
                'provincias',
                'sectores',
                'asociaciones',
                'precios',
                'inversiones',
                'invitado'
            )
        );
    }
    public function quienes()
    {
        $provincias=Provincia::all();
        return view('public.quienes')
        ->with(
            compact(
                'provincias'
            )
        );
    }
    public function vende(NuevaEmpresaRequest $request)
    {
        $provincias=Provincia::all();
        
        return view('public.vende')
        ->with(
            compact(
                'provincias',
                'request'
            )
        );
    }
    public function compra(NuevaEmpresaRequest $request)
    {
        return view('public.compra')
        ->with(
            compact(
                'request'
            )
        );
    }
    public function socio()
    {
        return view('public.socio')
            ->with(
                compact(
                    'provincias'
                )
        );
    }
    public function registro(RegistroRequest $request)
    {
        $user = User::create([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
            ]);

        $user->NotificacionNuevoUsuario();
        $user
            ->roles()
            ->attach(Role::where('name', 'Inversor')->first());

        $enviado = true;
        return redirect(url()->previous() . '#formulario')->with(compact(
            'enviado'
            ));
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:2', 'confirmed']
            ]);
    }
    public function inversion(Request $request)
    {
        if ($request->input('oferta_id')!=null && Auth::check()) {
            $inversion = new Inversion();
            $inversion->user_id = Auth::User()->id;
            $inversion->oferta_id = $request->input('oferta_id');
            $inversion->estado_id =1;
            $inversion->save();
            $inversion->NotificacionNuevoInversor();


            $data['status']=true;
            return response()->json($data);
        } else {
            return response()->json(['status'=>false]);
        }
    }
    public function vendeContacto(NuevaEmpresaRequest $request)
    {
        $administradores = Role::with('users')->where('name', 'Admin')->first()->users()->get();
        foreach ($administradores as $administrador) {
            Notification::send($administrador, new ContactoEmpresaNueva($administrador, $request->input('name'), $request->input('email'), $request->input('phone')));
        }

        $enviado = true;
        $provincias=Provincia::all();
        return redirect()->to(route('vendeEmpresa'). '#formulario')->with(compact(
            'provincias',
            'enviado'
        ));
    }


    public function buscador(Request $request)
    {
        $provincias=Provincia::all();
        $sectores=Sector::all();
        $asociaciones=Asociacion::all();

        if (Auth::check()) {
            $inversiones = Auth::User()->inversiones->pluck('oferta_id')->toArray();
            $invitado = 0;
        } else {
            $inversiones = array();
            $invitado = 1;
        }

       
        $precios = $this->precios;


        $query[]=["ofertas.active" , "=", 1];
        $query[]=["ofertas.approved" , "=", 1];

        // if ($request->input('name')) {
        //     $query[]=["ofertas.name","LIKE","%{$request->input('name')}%"];
        //     // $query[]=["ofertas.descripcion","LIKE","%{$request->input('name')}%"];
        // }
        if ($request->input('provincia_id')) {
            $query[]=["ofertas.provincia_id","=",$request->input('provincia_id')];
        }
        if ($request->input('sector_id')) {
            $query[]=["ofertas.sector_id","=",$request->input('sector_id')];
        }
        if ($request->input('asociacion_id')) {
            $query[]=[ "ofertas.asociacion_id","=",$request->input('asociacion_id')];
        }



        $ofertas = Oferta::with('provincia', 'sector', 'forma', 'poblacion')
                ->leftJoin('provincias', 'provincias.id', '=', 'ofertas.provincia_id')
                ->leftJoin('sectores', 'sectores.id', '=', 'ofertas.sector_id')
                ->where($query);



        if ($request->input('precio')) {
            switch ($request->input('precio')) {
                case "1":
                $valores=array([0,10000]);
                break;
                case "2":
                $valores=array([10000,25000]);
                break;
                case "3":
                $valores=array([25000,50000]);
                break;
                case "4":
                $valores=array([50000,100000]);
                break;
                case "5":
                $valores=array([100000,250000]);
                break;
                case "6":
                $valores=array([250000,500000]);
                break;
                case "7":
                $valores=array([500000,1000000]);
                break;
                case "8":
                $valores=array([1000000,1000000000]);
                break;
            }
            $ofertas= $ofertas
                ->whereBetween('ofertas.valoracion', $valores);
        }

        if ($request->input('name')) {
            $ofertas= $ofertas->where(function ($query) use ($request) {
                $query->where('ofertas.name', 'like', "%{$request->input('name')}%");
                $query->orWhere('ofertas.descripcion', 'like', "%{$request->input('name')}%");
            });
        }

        if ($request->get('sort')=="valoracion") {
            $ofertas= $ofertas
                ->orderBy('valoracion', $request->get('direction'));
        }

        if ($request->get('sort')=="sector") {
            $ofertas= $ofertas
                ->orderBy('sectores.name', $request->get('direction'));
        }


        $ofertas= $ofertas->select('ofertas.*', 'sectores.name as sector_name')->sortable()->paginate(15);

        $busqueda = ($request->input('search')) ? $request->input('search') : null ;

        return view('public.buscador')
        ->with(
            compact(
                'request',
                'provincias',
                'sectores',
                'asociaciones',
                'precios',
                'inversiones',
                'invitado',
                'ofertas'
            )
        );
    }

    public function origintal()
    {
        $provincias=Provincia::all();
        return view('public.home')
        ->with(
            compact(
                'provincias'
            )
        );
    }
}
