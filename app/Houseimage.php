<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Houseimage extends Model
{
    //
    protected $table = 'Houseimage';

    protected $fillable = ['house_id','image','description'];

    protected $primaryKey = 'id';

    public function housebelong(){
    	return $this->belongsTo('App\House','house_id','numberID');
    }


}
