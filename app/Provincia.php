<?php

namespace App;
use App\Traits\DatesTranslator;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //
    use DatesTranslator;
    public $timestamps = false;
}
