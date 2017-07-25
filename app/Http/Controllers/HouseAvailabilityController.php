<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


use ICal\ICal;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;

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


    public function insert(Request $request,$id){
    	Log::info($request->all());
    	$house = \App\House::find($id);
    	$newHouseAva =  new \App\Houseavailability();
    	$newHouseAva->rentBegin = $request->input('rentStart');
    	$newHouseAva->rentEnd = $request->input('rentEnd');
    	$newHouseAva->inquiryID = $request->input('inquiryID',0);

    	$house->houseavailability()->save($newHouseAva);

    	if($request->ajax()||$request->wantsJson()){
    		return ;
    	}
    }

    //#007FFF => Alhambra_23
    //#FF4040 => Monrovia_13
    //#7CFC00 => TC_21
    //#FF1493 => Arcadia_128
    //#FFD700 => Irvine_85
    //#7FFFD4 => RH_89
    //#F0FFFF => Arcadia_130
    //#FF7F24 => TC_01
    //#00FFFF => Tustin_03


    private $housecals = array(
    						'Alhambra_23'=>array('17046071.ics?s=e9923535454dc862ba756d211d9123a3','#007FFF'),
    						'Monrovia_13'=>array('17867446.ics?s=3db0cd9df87b853420f9eb03958f95f9','#FF4040'),
    						'RH_89'=>array('18044055.ics?s=b810601c619ff7db7cceadaa04341dff','#7FFFD4'),
    						'Irvine_85'=>array('18584713.ics?s=976d6fc96ae42067327bf6565bbe7933','#FFD700'),
    						'TC_01'=>array('18584713.ics?s=976d6fc96ae42067327bf6565bbe7933','#FF7F24'),
    						'Arcadia_128'=>array('18946103.ics?s=fb1388b36d6e0450e3c2ff3d537d4389','#FF1493'),
    						'Arcadia_130'=>array('19309098.ics?s=3312405167315729456c561e8971bbf7','#F0FFFF'),
    						'Tustin_03'=>array('19713586.ics?s=5f323ea05754bc2ce1af2f2259e6e6d5','#00FFFF'),
    						'TC_21'=>array('19786881.ics?s=d1c123ba4f87f4140b3be5abb84a3b8a','#7CFC00'),
    					);


    public function fromSource(Request $request){

    	// Create default HandlerStack
		// $stack = HandlerStack::create();

  //   	$stack->push(
  //   		new CacheMiddleware(
  //   			new PrivateCacheStrategy(
  //   				new LaravelCacheStorage(
  //   					Cache::store('redis')
  //   					)
  //   				)
  //   			),
  //   		'cache'
  //   		);


    	$httpclient = new \GuzzleHttp\Client(['base_uri'=>'https://www.airbnb.com/calendar/ical/','timeout'=>5.0]);
    	$start = $request->input('start');
	    $end = $request->input('end');
    	$ret = array();
    	foreach($this->housecals as $key=>$value){
    		$icalstr = NULL;
     		$filename = storage_path("icals/".(explode('?', $value[0])[0]));
    		if(file_exists($filename)){

				$now = new \DateTime();
				$lasttime = filemtime($filename);
				Log::info(date_timestamp_get($now) - $lasttime);
				if(date_timestamp_get($now) - $lasttime <= 60*60){ // 30*60 = 30 min ;{
					$icalstr = file_get_contents($filename);
				}
    		}
    		if(!isset($icalstr)){

				Log::info("No file in cache");
		    	$response = $httpclient->request('GET',$value[0]);

		    	$length = $response->getHeaders()['Content-Length'][0];
				$icalstr =  $response->getBody()->getContents();
				$bytewrite = file_put_contents($filename, $icalstr);
				if($bytewrite!=$length){
					Log::error("there is inconsistent between ics and actual ics file");
				}
	    	}
	    	try{
	    		$ical = new ICal();
	    		$ical->initString($icalstr);
	    	}catch (\Exception $e) {
	    		Log::info($e);
	    		die($e);
			}
			foreach($ical->eventsFromRange($start,$end) as &$event){
				if($event->summary == "Not available")
					continue;

				$renter = substr($event->summary,0,strpos($event->summary,'('));

				$info = "Renter: ".$renter."; House: ".$key;
				$ts = $event->dtstart_array[2];
				$estart = new \DateTime("@$ts") ;
				$ts = $event->dtend_array[2];
				$eend = new \DateTime("@$ts");

				$tmp = array('id'=>$event->uid,'start'=>$estart->format('Y-m-d'),'end'=>$eend->format('Y-m-d'),'color'=>$value[1],'title'=>$info);
				array_push($ret,$tmp);
			}
		}




		return response($ret);
    }	

}
