<?php

namespace App;

use Illuminate\Database\Eloquent\Model;




class InquiryFollow extends Model
{
    //

	//
	/*
    *connected database table's name 
    *
    * @var string
    */
	protected $table = 'inquiryfollowup';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['*'];


	/**
	 * primaryKey 
	 * 
	 * @var integer
	 * @access protected
	 */
	protected $primaryKey = null;

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;

    public $timestamps = false;

    public function inqueryinfo()
    {
    	return $this->belongsTo('App\Inquiry','inquiryID');
    }

}
