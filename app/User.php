<?php

namespace App;
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
        'active' => true
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
        return $this->roles->first()->name;
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

    public function asociacion()
    {
        return $this
            ->belongsToMany('App\Asociacion')
            ->withTimestamps();
    }
    public function ofertas()
    {
        return $this
            ->belongsToMany('App\Oferta')
            ->withTimestamps();
    }
    public function inversores()
    {
        return $this
        ->belongsToMany('App\Oferta','oferta_inversor','user_id','oferta_id')->withTimestamps();
    }


    public function getRoleClass(){
        
        return 'role'.substr($this->roles->first()->name,0,2);
    
    }

    
    public function getAsociacionesDelUsario(){
        
        $asociacion = $this->asociacion()->pluck('asociacions.id');
        
        // $usuarios = DB::table('asociacion_user')->where('user_id', $this->id)->first();
        return $asociacion;
    
    }
    
    public function getUsersFromThisAsociacion(){
        $result = DB::table('asociacion_user')->select('user_id')->whereIn('asociacion_id', $this->getAsociacionesDelUsario())->get()->pluck('user_id');
        $users = User::whereIn('id',$result); 
        return $users;
        // return DB::table('asociacion_user')->whereIn('asociacion_id', $this->getAsociacionesDelUsario());
    
    }


    
}
