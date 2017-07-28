<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Events\HouseDelete;

use App\Observers\HouseObserver;
use DB;



define("FULL_HOUSE_ID_TITLE","91bnb_");

class House extends Model
{

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }
    /*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'House';

    protected $geofields = array('location');

	protected $hidden = ['location'];

    protected $fillable =['houseID','fullHouseID','houseOwnerID','dateHouseAdded','houseIDByOwner',
                          'region','houseAddress','country','state','city','houseZip','longitude','latitude',
                          'houseType','houseTypeOther','size','numOfRooms','numOfBaths','numOfBeds',
                          'maxNumOfGuests','onOtherWebsite'];

	//protected $visible =['country','state','city','fullHouseID','houseAddress','longitude','latitude'];

    /* primaryKey keyword*/

    protected $primaryKey = 'numberID';

    // protected $events =[
    //     'deleted' => HouseDelete::class;
    // ];

    // protected $events = [
    //     'deleted' =>  HouseDelete::class,
    // ];

    public $timestamps = false;

    // public static function boot(){
    //     parent::boot();
    //     House::observe(new HouseObserver());
    // }

    //Table relationship
    public function houseowner(){
        return $this->belongsTo('App\Houseowner','houseOwnerID');
    }

    public function houseprice(){
    	return $this->hasOne('App\Houseprice','numberID');
    }

    public function houserooms(){
        return $this->hasMany('App\Houseroom','numberID');
    }
    public function houseavailability(){
        return $this->hasMany('App\Houseavailability','numberID');
    }
    public function housingcondition(){
        return $this->hasOne('App\Housingcondition','numberID');
    }

    public function houseimage(){
        return $this->hasOne('App\Houseimage','numberID');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction','numberID');
    }

    public function setHouseID(){
        $previousHighestID = House::where('country','=',$this->country)
                              ->where('state','=',$this->state)
                              ->where('city','=',$this->city)
                              ->orderBy('fullHouseID','desc')->first();

        if($previousHighestID){
            $houseid = explode('_',$previousHighestID)[3]+1;
        }
        else{
            $houseid =1;
        } 
        $this->houseID = $houseid;

        $this->fullHouseID = FULL_HOUSE_ID_TITLE.$this->state_abbr($this->state).'_'.str_replace(' ','',$this->city).'_'.sprintf('%04d',$this->houseID);
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
	    		$raw .= ' astext('.$column.')';//    as cus_' .$column.' '; 
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
    	//$locationarray = explode(",",trim($center));
    	
    	$loc = $location['longitude'].','.$location['latitude'];
    	return $query->whereRaw('ST_Distance_Sphere(location,POINT('.$loc.')) < '. $dist*1000);
    }


    /*
	mile per degree = 69.0
	km per degree = 111.045
    */
    public function scopeWithinCircle($query,$radius,$loc)
    {

    	$longitude = $loc['longitude'];
    	$latitude =$loc['latitude'];

    	$search_area_str = "ST_makeEnvelope(POINT(".$longitude."+".$radius."/111.045,".$latitude."+".$radius."/(111.045*COS(RADIANS(".$longitude.")))),
    											  "."POINT(".$longitude."-".$radius."/111.045,".$latitude."-".$radius."/(111.045*COS(RADIANS(".$longitude.")))))";

    	return $query = $query->whereRaw('MBRContains('.$search_area_str.',location)');
    }

    /*
    $house = App\House::WithinCircle(10.040,'32.751236,-117.091794')->toSql();
	$res = DB::table(DB::raw("($house) as a"))->whereRaw("st_distance(a.location,POINT(-117.091794,31.751236))< 10.040")->get();
	*/



	/*



	*/

    private function state_abbr($name){
        $states = array(
            'Alabama'=>'AL',
            'Alaska'=>'AK',
            'Arizona'=>'AZ',
            'Arkansas'=>'AR',
            'California'=>'CA',
            'Colorado'=>'CO',
            'Connecticut'=>'CT',
            'Delaware'=>'DE',
            'Florida'=>'FL',
            'Georgia'=>'GA',
            'Hawaii'=>'HI',
            'Idaho'=>'ID',
            'Illinois'=>'IL',
            'Indiana'=>'IN',
            'Iowa'=>'IA',
            'Kansas'=>'KS',
            'Kentucky'=>'KY',
            'Louisiana'=>'LA',
            'Maine'=>'ME',
            'Maryland'=>'MD',
            'Massachusetts'=>'MA',
            'Michigan'=>'MI',
            'Minnesota'=>'MN',
            'Mississippi'=>'MS',
            'Missouri'=>'MO',
            'Montana'=>'MT',
            'Nebraska'=>'NE',
            'Nevada'=>'NV',
            'New Hampshire'=>'NH',
            'New Jersey'=>'NJ',
            'New Mexico'=>'NM',
            'New York'=>'NY',
            'North Carolina'=>'NC',
            'North Dakota'=>'ND',
            'Ohio'=>'OH',
            'Oklahoma'=>'OK',
            'Oregon'=>'OR',
            'Pennsylvania'=>'PA',
            'Rhode Island'=>'RI',
            'South Carolina'=>'SC',
            'South Dakota'=>'SD',
            'Tennessee'=>'TN',
            'Texas'=>'TX',
            'Utah'=>'UT',
            'Vermont'=>'VT',
            'Virginia'=>'VA',
            'Washington'=>'WA',
            'West Virginia'=>'WV',
            'Wisconsin'=>'WI',
            'Wyoming'=>'WY'
            );
        return $states[$name];
    }
}
