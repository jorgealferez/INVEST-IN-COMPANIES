<?php

namespace App;

use App\Traits\DatesTranslator;
use Kyslik\ColumnSortable\Sortable;

use App\Oferta;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;


use App\Notifications\Inversores\InversorNuevo;

class Inversion extends Model
{
    use Notifiable;
    use DatesTranslator;
    use Sortable;

    protected $table = 'inversiones';
    // public $timestamps = false;


    public function oferta()
    {
        return $this
        ->belongsTo('App\Oferta');
    }
    public function usuario()
    {
        return $this
        ->belongsTo('App\User', 'user_id');
    }
    public function estado()
    {
        return $this
        ->belongsTo('App\Estadoinversor');
    }
    public function NotificacionNuevoInversor()
    {
        $oferta = Oferta::find($this->oferta_id);
        $administradores = Role::with('users')->where('name', 'Admin')->first()->users()->get();
        $asesores= $oferta->asociacion->asesores();
        $usuario = User::find($this->user_id);
        if (!in_array($this->user_id, $asesores->pluck('id')->toArray())) {
            Notification::send($usuario, new InversorNuevo($this->id, $usuario));
        }
        foreach ($asesores as $asesor) {
            Notification::send($asesor, new InversorNuevo($this->id, $asesor));
        }
        foreach ($administradores as $administrador) {
            Notification::send($administrador, new InversorNuevo($this->id, $administrador));
        }
    }
}
