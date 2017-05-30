<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class House_loc extends Model
{
    /*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'house_loc';

    protected $geofields = array('location');

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


}
