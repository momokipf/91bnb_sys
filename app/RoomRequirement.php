<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomRequirement extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'RoomRequirement';

	protected $primaryKey = 'repID';

	public function inquiry(){
		return $this->belongsTo('App\Inquiry','inquiryID');
	}
}
