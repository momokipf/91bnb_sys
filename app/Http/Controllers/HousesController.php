<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use GuzzleHttp\Pool;
use GuzzleHttp\Client;

use View;

use App\House;
use App\Houseavailability;


define("GOOGLE_KEY","AIzaSyAAIAQT72snLXj_BITkOc5TMZjpTrzbYRw");


class HousesController extends Controller
{
    //

	//private $httpclient = new Client(['base_uri'=>'https://maps.googleapis.com/','timeout'=>2.0]);

	public function __construct()
    {
        $this->middleware('auth');
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

	public function getCityCount($state) {
		$city_count = House::where('state', $state)->select('city', DB::raw('count(*) as count'))->groupBy('city')->get();
		// Log::info($city_count);
		return $city_count;
	}

    public function searchindex(Request $request)
    {
    	//$fakequery = App\Inquiry::find(114);
    	return view('House/HouseSearch')
    			//->with('Query',$fakequery)
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

    public function addindex(Request $request)
    {
    	return view('House/HouseAdd')
    			->with('Rep',Auth::user());
    }

    public function report(Request $request)
    {
        return view('/report/houseReport')
                ->with('rep',Auth::user());
    }

    public function search(Request $request)
    {
    	Log::info($request->all());
    	$httpclient = new Client(['base_uri'=>'https://maps.googleapis.com/','timeout'=>2.0]);

    	$zipcode = $request->input('zipcode');
    	$houseAddress = $request->input('houseAddress');

    	$country = $request->input('country');
    	$state = $this->getState($request->input('state'));
    	$city = $request->input('city');

    	$road_1 = $request->input('crossroadA');
    	$road_2 = $request->input('crossroadB');
    	$radius = $request->input('milesrange',2);

    	$numOfRoomsFrom = $request->input('numOfRoomsFrom');
    	$numOfRoomsTo = $request->input('numOfRoomsTo');


    	$target_pt = "";

    	if($request->input('search_latitude')&&$request->input('search_longitude'))
    	{
    		$target_pt = collect(['latitude'=>$request->input('search_latitude'),'longitude'=>$request->input('search_longitude')]);
    	}
    	else{
	    	if(isset($road_1)&&isset($road_2))
	    	{
	    		$query_addr= $road_1.' and '.$road_2.','.$zipcode;
	    		$response =$httpclient->request('GET','maps/api/geocode/json?',['query'=>['address'=>$query_addr,'key'=>GOOGLE_KEY]]);

	    	}
	    	else if($houseAddress)
	    	{
	    		$query_addr=$houseAddress.($country?','.$country:' ').($state?','.$state:' ').($city?','.$city:' ').','.$zipcode;
	    		$response =$httpclient->request('GET','maps/api/geocode/json?',['query'=>['address'=>$query_addr,'key'=>GOOGLE_KEY]]);
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

					//$search_geo = collect($obj->{'results'}[0]->{'geometry'}->{'location'});
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
				Log::info($response->getStatusCode());
			}
		}

		$fields = array('r.numberID', 'fullHouseID', 'state', 'city', 'houseAddress','numOfRooms', 'numOfBaths','houseType','r.houseOwnerID','latitude','longitude',//basic information
                     'costMonthPrice', 'costDayPrice',//price information
                     'nextAvailableDate', 'minStayTerm','minStayUnit', 'rentShared',//available information
                     'first', 'last', 'ownerUsPhoneNumber', 'ownerWechatUserName','ownerWechatID','first','last','ownerCompanyName');

		if(isset($target_pt))
    	{
    		$housesql = House::WithinCircle($radius,$target_pt)->toSql();
    		$circlesql = "ST_Distance_Sphere(r.location,POINT(".$target_pt['longitude'].','.$target_pt['latitude']."))";//<".$radius;
    		$housebuilder = DB::table(DB::raw("(".$housesql.") as r"))
    					->select(DB::raw(implode(',',$fields)))
    					->join('HouseOwner','r.houseOwnerID','=','HouseOwner.houseOwnerID')
    					->join('HousePrice','r.numberID','=','HousePrice.numberID')
    					->join('HouseAvailability','r.numberID','=','HouseAvailability.numberID')
    					->join('HousingCondition','r.numberID','=','HousingCondition.numberID')
    					->whereRaw($circlesql.'<'.$radius*1000)
    					->orderBy(DB::raw($circlesql));

    		if(isset($numOfRoomsFrom))
    		{
    			$housesql = $housesql->whereRaw('numOfRooms >='.$numOfRoomsFrom);
    		}
    		if(isset($numOfRoomsTo))
    		{
    			$housesql = $housesql->whereRaw('numOfRooms <='.$numOfRoomsTo);
    		}


    		$houses =$housebuilder->get();


    		$houses = collect($houses);


    		Log::info(response($houses)
                ->header('Content-Type', 'json'));
    		return response($houses)
                ->header('Content-Type', 'json');
    	}


    }
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

}
