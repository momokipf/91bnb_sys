<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Houseimage extends Model
{
    //
    protected $table = 'HouseImage';

    protected $fillable = ['ImageID','numberID','ImagePath'];

    protected $primaryKey = 'ImageID';

    public function house(){
    	return $this->belongsTo('App\House','numberID');
    }


}
