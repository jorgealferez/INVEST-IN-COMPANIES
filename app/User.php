<?php

namespace App;
use App\Role;
use App\Traits\DatesTranslator;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Sortable;
    use DatesTranslator;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname','phone','email', 'password', 'active','LOPD'
    ];
    protected $attributes = [
        'active' => true,
    ];
    public $sortable = ['name','email','asociacion_count'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this
        ->belongsTo('App\Role','role_user','user_id','role_id');
    }
    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function asociaciones()
    {
        return $this
            ->belongsToMany('App\Asociacion')
            ->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }


    public function ofertas()
    {
        return $this
        ->hasMany('App\Oferta');
    }
    public function inversiones()
    {
        return $this
        ->hasMany('App\Inversion')->withTimestamps();
    }


    public function isAdmin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'Admin')
            {
                return true;
            }
        }
    }
    public function isAsesor()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'Asesor')
            {
                return true;
            }
        }
    }
    public function isGestor()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'Gestor')
            {
                return true;
            }
        }
    }
    public function isInversor()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'Inversor')
            {
                return true;
            }
        }
    }

    public function getRoleClass(){

        return 'role'.substr($this->roles->first()->name,0,2);

    }

    public function statusClass(){
        $status="";
        switch ($this->active) {
            case true:
                $status= ($this->email_verified_at) ? "online" :  "away" ;
                break;
            case false:
                $status= "busy" ;
                break;
        }
        return $status;

    }

    public function statusName(){
        $status="";
        switch ($this->active) {
            case true:
                $status= ($this->email_verified_at) ? __('Activo') :  __('Sin verificar') ;
                break;
            case false:
                $status=  __('No Activo') ;
                break;
        }
        return $status;

    }


    public function getAsociacionesDelUsario(){

        $asociacion = $this->asociaciones()->where('active',1)->pluck('asociaciones.id');
        return $asociacion;

    }


    public function permisoOferta($oferta_id){
       if($this->id==$oferta_id){

            return true;
        }else{
            return false;
        }

    }



    public function asociacionesDisponiblesByRole(){

        switch ($this->roles()->first()->name) {
            case 'Admin':
                $asociaciones=Asociacion::all();
                break;
            case 'Asesor':
            case 'Gestor':
                $asociaciones=Asociacion::where([
                    ['active','=',1],
                    ['id','=',$this->asociaciones()->first()->id]
                    ])->get();
                break;

            default:
                $asociaciones=null;
                break;
        }
        return  $asociaciones;
    }

    public function usuariosDeMiAsociacion(){

        switch ($this->roles()->first()->name) {
            case 'Admin':
                $usuarios= User::whereHas('roles', function ($q) {
                    $q->Where('name', 'Gestor')->
                        orWhere('name', 'Asesor');

                })->where('active', 1)->get();
                break;
            case 'Asesor':
                $usuarios=Asociacion::find($this->asociaciones()->first()->id)
                            ->usuarios->where('active', 1);
                break;
            case 'Gestor':
            default:
                $usuarios=null;
                break;
        }
        return  $usuarios;
    }


    public function getUsersFromThisAsociacion(){
        $result = DB::table('asociacion_user')
            ->select('user_id')->whereIn('asociacion_id',$this->getAsociacionesDelUsario())
            ->get()->pluck('user_id');
        $users = User::whereIn('id',$result);
        return $users;

    }



}
