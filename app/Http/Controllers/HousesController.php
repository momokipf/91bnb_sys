<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use GuzzleHttp\Pool;
use GuzzleHttp\Client;

use View;
use DB;

use App\House;


define("GOOGLE_KEY","AIzaSyAAIAQT72snLXj_BITkOc5TMZjpTrzbYRw");


class HousesController extends Controller
{
    //

	//private $httpclient = new Client(['base_uri'=>'https://maps.googleapis.com/','timeout'=>2.0]);

	public function __construct()
    {
        $this->middleware('auth');
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
    	$house = House::find($id);

    	if($request->ajax() || $request->wantsJson())
    	{
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
    	$search_center = $request->input('center');

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
	    	else if($search_center)
	    	{
	    		$query_addr=$search_center.($country?','.$country:' ').($state?','.$state:' ').($city?','.$city:' ').','.$zipcode;
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
					$target_pt = collect(['latitude'=>$obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'},'longitude'=>$obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}]);
					//$isExact = $obj->{'results'}[0]->{'geometry'}->{'location_type'};
					Log::info($target_pt);
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
                     'first', 'last', 'ownerUsPhoneNumber', 'ownerWechatUserName','ownerWechatID');

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
