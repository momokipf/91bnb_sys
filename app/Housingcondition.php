<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Housingcondition extends Model
{
  	/*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'Housingcondition';
    protected $hidden = [];
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];

    /* primaryKey keyword*/

    protected $primaryKey = 'numberID';
    public $timestamps = false;

    //Table relationship
    public function house(){
        return $this->belongsTo('App\House','numberID');
    }
}
