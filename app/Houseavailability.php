<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Houseavailability extends Model
{
        //
	/*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'HouseAvailability';
    protected $hidden = [];
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];

    /* primaryKey keyword*/
    protected $primaryKey = ['numberID','avaid'];

    public $timestamps = false;


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
    //Table relationship
    public function house(){
        return $this->belongsTo('App\House','numberID');
    }


    public function scopeavailabilitiesInRange($query,$start,$end){


        return $query->where('rentEnd','>',$start)
                        ->orwhere('rentBegin','<',$end);
    }
}
