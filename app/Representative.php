<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Schema;
use DB;

class Representative extends Model implements
	 AuthenticatableContract,
     AuthorizableContract,
     CanResetPasswordContract

{

	use Authenticatable, Authorizable, CanResetPassword;
    /*
    *connected database table's name 
    *
    * @var string
    */
    protected $table = 'Representative';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active', 'repUserName','repFirstName','repLastName'
    ];
    protected $hidden = ['password'];

    public function queries(){
        return $this->hasMany('App\Inquiry','repID');
    }


    /* primaryKey keyword*/

    protected $primaryKey = 'repID';

    public $timestamps = false;



    public function scopeGetValuesinField($query,$attributes)
    {
        if(! Schema::hasColumn($this->table,$attributes))
            return $query;
        return $query->distinct()->select($attributes);
    }

    public function scopeRepName($query)
    {
        return $query->select(DB::raw('CONCAT(repFirstName,\' \',repLastName) as name'));
    }

    public function inquirer() {
        return Inquirer
                ::whereIn('inquirerID', function ($query) {
                    $query->select('inquirerID')
                        ->from('Inquiry')
                        ->where('repID', $this->repID);
                });


        //return DB::select('select * from inquirer where inquirerID in (select inquirerID from inquiry where repID = ?)', [$this->repID]);
    }

}
