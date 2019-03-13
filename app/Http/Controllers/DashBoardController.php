<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashBoardController extends Controller
{
    //
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //
        // \Carbon::setLocale(config('app.locale'));
    }
    public function RolesCheck(){
        $this->isAdmin = false;
        $this->isAsesor = false;
        $this->isGestor = false;
        $this->isInversor = false;
        $this->authUser= Auth::User();


        if (Auth::check()) {
            // COMPRUEBO EL ROL Y PASO VARIABLES EN FUNCION A SU ROL A TODAS LAS VISTAS
            $this->roleActual = $this->authUser->roles()->pluck('name')->first();
            $usuarioActual = 'is'.$this->roleActual;
            $this->{$usuarioActual} = true;
            $notificaciones =$this->authUser->unreadNotifications;
            $this->notifiacionesUsuarios=$notificaciones->whereIn('type', "App\Notifications\Usuarios\UsuarioNuevo");
            $this->notifiacionesOfertas=$notificaciones->whereIn('type', "App\Notifications\Ofertas\OfertaNueva");
            $this->notifiacionesAsociaciones=$notificaciones->whereIn('type', "App\Notifications\Asociaciones\AsociacionNueva");

            view()->composer('*', function($view)
            {
                $view->with([
                        'isAdmin' => $this->isAdmin,
                        'isGestor' => $this->isGestor,
                        'isAsesor' => $this->isAsesor,
                        'isInversor' => $this->isInversor,
                        'roleActual' => $this->roleActual,
                        'notifiacionesUsuarios' => $this->notifiacionesUsuarios,
                        'notifiacionesAsociaciones' => $this->notifiacionesAsociaciones,
                        'notifiacionesOfertas' => $this->notifiacionesOfertas
                    ]);
            });

        }
    }

}
