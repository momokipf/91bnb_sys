<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use DB;
use Schema;

use App\InquiryFollow;
use App\Representative;

class Inquiry extends Model
{
    //
	/*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'inquiry';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'repID',
        'inquiryDate','inquirySource','inquirySourceOther','inquirerID','purpose','purposeOther',
        'checkIn','checkOut',
        'country','state','city','cityOther',
        'fullHouseID','rooms','share','houseType','houseTypeOther','room1Type','room1TypeOther','room2Type','room2TypeOther',
        'room3Type','room3TypeOther', 
        'numOfAdult','numOfChildren','childAge','pregnancy',
        'budgetLower','budgetUpper','budgetUnit',
        'pet','petType',
        'specialNote',
        'inquiryPriorityLevel','status',
        'reasonOfDecline',
        'note',
        'comment',
        'hasBaby'
    ];
    protected $hidden = [];

    /* primaryKey keyword*/

    protected $primaryKey = 'inquiryID';

    public $timestamps = false;

    //protected static $searchable = ['inquiryID','repID','inquiryDate','checkIn','checkOut','inquiryPriorityLevel'];

    //Table relationship
    public function getfollowup(){
    	return $this->hasMany('App\InquiryFollow','inquiryID');
    }

    public function reprensent(){
    	return $this->belongsTo('App\Representative','repID');
    }

    public function quirer(){
        return $this->belongsTo('App\Inquirer','inquirerID');
    }

    //Scope

    public function scopeHotQuerys($query)
    {

    	return $query->where('inquiryPriorityLevel','<',3)
    				 ->whereRaw(DB::raw('checkIn - CURDATE()>=0'))
    				 ->orderBy('inquiryPriorityLevel','asc')
    				 ->orderBy(DB::raw('checkIn - CURDATE()'));	
    }


    public function scopeGetValuesinField($query,$attributes)
    {
    	if(! Schema::hasColumn($this->table,$attributes))
    		return $query;
    	return $query->select($attributes);
    }


    public function scopeSearchbyField($query,$attributes)
    {
        Log::info($attributes);
        if($attributes['inquiryDate']){
            $query =$query->where('InquiryDate','=',$attributes['inquiryDate']);
        }
        if($attributes['inquiryDateFrom']){
            $query = $query->whereRaw("inquiryDate>='".$attributes['inquiryDateFrom']."'");
        }
        if($attributes['inquiryDateTo']){
            $query = $query->whereRaw("InquiryDate<='".$attributes['inquiryDateTo']."'");
        }
        if($attributes['inquiryPriorityLevel']){
            $query = $query->where('inquiryPriorityLevel','=',$attributes['inquiryPriorityLevel']);
        }
        if($attributes['inquirycity']){
            $query = $query->where('city','=',$attributes['inquirycity']);
        }

        return $query;

    }

    //public customized function
    //public function 


}
