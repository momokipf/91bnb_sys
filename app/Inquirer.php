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

    protected static $searable = ['inquirerFirst','inquirerLast','inquirerTaobaoUserName','inquirerWechatUserName','inquirerWechatID'];

    public function queries(){
        return $this->hasMany('App\Inquiry','inquirerID');
    }
    
    public static function searablefield ($arr)
    {   
        // if(!is_array($arr))
        //     return ;
        $res = collect();
        foreach(self::$searable as $field)
        {
            $tmp = array_get($arr,$field);
            if($tmp)
            {
                $res->put($field,$tmp);
            }
        }
        return $res;
    }


    public function scopeFindSimilar($query,$keypair){

        $wheresql = "";
        foreach($keypair as $attributes=>$value){
            $wheresql .= ((strcmp($wheresql,"")==0)? "":"AND ").$attributes." like '%".$value."%' "; 
        }
        Log::info($wheresql);
        return $query-> whereRaw(DB::raw("$wheresql"));
    }


}
