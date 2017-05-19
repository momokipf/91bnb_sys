<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Schema;

class House extends Model
{
	/*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'house';

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


    //Table relationship
    public function houseowner(){
        return $this->belongsTo('App\Houseowner','houseOwnerID');
    }

    public function gethouseprice(){
    	return $this->hasMany('App\Houseprice','numberID');
    }

    public function gethouseavailability(){
        return $this->hasMany('App\Houseavailability','numberID');
    }
    public function gethousingcondition(){
        return $this->hasMany('App\Housingcondition','numberID');
    }


    


    //Scope

    // public function scopeHotQuerys($query)
    // {

    // 	return $query->where('inquiryPriorityLevel','<',3)
    // 				 ->whereRaw(DB::raw('checkIn - CURDATE()>=0'))
    // 				 ->orderBy('inquiryPriorityLevel','asc')
    // 				 ->orderBy(DB::raw('checkIn - CURDATE()'));	
    // }


    // public function scopeGetValuesinField($query,$attributes)
    // {
    // 	if(! Schema::hasColumn($this->table,$attributes))
    // 		return $query;
    // 	return $query->select($attributes);
    // }


}
