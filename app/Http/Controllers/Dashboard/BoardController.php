<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\DashBoardController;

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
        $contactosEmpresasNuevas =Auth::User()->notifications()->where('type', 'App\Notifications\ContactoEmpresaNueva')->paginate(5);


        // dd($contactosEmpresasNuevas);
        Parent::RolesCheck();
        return view('dashboard.dashboard')->with(
            compact(
                'contactosEmpresasNuevas'
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
}
