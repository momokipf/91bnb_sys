<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\House;

class Houseowner extends Model
{
    	/*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'houseowner';
    protected $hidden = [];
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];

    /* primaryKey keyword*/

    protected $primaryKey = 'houseOwnerID';
    public $timestamps = false;

    //Table relationship
    public function house(){
    	return $this->hasMany('App\House','houseOwnerID');
    }

}
