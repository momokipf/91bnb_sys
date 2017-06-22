<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  \Illuminate\Database\Eloquent\Builder;


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

    protected $primaryKey = ['numberID','roomID'];

    //static public $fields = ['roomType','roomBedType','roomBedTypeOther']

    public $incrementing = false;

    protected function setKeysForSaveQuery(Builder $query){
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }
        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null){
        if(is_null($keyName)){
           $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }


    public $timestamps = false;

    public function house(){
        return $this->belongsTo('App\House','numberID');
    }


}
