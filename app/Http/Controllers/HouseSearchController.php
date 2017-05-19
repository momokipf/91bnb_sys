<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HouseSearchController extends Controller
{

	//define the constant of house status : whole ,share or either
	define("WHOLE","1");
	define("SHARE","-1");
	define("EITHER","0");

	public function index(Request $request){


	}


	public function search(Request $request){
		$inquirerID = $request->input('inquirerID');
		$repWithOwner = $request->input('repWithOwner');
		$checkIn = $request->input('checkIn');
		$checkOut = $request->input('checkOut');
		$country = $request->input('country');
		$state = $request->input('state');
		$city = $request->input('city');
		$cityOther = $request->input('cityOther');
		$fullHouseID = $request->input('fullHouseID');
		$rooms = $request->input('rooms');
		$share = $request->input('share');
		$room1Type = $request->input('room1Type');
		$room1TypeOther = $request->input('room1TypeOther');
		$room2Type = $request->input('room2Type');
		$room2TypeOther = $request->input('room2TypeOther');
		$room3Type = $request->input('room3Type');
		$room3TypeOther = $request->input('room3TypeOther');
		$numOfAdult = $request->input('room3TypeOther');

		$rentShareWhole = EITHER;

		$numOfChildren = $request->input('numOfChildren', 0);
		$childAge = $request->input('childAge', 0);
		$pregnancy = $request->input('pregnancy', 0);
		$pet = $request->input('room3TypeOther');
		$petType = $request->input('petType', 0);
		$hasBaby = $request->input('hasBaby', 0);
		$budgetLower = $request->input('budgetLower', '');
		$budgetUpper = $request->input('budgetUpper', '');
		$budgetUnit = $request->input('budgetUnit', '');
		$specialNote = $request->input('specialNote', '');

		$houseAddress = $request->input('houseAddress', '');		
		$crossroadA = $request->input('crossroadA', '');	
		$houseAddress = $request->input('crossroadB', '');
		$numOfAdult = $request->input('numOfAdult');

		// $checkin = '0000-00-00';
		// $checkout = '0000-00-00';
		//0119
		//ori
		//$checkin='2017-01-09';
		$checkin = $request->input('checkin');
		$checkout = $request->input('checkout');		

		//test  
		$pre  = substr($checkin, 0, 2);
		$mid  = substr($checkin, 3, 2);
		$post = substr($checkin, 6 ,4);
		// echo "pre ".$pre;
		// echo "mid ".$mid;
		// echo "post ".$post;
		//$checkin= $post.'\/'.$pre.'\/'.$mid;
		$checkin= $post.'-'.$pre.'-'.$mid;	

		$numOfRoomsFrom = 0;
		$numOfRoomsTo = 0;
		$numOfAdults = 0;
		$numOfRoomsFrom  = $request->input('numOfRoomsFrom');
		$numOfRoomsTo    = $request->input('numOfRoomsTo');
		$numOfAdults     = $request->input('numOfAdults');
		$allowPregnant   = 0;
		$allowBaby       = 0;
		$allowKid        = 0;
		$allowPets       = 0;
		if(isset($request->input('allowPregnant')))
		{$allowPregnant   = 1;}
		if(isset($request->input('allowBaby')))
		{$allowBaby   = 1;}
		if(isset($request->input('allowKid'))) {$allowKid   = 1;}
		if(isset($request->input('allowPets'))) {$allowPets   = 1;}


		$query = "select *
		          from HOUSE, HOUSEOWNER, HOUSEPRICE,HOUSEAVAILABILITY, HOUSINGCONDITION
		          where
		          HOUSE.houseOwnerID = HOUSEOWNER.houseOwnerID
		          and HOUSE.numberID = HOUSEPRICE.numberID
		          and HOUSE.numberID = HOUSEAVAILABILITY.numberID
		          and HOUSE.numberID = HOUSINGCONDITION.numberID";


		if($fullHouseID!=null){
		  //if fullhouseID is not empty then set it as a houseAddress to pin on the Google map, and apply milesrange to this place.
		  $getlatlng = "select latitude, longitude
		            from HOUSE
		            where HOUSE.fullHouseID = '".$fullHouseID."'";
		  $lnglatRes = $conn->query($getlatlng)->fetch_assoc();
		  $query .= " and degrees(acos(sin(radians(".$lnglatRes['latitude'].")) * sin(radians(HOUSE.latitude)) +  cos(radians(".$lnglatRes['latitude'].")) * cos(radians(HOUSE.latitude)) * cos(radians(".$lnglatRes['longitude']."-HOUSE.longitude))))*60*1.1515<".$milesrange;//calculate the distance between each house and center of RoadA and B
		}else{
		  if ($country && $country != 'Select Country') {
		      $query .= " and HOUSE.country = '".$country."'";
		  }
		  if ($state && $state != 'Select State') {
		      $query .= " and HOUSE.state = '".$state."'";
		  }
		  if($crossroadB && $crossroadA){
		    //get the geolocation of the intersection of two roads
		    if ($city && $city != 'Select City') {
		        $query .= " and HOUSE.city = '".$city."'";
		    }
		      $geoposition = getPosition($crossroadA, $crossroadB,$city,$state);
		      $query .= " and degrees(acos(sin(radians(".$geoposition['lat'].")) * sin(radians(HOUSE.latitude)) +  cos(radians(".$geoposition['lat'].")) * cos(radians(HOUSE.latitude)) * cos(radians(".$geoposition['lng']."-HOUSE.longitude))))*60*1.1515<".$milesrange;//calculate the distance between each house and center of RoadA and B
		      //  echo $query;
		  }
		  else{
		    //get geolocation of the address
		    if($houseAddress){
		      if ($city && $city != 'Select City') {
		          $query .= " and HOUSE.city = '".$city."'";
		      }// if it has house address then the city should be a must
		      $geoposition = getsinglePosition($houseAddress,$city,$state,true);
		      //echo $geoposition['lat']."%".$geoposition['lng'];
		      //calculate the distance between each house and center of RoadA and B
		      $query .= " and degrees(acos(sin(radians(".$geoposition['lat'].")) * sin(radians(HOUSE.latitude)) +  cos(radians(".$geoposition['lat'].")) * cos(radians(HOUSE.latitude)) * cos(radians(".$geoposition['lng']."-HOUSE.longitude))))*60*1.1515<".$milesrange;
		      //echo $query;
		    }
		    else{
		      //If it doesnt have houseaddress, city should be optional.
		      if($city){
		        $geoposition = getsinglePosition($houseAddress,$city,$state,false);
		        $query .= " and degrees(acos(sin(radians(".$geoposition['lat'].")) * sin(radians(HOUSE.latitude)) +  cos(radians(".$geoposition['lat'].")) * cos(radians(HOUSE.latitude)) * cos(radians(".$geoposition['lng']."-HOUSE.longitude))))*60*1.1515<".$milesrange;
		      }
		      //echo $geoposition['lat']."%".$geoposition['lng'];
		      //calculate the distance between each house and center of RoadA and B

		      //echo $query;
		    }
		  }

		}

		if ($rentShareWhole == 1) {
		    $query .= " and  HOUSEAVAILABILITY.rentShared >= 0";
		} else if ($rentShareWhole == -1) {
		    $query .= " and  HOUSEAVAILABILITY.rentShared <= 0";
		} else{
		    $query .= " and  HOUSEAVAILABILITY.rentShared <= 1";
		}

		// //fix 0207 isset
		if(isset($_POST['checkin']) && !empty($_POST['checkin'])) {
		  //0119
		  //ori
		  $query .= " and HOUSEAVAILABILITY.nextAvailableDate <= '".$checkin."'";
		  $query .= " and HOUSEAVAILABILITY.nextAvailableDate != '0000-00-00'";
		}
		if($numOfRoomsFrom) {
		    $query .= " and HOUSE.numOfRooms >= ".$numOfRoomsFrom;
		}
		if($numOfRoomsTo) {
		    $query .= " and HOUSE.numOfRooms <= ".$numOfRoomsTo;
		}
		if($numOfAdults) {
		    $query .= " and HOUSE.maxNumOfGuests >= ".$numOfAdults;
		}
		if($allowPregnant) {
		    $query .= " and HOUSINGCONDITION.allowPregnant = 1";
		}
		if($allowBaby) {
		    $query .= " and HOUSINGCONDITION.allowBaby = 1";
		}
		if($allowKid) {
		    $query .= " and HOUSINGCONDITION.allowKid = 1";
		}
		if($allowPets) {
		    $query .= " and HOUSINGCONDITION.allowPets = 1";
		}


		// house price filter
		//fix 0309 only smaller than
		if( $request->has('houseMonthlyPrice') && !empty(Input::get('houseMonthlyPrice') ) {
		    $houseMonthlyPrice = Input::get('houseMonthlyPrice');
		    $houseMonthlyRate  = Input::get('houseMonthlyRate');
		    $query .= " and HOUSEPRICE.costMonthPrice <= ".$houseMonthlyPrice*(1+$houseMonthlyRate/100);
		    // $query .= " and HOUSEPRICE.costMonthPrice >= ".$houseMonthlyPrice*(1-$houseMonthlyRate/100);

		}

		if( $request->has('houseDailyPrice') && !empty(Input::get('houseDailyPrice') ){
		    $houseDailyPrice   = Input::get('houseDailyPrice');
		    $houseDailyRate    = Input::get('houseDailyRate');
		    $query .= " and HOUSEPRICE.costDayPrice <= ".$houseDailyPrice*(1+$houseDailyRate/100);
		    // $query .= " and HOUSEPRICE.costDayPrice >= ".$houseDailyPrice*(1-$houseDailyRate/100);
		}

		if( $request->has('roomMonthlyPrice') && !empty(Input::get('roomMonthlyPrice') ){
		    $roomMonthlyPrice  = Input::get('roomMonthlyPrice');
		    $roomMonthlyRate   = Input::get('roomMonthlyRate');

		    //0109
		    $query .= " and HOUSE.numberId in (select numberID from HOUSEROOM WHERE HOUSEROOM.numberID = HOUSE.numberID";
		    $query .= " and HOUSEROOM.roomCostMonthPrice <= ".$roomMonthlyPrice*(1+$roomMonthlyRate/100);
		    // $query .= " and HOUSEROOM.roomCostMonthPrice >= ".$roomMonthlyPrice*(1-$roomMonthlyRate/100);
		      $query .= " )";
		}

		if( $request->has('roomDailyPrice') && !empty(Input::get('roomDailyPrice') ){
		    $roomDailyPrice    = Input::get('roomDailyPrice');
		    $roomDailyRate     = Input::get('roomDailyRate');
		    $query .= " and HOUSE.numberId in (select numberID from HOUSEROOM WHERE HOUSEROOM.numberID = HOUSE.numberID";
		    $query .= " and HOUSEROOM.roomCostDayPrice <= ".$roomDailyPrice*(1+$roomDailyRate/100);
		    // $query .= " and HOUSEROOM.roomCostDayPrice >= ".$roomDailyPrice*(1-$roomDailyRate/100);
		     $query .= " )";
		    
		}
		
		// in sum
		$query .= " order by HOUSE.numberID;";
		$sqlresults = DB::select($query);
		$result='';

		if($sqlRes) {
		    $index = 0;
		    $lastHouseID = '';
		    while ($row = $sqlresults->fetch_assoc()){
		      	// echo $row;
		      	// echo $row['nextAvailableDate']."\n";
		      	$row['nextAvailableDate'] = toUsDateFormat($row['nextAvailableDate']);
		      	// echo "after ".$row['nextAvailableDate'];
		        $lastHouseID = $row['houseID'];
		        for ($i = 0; $i < count($itemsToShow); $i++) {
		            $result[$index][$itemsToShow[$i]] = $row[$itemsToShow[$i]];
		        }
		        $index++;
		    }
		}

		return json_encode($result);
	}



	/*
	search address based on cross road.

	@param $crossroadA first crossroad
	@param $crossroadB second crossroad
	@param $city city name
	@param $state state name
	@return the lat and loc of the location
	*/
	function getPosition($crossroadA, $crossroadB,$city,$state){
	    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=";
	    $url .= urlencode($crossroadA." and ".$crossroadB." ".$city." ".$state." USA");
	    $url .= "&key=AIzaSyARZoJT1ZeLMF1ndyU7nDguJliUthA87cY";
	    $url .= "&key=AIzaSyARZoJT1ZeLMF1ndyU7nDguJliUthA87cY";
	    $data = file_get_contents($url);
	    $obj = json_decode($data);
	    $lat = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	    $lng = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	    if($lat && $lng)  return array("lat"=>$lat, "lng"=>$lng);
	    else return array("lat"=>"", "lng"=>"");
	}


	/*
	search address based on single position.

	@param $houseAddress the detail address of house
	@param $city city name
	@param $state state name
	@return the lat and loc of the location
	*/
	function getsinglePosition($houseAddress,$city,$state,$ishouse){
	  $url = "https://maps.googleapis.com/maps/api/geocode/json?address=";
	  if($ishouse){
	    $url .= urlencode($houseAddress." ".$city." ".$state." USA");
	  }
	  else{
	    $url .= urlencode($city." ".$state." USA");
	  }
	  $url .= "&key=AIzaSyARZoJT1ZeLMF1ndyU7nDguJliUthA87cY";
	  
	  $data = file_get_contents($url);
	  $obj = json_decode($data);
	  $lat = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	  $lng = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	  if($lat && $lng)  return array("lat"=>$lat, "lng"=>$lng);
	  else return array("lat"=>"", "lng"=>"");
	}





}
