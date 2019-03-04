<?php

namespace App;

use App\Traits\DatesTranslator;

use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
    //
    use DatesTranslator;

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
        ->belongsTo('App\User','user_id');

    }
    public function estado()
    {
        return $this
        ->belongsTo('App\Estadoinversor');

    }
}
