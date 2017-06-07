
<!DOCTYPE html>
<html>
	<head>
	<title>House Search</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
	   <!-- Bootstrap CSS -->
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

				<!-- jquery -->
				<script src="{{asset('js/jquery.min.js')}}"></script>


				<!-- bootstrap -->
				<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

				<script src="{{asset('js/bootstrap.min.js')}}"></script>

				<!-- bootstrap phone (local file) -->
				<script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>

                <!-- alert box -->
				<script src="{{asset('js/bootbox.min.js')}}"></script>
                <link rel="stylesheet" href="{{asset('css/self.css')}}">
                <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
                <script src="{{asset('js/util.js')}}"></script>
              <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
              <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
			  
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
			#map_canvas{
				margin-top:20px;width:100%;height:60%;display:none;*/
			}
            #map_div{
                height: 800px;
                width: 100%;
            }
            #map {
              height: 100%;
              width: 100%;
             }
		</style>


	</head>

<body class="marginMe">
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
        <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" style="padding-top:5px;"><img src="../img/icon.png" class="img-rounded img-responsive" width="45px" height="45px" alt=""></a>
              <a class="navbar-brand" href="mainPage">91bnb Manage System</a>
        </div>

    <div id="navbar" class="navbar-collapse collapse">
          <!-- navbar left -->
          <ul class="nav navbar-nav">
            <li class=""><a href="/MainPage">Home</a></li>
            <li class="active"><a>House Search</a></li>
          </ul>
          <!-- navbar right -->
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <span class="glyphicon glyphicon-user"></span>
                        {{$Rep->repUserName}}
                      <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Change Password</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="../logout.php">Log Out</a></li>
                  </ul>
                </li>
          </ul>

    </div><!--/.nav-collapse -->
  </div><!--/ container -->
</nav>
<!-- Fixed navbar -->


<div class="container-fluid" style="margin-top:70px;width:100%;height:100%">
    <div class="row equal">
    <div class = "col-sm-6">
        <form id="houseSearchForm">
            {{csrf_field()}}
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#aboutLocation">Location</a></li>
                <li><a data-toggle="tab" href="#aboutShare">Whole/Share</a></li>
                <li><a data-toggle="tab" href="#aboutCheckin">Check-In/Out Date</a></li>
                <li><a data-toggle="tab" href="#aboutCondition">House Condition</a></li>
                <li><a data-toggle="tab" href="#aboutAmenity">Detail Condition</a></li>
                <li><a data-toggle="tab" href="#aboutPrice">House/Room Price</a></li>
            </ul>

            <div class="tab-content">

                <!-- house condition -->
                <div class="tab-pane fade in active" id="aboutLocation">

                    <div class="row">
        				<div class="row">
    						<div class="col-sm-4">
    							<label>Inquerier ID</label>
                                @if(isset($inquirerID))
                                <input class="form-control input-sm" type="text" id="inquirerID" name="inquirerID" value="{{$inquirerID}}" readonly>
                                @else
                                <input class="form-control input-sm" type="text" id="inquirerID" name="inquirerID" readonly>
                                @endif
    								
    						</div>

    						<div class="col-sm-4">
    							<label>Representatives</label>
                                @if(isset($searchrepID))
                                <input class="form-control input-sm" type="text" id="repWithOwner" name="repWithOwner" value="{{$repID}}" readonly>
                                @else
                                <input class="form-control input-sm" type="text" id="repWithOwner" name="repWithOwner" readonly>
    							@endif
    						</div>
        				</div>

                        <div class="row" hidden>
                                <input name = "country"  id="country">
                                <input id="administrative_area_level_1" name="state">
                                <input id="locality" name="city">
                                <input id="route" name="route">
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <label>House ID</label>
                                @if(isset($fullHouseID))
                                <input class="form-control input-sm" type="text" id="houseID" name="houseID" placeholder="Format: 91bnb_State_City_0000" value="{{$fullHouseID}}">
                                @else
                                <input class="form-control input-sm" type="text" id="houseID" name="houseID" placeholder="Format: 91bnb_State_City_0000">
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-8">
                                <label>House Address</label>
                                <input class="form-control input-sm"  type="text" id="houseAddress" name="houseAddress" placeholder="Enter and address,neighborhood,city" >
                            </div>
                            <div class="col-sm-2">
                                <label>Zip Code</label>
                                <input class='form-control input-sm' type="text" id = "postal_code" name="zipcode" maxlength="5">
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-sm-10">
                                <label>Cross Road Between</label>
                                <div class="input-group">
                                    <input class="form-control input-sm" type="text" id="crossroadA" name="crossroadA" placeholder="Road A">
                                    <span class="input-group-addon">and</span>
                                    <input class="form-control input-sm" type="text" id="crossroadB" name="crossroadB" placeholder="Road B">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label>Apply Range</label>
                                <select class="form-control input-sm" id="milesrange" name="milesrange">
        														<OPTION value=1>&nbsp;&nbsp;1 Mile</OPTION>
                                    <OPTION value=2 selected>&nbsp;&nbsp;2 Miles</OPTION>
                                    <OPTION value=5 >&nbsp;&nbsp;5 Miles</OPTION>
                                    <OPTION value=10>10 Miles</OPTION>
                                    <OPTION value=20>20 Miles</OPTION>
                                    <OPTION value=30>30 Miles</OPTION>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-warning">
                                    <h5><i class="fa fa-info-circle" aria-hidden="true"></i><em><strong> Note:</strong> * indicates required field. </em>
                                  </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- / house condition -->


                <!-- share -1, whole 1, either 0 -->
                <div class="tab-pane fade" id="aboutShare">
                    <div class="row">
                        <div class="col-sm-12">
                            @if(isset($Query)|| (isset($Query->share)&&$Query->share==1))
                                <input type="radio" id="rentWhole" name="rentShareWhole" value="1" checked> Rent Whole
                            @else
                                <input type="radio" id="rentWhole" name="rentShareWhole" value="1"> Rent Whole
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @if(!isset($Query) && (isset($Query->share)&&$Query->share==-1))
                                <input type="radio" id="rentShare" name="rentShareWhole" value="-1" checked> Rent Share
                            @else
                                <input type="radio" id="rentShare" name="rentShareWhole" value="-1"> Rent Share
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @if(!isset($Query)&& (isset($Query->share)&&$Query->share==0))
                                <input type="radio" id="rentEither" name="rentShareWhole" value="0" checked> Rent Either
                            @else 
                                <input type="radio" id="rentEither" name="rentShareWhole" value="0" > Rent Either
                            @endif
                        </div>
                    </div>

                </div>
                <!-- / Whole or Share -->

                <div class="tab-pane fade" id="aboutCheckin">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Check-In Date</label>
                            @if(!isset($Query)&&isset($Query->checkIn))
                            <input class="form-control input-sm" type="search" id="checkin" name="checkin" value="{{$Query->checkIn}}">
                            @else
                            <input class="form-control input-sm" type="search" id="checkin" name="checkin">
                            @endif
                        </div>

                        <div class="col-sm-2">
                            <label>Check-Out Date</label>
                            @if(!isset($Query)&&isset($Query->checkOut))
                            <input class="form-control input-sm" type="search" id="checkout" name="checkout" value="{{$Query->checkOut}}">
                            @else
                            <input class="form-control input-sm" type="search" id="checkout" name="checkout">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-warning">
                                <h5><i class="fa fa-info-circle" aria-hidden="true"></i><em><strong> Note:</strong> If guest didn't indicate the exact date, please apply the 1st of the month
                                for Check-In date, and the end of the month for Check-Out date.</em>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-warning">
                                <h5><i class="fa fa-info-circle" aria-hidden="true"></i><em><strong> Note:</strong> * indicates required field. </em>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id='checkDateCheck'></div>
                        </div>
                    </div>
                </div><!-- / Check in and check out -->




                <div class="tab-pane fade" id="aboutCondition">
                    <div class="row">
                        <div class="col-sm-5">
                            <label>Number of Rooms</label>
                            <div class="input-group">
                                <span class="input-group-addon">Range from</span>
                                @if(!isset($Query)&&isset($Query->rooms))
                                <input class="form-control input-sm" type="text" id="numOfRoomsFrom" name="numOfRoomsFrom" value="{{$Query->number}}">
                                @else
                                <input class="form-control input-sm" type="text" id="numOfRoomsFrom" name="numOfRoomsFrom">
                                @endif
                                <span class="input-group-addon">to</span>
                                <input class="form-control input-sm" type="text" id="numOfRoomsTo" name="numOfRoomsTo">
                                <span class="input-group-addon">Rooms Per House</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <label>Number of Adults</label>
                            @if(!isset($Query)&&isset($Query->numOfAdult))
                            <input class="form-control input-sm" type="number" id="numOfAdults" name="numOfAdults" value="{{$Query->numOfAdult}}">
                            @else
                            <input class="form-control input-sm" type="number" id="numOfAdults" name="numOfAdults">
                            @endif
                        </div>
                    </div>


                </div><!-- / House Condition -->

               <!-- condtion details -->
                <div class="tab-pane fade" id="aboutAmenity" style="font-size:12px;">
                    <h5>Basic Info</h5>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="checkbox" value="1" name="allowPregnant" 
                                @if(!isset($Query)&&isset($Query->pregnancy)&&$Query->pregnancy==1){
                                    checked
                                @endif
                                >Allow Pregnant
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" value="1" name="allowBaby"
                                @if(!isset($Query)&&isset($Query->hasBaby)&&$Query->hasBaby==1)
                                    checked
                                @endif
                                >Allow Baby
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" value="1" name="allowKid" id="allowKid"
                                @if(!isset($Query)&&isset($Query->numOfChildren)&&$Query->numOfChildren>0)
                                    checked
                                @endif
                                >Allow Kid
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" value="1" name="allowPets" id="allowPets"
                                @if(!isset($Query)&&isset($Query->pet)&& $Query->pet==1)
                                    checked
                                @endif
                                > Allow Pet
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" value="1" name="havePet" id="havePet"> Have Pet
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">
                            <input id="allowKidAge" type="text" name="allowKidAge" class="form-control input-sm" 
                                @if(isset($Query))
                                    @if($Query->childAge<=3||$Query->numOfChildren<=0))
                                        disabled
                                    @else 
                                        value= {{$Query->numOfChildren}} 
                                    @endif
                                @endif
                                placeholder="Allow Kids Age">
                        </div>
                        <div class="col-sm-2">
                            <input id="allowPetType" type="text" name="allowPetType" class="form-control input-sm" 
                                @if(isset($Query))
                                    @if($Query->pet!=1))
                                        disabled
                                    @else
                                        value= {{$Query->numOfChildren}} 
                                    @endif
                                @endif
                                placeholder="Allow Pet Type" 
                                @if(!isset($Query)&&isset($Query->petType))
                                    value={{$Query->petType}}
                                @endif
                                >
                        </div>
                        <div class="col-sm-2">
                            <input id="havePetType" type="text" name="havePetType" class="form-control input-sm" disabled placeholder="Have Pet Type">
                        </div>
                    </div>
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
                    <hr>
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
                            <textarea name="additionalNote" ROWS=10 COLS=100 class="form-control input-sm"></textarea>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="aboutPrice">
                    <!-- <div class="alert alert-warning">
                      <em><i class="fa fa-info-circle" aria-hidden="true"></i><strong> Inquiry Budget: </strong>
                      From $ <input style="background-color:#E6E6E6" class="input-sm" value= readonly> to $
                        <input style="background-color:#E6E6E6" class="input-sm" value="'.$budgetUpper.'" disabled>';
                    if ($budgetUnit == '1') {echo ' Per Month</em></div>'; } else { echo ' Per Day</em></div>'; } -->
                    <div class="row">
                    <div class="col-sm-6">
                            <h4>House Price Range</h4>
                            <div class="row">
                                <div class="col-sm-10">
                                    <label>Monthly Price Approx</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <?php
                                            echo '<input class="form-control input-sm" type="text" id="houseMonthlyPrice" name="houseMonthlyPrice">';
                                        ?>
                                        <span class="input-group-addon">with Up/Down Rate of</span>
                                        <SELECT id='houseMonthlyRate' class='form-control input-sm' name="houseMonthlyRate">
                                                <OPTION value=5 selected>&nbsp;&nbsp;5%</OPTION>
                                                <OPTION value=10>10%</OPTION>
                                                <OPTION value=20>20%</OPTION>
                                                <OPTION value=50>50%</OPTION>
                                        </SELECT>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10">
                                    <label>Daily Price Approx</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <?php

                                            echo '<input class="form-control input-sm" type="text" id="houseDailyPrice" name="houseDailyPrice">';

                                        ?>
                                        <span class="input-group-addon">with Up/Down Rate of</span>
                                        <SELECT id="houseDailyRate" class="form-control input-sm" name="houseDailyRate">
                                                <OPTION value=5 selected>&nbsp;&nbsp;5%</OPTION>
                                                <OPTION value=10>10%</OPTION>
                                                <OPTION value=20>20%</OPTION>
                                                <OPTION value=50>50%</OPTION>
                                        </SELECT>
                                    </div>
                                </div>
                            </div>
                    </div>


                    <div class="col-sm-6">
                        <h4>Room Price Range</h4>
                    <div class="row">
                            <div class="col-sm-10">
                                <label>Monthly Price Approx</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input class="form-control input-sm" type="text" id="roomMonthlyPrice" name="roomMonthlyPrice">
                                    <span class="input-group-addon">with Up/Down Rate of</span>
                                    <SELECT id='roomMonthlyRate' class='form-control input-sm' name="roomMonthlyRate">
                                            <OPTION value=5 selected>&nbsp;&nbsp;5%</OPTION>
                                            <OPTION value=10>10%</OPTION>
                                            <OPTION value=20>20%</OPTION>
                                            <OPTION value=50>50%</OPTION>
                                    </SELECT>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10">
                                <label>Daily Price Approx</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input class="form-control input-sm" type="text" id="roomDailyPrice" name="roomDailyPrice">
                                    <span class="input-group-addon">with Up/Down Rate of</span>
                                    <SELECT id='roomDailyRate' class='form-control input-sm' name="roomDailyRate">
                                            <OPTION value=5 selected>&nbsp;&nbsp;5%</OPTION>
                                            <OPTION value=10>10%</OPTION>
                                            <OPTION value=20>20%</OPTION>
                                            <OPTION value=50>50%</OPTION>
                                    </SELECT>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div style="margin-top:30px; margin-bottom:50px;">
                <button class="btn btn-success" type="button" id="myBtn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Apply Filter</button>
                <button class="btn btn-warning disToLeft" type="reset" id = "refreshPage"><span class="glyphicon glyphicon-refresh"></span> Reset Filter</button>
                <button id="extall" type="button" class="btn btn-primary disToLeft"><span class="glyphicon glyphicon-download-alt"></span>
                    Export Filtered Result to Excel
                </button>
            </div>
        </form>
    </div>

    <div class="col-sm-6">
        <div id="map_div">
            <div id="map">
            </div>
        </div>
    </div>
    </div>
</div>

<script async defer
src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAAIAQT72snLXj_BITkOc5TMZjpTrzbYRw&language=en&callback=initialize">
</script>
<script>

    var autocomplete; 
    var search_geo;
    var map;
    var housemarkers = [];
    var componentForm = {
        //street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'short_name',
        postal_code: 'short_name'
    };


//fix 0201 suppose all is formatted
$(document).ready(function() {
    // locations
        $("#country").change(function(){
            if($(this).val().length!=0){
                var countryfile = $(this).val().replace(' ','');
                $.get("/resource/"+countryfile,function(data,status){
                $('#state').empty();
                for(i=0;i<data.length;++i){
                    var option = $("<option></option>").attr("value", data[i]).text(data[i]);
                    $('#state').append(option);
                }
                });
            }
        });

        $('#state').change(function(){
            if($(this).val().length!=0){
                var cityfile = $("#country").val().replace(' ','')+"_"+$(this).val().replace(' ','');
                $.get("/resource/"+cityfile,function(data,status){
                $('#city').empty();
                for(i=0;i<data.length;++i){
                    var option = $("<option></option>").attr("value", data[i]).text(data[i]);
                    $('#city').append(option);
                }
                });
            }
        });
        
        $("#allowKid").change(function(){
            if ($("#allowKid").is(":checked")) {
                $("#allowKidAge").removeAttr("disabled");
            } else {
                $("#allowKidAge").attr("disabled", "true");
            }
        });

        $("#allowPets").change(function(){
            if ($("#allowPets").is(":checked")) {
                $("#allowPetType").removeAttr("disabled");
            } else {
                $("#allowPetType").attr("disabled", "true");
            }
        });

        $("#havePet").change(function(){
            if ($("#havePet").is(":checked")) {
                $("#havePetType").removeAttr("disabled");
            } else {
                $("#havePetType").attr("disabled", "true");
            }
        });


       $('#checkin').datepicker({
          dateFormat: "mm/dd/yy",
          beforeShow: function () {
            $('#checkin').datepicker('option', 'minDate', 0);
           
          },
          onSelect:function(){
            var checkOutDate = $('#checkout').datepicker('getDate');
            // alert(checkOutDate);
            var curCheckInDate= $('#checkin').datepicker('getDate');
            if(curCheckInDate>checkOutDate)
            {
                 // alert("error date");
                 var text='<div class="alert alert-warning"><h5><i class="fa fa-info-circle" aria-hidden=true></i><em><strong> Note:</strong>The Check-In Date should be earlier than Check-Out Date.</em></h5></div>';
                 $('#checkDateCheck').html(text);
            }else{
                $('#checkDateCheck').html('');
            }
        
          }
         
         
        });

        $('#checkout').datepicker({
          dateFormat: "mm/dd/yy",
          beforeShow: function () {
            var checkin = $('#checkin').datepicker('getDate');
            checkin.setDate(checkin.getDate() + 1);
            $('#checkout').datepicker('option', 'minDate', checkin);
          }
        });


        loadOpt();
    });
    $("#extall").click(function(){
        console.log("displayInquiry - extract all");
        $(".loaderDiv").show();

        // post excel download requeset to myResponse.php
        $.post("ext_filter_house.php",
                    $("#myForm").serialize(),
                // {   msg: "filter"
                // },
        function(data){ $(".loaderDiv").hide();  window.location.href="../PHPExcel/Files/" + data;})
    });

    $("#myBtn").click(function() {
        var toSend = $('#houseSearchForm').serializeArray();
        if(search_geo){
            var location = search_geo['location'];
            toSend.push({'name':'search_latitude','value':location['lat']});
            toSend.push({'name':'search_longitude','value':location['lng']});
        }
        //alert(JSON.stringify(toSend));
        $.ajax({
            type:"POST",
            url:"/house/search",
            data:$.param(toSend),
            datatype:'json',
            success: function(data){
                if(map){
                    deleteMarkers();
                }
                initMap(search_geo);
                if(data.length>0)
                {
                    for(var i=0;i<data.length;++i)
                    {
                        var marker = new google.maps.Marker({
                            position:{'lat':data[i].latitude,'lng':data[i].longitude},
                            map:map
                        });
                        housemarkers.push(marker);
                    }
                    showMarkers();

                }
                else
                {
                    // Notice that there is no result
                }
            }
        });
    });
    
    function setMapOnAll(map){
        //var bounds = new google.maps.LatLngBounds();
        for(var i=0;i<housemarkers.length;++i)
        {
            housemarkers[i].setMap(map);
        }
    }

    function clearMarker(){
        setMapOnAll(null);
    }

    function showMarkers(){
        setMapOnAll(map);
    }

    function deleteMarkers(){
        clearMarker();
        housemarkers=[];
    }

    function initMap(search_geo){
        if(!map)
        {
            if(search_geo)
            {
                uluru = search_geo['location'];
            }
            else{
                uluru = {lat: 36.778259, lng: -119.417931};
            }
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: uluru
            });
            var cityCircle = new google.maps.Circle({
              strokeColor: '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: 0.35,
              map: map,
              center: uluru,
              radius: 2000
            });
        }
    }

    function initAutoComplete(){
        var options = {
        // bounds: new google.maps.LatLngBounds(southwest, northeast),
        componentRestrictions: {country: "us"}//Make the range fixed
        }

        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('houseAddress')),
            options);
        autocomplete.addListener('place_changed',geolocate)
    }

 //    function geocodeAddress(locations) {
	//   var title = locations[0];
	// 	var address = locations[1];
	//   var lat = locations[2];
	// 	var lng = locations[3];
	// 	var id = locations[4];
	//   //var url = locations[4];
	// 	var position = new google.maps.LatLng(locations[2],locations[3]);
	// 	var marker = new google.maps.Marker({
	// 			icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
	// 			map: map,
	// 			position: position,
	// 		  title: title,
	// 			animation: google.maps.Animation.DROP,
	// 			address: address
	// 			});
	// 			infoWindow(marker, map, title, address, id);
	// 			bounds.extend(marker.getPosition());
	// 			map.fitBounds(bounds);
	// 			google.maps.event.addListener(marker, 'mouseover', function(event) {
	// 	          this.setIcon('http://maps.google.com/mapfiles/ms/icons/red.png');
	// 	      });
	// 			google.maps.event.addListener(marker, 'mouseout', function(event) {
 //           this.setIcon('http://maps.google.com/mapfiles/ms/icons/blue.png');
 //       });

	// }

    // function infoWindow(marker, map, title, address, id) {
    // 	  google.maps.event.addListener(marker, 'click', function() {
    // 			if(previousmarker != false){
    // 				previousmarker.close();
    // 			}
    // 	    var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a onclick='selecthouse("+id+")'>View Details</a></p></div>";
    // 	    iw = new google.maps.InfoWindow({
    // 	      content: html,
    // 	      maxWidth: 350
    // 	    });
    // 	    iw.open(map, marker);
    // 			previousmarker = iw;
    // 	  });
    // }



    function initialize(){
        //initMap();
        initAutoComplete();
    }

    function geolocate(){
        var place = autocomplete.getPlace();
        console.log(JSON.stringify(place));
        if(place){
            for(var i = 0 ;i < place.address_components.length;i++){
                var addressType = place.address_components[i].types[0];
                if(componentForm[addressType]){
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
            search_geo = place.geometry;
        }
    }

// function selecthouse(numberID) {
// 	$.ajax({
// 		type: "POST",
// 		dataType: "html",//data type expected from server
// 		url: "housedetailinshowhouse.php",
// 		data: 'numberID='+numberID,
// 		success: function(data) {
// 			$("#showForm").html(data);
// 				// -----------------------------------------------
// 											$("#btnDiscard").click(function() {
// 													$("#houseID_search_form").submit();
// 											});


// 											$("#allowKid").change(function(){
// 													if ($("#allowKid").is(":checked")) {
// 															$("#allowKidAge").removeAttr('disabled');
// 													} else {
// 															$("#allowKidAge").attr('disabled', 'true');
// 																// $("#allowKidAge").removeAttr('value');
// 															$("#allowKidAge").val('');

// 													}
// 											});

// 											$("#allowPets").change(function(){
// 													if ($("#allowPets").is(":checked")) {
// 															$("#allowPetType").removeAttr("disabled");
// 													} else {
// 															$("#allowPetType").attr("disabled", "true");
// 															$("#allowPetType").val('');
// 													}
// 											});

// 											$("#havePet").change(function(){
// 													if ($("#havePet").is(":checked")) {
// 															$("#havePetType").removeAttr("disabled");
// 													} else {
// 															$("#havePetType").attr("disabled", "true");
// 															$("#havePetType").val('');
// 													}
// 											});
// 		}

// 	});
// }
</script>
</body>
</html>
