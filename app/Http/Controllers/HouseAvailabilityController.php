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

    			$tmp = array('start'=>$ava->rentBegin,'end'=>$ava->rentEnd,'id'=>$id.'_'.$ava->avaid);
    			if($ava->inquiryID==0&&$ava->source=="inner"){
    				$tmp['color'] = '#ff1a1a';
    				$tmp['title'] = 'Block';
    			}
                else if($ava->source=="Airbnb"){
                    $tmp['color'] = '#A52A2A'; 
                    $tmp['durationEditable'] = false;
                    $tmp['startEditable'] = false;
                    $tmp['editable'] = false;
                    if($ava->description!="Not available"){
                        $tmp['title'] = $ava->source;
                    }
                    else{
                        $tmp['title'] = "Block";
                    }
                }


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
    	//Log::info($request->input('source','inner'));
    	$house = \App\House::find($id);
    	$highava = $house->houseavailability()->orderBy('avaid','desc')->first();
    	if($highava)
    		$avaid = $highava->avaid+1;
    	else
    		$avaid = 0;	

    	$newHouseAva =  new \App\Houseavailability();

    	$newHouseAva->rentBegin = $request->input('rentStart');
    	$newHouseAva->rentEnd = $request->input('rentEnd');
    	$newHouseAva->inquiryID = $request->input('inquiryID',0);
    	$newHouseAva->source = $request->input('source','inner');
    	$newHouseAva->idInSource = $request->input('idInSource');
    	$newHouseAva->avaid = $avaid;
    	$house->houseavailability()->save($newHouseAva);

    	if($request->ajax()||$request->wantsJson()){
    		return ;
    	}
    }


    public function update(Request $request,$id){
    	$avaid = $request->input('avaid');
    	Log::info($request->all());
    	if(isset($avaid)){
    		$houseava = \App\Houseavailability::where('numberID','=',$id)->where('avaid','=',$avaid)->first();
			if($houseava){
				if($request->input('delete')=='true'){
					$houseava->delete();
				}
				else{
					$houseava->rentBegin = $request->input('rentStart');
					$houseava->rentEnd = $request->input('rentEnd');
					$houseava->save();
				}
			}    		

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
    						'Alhambra_0023'=>array('17046071.ics?s=e9923535454dc862ba756d211d9123a3','#007FFF'),
    						'Monrovia_0013'=>array('17867446.ics?s=3db0cd9df87b853420f9eb03958f95f9','#FF4040'),
    						'RH_0089'=>array('18044055.ics?s=b810601c619ff7db7cceadaa04341dff','#7FFFD4'),
    						'Irvine_0085'=>array('18584713.ics?s=976d6fc96ae42067327bf6565bbe7933','#FFD700'),
    						'TempleCity_0001'=>array('18584713.ics?s=976d6fc96ae42067327bf6565bbe7933','#FF7F24'),
    						'Arcadia_128'=>array('18946103.ics?s=fb1388b36d6e0450e3c2ff3d537d4389','#FF1493'),
    						'Arcadia_130'=>array('19309098.ics?s=3312405167315729456c561e8971bbf7','#F0FFFF'),
    						'Tustin_0003'=>array('19713586.ics?s=5f323ea05754bc2ce1af2f2259e6e6d5','#00FFFF'),
    						'TempleCity_0021'=>array('19786881.ics?s=d1c123ba4f87f4140b3be5abb84a3b8a','#7CFC00'),
    					);

    public function importSource(Request $request){
        if(!file_exists(storage_path('icals')))
            mkdir(storage_path('icals'),0700);

        foreach($this->housecals as $key=>$value){
            $icalstr = NULL;
            $filename = storage_path("icals/".(explode('?', $value[0])[0]));
            $icalstr = file_get_contents($filename);
            try{
                $ical = new ICal();
                $ical->initString($icalstr);
            }catch (\Exception $e) {
                Log::info($e);
                die($e);
            }
            $house = \App\House::where('fullHouseID','LIKE','%'.$key)->first();
            if(!isset($house)){
                Log::debug($key." can not found");    
                continue;
            }
            $highava = $house->houseavailability()->orderBy('avaid','desc')->first();
            if($highava)
                $avaid = $highava->avaid+1;
            else
                $avaid = 0; 
            foreach($ical->events() as &$event){
                $houseava = $house->houseavailability()->where('idInSource','=',$event->uid)->first();
                if(isset($houseava))continue;
                $ts = $event->dtstart_array[2];
                $estart = new \DateTime("@$ts") ;
                $ts = $event->dtend_array[2];
                $eend = new \DateTime("@$ts");

                $newHouseAva = new \App\Houseavailability();
                $newHouseAva->rentBegin=$estart->format('Y-m-d');
                $newHouseAva->rentEnd = $eend->format('Y-m-d');
                $newHouseAva->inquiryID = 0; 
                $newHouseAva->source = "Airbnb";
                $newHouseAva->idInSource = $event->uid;
                $newHouseAva->avaid = $avaid;
                $avaid++;
                if($event->summary == "Not available")
                {
                    $newHouseAva->description = $event->summary;
                }
                else{
                    $newHouseAva->description = $event->description.'\nRENTER: '.$event->summary;
                }   
                Log::debug($newHouseAva);
                $house->houseavailability()->save($newHouseAva);
            }
        }
        if($request->ajax()||$request->wantsJson){
            Log::info("fin");
            return response()->json(['status'=>'success'])
                                ->header('Content','json');
        }
    }
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
    	if(!file_exists(storage_path('icals'))){
    		mkdir(storage_path("icals"), 0700);
    	}

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
				if(date_timestamp_get($now) - $lasttime <= 60*60){ // 60*60 = 30 min ;{
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

			$house = \App\House::where('fullHouseID','LIKE','%'.$key)->first();
			if($house)
				Log::info("House ID : ".$house->numberID);
			else
				Log::info($key." can not found");

			foreach($ical->eventsFromRange($start,$end) as &$event){
				if($event->summary == "Not available")
					continue;

				$renter = substr($event->summary,0,strpos($event->summary,'('));

				$info = "Renter: ".$renter."; House: ".$key;
				if(preg_match("/PHONE:([\s\+]+[\d\s()-]+)\\n/", $event->description,$match)){
		    		$phone = str_replace(" ","",$match[1]);
		    		$info = $info." PHONE: ".$phone;
		    	}
		    	if(preg_match("/EMAIL:\s([A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,})\\n/", $event->description,$match)){
		    		$email = $match[1];
		    		$info = $info." EMAIL: ".$email;
		    	}

				$ts = $event->dtstart_array[2];
				$estart = new \DateTime("@$ts") ;
				$ts = $event->dtend_array[2];
				$eend = new \DateTime("@$ts");


				$tmp = array('id'=>$event->uid,'start'=>$estart->format('Y-m-d'),'end'=>$eend->format('Y-m-d'),'color'=>$value[1],'url'=>$info);
				array_push($ret,$tmp);
			}
		}




		return response($ret);
    }	


}
