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

    static public $fields= ['additionalNote','offerToothbrush','offerToothpaste','offerFacialWash','offerBodyWash',
                            'offerSoap','offerShampoo','offerConditioner','offerTowel','offerBathTowel','offerHairDryer',
                            'offerIron','offerHangers','offerSlippers','offerWorkSpace','offerWifi','offerTV','offerChineseTV',
                            'offerCable','offerAC','offerHeater','offerHotWaterkettle','offerRiceCooker','offerCookware','offerCookingPan',
                            'offerCookingKnife','offerUtensils','offerCookingPot','havePet','havePetType','haveSmokeDetector','haveFirstAidKit',
                            'haveFireExt','haveCCTV','haveCODetector','haveSafetyGuard','haveBedroomLock','haveSecurityAlarm','allowPregnant',
                            'allowBaby','allowKid','allowKidAge','allowPets','allowPetType','allowKitchen','allowParking','allowSwimmingPool',
                            'allowBBQ','allowFrontYard','allowBackYard','allowLaundryWasher','allowLandryDryer','allowGym','allowElevator',
                            'allowHotTub',
                            ];
    //Table relationship
    public function house(){
        return $this->belongsTo('App\House','numberID');
    }
}
