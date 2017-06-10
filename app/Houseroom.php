<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Schema;
class Houseroom extends Model
{
    /*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'HouseRoom';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];
    protected $hidden = [];

    /* primaryKey keyword*/

    protected $primaryKey = 'numberID';

    public $timestamps = false;
}
