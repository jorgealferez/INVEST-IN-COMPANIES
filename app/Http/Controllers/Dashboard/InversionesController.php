<?php

namespace App\Http\Controllers\Dashboard;

use App\Inversion;
use App\Estadoinversor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DashBoardController;

class InversionesController extends DashBoardController
{
    //

    public function index()
    {
        Parent::RolesCheck();
        if ($this->isInversor) {
            $inversiones=Inversion::where('user_id', Auth::user()->id)->with('oferta')->sortable()->paginate(11);
            $estadosInversor=Estadoinversor::all();
            return view('dashboard.inversiones.inversiones')
                ->with(compact(
                    'inversiones',
                    'estadosInversor'

                ));
        } else {
            return redirect()->route('dashboard');
        }
    }
}
