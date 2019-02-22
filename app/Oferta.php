<?php

namespace App;
use App\Oferta;
use App\Asociacion;
use App\Traits\DatesTranslator;
use Kyslik\ColumnSortable\Sortable;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
       'asociacion_id',
       'user_id',
       'forma',
       'socios',
       'forma_id',
       'motivo',
       'sector_id',
       'empleados',
       'año',
       'valoracion_id',
       'name',
       'cif',
       'contact',
       'contactSurname',
       'contactPhone',
       'contactEmail',
       'address',
       'municipio',
       'provincia_id',
       'web',
       'explotacion1',
       'explotacion2',
       'explotacion3',
       'endeudamiento',
       'local',
       'active',
       'approved',
    ];
    public $sortable = ['id','name','cif','created_at','approved'];

    public function userSortable($query, $direction)
    {

    }


    public function usuario()
    {
        return $this
        ->belongsTo('App\User','user_id');
    }


    public function asociacion()
    {
        return $this
        ->belongsTo('App\Asociacion');

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

    public function inversores()
    {
        return $this
        ->belongsToMany('App\User','oferta_inversor','oferta_id','user_id')->withTimestamps();
    }

}
