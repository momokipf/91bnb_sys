<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class House extends Model
{
    /*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'House';

    protected $geofields = array('location');

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


    public function setLocationAttribute($value){
    	$this->attributes['location'] = DB::raw("POINT($value)");
    }


    public function getLocationAttribute($value){
    	$loc = substr($value,6);
    	$loc  = preg_replace('/[ ,]+/', ',', $loc, 1);
    	return substr($loc,0,-1);
    }

    public function newQuery($excludeDeleted = true)
    {
    	$raw = '';
    	if($excludeDeleted)
    	{
	    	foreach($this->geofields as $column){
	    		$raw .= ' astext('.$column.') as cus_' .$column.' '; 
	    	}
	    }
	    return parent::newQuery($excludeDeleted)->addSelect('*',DB::raw($raw));
    }


    public function scopeDistance($query,$dist,$location)
    {
        return $query->whereRaw('st_distance(location,POINT('.$location.')) < '.$dist);
    }


    public function scopeShpereDistance($query,$dist,$location)
    {
    	return $query->whereRaw('ST_Distance_Sphere(location,POINT('.$location.')) < '. $dist*1000);
    }

    public function scopeWithinCircle($query,$radius,$center)
    {
    	$locationarray = explode(",",trim($center));
    	$longitude = $locationarray[1];
    	$latitude = $locationarray[0]; 

    	$search_area_str = "ST_makeEnvelope(POINT(".$longitude."+".$radius."/111.045,".$latitude."+".$radius."/(111.045*COS(RADIANS(".$longitude.")))),"."POINT(".$longitude."-".$radius."/111.045,".$latitude."-".$radius."/(111.045*COS(RADIANS(".$longitude.")))) )";

    	return $query = $query->whereRaw('MBRContains('.$search_area_str.',location)');
    }

    /*
    $house = App\House::WithinCircle(10.040,'32.751236,-117.091794')->toSql();
	$res = DB::table(DB::raw("($house) as a"))->whereRaw("st_distance(a.location,POINT(-117.091794,31.751236))< 10.040")->get();
	*/



	/*



	*/
}
