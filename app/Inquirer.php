<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use DB;
use Log;
class Inquirer extends Model
{
    //

    protected $table = 'inquirer';

    /* primaryKey keyword*/

    protected $primaryKey = 'inquirerID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inquirerFirst', 'inquirerLast',
        'inquirerUsPhoneNumber','inquirerPhoneCountry','inquirerPhoneNumber',
        'inquirerEmail','inquirerTaobaoUserName','inquirerWechatUserName',
        'inquirerWechatID','inquirerCountry','inquirerState','inquirerCity',
        'inquirerCityOther'
    ];

    public $timestamps = false;

    protected static $searchable = ['inquirerFirst','inquirerLast','inquirerTaobaoUserName','inquirerWechatUserName','inquirerWechatID', 'inquirerUsPhoneNumber', 'inquirerEmail'];


    public function queries(){
        return $this->hasMany('App\Inquiry','inquirerID');
    }
    

    public static function searchablefield ($arr)
    {   
        // if(!is_array($arr))
        //     return ;
        $res = collect();
        foreach(self::$searchable as $field)
        {
            $tmp = array_get($arr,$field);
            if($tmp)
            {
                $res->put($field,$tmp);
            }
        }
        return $res;
    }


    public function scopeFindSimilar($query,$keypair,$andOr){

        $wheresql = "";
        foreach($keypair as $attributes=>$value){
            $wheresql .= ((strcmp($wheresql,"")==0)? "":$andOr." ").$attributes." like '%".$value."%' "; 
        }
        //Log::info($wheresql);
        return $query-> whereRaw(DB::raw("$wheresql"));
    }


}
