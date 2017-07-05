<?php
namespace App\Observers;

use App\House;
use Illuminate\Support\Facades\Log;


class HouseObserver
{

	 /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     * Auther: Moki
     */


	public function deleting(House $house){
		Log::info("deleting invoke");
		$house->houseprice()->delete();
		$house->houserooms()->delete();
		Log::info($house);
	}

}