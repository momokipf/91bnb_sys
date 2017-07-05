<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\House;

class Houseowner extends Model
{
    	/*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'HouseOwner';
    protected $hidden = [];
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first','last','ownerCompanyName','ownerUsPhoneNumber','ownerPhone2Country',
                            'ownerPhone2Number','ownerEmail','ownerWechatUserName','ownerWechatID',
                            'ownerOtherID','bankAccountName','bankName','bankRountingNumber','bankAccountNumber'];

    /* primaryKey keyword*/

    protected $primaryKey = 'houseOwnerID';
    public $timestamps = false;
    //static public $fields =  


    //Table relationship
    public function houses(){
    	return $this->hasMany('App\House','houseOwnerID');
    }


    public function addHouse($houseinput){
        $newhouse = new House($houseinput);
        $newhouse->setHouseID();
        $point = $houseinput['longitude'].',' .$houseinput['latitude'];
        $newhouse->setLocationAttribute($point);
        $this->houses()->save($newhouse);
        return $newhouse;
    }


    /*
    * Find similar houseowner in database
    * @para $keypair: is a array of key-value pairs that need to match in database
    *       $andOr: 1."AND" 2."OR"
    * Author: Moki 
    */

    public function scopeFindSimilar($query,$keypair,$andOr){
        Log::info($keypair);
        foreach($keypair as $attributes=>$value){
            if(!$value)
                continue;
            if($andOr=='AND'){
                $query->where($attributes,'LIKE','%'.$value.'%');
            }
            else if($andOr=='OR'){
                $query->orwhere($attributes,'LIKE','%'.$value.'%');
            }
        }
        return $query;
    }


}
