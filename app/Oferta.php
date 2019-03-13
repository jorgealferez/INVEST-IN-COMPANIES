<?php

namespace App;

use App\Oferta;
use App\Asociacion;
use App\Traits\DatesTranslator;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Notifications\Ofertas\OfertaNueva;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Ofertas\OfertaAprobada;

class Oferta extends Model
{
    use Notifiable;
    use DatesTranslator;
    use Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'active',
       'address',
       'año',
       'approved',
       'asociacion_id',
       'cif',
       'contact',
       'contactEmail',
       'contactPhone',
       'contactSurname',
       'descripcion',
       'empleados',
       'endeudamiento',
       'explotacion1',
       'explotacion2',
       'explotacion3',
       'forma_id',
       'forma',
       'local',
       'motivo',
       'poblacion_id',
       'name',
       'provincia_id',
       'sector_id',
       'socios',
       'user_id',
       'valoracion',
       'web',
    ];
    // protected $casts = [
    //     'endeudamiento' => 'decimal:2',
    // ];
    public $sortable = ['id','name','cif','created_at','approved'];

    public function userSortable($query, $direction)
    {
    }


    public function usuario()
    {
        return $this
        ->belongsTo('App\User', 'user_id');
    }


    public function asociacion()
    {
        return $this
        ->belongsTo('App\Asociacion');
    }
    public function forma()
    {
        return $this
        ->belongsTo('App\Forma');
    }

    public function sector()
    {
        return $this
        ->belongsTo('App\Sector');
    }

    public function provincia()
    {
        return $this
        ->belongsTo('App\Provincia');
    }

    public function poblacion()
    {
        return $this
        ->belongsTo('App\Poblacion');
    }



    public function inversiones()
    {
        return $this->hasMany('App\Inversion');
    }



    public function getContactFullNameAttribute()
    {
        return "{$this->contact} {$this->contactSurname}";
    }

    public function NotificacionNuevaOferta()
    {
        $administradores = Role::with('users')->where('name', 'Admin')->first()->users()->get();
        $asesores= $this->asociacion->asesores();
        $usuario = User::find($this->user_id);
        if (!in_array($this->user_id, $asesores->pluck('id')->toArray())) {
            Notification::send($usuario, new OfertaNueva($this->id, $usuario));
        }
        foreach ($asesores as $asesor) {
            Notification::send($asesor, new OfertaNueva($this->id, $asesor));
        }
        foreach ($administradores as $administrador) {
            Notification::send($administrador, new OfertaNueva($this->id, $administrador));
        }
        //
            // Notification::send($administradores, new OfertaNueva($this->id,$administradores));
    }
    public function NotificacionOfertaAprobada()
    {
        $usuario = User::find($this->user_id);
        Notification::send($usuario, new OfertaAprobada($this->id, $usuario));
    }
}
