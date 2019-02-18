<?php

namespace App;
use App\Traits\DatesTranslator;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //
    use DatesTranslator;
    public $timestamps = false;


    // public function ofertas()
    // {
    //     return $this
    //     ->belongsTo('App\Provincia');

    // }
}
