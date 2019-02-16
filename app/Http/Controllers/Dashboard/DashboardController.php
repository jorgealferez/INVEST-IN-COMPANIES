<?php

namespace App\Http\Controllers\Dashboard;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EditAsociacionRequest;

class DashboardController extends Controller
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

        return view('dashboard.dashboard');
    }

    public function asociaciones()
    {
        // $asociaciones = \App\Asociacion::where('active',1)->orderBy('updated_at', 'desc')->get();
        // return view('dashboard.asociaciones.asociaciones')
        //         ->with(compact('asociaciones'));
    }


    public function asociacionesNew()
    {
        return 'Nueva Asociacion';
    }


    public function asociacionesShow($id)
    {
        $asociacion = \App\Asociacion::where(['active'=>1, 'id'=>$id])->first();
        //  dd($asociacion->users[0]->roles[0]->name);
        return view('dashboard.asociaciones.detalle')
                ->with(compact('asociacion'));
    }


    public function asociacionesEdit($id,EditAsociacionRequest $request)
    {

        // $asociacion = \App\Asociacion::find($id);
        // $asociacion->name = $request->name;
        // $asociacion->address = $request->address;
        // $asociacion->email = $request->email;
        // $asociacion->phone = $request->phone;
        // $asociacion->save();

        // $asociacion = \App\Asociacion::where(['active'=>1, 'id'=>$id])->first();
        // return redirect()->route('dashboardAsociacion',compact('asociacion'));
    }

}
