<?php

namespace App;
use App\Traits\DatesTranslator;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    use DatesTranslator;
    public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }
}
