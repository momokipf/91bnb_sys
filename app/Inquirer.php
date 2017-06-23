<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use DB;
use Log;
class Inquirer extends Model
{
    //

    protected $table = 'Inquirer';

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
        'inquirerWechatID','inquirerCountry','inquirerState','inquirerCity'
    ];

    public $timestamps = false;

    protected static $searchable = ['inquirerFirst','inquirerLast','inquirerTaobaoUserName','inquirerWechatUserName','inquirerWechatID', 'inquirerUsPhoneNumber','inquirerEmail'];


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

    /*
    * Find similar inquirer in database
    * @para $keypair: is a array of key-value pairs that need to match in database
    *       $andOr: 1."AND" 2."OR"
    * Author: Moki
    * Patch: Yichen, ,moki(06-22-2017)
    */
    public function scopeFindSimilar($query,$keypair,$andOr){

        foreach($keypair as $attributes=>$value){
            if(!$value)
                continue;
            if($andOr=='AND'){
                $query->where($attributes,'LIKE','%'.$value.'%');
            }
            else if($andOr=='OR'){
                $query->orwhere($attributes,'LIKE','%'.$value).'%';
            }
        }
        return $query;
    }


}
