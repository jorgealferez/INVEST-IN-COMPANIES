<?php

namespace App;
use App\Asociacion;
use App\Traits\DatesTranslator;
use Kyslik\ColumnSortable\Sortable;


use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use DatesTranslator;
    use Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name',
       'cif',
       'contact',
       'contactSurname',
       'contactPhone',
       'contactEmail',
       'address',
       'web',
       'explotacion1',
       'explotacion2',
       'explotacion3',
       'endeudamiento',
       'socios',
       'motivo',
       'año',
       'valoracion',
       'local',
       'phone',
       'active',
    ];
    public $sortable = ['id','name','cif','created_at'];

    public function userSortable($query, $direction)
    {
     
        dd('sdf');
    }


    public function users()
    {
        return $this
        ->belongsToMany('App\User')->withTimestamps();
    }

    public function asociacion()
    {
        return $this
        ->belongsToMany('App\Asociacion')->withTimestamps();
        
        // ->belongsToMany('App\Asociacion','asociacion_oferta','asociacion_id','oferta_id');
    }
    
    public function inversores()
    {
        return $this
        ->belongsToMany('App\User','oferta_inversor','oferta_id','user_id')->withTimestamps();
    }
    // public function getOfertasDeAsociacion ($query, $listado) {
       
    //     return $query->whereHas('asociacions', function ($q) use ($listado) {
    //                     $q->whereIn('asociacion_oferta.asociacion_id', $listado);
    //     });
    // }
    
}
