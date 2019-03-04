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
        ->belongsTo('App\User','user_id');
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

    // public function inversores()
    // {
    //     return $this
    //     ->belongsToMany('App\User','oferta_inversor','oferta_id','user_id')->with('estado_id')->withTimestamps();
    // }

    public function inversiones()
    {
        return $this->hasMany('App\Inversion');
    }

    public function getValoracionAttribute($value)
    {
        return number_format ($value,2,',','');
    }
    // public function setValoracionAttribute($value)
    // {
    //     $valor = str_replace(".", "", $value);
    //     $valorFinal = str_replace(",", ".", $valor);
    //     // dd($valorFinal);
    //     return $valorFinal;
    // }
    public function getEndeudamientoAttribute($value)
    {
        return number_format ($value,2,',','.');
    }

    public function getContactFullNameAttribute()
    {
        return "{$this->contact} {$this->contactSurname}";
    }



}
