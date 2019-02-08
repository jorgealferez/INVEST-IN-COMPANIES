<?php

namespace App;
use App\Traits\DatesTranslator;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Model;

class Asociacion extends Model
{
    
    use DatesTranslator;
    use Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address','email','phone','active','contact','contactPhone','contactEmail','state'
    ];
    public $sortable = ['id','name','active','created_at'];


    public function users()
    {
        return $this
        ->belongsToMany('App\User');
    }


   
}
