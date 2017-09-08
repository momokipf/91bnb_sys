@extends('navbar')
@section('title', 'Modify House')

@section('head')

	<!-- Bootstrap CSS -->
	<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">-->

	<!-- jquery -->
	<!-- <script src="{{asset('js/jquery.min.js')}}"></script> -->

	<!-- bootstrap -->
	<!--<script src="{{asset('js/bootstrap.min.js')}}"></script>-->

	<!-- bootstrap phone (local file) -->
	<!--<script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>-->

	<!-- alert box -->
	<!--<script src="{{asset('js/bootbox.min.js')}}"></script>-->

  	<!-- Include jQuery Popup Overlay -->
  	<script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js"></script>
	<script type="text/javascript" src="{{asset('js/moment.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar.css')}}">
	<script rel="stylesheet" type="text/javascript" src="{{asset('js/fullcalendar.min.js')}}"></script>

	
	<script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker3.css')}}" />	  

	<link rel="stylesheet" href="{{asset('css/priceswitch.css')}}"> 

	<script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>

	
    <script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>
		  

	<style>
		html {width:100%; height:100%;}
		body { line-height: 100%; line-height: 100%; width:100%; height:100%;}
		.marginMe { padding-left: 2%; padding-right: 2%; }
		.row { margin-bottom: 15px;}
		.my-left {margin-left: 15px;}
		.table-bordered th{ text-align: center;}
		.disToLeft { margin-left: 20px;}
		.tab-content {
			padding: 20px;
			border-left: 1px solid #ddd;
			border-right: 1px solid #ddd;
			border-bottom: 1px solid #ddd;
			border-radius: 0px 0px 5px 5px;
		}
		table th, td{
			border: 1px solid Gainsboro;
			border-collapse: collapse;
		}
		.bedtable th,td{
			margin-left: 20px;
			margin-top: 20px;
			padding: 5px;
			text-align: center;
		}
		a {
			text-decoration: none;
			display: inline-block;
			padding: 8px 16px;
		}
		a:hover {
			background-color: #ddd;
			color: black;
		}
		.previous {
			background-color: #f1f1f1;
			color: black;
		}
		#map_div{
			height: 650px;
			width: 100%;
		}
		#map {
			height: 100%;
			width: 100%;
		}
		i.arrow {
			border: solid black;
			border-width: 0 3px 3px 0;
			display: inline-block;
			padding: 3px;
		}
		.arrowleft{
			transform: rotate(135deg);
			-webkit-transform: rotate(135deg);
		}

		#houseroomswitch-inner:before {
			content: "House";
		}
		#houseroomswitch-inner:after {
			content: "Room";
		}

		#monthdailyswitch-inner:before{
			content: "Monthly";
		}
		#monthdailyswitch-inner:after{
			content: "Daily";
		}

		.date-disabled-day{
			 background-image: linear-gradient(to bottom right,  transparent calc(50% - 1px), red, transparent calc(50% + 1px));
		}

		
		div.gallery {
		    margin: 5px;
		    border: 1px solid #ccc;
		    float: left;
		    width: 200px;
		    height: 150px;
		}

		div.gallery:hover {
		    border: 1px solid #777;
		}

		div.gallery:hover a.glyphicon-trash{
		   display:inline-block;
		}

		div.gallery{
		    background-size: 200px 150px;
		}

		div.desc {
		    padding: 15px;
		    text-align: center;
		}

	</style>

	<script async defer src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAAIAQT72snLXj_BITkOc5TMZjpTrzbYRw&language=en&callback=initAutoComplete"></script>
	<script>
		var componentForm = {
			//street_number: 'short_name',
			// route: 'long_name',
			locality: 'long_name',
			administrative_area_level_1: 'long_name',
			country: 'long_name',
			postal_code: 'short_name'
		};

		var componentMap ={
			// route: 'route',
			locality: 'city',
			administrative_area_level_1: 'state',
			country: 'country',
			postal_code: 'houseZip'
		}

		var loc;
		
		function initAutoComplete(){
			var options = {
				// bounds: new google.maps.LatLngBounds(southwest, northeast),
				componentRestrictions: {country: "us"}//Make the range fixed
			}

			autocomplete = new google.maps.places.Autocomplete(document.getElementById('houseAddress'), options);
			autocomplete.addListener('place_changed',geolocate);
		}

		function geolocate(){
			var place = autocomplete.getPlace();
			if(place){
				// console.log(place);
				// console.log(place.geometry.location['lat']);
				for(var i = 0 ;i < place.address_components.length; i++){
					var addressType = place.address_components[i].types[0];
					if(componentForm[addressType]){
						var val = place.address_components[i][componentForm[addressType]];
						if(document.getElementById(componentMap[addressType]).value!=val){
							document.getElementById(componentMap[addressType]).value = val;
							alert("there is conflict on "+componentMap[addressType]+'\n Autocorrected');
						}
					}
				}
				 loc = place.geometry.location;
				document.getElementById('latitude').value=loc['lat']();
				document.getElementById('longitude').value=loc['lng']();
			}
			else {
				document.getElementById('latitude').value="";
				document.getElementById('longitude').value="";
			}
		}
	</script>
@endsection


@section('content')

	<div class="container">
		<form method = "post" id="modifyForm" onsubmit='return false;'>
			{{csrf_field()}}
			<ul class="nav nav-tabs" id='navtab'>
				<li class="active"><a data-toggle="tab" id='housetab' href="#house">House</a></li>
				<li><a data-toggle="tab" id='conditiontab' href="#condition">Condition</a></li>
				<li><a data-toggle="tab" id='availabilitytab' href="#availability">Availability</a></li>
				<li><a data-toggle="tab" id='pricetab' href="#price">Price</a></li>
				<li><a data-toggle="tab" id='roomtab' href="#room">Room (Optional)</a></li>
				<li><a data-toggle="tab" id='imgtab' href='#img'>Picture</a><li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane fade in active" id="house">
					<div class='row'>
						<div class='col-sm-3'>
							<label>House ID</label>
							<input class='form-control input-sm' name="fullHouseID" value="{{$house->fullHouseID}}" readonly>
							<input class='form-control input-sm' type="hidden" name="numberID" value="{{$house->numberID}}">
						</div>

						<div class='col-sm-2'>
							<label>House Owner ID</label>
							<input name='houseOwnerID' value="{{$house->houseOwnerID}}" class='form-control input-sm'>
						</div>

						<div class='col-sm-2'>
							<label>Date House Added</label>
							<input type='search' name='dateHouseAdded' value="{{$house->dateHouseAdded}}" class='form-control input-sm'>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-2'>
							<label>House ID by Owner</label>
							<input type='text' name='houseIDByOwner' value="{{$house->houseIDByOwner}}" class='form-control input-sm'>
						</div>

						<div class='col-sm-3'>
							<label>Representative with Owner</label>
							<select name='repWithOwner' class='form-control input-sm'>
						</select>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-2'>
							<label>Country</label>
							<input class='form-control input-sm' type='text' name='country' id='country' list="hotcountry" value="{{$house->country}}" readonly>
							<datalist id="hotcountry">
							</datalist>
						</div>

						<div class='col-sm-2'>
								<label>Region</label>
								<input class='form-control input-sm' type='text' name='region' value="{{$house->region}}">
						</div>
					</div>

					<div class="row" hidden>
						<input id="state" name="state" value="{{$house->country}}" readonly>
						<input id="city" name="city" value="{{$house->city}}" readonly>
						<input id="longitude" name="longitude" value="{{$house->longitude}}" readonly>
						<input id="latitude" name="latitude" value="{{$house->latitude}}" readonly>
					</div>

					<div class='row'>
						<div class='col-sm-4'>
								<label>House Address</label>
								<input type='text' name='houseAddress' id='houseAddress' value="{{$house->houseAddress}}" class='form-control input-sm' readonly>
						</div>

						<div class='col-sm-2'>
							<label>Zip</label>
							<input class='form-control input-sm' type='text' name='houseZip' id='houseZip' value="{{$house->houseZip}}" readonly>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-2'>
							<label>House Type</label>
							<select class='form-control input-sm' id='houseType' name='houseType' value="{{$house->houseType}}">
							</select>
						</div>

						<div class='col-sm-2' id='houseTypeOtherDiv'>
							<label>House Type Other</label>
							<input type='text' name='houseTypeOther' id='houseTypeOther' class='form-control input-sm' value="{{$house->houseTypeOther}}" >
						</div>

						<div class='col-sm-2'>
							<label>Size</label>
							<div class='input-group'>
								<input name='size' value="{{$house->size}}" class='form-control input-sm'>
								<span class='input-group-addon'>Sq.ft.</span>
							</div>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-2'>
							<label>Number of Rooms</label>
							<input name='numOfRooms' value="{{$house->numOfRooms}}" class='form-control input-sm'>
						</div>

						<div class='col-sm-2'>
							<label>Number of Baths</label>
							<input name='numOfBaths' value="{{$house->numOfBaths}}" class='form-control input-sm'>
						</div>

						<div class='col-sm-2'>
							<label>Number of Beds</label>
							<input name='numOfBeds' value="{{$house->numOfBeds}}" class='form-control input-sm'>
						</div>

						<div class='col-sm-2'>
							<label>Max Number of Guests</label>
							@if($house->maxNumOfGuests)
							<input name='maxNumOfGuests' value="{{$house->maxNumOfGuests}}" type='number'class='form-control input-sm'>
							@else
							<input name='maxNumOfGuests' value="0" type='number' class='form-control input-sm' >
							@endif
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-8'>
							<label>On Other Website</label>
							<input type="text" name="onOtherWebsite" class="form-control input-sm" value="{{$house->onOtherWebsite}}">
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="condition">
					<fieldset>
						<!-- <legend>123</legend> -->
					<h5>Guests Info</h5>
					<div class="row">
						<div class="col-sm-2">
							@if (isset($house->housingcondition)&&$house->housingcondition->allowPregnant == 1)
								<input type="checkbox" checked value="1" name="allowPregnant"> Allow Pregnant
							@else
								<input type="checkbox" value="1" name="allowPregnant"> Allow Pregnant
							@endif
						</div>
						<div class="col-sm-2">
							@if (isset($house->housingcondition)&&$house->housingcondition->allowBaby == 1)
								<input type="checkbox" checked value="1" name="allowBaby"> Allow Baby
							@else
								<input type="checkbox" value="1" name="allowBaby"> Allow Baby
							@endif
						</div>
						<div class="col-sm-2">
							@if (isset($house->housingcondition)&&$house->housingcondition->allowKid == 1)
								<input type="checkbox" checked value="1" name="allowKid" id="allowKid"> Allow Kid
							@else
								<input type="checkbox" value="1" name="allowKid" id="allowKid"> Allow Kid
							@endif
						</div>
						<div class="col-sm-2">
							@if (isset($house->housingcondition)&&$house->housingcondition->allowPets == 1)
								<input type="checkbox" checked value="1" name="allowPets" id="allowPets"> Allow Pet
							@else
								<input type="checkbox" value="1" name="allowPets" id="allowPets"> Allow Pet
							@endif
						</div>
						<div class="col-sm-2">
							@if (isset($house->housingcondition)&&$house->housingcondition->havePet == 1)
								<input type="checkbox" checked value="1" name="havePet" id="havePet"> Have Pet
							@else
								<input type="checkbox" value="1" name="havePet" id="havePet"> Have Pet
							@endif
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-2"></div>
						<div class="col-sm-2">
							@if (isset($house->housingcondition)&&$house->housingcondition->allowKid == 1)
								<input id="allowKidAge" type="text" name="allowKidAge" class="form-control input-sm" value="{{$house->housingcondition->allowKidAge}}" placeholder="Allow Kids Age">
							@else
								<input id="allowKidAge" type="text" name="allowKidAge" class="form-control input-sm" disabled placeholder="Allow Kids Age">
							@endif
						</div>
						<div class="col-sm-2">
							@if (isset($house->housingcondition)&&$house->housingcondition->allowPet == 1)
								<input id="allowPetType" type="text" name="allowPetType" class="form-control input-sm" value="{{$house->housingcondition->allowPetType}}" placeholder="Allow Pet Type">
							@else
								<input id="allowPetType" type="text" name="allowPetType" class="form-control input-sm" disabled placeholder="Allow Pet Type">
							@endif
						</div>
						<div class="col-sm-2">
							@if (isset($house->housingcondition)&&$house->housingcondition->havePet == 1)
								<input id="havePetType" type="text" name="havePetType" class="form-control input-sm" value="{{$house->housingcondition->havePetType}}" placeholder="Have Pet Type">
							@else
								<input id="havePetType" type="text" name="havePetType" class="form-control input-sm" disabled placeholder="Have Pet Type">
							@endif
						</div>
					</div>

					</fieldset>

					<hr>

					<h5>Guests Can Use</h5>
					<div class="row">
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowKitchen"> Kitchen
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowParking"> Parking Space
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowBBQ"> BBQ Grill
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowFrontYard"> Front Yard
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowBackYard"> Back Yard
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowSwimmingPool"> Swimming Pool
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowLaundryWasher"> Laundry - Washer
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowLandryDryer"> Laundry - Dryer
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowElevator"> Elevator
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowHotTub"> Hot Tub
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="allowGym"> Gym
						</div>
					</div>

					<hr>

					<h5>General Amenities</h5>

					<div class="row">
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerToothbrush"> Toothbrush
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerToothpaste"> Toothpaste
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerFacialWash"> Facial Wash
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerBodyWash"> Body Wash
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerSoap"> Soap
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerShampoo"> Shampoo
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerConditioner"> Conditioner
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerTowel"> Towel
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerBathTowel"> Bath Towel
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerHairDryer"> Hair Dryer
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerIron"> Iron
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerHangers"> Hangers
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerSlippers"> Slippers
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerWorkSpace"> Desk/Workspace
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerWifi"> Wifi
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerTV"> TV
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerChineseTV"> Chinese TV
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerCable"> Cable
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerAC"> Air Conditioning
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerHeater"> Heater
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerHotWaterkettle"> Hot Water Kettle
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerRiceCooker"> Rice Cooker
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerCookware"> Cookware
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerCookingPan"> Cooking Pan
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerCookingPot"> Cooking Pot
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerCookingKnife"> Cooking Knife
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="offerUtensils"> Utensils
						</div>
					</div>
					<hr>

					<h5>Safety Amenities</h5>
					<div class="row">
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="haveSmokeDetector"> Smoke Detector
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="haveFirstAidKit"> First Aid Kit
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="haveFireExt"> Fire Extinguisher
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="haveCCTV"> CCTV
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="haveSecurityAlarm"> Security Alarm
						</div>
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="haveSafetyGuard"> Safety Guard
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<input type="checkbox" value="1" name="haveBedroomLock"> Lock on Bedroom Door
						</div>
						<div class="col-sm-3">
							<input type="checkbox" value="1" name="haveCODetector"> Carbon Monoxide Detector
						</div>
					</div>

					<hr>
					<h5>Additional Note</h5>
					<div class="row">
						<div class="col-sm-6">
							<textarea name="additionalNote" ROWS=10 COLS=100 class="form-control input-sm">@if(isset($house->housingcondition)){{$house->housingcondition->additionalNote}}@endif</textarea>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="availability">
					<div class="row">
						<div class="col-lg-9">

							<div id="calendar"></div>
						</div>

						<div class="col-lg-3" style="margin-top: 30px;">
							<label> Start </label>
							<input type="text" class="form-control" name="rentStart" id="datestart">
							<label> End </label>
							<input type="text" class="form-control" name="rentEnd" id = "dateend">
							<div style='text-align:center; margin: 25px 0 200px 0;'>
								<button type='button' class='btn btn-danger' onclick='insertDaterange();'>Block</button> 
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="price">
					<div class="row">
						<div class="col-sm-2">
							<label>Cost Day Price</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="costDayPrice" class="form-control input-sm" value="{{$house->houseprice->costDayPrice}}">
							</div>
						</div>

						<div class="col-sm-2">
							<label>Cost Week Price</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="costWeekPrice" class="form-control input-sm" value="{{$house->houseprice->costWeekPrice}}">
							</div>
						</div>

						<div class="col-sm-2">
							<label>Cost Month Price</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="costMonthPrice" class="form-control input-sm" value="{{$house->houseprice->costMonthPrice}}">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Cost Utility</label>
							<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" name="costUtility" class="form-control input-sm" value="{{$house->houseprice->costUtility}}">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-4">
							<label>Utility Note</label>
							<textarea class="form-control" rows="4" cols="50" name="utilityNote" placeholder="What's included? Ex: Wi-Fi, Electricity, Water, Gas...">{{$house->houseprice->utilityNote}}</textarea>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Cost Cleaning</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="costCleaning" class="form-control input-sm" value="{{$house->houseprice->costCleaning}}">
							</div>
						</div>

						<div class="col-sm-2">
							<label>Cost Security Deposit</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="costSecurityDeposit" class="form-control input-sm" value="{{$house->houseprice->costSecurityDeposit}}">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-4">
							<label>Cost Note</label>
							<textarea class="form-control" rows="4" cols="50" name="costNote">{{$house->houseprice->costNote}}</textarea>
						</div>               
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Retail Day Price</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="retailDayPrice" class="form-control input-sm" value="{{$house->houseprice->retailDayPrice}}">
							</div>
						</div>

						<div class="col-sm-2">
							<label>Retail Week Price</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="retailWeekPrice" class="form-control input-sm" value="{{$house->houseprice->retailWeekPrice}}">
							</div>
						</div>

						<div class="col-sm-2">
							<label>Retail Month Price</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="retailMonthPrice" class="form-control input-sm" value="{{$house->houseprice->retailMonthPrice}}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2">
							<label>Retail Utility</label>
							<div class="input-group">
								<!--    <span class="input-group-addon">$</span>
								<input type="number" name="retailUtility" class="form-control input-sm"> -->                     
								<input type="text" name="retailUtility" class="form-control input-sm" value="{{$house->houseprice->retailUtility}}">
							</div>
						</div>

						<div class="col-sm-2">
							<label>Retail Cleaning</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="retailCleaning" class="form-control input-sm" value="{{$house->houseprice->retailCleaning}}">
							</div>
						</div>

						<div class="col-sm-2">
							<label>Retail Security Deposit</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="retailSecurityDeposit" class="form-control input-sm" value="{{$house->houseprice->retailSecurityDeposit}}">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Upsell Percent</label>
								<div class="input-group">
									<input type="number" name="upsellPercent" class="form-control input-sm" value="{{$house->houseprice->upsellPercent}}">
									<span class="input-group-addon">%</span>
								</div>
						</div>

						<div class="col-sm-2">
							<label>TOT Percent</label>
							<div class="input-group">
								<input type="number" name="totpercent" class="form-control input-sm" value="{{$house->houseprice->totpercent}}">
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="room">
					<div id = "roomsdiv">
						@for ($i = 1; $i <= count($house->houserooms); $i++)
							<div class='well' style='background-color:white;margin-bottom:30px' id="room{{$i}}">
								<h4>Room {{$i}}</h4>
								<div class='row'>
									<div class='col-sm-2'>
										<label>Room ID</label>
										<input readonly type='number' class='form-control input-sm' name="roomID_{{$i}}" value="{{$i}}">
									</div>
									<div class='col-sm-2'>
										<label>Room Type</label>
										<select class='form-control input-sm' name="roomType_{{$i}}" id="roomType_{{$i}}">
										</select>
									</div>
								</div>

								<div class='row'>
									<div class='col-sm-4'>
										<label>Number of Beds</label>
										<input name='numOfBeds_{{$i}}'type='number' min='1' class='form-control input-sm' onchange='bedsnumberchange(this)' value='{{$house->houserooms[$i-1]->numOfBeds}}'>

										<table class='bedtable'>
											<thead>
												<tr>
													<th style='min-width:50px;'>#</th>
													<th style='min-width:200px;'>Bed Type</th>
												</tr>
											</thead>
											<tbody>
												@for($j=0;$j<$house->houserooms[$i-1]->numOfBeds;++$j)
													<tr>
														<th>{{$j+1}}</th>
														<th>
															<select class='form-control input-sm bedtype' >
															</select>
														</th>
													</tr>
												@endfor
											</tbody>
										</table>
									</div>	
								</div>

								<div class='row'>
									<div class='col-sm-2'>
										<label>Bed Type</label>
										<select class='form-control input-sm' name="roomBedType_{{$i}}" id="roomBedType_{{$i}}">
										</select>
									</div>
									<div class='col-sm-2' id="roomBedTypeotherdiv_{{$i}}">
										<label>Bed Type Other</label>
										<input name="roomBedTypeOther_{{$i}}" id="roomBedTypeOther{{$i}}" 'text' class='form-control input-sm' value="{{$house->houserooms[$i-1]->roomBedTypeOther}}">
									</div>
									<div class='col-sm-2'>
										<label>Max Guests number</label>
										@if($house->houserooms[$i-1]->roomGuestMax!="N/A")
											<input name="maxGuestsnum_{{$i}}" id="maxGuestsnum_{{$i}}" type='number' class='form-control input-sm' min='0' value="{{$house->houserooms[$i-1]->roomGuestMax}}">
										@else
											<input name="maxGuestsnum_{{$i}}" id="maxGuestsnum_{{$i}}" type='number' class='form-control input-sm' min='0' >
										@endif
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-2'>
										<label>Cost Day Price</label>
										<div class='input-group'>
											<span class='input-group-addon'>$</span>
											<input type='number' name="roomCostDayPrice_{{$i}}" min='0' class='form-control input-sm' value="{{$house->houserooms[$i-1]->roomCostDayPrice}}">
											<span class='input-group-addon'>USD</span>
										</div>
									</div>
									<div class='col-sm-2'>
										<label>Cost Week Price</label>
										<div class='input-group'>
											<span class='input-group-addon'>$</span>
											<input type='number' name="roomCostWeekPrice_{{$i}}" class='form-control input-sm' min='0' value="{{$house->houserooms[$i-1]->roomCostWeekPrice}}">
											<span class='input-group-addon'>USD</span>
										</div>
									</div>
									<div class='col-sm-2'>
										<label>Cost Month Price</label>
										<div class='input-group'>
											<span class='input-group-addon'>$</span>
											<input type='number' name="roomCostMonthPrice_{{$i}}" class='form-control input-sm' min='0' value="{{$house->houserooms[$i-1]->roomCostMonthPrice}}">
											<span class='input-group-addon'>USD</span>
										</div>
									</div>
								</div>

								<div class='row'>
									<div class='col-sm-2'>
										<label>Cost Utility</label>
										<div class='input-group'>
											<span class='input-group-addon'>$</span>
											<input type='number' name="roomCostUtility_{{$i}}" class='form-control input-sm' min='0' value="{{$house->houserooms[$i-1]->roomCostUtility}}">
											<span class='input-group-addon'>USD</span>
										</div>
									</div>
									<div class='col-sm-4'>
										<label>Utility Note</laebl>
										<textarea class='form-control' rows='4' cols='50' name="utilityNote_{{$i}}" placeholder='What&#39s included? Ex: Wi-Fi, Electricity, Water, Gas...'>{{$house->houserooms[$i-1]->utilityNote}}</textarea>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-2'>
										<label>Cleaning Fee</label>
										<div class='input-group'>
											<span class='input-group-addon'>$</span>
											<input type='number' name="roomCostCleaning_{{$i}}" class='form-control input-sm' min='0' value="{{$house->houserooms[$i-1]->roomCostCleaning}}">
											<span class='input-group-addon'>USD</span>
										</div>
									</div>
									<div class='col-sm-2'>
										<label>Cost Security Deposit</label>
										<div class='input-group'>
											<span class='input-group-addon'>$</span>
											<input type='number' name="roomCostSecurityDeposit_{{$i}}" class='form-control input-sm' value="{{$house->houserooms[$i-1]->roomCostSecurityDeposit}}">
											<span class='input-group-addon'>USD</span>
										</div>
									</div>
								</div>
							</div>
						@endfor
					</div>
					<br>
					<div class="row">
						<div class="col-sm-3">
							<input id="room_num" name="room_num" hidden>
							<button class="btn btn-success btn-sm" type="button" id="addRoom">Add a Room</button>
							<button class="btn btn-danger btn-sm" type="button" id="removeRoom">Remove a Room</button>
						</div>
					</div>
				</div>
			</form>
				<div class="tab-pane fade" id='img' style ="height:500px;overflow-y: scroll;">
					@for($i=0 ; $i < count($house->imgURLs);$i++)
						<div class="gallery" value="{{$house->imgURLs[$i]}}" style='background-image:url({{$house->imgURLs[$i]}});'>
							<!-- <a target="_blank" href="fjords.jpg"> -->
							<!-- <img src="{{$house->imgURLs[$i]}}" alt="Fjords" width="300" height="200"> -->
							<a href="#" class="glyphicon glyphicon-trash">
							</a>
													<!-- </a> -->
							<!-- <div class="desc">Add a description of the image here</div> -->
						</div>
					@endfor
					<!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner" role="listbox">
							@for($i = 0 ; $i<count($house->imgURLs) ; $i++)
								@if($i==0)
									<div class="item active">
								@else
									<div class="item">
								@endif
									<img class="d-block img-fluid" src="{{$house->imgURLs[$i]}}" style="width:100%;">
								</div>
							@endfor

						</div>
						<a class="left carousel-control" href="#carouselExampleControls" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carouselExampleControls" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
						</a>
						</a>
					</div>-->
				</div>
				<div style="margin:auto;text-align: center;">
					<button class="uploadpopup_open btn btn-default btn-sm" >Upload</button>
				</div>
			</div>

			<div style='text-align:center; margin: 25px 0 200px 0;'>
				<button class="btn btn-primary btn-sm" type="submit">Save Modified Info</button>
			</div>
		<!-- </form> -->

		<div data-role="popup" id='uploadpopup' >
			<div style = "width:480px;background:#FFFFFF;">
			<form action='/house/pic/upload' enctype="multipart/form-data" method="POST" id='picuploadform'>
				{{ csrf_field()}}
				<input type='text' name='houseID'  value='{{$house->numberID}}' hidden>
				<input type='file' name='pic[]'  class= "form-control" accept='image/*' multiple>
				<div class='hint'>The Maximal size is 2M</div>
				<!-- <button class='form-control' onclick='addOneMoreFile();'>Add Image file</button>  -->
				<input type='submit' onclick='checkpic();' value='Upload'>
				<button class="uploadpopup_close">Close</button>
			</form>
			</div>
		</div>

	</div>
@endsection

@section('script')
<script>
	

	var patharray = (window.location.pathname).split('/');
	var numberID = patharray[3];

	$(document).ready(function() {
			loadOpt();
			//$("#hotcountry").load("{{asset('list/hotCountryList')}}");
			$('#datestart').datepicker({
				todayHighlight:true,
				autoclose:true,

			});
			
			$('#datestart').change(function(){
				// $('#calendar').fullcalendar('select',$(this).val());
			});

			$('#dateend').datepicker({
				autoclose:true,
			});

			$('#dateend').change(function(){
				// var start = $('#datestart').val();
				var end = $(this).val();
				// if(start){
				// 	$('#calendar').fullCalendar('select',moment(start),moment(end));
				// }
				// else{

				// }

				alert(end);
			});
			$('#calendar').fullCalendar({
		        // put your options and callbacks here
		        eventSources: [
				    {
				        url:'/houseavailability/'+ numberID,
				        error: function() {
			                alert('there was an error while fetching events!');
			            },
				        allDay:true,
				        cache: true,
				        className :'tool',
						// rendering: 'background',
						// color: '#FF0000'
				    },],
				selectable:true,
				selectMinDistance:2, 
				selectOverlap: false,
				eventDurationEditable: true,
				droppable: true, // this allows things to be dropped onto the calendar
				select: function( start, end, jsEvent, view){
					//alert("from: "+moment(start).format("YYYY-MM-DD") + " to " + moment(end).format("YYYY-MM-DD") + " has been selected");

					$('#datestart').val(moment(start).format("MM/DD/YYYY"));
					$('#dateend').val(moment(end).format("MM/DD/YYYY"));

					// $('#calendar').fullCalendar('unselect');
				},
				dayRender:function(date,cell){
					if(moment().diff(date,'days') > 0){
						cell.addClass('date-disabled-day');
					}
				},
				eventResize:function( event, delta, revertFunc, jsEvent, ui, view){
					if (confirm("Change the block interval?") == true) {
				        updateDaterange(event,false);
				    } else {
				    	revertFunc();
				    }
				},
				eventClick:function(event){
					if(event.title=="Block"){
						if(confirm("Do you want to disable this block?")==true){
							$('#calendar').fullCalendar( 'removeEvents',event.id);
							updateDaterange(event,true);
						}
					}
					else if(event.url){
						window.open(event.url);
						return false;
					}
				}
				
		    });

			// store the currently selected tab in the hash value
			$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
			  var id = $(e.target).attr("href").substr(1);
			  window.location.hash = id;
			});

			// on load of the page: switch to the currently selected tab
			var hash = window.location.hash;
			$('#navtab a[href="' + hash + '"]').tab('show');

			$('#uploadpopup').popup({
				background: true,
			});

			$('a.glyphicon-trash').on('click',function(e){
				e.preventDefault();
				var ele = $(this);
				var url = $(this).closest('.gallery').css('background-image');
				var imageID = url.substring(url.lastIndexOf('/')+1,url.length-2);
				console.log("deleting: "+imageID);

				$.ajax({
					url:'/house/pic/delete',
					type:'DELETE',
					data:{'_token':"{{csrf_token()}}",'filename':imageID,'numberID':numberID},
					success:function(data){
						removeimgNode(data,ele);
					},
					error: function(){

					}
				});
			});

			function removeimgNode(response,ele){
				if(response.length!=0&&response.status=='success'){
					bootbox.dialog({
						message: "Img has been deleted" ,
						title:"Success",
						buttons: {
							main: {
								label:"OK",
								className: "btn-primary"
							}
						}
					});
					ele.parent().remove();
				}
				else if(response.length!=0&&response.status=='error'){

				}
				else{
					alert("warning, system error");
				}
			}

			function addOneMoreInput(){
				$('input[type=file]').last().change(function(){
					$(this).after("<input type='file' name='pic[]' class='form-control' accept='image/*' multiple>");
					$(this).off('change');
					addOneMoreInput();
				})
			}

			addOneMoreInput();

			$("#allowKid").change(function() {
				if (this.checked) {
					$("#allowKidAge").prop("disabled", false);
					$("#allowKidAge").val("");
				}
				else {
					$("#allowKidAge").prop("disabled", true);
					$("#allowKidAge").val("");
				}
			});

			$("#allowPets").change(function() {
				if (this.checked) {
					$("#allowPetType").prop("disabled", false);
					$("#allowPetType").val("");
				}
				else {
					$("#allowPetType").prop("disabled", true);
					$("#allowPetType").val("");
				}
			});

			$("#havePet").change(function() {
				if (this.checked) {
					$("#havePetType").prop("disabled", false);
					$("#havePetType").val("");
				}
				else {
					$("#havePetType").prop("disabled", true);
					$("#havePetType").val("");
				}
			});

			$.get("/resource/roomTypes",function(data,status){
				roomtype = "";
				for(i=0;i<data.length;++i){
					// var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					// $('#room1Type').append(option);
					// $('#room2Type').append("<option>" + data[i] + "</option>");
					var option = "<option value='" + data[i] + "'> "+data[i]+"</option>";
					roomtype += option;
				}
				var room = "{{$house->houserooms}}";
				room = room.replace(/&quot;/g, '"');
				room = JSON.parse(room);
				// console.log(room);

				for (var i = 1; i <= $("#roomsdiv").children().length; i++) {
					$("#roomType_"+i).html(roomtype);
					$("#roomType_"+i).val(room[0].roomType);
				}
			});

			$.get("/resource/bedTypes",function(data,status){
				bedtype = "";
				for(i=0;i<data.length;++i){
					// var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					// $('#room1Type').append(option);
					// $('#room2Type').append("<option>" + data[i] + "</option>");
					var option = "<option value='" + data[i] + "'> "+data[i]+"</option>";
					bedtype += option;
				}
				$('.bedtype').html(bedtype);
				var room = "{{$house->houserooms}}";
				bedT = room.replace(/&quot;/g, '"');
				bedT = JSON.parse(bedT);
				for (var i = 0; i <$("#roomsdiv").children().length; i++) {
					bedTarray = (bedT[i].roomBedType).split(';');
					var tableele = $('#roomsdiv').children().eq(i).find('table');
					var rowCount = $('tr', $(tableele).find('tbody')).length;
					for(var j = 0 ; j < rowCount ; ++j ){
						$('tbody > tr',tableele).eq(j).find('select').val(bedTarray[j]);
					}
				}
			});

			$('#addRoom').click(function(){
				var count = $("#roomsdiv").children().length + 1;
				var htmlstr = "<div class='well' style='background-color:white;margin-bottom:30px' id=room_"+count+">";
				htmlstr += "<h4>Room "+count+"</h4><div class='row'><div class='col-sm-2'><label>Room ID</label>" + 
						   "<input readonly type='number' class='form-control input-sm' name='roomID_"+count+"' value="+count+"></div>"+
						   "<div class='col-sm-2'><label>Room Type</label>" +
						   "<select class='form-control input-sm' name='roomType_"+count+"' id='roomType_"+count+" ' onchange='roomtypechange(this)'>"+roomtype+"</select></div>"+

						   "<div class='col-sm-2' id='roomTypeOtherDiv_"+count+"' hidden><label>Room Type Other</label>"+
						   "<input name='roomTypeOther_"+count+"'  type='text' class='form-control input-sm' ></div></div>"+

						   "<div class='row'><div class='col-sm-4'><label>Number of Beds</label><input name='numOfBeds_"+count+"'type='number' min='1' value='0'  class='form-control input-sm' onchange='bedsnumberchange(this)'>"+
						   "<table class='bedtable'><thead><tr><th style='min-width:50px;'>#</th><th style='min-width:200px;'>Bed Type</th></tr></thead><tbody></tbody></table></div></div>"+


						   "<div class='row'>"+
						   // "<div class='col-sm-2'><label>Bed Type</label><select class='form-control input-sm' name='roomBedType_"+count+"'id='roomBedType_"+count+"' onchange='bedtypechange(this)'>"+bedtype+"</select></div>"+
						   // "<div class='col-sm-2' id='roomBedTypeotherdiv_"+count+"' hidden><label>Bed Type Other</label>"+
						   // "<input name='roomBedTypeOther_"+count+"' id='roomBedTypeOther_"+count+"' type='text' class='form-control input-sm'></div>"+

						   "<div class='col-sm-2'><label>Max Guests number</label><input name='maxGuestsnum_"+count+"' id='maxGuestsnum_"+count+"' type='number' class='form-control input-sm' value='0' min='1'></div></div>"+
						   "<div class=row><div class='col-sm-2'><label>Cost Day Price</label><div class='input-group'><span class='input-group-addon'>$</span>"+
						   "<input type='number' name='roomCostDayPrice_"+count+"' min='0' value='0' class='form-control input-sm'><span class='input-group-addon'>USD</span></div></div>"+
						   "<div class='col-sm-2'><label>Cost Week Price</label><div class='input-group'><span class='input-group-addon'>$</span>"+
						   "<input type='number' name='roomCostWeekPrice_"+count+"' class='form-control input-sm' value='0' min='0'><span class='input-group-addon'>USD</span></div></div>"+
						   "<div class='col-sm-2'><label>Cost Month Price</label><div class='input-group'><span class='input-group-addon'>$</span>"+
						   "<input type='number' name='roomCostMonthPrice_"+count+"' class='form-control input-sm' value='0' min='0'><span class='input-group-addon'>USD</span></div></div></div>"+

						   "<div class='row'><div class='col-sm-2'><label>Cost Utility</label><div class='input-group'><span class='input-group-addon'>$</span>"+
						   "<input type='number' name='roomCostUtility_"+count+"' class='form-control input-sm' value='0' min='0'><span class='input-group-addon'>USD</span></div></div>"+
						   "<div class='col-sm-4'><label>Utility Note</laebl><textarea class='form-control' rows='4' cols='50' name='utilityNote_"+count+"' placeholder='What&#39s included? Ex: Wi-Fi, Electricity, Water, Gas...'></textarea></div></div>"+
 						   "<div class='row'><div class='col-sm-2'><label>Cleaning Fee</label><div class='input-group'><span class='input-group-addon'>$</span>"+
 						   "<input type='number' name='roomCostCleaning_"+count+"' class='form-control input-sm' value='0' min='0'><span class='input-group-addon'>USD</span></div></div>"+
 						   "<div class='col-sm-2'><label>Cost Security Deposit</label><div class='input-group'><span class='input-group-addon'>$</span>"+
 						   "<input type='number' name='roomCostSecurityDeposit_"+count+"' class='form-control input-sm' value='0' min='0' ><span class='input-group-addon'>USD</span></div></div></div>"+
						   "</div>";
				$('#roomsdiv').append(htmlstr);
			});

			$('#removeRoom').click(function(){
				$("#roomsdiv").children().last().remove();
			});

			$('#modifyForm').submit(function() {
				var toSend = $('#modifyForm').serializeArray();
				for(var i=0;i< document.getElementById("roomsdiv").childElementCount;++i){
					var tableele = $('#roomsdiv').children().eq(i).find('table');
					var roombedtype="";
					var rowCount = $('tr', $(tableele).find('tbody')).length;
					for(var j=0;j<rowCount;++j){
						roombedtype += ((roombedtype)?';':'')+$('tbody > tr',tableele).eq(j).find('select').val();
					}
					console.log = roombedtype;
					toSend.push({'name':'roomBedType_'+(i+1),'value':roombedtype});
				}
				toSend.push({'name':'room_num','value':document.getElementById('roomsdiv').childElementCount});
				$.ajax({
					type: "POST",
					url: "/house/modify/update/"+numberID,
					data: $.param(toSend),
					success: function(data) {
						if(data.length==0||data.status=="error"){
							bootbox.dialog({
								message: "Erro happened on modifying House info, please contact IT stuff",
								title:"Failed",
								buttons: {
									main: {
										label:"OK",
										className: "btn-primary"
									}
								}
							});
						}
						else if(data.status="success"){
							bootbox.dialog({
								message: "Modifying House info successfully",
								title: 'Notice',
								buttons: {
								  success: {
									  label: 'OK',
									  className: 'btn-primary',
									  callback: function(){
										window.history.back();
									  }
								  }
								},
							});


						}
					}
				});
			});
		});

	function bedsnumberchange(ele){
		var tableele = $(ele).siblings('table');
		var rowCount = $('tr', $(tableele).find('tbody')).length;
		var numberofbeds = parseInt($(ele).val());

		if(rowCount<numberofbeds){
			for(var i=rowCount;i<numberofbeds;++i){
				var markup = "<tr><td>"+(i+1)+"</td><td><select class='form-control input-sm'>"+bedtype+"</select></td></tr>";
				$('tbody',tableele).append(markup);
			}
		}
		else{
			for(var i=numberofbeds+1;i<=rowCount;++i){
				$('tbody > tr:nth-child('+i+')',tableele).remove();
			}
		}


	}	

	function insertDaterange(){
		var toSend = {};
		var id = numberID;
		toSend['_token'] = "{{csrf_token()}}";
		toSend['rentStart'] = converttimetosql($('#datestart').val());
		toSend['rentEnd'] = converttimetosql($('#dateend').val());
		$.ajax({
			type: "POST",
			url: "/houseavailability/"+numberID+"/insert",
			data: toSend,
			success: function(data){
				$('#calendar').fullCalendar( 'refetchEvents' );
				bootbox.dialog({
					message: "Range successfully added",
					title: "Confirmation",

					buttons: {
						main: {
							label: "OK",
							className: "btn-primary"
						}
					}
				});

			}
		});
	}

	function updateDaterange(ele,isdelete){
		var toSend={};
		var id = numberID;
		var avaid = 

		toSend['_token'] = "{{csrf_token()}}";
		toSend['avaid'] = ele.id.split('_')[1];
		toSend['rentStart'] = converttimetosql(ele.start.format("MM/DD/YYYY"));
		toSend['rentEnd'] = converttimetosql(ele.end.format("MM/DD/YYYY"));

		if(isdelete){
			toSend['delete'] = 'true';
			$.ajax({
				type: "POST",
				url: "/houseavailability/"+numberID+"/update",
				data: toSend,
				success: function(data){
					bootbox.dialog({
						message: "Range successfully delete",
						title: "Confirmation",
						buttons: {
							main: {
								label: "OK",
								className: "btn-primary"
							}
						}
					});
				}
			});
		}
		else{
			toSend['delete'] = 'false';
			$.ajax({
				type: "POST",
				url: "/houseavailability/"+numberID+"/update",
				data: toSend,
				success: function(data){
					bootbox.dialog({
						message: "Range successfully update",
						title: "Confirmation",
						buttons: {
							main: {
								label: "OK",
								className: "btn-primary"
							}
						}
					});
				}
			});
		}
	}


	function checkpic(){
		var files = $('input[type=file]');
		if(files.length<=1){
			return false;
		}
		else{
			files.last().remove();
			return true;
		}
	}

</script>
@endsection



