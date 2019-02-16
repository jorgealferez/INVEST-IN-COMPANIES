<?php

namespace App;
use App\Traits\DatesTranslator;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Asociacion extends Model
{


    use DatesTranslator;
    use Sortable;

    protected $table = 'asociaciones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address','email','phone','active','contact','contactPhone','contactEmail','state'
    ];
    public $sortable = ['id','name','active','created_at'];


    public function usuarios()
    {
        return $this
        ->belongsToMany('App\User');
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

    // public function usuarios()
    // {
    //     return $this
    //     ->belongsToMany('App\User','asociacion_user','asociacion_id','user_id')->withTimestamps();

    //     // ->belongsToMany('App\Asociacion','asociacion_oferta','asociacion_id','oferta_id');
    // }

    // public function scopeStatus (Builder $query, $name) {
    //     return $query->whereHas('user_id', function ($q) use ($name) {
    //             $q->where('id', $name);
    //     });
    // }

    public function Asociaciones () {

        return $this->pluck('id');
    }


}
