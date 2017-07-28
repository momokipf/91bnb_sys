<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;
use Storage;

use GuzzleHttp\Pool;
use GuzzleHttp\Client;


use Validator;
use View;
use \DateTime;
use App\House;
use App\Houseavailability;
use App\Houseowner;



define("GOOGLE_KEY","AIzaSyAAIAQT72snLXj_BITkOc5TMZjpTrzbYRw");

class HousesController extends Controller
{
    //

	//private $httpclient = new Client(['base_uri'=>'https://maps.googleapis.com/','timeout'=>2.0]);

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function report(Request $request)
    {
        return view('report.houseReport')
                ->with('rep',Auth::user());
    }

    public function reportingSearch(Request $request) {
		Log::info($request->all());
		$query = House::where('country', 'united States');
		// dd($query);
		if ($request->input('state') != 'Please Select State' && $request->input('state') != '' && $request->input('state') != null) {
			$query = $query->where('state', $request->input('state'));
		}
		if ($request->input('city') != 'Please Select City' && $request->input('city') != '' && $request->input('city') != null) {
			$query = $query->where('city', $request->input('city'));
		}
		if ($request->input('houseZip') != '' && $request->input('houseZip') != null) {
			$query = $query->where('houseZip', $request->input('houseZip'));
		}
		if ($request->input('rentShared') == 1) {
			$query = $query->whereHas('Houseavailability', function($q) {
				$q->where('rentShared', '>=', 0);
			});
		}
		else if ($request->input('rentShared') == -1) {
			$query = $query->whereHas('Houseavailability', function($q) {
				$q->where('rentShared', '<=', 0);
			});
		}
		if ($request->input('houseType') != 'All') {
			$query = $query->where('houseType', $request->input('houseType'));
		}
		// $result = $query->first();
		// unset($result['cus_location']);
		Log::info($query->get());
		return response($query->get())->header('Content-Type', 'json');
	}

	public function houseTotal() {
		$count = House::count();
		$lastHouse = House::orderBy('numberID', 'desc')->first();
		$wholeCount = House::whereHas('Houseavailability', function($q) {
		        $q->where('rentShared', 1);
		    })->count();
		$shareCount = House::whereHas('Houseavailability', function($q) {
		        $q->where('rentShared', -1);
		    })->count();
		$eitherCount = House::whereHas('Houseavailability', function($q) {
		        $q->where('rentShared', 0);
		    })->count();
		$aptCount = House::where('houseType', 'Apartment')->count();
		$boatCount = House::where('houseType', 'Boat')->count();
		$condoCount = House::where('houseType', 'Condo')->count();
		$loftCount = House::where('houseType', 'Loft')->count();
		$mansionCount = House::where('houseType', 'Mansion')->count();
		$RVCount = House::where('houseType', 'RV')->count();
		$studioCount = House::where('houseType', 'Studio')->count();
		$singleCount = House::where('houseType', 'Single House')->count();
		$townCount = House::where('houseType', 'Townhouse')->count();
		$villaCount = House::where('houseType', 'Villa')->count();
		$otherCount = House::where('houseType', 'Other')->count();

		return view('report.houseTotal')
				->with('count',$count)
				->with('lastHouse',$lastHouse)
				->with('wholeCount',$wholeCount)
				->with('shareCount',$shareCount)
				->with('eitherCount',$eitherCount)
				->with('aptCount',$aptCount)
				->with('boatCount',$boatCount)
				->with('condoCount',$condoCount)
				->with('loftCount',$loftCount)
				->with('mansionCount',$mansionCount)
				->with('RVCount',$RVCount)
				->with('studioCount',$studioCount)
				->with('singleCount',$singleCount)
				->with('townCount',$townCount)
				->with('villaCount',$villaCount)
				->with('otherCount',$otherCount);
	}

	public function houseLocation() {
		$count = House::where('country', 'United States')->count();
		$state_count = House::where('country', 'United States')->select('state', DB::raw('count(*) as count'))->groupBy('state')->get();
		return view('report.houseLocation')
				->with('state_count', $state_count)
				->with('count', $count);
	}

    /*
    * Moki
    * Comment:  This function should be included in House Modal.
    *           The design goal of controler is light weighted controller, heavy modal.
    *           Same comment applys for function searchByAddress, searchByID, searchByID
    * Author: Yichen
    * 
    */
	public function getCityCount($state) {
		$city_count = House::where('state', $state)->select('city', DB::raw('count(*) as count'))->groupBy('city')->get();
		// Log::info($city_count);
		return $city_count;
	}

	public function modify() {
        return view('house.Modify')
                ->with('Rep',Auth::user());
    }

    public function searchByAddress(Request $request) {
    	$input = $request->all();
        $sql = "ST_Distance_Sphere(location, POINT(".$input['longitude'].','.$input['latitude']."))";
        // $result = DB::table('house')->whereRaw($sql.'<'.$input['milesrange']*1000)->first();
        $result = House::whereRaw($sql.'<'.$input['milesrange']*1000)->with('houseowner')->get();
        // Log::info($result);
        return response($result)->header('Content-Type', 'json');
    }

    public function searchByID(Request $request) {
    	$input = $request->all();
    	$result = House::where('fullHouseID', $input['fullHouseID'])->with('houseowner')->get();
    	// Log::info($result);
    	return response($result)->header('Content-Type', 'json');
    }

    public function searchByOwner(Request $request) {
    	$input = $request->all();
    	$result = House::where('houseOwnerID', $input['id'])->with('houseowner')->get();
    	Log::info($result);
    	return response($result)->header('Content-Type', 'json');
    }

    public function modifyHouse($numberID) {
    	Log::info($numberID);
    	$house = House::where('numberID', $numberID)->first();
    	return view('house.ModifyHouse')
    			->with('house', $house)
    			->with('Rep',Auth::user());
    }

    public function searchindex(Request $request)
    {
    	return view('house.HouseSearchindex')
    			//->with('Query',$fakequery)
    			->with('Rep',Auth::user());
    }

    public function searchpage(Request $request)
    {
    	$input = $request->all();
    	Log::info($input);
    	return view('house.Housetmp')
    			->with('Rep',Auth::user());

    }

    //Different Reaction based on request 
    // if ($request->ajax() || $request->wantsJson())
    // {
    //     $json = [
    //         'success' => false,
    //         'error' => [
    //             'code' => $e->getCode(),
    //             'message' => $e->getMessage(),
    //         ],
    //     ];

    //     return response()->json($json, 400);
    // }

    public function showhouse(Request $request,$id)
    {
    	$house = House::with('Houseavailability','HousePrice')->find($id);

    	if($request->ajax() || $request->wantsJson())
    	{
    		Log::info($house);
    		return response($house)
    				->header('Content-Type', 'json');
    	}
    }


    /** 
	  * @desc this function will store all information related to House
	  * including house price, house condition and house rooms.
	  * @author Moki mokipang@91bnb.com
	  * @required all
	*/

    public function store(Request $request){
    	//Log::info($request->all());
    	$input = $request->all();
    	//Log::info($input);

    	$validator= Validator::make($input,[
    		'houseOwnerID' => 'bail|required',
    		'houseAddress' => 'required',
    		'houseZip' => 'max:5',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
    		]);

        if($validator->fails())
        {
            Log::info("here?");
            if($request->ajax()||$request->wantsJson()){
                return response()
                        ->json(['status'=>'input error']);
            }
        }
        $zipcode = $request->input('zipcode');
        $houseAddress = $request->input('houseAddress');

        $country = $request->input('country');
        $state = $this->getState($request->input('state'));
        $city = $request->input('city');




        $httpclient = new Client(['base_uri'=>'https://maps.googleapis.com/','timeout'=>5.0]);
        $query_addr=$houseAddress.($country?','.$country:' ').($state?','.$state:' ').($city?','.$city:' ').','.$zipcode;
        $response =$httpclient->request('GET','maps/api/geocode/json?',['query'=>['address'=>$query_addr,'key'=>GOOGLE_KEY]]);
        if($response->getStatusCode()=='200')
        {
            $obj = json_decode($response->getBody());
            $status = $obj->status;
            if($status=='OK')
            {
                //$target_pt = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}.','.$obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

                $search_geo = collect($obj->{'results'}[0]->{'geometry'});
                //$target_pt = collect(['latitude'=>$obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'},'longitude'=>$obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}]);
                $search_longitude = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                $search_latitude = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                //$isExact = $obj->{'results'}[0]->{'geometry'}->{'location_type'};
            }
            // else if($status=='ZERO_RESULTS')
            // {

            // }
            // else if($status=='OVER_QUERY_LIMIT')
            // {

            // }
            else{
                if($request->ajax()||$request->wantsJson()){
                return response()
                        ->json(['status'=>$status]);
                }
            }
        }
        else
        {
            if($request->ajax()||$request->wantsJson()){
                return response()
                        ->json(['status'=>$response->getReasonPhrase]);
            }

        }
        Log::info($search_longitude.'   '.$search_latitude);

    	$houseowner = \App\Houseowner::find($input['houseOwnerID']);

    	if($houseowner){

            $houseinput = $request->only((new House())->getFillable());  
            $houseinput['longitude'] = $search_longitude;
            $houseinput['latitude'] = $search_latitude;
            Log::info($houseinput);
            $newhouse = $houseowner->addHouse($houseinput);

			$room_num = $input['room_num'];   
			$newrooms = array();
			for($i = 1 ;$i <= $room_num; $i++)
			{
				//$roomtypefield = 'roomType_'.($i+1);
				//$roominput = $request->only
				$newroom = new \App\Houseroom();
				$newroom->roomID = $i;
				$newroom->roomType = $input['roomType_'.$i];
				$newroom->roomBedType = $input['roomBedType_'.$i];
				$newroom->roomBedTypeOther = $input['roomBedTypeOther_'.$i];
				$newroom->roomGuestMax = $input['maxGuestsnum_'.$i];
				$newroom->roomCostDayPrice = $input['roomCostDayPrice_'.$i];
				$newroom->roomCostWeekPrice = $input['roomCostWeekPrice_'.$i];
				$newroom->roomCostMonthPrice = $input['roomCostMonthPrice_'.$i];
				$newroom->roomCostUtility = $input['roomCostUtility_'.$i];
				$newroom->utilityNote = $input['utilityNote_'.$i];
				$newroom->roomCostCleaning = $input['roomCostCleaning_'.$i];
				$newroom->roomCostSecurityDeposit = $input['roomCostSecurityDeposit_'.$i];
				array_push($newrooms,$newroom);
			}

			$priceinput = $request->only(\App\Houseprice::$fields); 
			$conditioninput = $request->only(\App\Housingcondition::$fields);
    		$newhouseprice = new \App\Houseprice($priceinput);  
    		$newhousecond = new \App\Housingcondition($conditioninput);
            $newhouseAvailability = new \App\Houseavailability();
    		/*TODO: add house availability table funciton
    		* 
    		*
			*/

    		try{
        		$newhouse->houseprice()->save($newhouseprice);
        		$newhouse->housingcondition()->save($newhousecond);
        		$newhouse->houserooms()->saveMany($newrooms);
                $newhouse->houseavailability()->save($newhouseAvailability);
    		}
    		catch(\Illuminate\Database\QueryException $ex){
                 Log::error("QueryException has been found, need to be handled");
                 /*
                 * Need to found a elegant way to do cascade delete;
                 * one on boot
                 */   			
                 $newhouse->delete();
    		}

    		if($request->ajax() || $request->wantsJson()){
    			//Log::info("Send json back to client ".$newhouse);
    			// return response()
    			// 		->json(['status'=>'success','houseinfo'=>$newhouse])
    			// 		->header('Content','json');
                return ;
    		}
    	}
    }

    public function update(Request $request) {
        // Log::info($request->all());
        $fullhouseid = $request->input('fullHouseID');
        $house = House::where('fullHouseID','=',$fullhouseid)->first();
        if($house){
            $houseinput = $request->only($house->getFillable()); 

            $priceinput = $request->only($house->houseprice->getFillable());
            $conditioninput = $request->only($house->housingcondition->getFillable());

            foreach($houseinput as $key=>$value){
                Log::info($key."=>".$value);
                if($value){
                    $house[$key] = $value;
                }
            }
            $point = $houseinput['longitude'].',' .$houseinput['latitude'];
            $house->setLocationAttribute($point);
            $houseprice = $house->houseprice;
            if($houseprice){
                foreach($priceinput as $key=>$value){
                    if($value){
                        $houseprice[$key] = $value;
                    }
                }
            }
            //else handler

            $housecond = $house->housingcondition;
            if($housecond){
                foreach($conditioninput as $key=>$value){
                    if($value){
                        $housecond[$key] = $value;
                    }

                }
            }
            $house->save();
            $houseprice->save();
            /*

            */
            Log::info($housecond);
            $housecond->save();

        }
        else{

        }
    }

    public function addindex(Request $request)
    {
    	return view('house.HouseAdd')
    			->with('Rep',Auth::user());
    }

    public function search(Request $request)
    {
        Log::info(Log::info($request->all()));
        if($request->has('houseID')==1){
            Log::info("search By ID");
            $houseid = $request->input('houseID');

            //$house = House::where('fullHouseID','=',$houseid)->first();
            $house = House::with('Houseimage')
                ->where('fullHouseID','=',$houseid)->first();
            Log::info($house);
            if(isset($house)){
                $search_geo = collect(['location'=>collect(['lat'=>$house->latitude,'lng'=>$house->longitude])]);

                if($house->Houseimage){
                    //for local use ftp
                    //$files = Storage::disk('ftphouseimage')->files($house->houseimage->ImagePath);
                    
                    // for server use storage
                    $files = Storage::files('public/houses/'.$house->Houseimage->ImagePath);
                    if($files){
                        
                        foreach ($files as $tmp) {
                            //echo $tmp;
                            if(pathinfo($tmp)['extension'] =='jpg'|| pathinfo($tmp)['extension'] =='png'|| pathinfo($tmp)['extension'] =='jpeg' ){
                                $house->Houseimage->ImagePath = Storage::url($tmp);
                                break;
                            }
                        } 

                    }    
                }
                return response()
                    ->json(['houses'=>array($house->load('houseowner')),
                         'geo_center'=>$search_geo
                    ]);
            }
            else{

            }
        }
        else if($request->has('houseOwnerID')==1){

            $ownerid = $request->input('houseOwnerID');
            if(isset($ownerid)){
                //$houses = Houseowner::find($ownerid)->houses;
                $houses = House::with('Houseimage')
                    ->where('houseOwnerID','=',$ownerid);
                if($houses){
                    $search_geo = collect(['location'=>collect(['lat'=>$houses[0]->latitude,'lng'=>$houses[0]->longitude])]);

                    for($i =0; $i< count($houses); $i++){
                        if($houses[$i]->Houseimage){
                            // for local use ftp
                            //$files = Storage::disk('ftphouseimage')->files($houses[$i]->Houseimage->ImagePath);
                            // for server use storage
                            $files = Storage::files('public/houses/'.$houses[$i]->Houseimage->ImagePath);
                            foreach($files as $tmp){
                                if(pathinfo($tmp)['extension'] =='jpg'|| pathinfo($tmp)['extension'] =='png'|| pathinfo($tmp)['extension'] =='jpeg' ){
                                    $houses[$i]->Houseimage->ImagePath = Storage::url($tmp);
                                    break;
                                }
                            }
                        } 
                    }

                    return response()
                        ->json(['houses'=>$houses->load('houseowner'),
                             'geo_center'=>$search_geo
                        ]);
                }
            }
            else{

            }
        }
        else{
        	Log::info($request->all());
        	$httpclient = new Client(['base_uri'=>'https://maps.googleapis.com/','timeout'=>5.0]);

        	$zipcode = $request->input('zipcode');
        	$houseAddress = $request->input('houseAddress');

        	$country = $request->input('country');
        	$state = $this->getState($request->input('state'));
        	$city = $request->input('city');

        	$radius = $request->input('milesrange',2);

        	$numOfRoomsFrom = $request->input('numOfRoomsFrom');
        	if(!$numOfRoomsFrom){
        		$numOfRoomsFrom = 1;
        	}
        	$numOfRoomsTo = $request->input('numOfRoomsTo');
        	if(!$numOfRoomsTo){
        		$numOfRoomsTo = 10;
        	}

            $checkIndate = $request->input('checkIn');
            $checkOutdate = $request->input('checkOut');

        	$rentShared = $request->input('rentShareWhole');
            $target_pt = null;
            $search_geo = null;

            /*
            Spatial information
            */
        	if($request->input('search_latitude')&&$request->input('search_longitude'))
        	{
        		$target_pt = collect(['latitude'=>$request->input('search_latitude'),'longitude'=>$request->input('search_longitude')]);
        	}
        	else{
                if($houseAddress)
    	    	{
    	    		$query_addr=$houseAddress.($country?','.$country:' ').($state?','.$state:' ').($city?','.$city:' ').','.$zipcode;
                    try{
    	    		$response =$httpclient->request('GET','maps/api/geocode/json?',['query'=>['address'=>$query_addr,'key'=>GOOGLE_KEY]]);
                   }
                   catch(GuzzleHttp\Exception\ConnectException $e){
                        Log::error($e);
                   }
    	    	}
        	}

        	if(isset($response))
    		{
    	    	if($response->getStatusCode()=='200')
    			{
    				$obj = json_decode($response->getBody());
    				$status = $obj->status;
    				if($status=='OK')
    				{
    					//$target_pt = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}.','.$obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

    					$search_geo = collect($obj->{'results'}[0]->{'geometry'});
    					$target_pt = collect(['latitude'=>$obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'},'longitude'=>$obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}]);
    					//$isExact = $obj->{'results'}[0]->{'geometry'}->{'location_type'};
    					//Log::info($search_geo);
    				}
    				else if($status=='ZERO_RESULTS')
    				{

    				}
    				else if($status=='OVER_QUERY_LIMIT')
    				{

    				}
    				else{
    					
    				}
    			}
    			else
    			{
    				Log::info($response->getReasonPhrase());
    			}
    		}



    		$fields = array('r.numberID', 'fullHouseID', 'state', 'city', 'houseAddress','numOfRooms', 'numOfBaths','houseType','r.houseOwnerID','latitude','longitude',//basic information
                         'costMonthPrice', 'costDayPrice',//price information
                         // 'nextAvailableDate', 'minStayTerm','minStayUnit', 'rentShared',//available information
                         'first', 'last', 'ownerUsPhoneNumber', 'ownerWechatUserName','ownerWechatID','ownerCompanyName');
    		Log::info($target_pt);
    		if(isset($target_pt))
        	{
        		// $housesql = House::WithinCircle($radius,$target_pt)->toSql();
        		// $circlesql = "ST_Distance_Sphere(r.location,POINT(".$target_pt['longitude'].','.$target_pt['latitude']."))";//<".$radius;
          //       Log::info($housesql);
        		// $housebuilder = 
          //                   DB::table(DB::raw("(".$housesql.") as r"))
          //                   ->join('HouseOwner','r.houseOwnerID','=','HouseOwner.houseOwnerID')
          //                   ->join('HousePrice','r.numberID','=','HousePrice.numberID')
          //                   ->leftjoin('HouseAvailability','r.numberID','=','HouseAvailability.numberID')
          //                   ->join('HousingCondition','r.numberID','=','HousingCondition.numberID')
        		// 			->select(DB::raw(implode(',',$fields)))
        		// 			->whereRaw($circlesql.'<'.$radius*1000);

                $housebuilder = House::with('Houseimage')
                            ->WithinCircle($radius,$target_pt)
                            ->ShpereDistance($radius,$target_pt);
                            


                /*
                    Note: this constrained may be affected by the change of the table in server in July;
                */
        		// if($rentShared!=0){
        		// 	$housebuilder = $housebuilder->where('rentShared','=',$rentShared);
        		// }

        		$housebuilder = $housebuilder->whereBetween('numOfRooms',[$numOfRoomsFrom,$numOfRoomsTo]);

        		$housebuilder = $housebuilder
        							->orderBy(DB::raw("ST_Distance_Sphere(location,POINT(".$target_pt['longitude'].','.$target_pt['latitude']."))"));
                $houses = $housebuilder->get();
                Log::info(DB::getQueryLog());
                if(isset($checkOutdate)&&isset($checkIndate)){
                    $houses = $houses->filter(function($house) use($checkIndate,$checkOutdate){
                        $tmp = $this->checkAvailability($house->houseavailability()->orderBy('rentBegin')->get(),$checkIndate,$checkOutdate);
                        Log::info($house->numberID."result: ".$tmp);
                        return $tmp;
                    });
                }

                
                for($i =0; $i< count($houses); $i++){
                    
                    if($houses[$i]->Houseimage){
                        // for local use ftp 
                        //$files = Storage::disk('ftphouseimage')->files($houses[$i]->Houseimage->ImagePath);
                        // for server use storage
                        $files = Storage::files('public/houses/'.$houses[$i]->Houseimage->ImagePath);
                        foreach($files as $tmp){
                            //Log::info('$tmp:'.$tmp);
                            if(pathinfo($tmp)['extension'] =='jpg'|| pathinfo($tmp)['extension'] =='png'|| pathinfo($tmp)['extension'] =='jpeg' ){
                                $houses[$i]->Houseimage->ImagePath = Storage::url($tmp);
                                break;
                            }
                        }    
                    }
                    
                }
                Log::info('houses query:'.$houses);

        		return response()
        			->json(['houses'=>$houses->values()->load('houseowner'),
        					 'geo_center'=>$search_geo
        				]);
        	}
        }

    }




    /** 
    * @desc This function check one house availability
    * given one checkin-checkout interval 
    * @author Moki mokipang@91bnb.com
    * @required all
    */    

    private function checkAvailability(\Illuminate\Support\Collection $availabilityInterval,$checkIndate,$checkOutdate){
        if(!isset($checkIndate)||!isset($checkOutdate))
        {
            Log::debug("HouseController:: variable $checkIndate and $checkOutdate is not set, function will not work");
            return true;
        }
        if(count($availabilityInterval)==0)
            return true;
        $numberID = $availabilityInterval[0]->numberID;
        $notAvaInterval = array();
        $web_format="Y/m/d";
        $sql_format="Y-m-d";
        $checkInterval = array(DateTime::createFromFormat($web_format,$checkIndate),DateTime::createFromFormat($web_format,$checkOutdate));
        foreach($availabilityInterval as $availability){
            $notAvaInterval[] = array(DateTime::createFromFormat($sql_format,$availability->rentBegin),DateTime::createFromFormat($sql_format,$availability->rentEnd));
        }

        for($i = 0; $i<count($notAvaInterval);++$i){
            if($checkInterval[0]>$notAvaInterval[$i][1]){
                continue;
            }
            if($checkInterval[0]>$notAvaInterval[$i][0]&&$checkInterval[0]<$notAvaInterval[$i][1]){
                Log::info($numberID+" is not available for given interval");
                return false;
            }
            else{
                return $checkInterval[1]<$notAvaInterval[$i][0];
            }
        }
        return true;
    }


    /*
	TODO: make it more robusted and maybe combine with the reverse.


    */
    private function getState($abbreviate)
    {
    	if(!$abbreviate)
    		return $abbreviate;
    	switch($abbreviate){
    		case "AL":
			return "Alabama";
			break;
		case "AK":
			return "Alaska";
			break;
		case "AZ":
			return "Arizona";
			break;
		case "AR":
			return "Arkansas";
			break;
		case "CA":
			return "California";
			break;
		case "CO":
			return "Colorado";
			break;
		case "CT":
			return "Connecticut";
			break;
		case "DE":
			return "Delaware";
			break;
		case "FL":
			return "Florida";
			break;
		case "GA":
			return "Georgia";
			break;
		case "HI":
			return "Hawaii";
			break;
		case "ID":
			return "Idaho";
			break;
		case "IL":
			return "Illinois";
			break;
		case "IN":
			return "Indiana";
			break;
		case "IA":
			return "Iowa";
			break;
		case "KS":
			return "Kansas";
			break;
		case "KY":
			return "Kentucky";
			break;
		case "LA":
			return "Louisiana";
			break;
		case "ME":
			return "Maine";
			break;
		case "MD":
			return "Maryland";
			break;
		case "MA":
			return "Massachusetts";
			break;
		case "MI":
			return "Michigan";
			break;
		case "MN":
			return "Minnesota";
			break;
		case "MS":
			return "Mississippi";
			break;
		case "MO":
			return "Missouri";
			break;
		case "MT":
			return "Montana";
			break;
		case "NE":
			return "Nebraska";
			break;
		case "NV":
			return "Nevada";
			break;
		case "NH":
			return "New Hampshire";
			break;
		case "NJ":
			return "New Jersey";
			break;
		case "NM":
			return "New Mexico";
			break;
		case "NY":
			return "New York";
			break;
		case "NC":
			return "North Carolina";
			break;
		case "ND":
			return "North Dakota";
			break;
		case "OH":
			return "Ohio";
			break;
		case "OK":
			return "Oklahoma";
			break;
		case "OR":
			return "Oregon";
			break;
		case "PA":
			return "Pennsylvania";
			break;
		case "RI":
			return "Rhode Island";
			break;
		case "SC":
			return "South Carolina";
			break;
		case "SD":
			return "South Dakota";
			break;
		case "TN":
			return "Tennessee";
			break;
		case "TX":
			return "Texas";
			break;
		case "UT":
			return "Utah";
			break;
		case "VT":
			return "Vermont";
			break;
		case "VA":
			return "Virginia";
			break;
		case "WA":
			return "Washington";
			break;
		case "WV":
			return "West Virginia";
			break;
		case "WI":
			return "Wisconsin";
			break;
		case "WY":
			return "Wyoming";
			break;
		default:
			return $abbreviate;
    	}
    }

    private function state_abbr($name){
    	$states = array(
			'Alabama'=>'AL',
			'Alaska'=>'AK',
			'Arizona'=>'AZ',
			'Arkansas'=>'AR',
			'California'=>'CA',
			'Colorado'=>'CO',
			'Connecticut'=>'CT',
			'Delaware'=>'DE',
			'Florida'=>'FL',
			'Georgia'=>'GA',
			'Hawaii'=>'HI',
			'Idaho'=>'ID',
			'Illinois'=>'IL',
			'Indiana'=>'IN',
			'Iowa'=>'IA',
			'Kansas'=>'KS',
			'Kentucky'=>'KY',
			'Louisiana'=>'LA',
			'Maine'=>'ME',
			'Maryland'=>'MD',
			'Massachusetts'=>'MA',
			'Michigan'=>'MI',
			'Minnesota'=>'MN',
			'Mississippi'=>'MS',
			'Missouri'=>'MO',
			'Montana'=>'MT',
			'Nebraska'=>'NE',
			'Nevada'=>'NV',
			'New Hampshire'=>'NH',
			'New Jersey'=>'NJ',
			'New Mexico'=>'NM',
			'New York'=>'NY',
			'North Carolina'=>'NC',
			'North Dakota'=>'ND',
			'Ohio'=>'OH',
			'Oklahoma'=>'OK',
			'Oregon'=>'OR',
			'Pennsylvania'=>'PA',
			'Rhode Island'=>'RI',
			'South Carolina'=>'SC',
			'South Dakota'=>'SD',
			'Tennessee'=>'TN',
			'Texas'=>'TX',
			'Utah'=>'UT',
			'Vermont'=>'VT',
			'Virginia'=>'VA',
			'Washington'=>'WA',
			'West Virginia'=>'WV',
			'Wisconsin'=>'WI',
			'Wyoming'=>'WY'
			);
		return $states[$name];
    }

}
