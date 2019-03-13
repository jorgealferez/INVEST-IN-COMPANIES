<?php

namespace App;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Traits\DatesTranslator;
use App\Role;
use App\Notifications\Asociaciones\AsociacionNueva;

class Asociacion extends Model
{


    use Notifiable;
    use DatesTranslator;
    use Sortable;

    protected $table = 'asociaciones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address','email','phone','active','contact','contactSurname','contactPhone','contactEmail','state'
    ];
    public $sortable = ['id','name','phone','email','address','created_at'];


    public function usuarios()
    {
        return $this
        ->belongsToMany('App\User')->withTimestamps();
    }

    public function asesores()
    {

        $result = $this->usuarios->pluck('id');

        $users = User::whereIn('id',$result)
        ->whereHas('roles', function ($query) {
            $query->where('name', '=', 'Asesor');
        })->get();
        return  $users;
    }

    public function gestores()
    {

        $result = $this->usuarios->pluck('id');

        $users = User::whereIn('id',$result)
        ->whereHas('roles', function ($query) {
            $query->where('name', '=', 'Gestor');
        })->get();
        return  $users;
    }

    public function ofertas()
    {
        return $this
        ->hasMany('App\Oferta','asociacion_id')
        ;
    }

    public function getUsers()
    {
        return $this
        ->belongsToMany('App\User')->toArray();
    }



    public function Asociaciones () {

        return $this->pluck('id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->contact} {$this->contactSurname}";
    }
    public function NotificacionNuevaAsociacion()
    {
        $administradores = Role::with('users')->where('name', 'Admin')->first()->users()->get();
        Notification::send($administradores, new AsociacionNueva($this->id));
    }
}
