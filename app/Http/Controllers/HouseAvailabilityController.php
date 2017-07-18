<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class HouseAvailabilityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Request $request,$id){

    	$house = \App\House::find($id);
    	$start = $request->input('start');
    	$end = $request->input('end');
    	if($house&&$start&&$end){
    		$availabilities= $house->houseavailability()
    									->availabilitiesInRange($start,$end)
    									->orderBy('rentBegin')->get();

			$ret = array();
    		foreach($availabilities as &$ava){
    			
    			$tmp = array('start'=>$ava->rentBegin,'end'=>$ava->rentEnd,'title'=>'Event');
    			array_push($ret,$tmp);
    		}
    		return response($ret);
    	}
    	else{
    		if($house){
    			Log::info("missing parameter");
    		}
    		else{
    			Log::info("cannot find the house");
    		}
    	}
    }


}
