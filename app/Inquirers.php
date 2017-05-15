<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquirers extends Model
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


    

}
