
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
            .input-w label, .input-w input {
                float: none; /* if you had floats before? otherwise inline-block will behave differently */
                display: inline-block;
                vertical-align: middle;    
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
            .left{
                transform: rotate(135deg);
                -webkit-transform: rotate(135deg);
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
                    <li><a href="/logout">Log Out</a></li>
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
                <!-- <li><a data-toggle="tab" href="#aboutAmenity">Detail Condition</a></li> -->
                <li><a data-toggle="tab" href="#aboutPrice">House/Room Price</a></li>
                <!-- <li><a data-toggle="tab" href="#aboutOwner">House Owner</a></li> -->
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
                                <input id="address" diabled>
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
                                <input type="radio" id="rentWhole" name="rentShareWhole" value="1" checked> Whole
                            @else
                                <input type="radio" id="rentWhole" name="rentShareWhole" value="1"> Whole
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @if(isset($Query) && (isset($Query->share)&&$Query->share==-1))
                                <input type="radio" id="rentShare" name="rentShareWhole" value="-1" checked> Rent Share
                            @else
                                <input type="radio" id="rentShare" name="rentShareWhole" value="-1"> Rent Share
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @if(!isset($Query))
                                <input type="radio" id="rentEither" name="rentShareWhole" value="0" checked> Either
                            @else 
                                <input type="radio" id="rentEither" name="rentShareWhole" value="0" > Either
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
                <!-- <div class="tab-pane fade" id="aboutAmenity" style="font-size:12px;">
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
                </div> -->

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

                <!-- <div class="tab-pane fade" id="aboutOwner">

                </div>  -->

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


    <hr>

    <div class="" id="showResult" style="width='100%';margin-top:60px;display:none" >
        <div class="row" id="back_menu" onclick="resultSM.toTablePage()" >
            <button><p><i class="arrow left" ></i>Back</p></button>
        </div>
        <table id="housestable" class="table table-bordered table-striped text-center" style="font-size:12px;">
            <thead>
                <tr>
                    <th style="min-width:50px;">Number ID</th>
                    <!-- <th style="min-width:100px;">House ID</th> -->
                    <th style="min-width:100px;">State</th>
                    <th style="min-width:100px;">City</th>
                    <th style="min-width:150px;">House Address</th>
                    <th style="min-width:50px;">Number of Rooms</th>
                    <th style="min-width:50px;">Number of Baths</th>

                    <th style="min-width:100px;">House Type</th>
                    <th style="min-width:100px;">Price per Month</th>
                    <th style="min-width:100px;">Price per Day</th>
                    <th style="min-width:150px;">Next Available Date</th>

                    <th style="min-width:100px;">Minimum Stay Term</th>
                    <th style="min-width:100px;">Whole/Share</th>
                    <th style="min-width:150px;">View House info</th>
                    <th style="min-width:159px;">View Owner info</th>
                    <!--<th style="min-width:170px;">Owner Phone Number</th>
                    <th style="min-width:170px;">Owner Name</th>
                    <th style="min-width:150px;">WeChat Name</th>
                    <th style="min-width:100px;">WeChat ID</th> -->
                </tr>
            </thead>
            <tbody id="fillArea">

            </tbody>

        </table>
        <div id = "ownerdiv" >
        </div>
        <div id = "housediv" class="container" style="display:none">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#HouseBasicinfo">Basic Info</a></li>
                <li><a data-toggle="tab" href="#HouseCondition">Condition</a></li> 
                <li><a data-toggle="tab" href="#HouseAvailability">Availability</a></li>
                <li><a data-toggle="tab" href="#HousePrice">Price</a></li>
                <!-- <li><a data-toggle -->
            </ul>
            <div class="tab-content">
                <div id="HouseBasicinfo" class="tab-pane fade in active" style="pading:20px;">
                    <div class="row" >
                        <div class="col-sm-2 input-w">
                            <label>House ID:</label><p id="houseid_info"></p>
                         </div>  
                        <div class='col-sm-2'>
                            <label>House Owner ID:</label>
                            <p id='houseOwnerID_info'></p>
                        </div> 
                        <div class='col-sm-2'>
                            <label>House ID in Owner:</label>
                            <p id='houseIDByOwner_info'></p>
                        </div> 
                    </div>

                    <div class='row'>
                        <div class="col-sm-2 input-w">
                            <label>Country:</label><p id="country_info"></p>
                        </div>
                        <div class="col-sm-2 input-w">
                            <label>State:</label><p id="state_info"></p>
                        </div>
                        <div class="col-sm-2 input-w">
                            <label>City:</label><p id="city_info"></p>
                        </div>
                        <div class='col-sm-2'>
                            <label>Region:</label>
                            <p id='region_info'></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class='col-sm-6'>
                            <label>House Address:</label>
                            <p id='houseAddress_info'></p>
                        </div>
                        <div class='col-sm-2'>
                            <label>Zip:</label>
                            <p id='houseZip_info'></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class='col-sm-4'>
                            <label>House Type:</label>
                            <p id="houseType_info"></p>
                        </div>
                        <div class='col-sm-4'>
                            <label>Size:</label>
                            <p id="size_info"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class='col-sm-2'>
                            <label>Number Of Rooms:</label>
                            <p id='numOfRooms_info'></p>
                        </div>
                        <div class='col-sm-2'>
                            <label>Number Of Baths:</label>
                            <p id='numOfBaths_info'></p>
                        </div>
                        <div class='col-sm-2'>
                            <label>Number Of Beds:</label>
                            <p id='numOfBeds_info'></p>
                        </div>
                        <div class='col-sm-2'>
                            <label>Max Number of Guests</label>
                            <p id='maxNumOfGuest_info'></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class='col-sm-4'>
                            <label>On Other Website</label>
                            <p id='onOtherWebsite_info'></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href"#"> -->

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
    var rangemarker;
    var itemsToShow = [
        'numberID', 'state', 'city', 'houseAddress',
        'numOfRooms', 'numOfBaths',
        'houseType','costMonthPrice', 'costDayPrice', 'nextAvailableDate',
        'minStayTerm','rentShared',
        // ,'OwnerName', 'ownerUsPhoneNumber', 'ownerWechatUserName','ownerWechatID'
    ];
    var infowindow ;
    var resultSM;


    function initMap(){
        uluru = {lat: 36.778259, lng: -119.417931};
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: uluru
        });
        infowindow = new google.maps.InfoWindow({
        maxWidth:350
    });
        // var cityCircle = new google.maps.Circle({
        //   strokeColor: '#FF0000',
        //   strokeOpacity: 0.8,
        //   strokeWeight: 2,
        //   fillColor: '#FF0000',
        //   fillOpacity: 0.35,
        //   map: map,
        //   center: uluru,
        //   radius: 2000
        // });
    }

    function initAutoComplete(){
        var options = {
        // bounds: new google.maps.LatLngBounds(southwest, northeast),
        componentRestrictions: {country: "us"}//Make the range fixed
        }

        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('houseAddress')),
            options);
        autocomplete.addListener('place_changed',geolocate);
    }

    function initialize(){
        initMap();
        initAutoComplete();
    }


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
          /*
          Display and send Date in different format 
          */
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

        if(document.getElementById('address').value){
            document.getElementById('houseAddress').value =  document.getElementById('address').value;
            $("#houseAddress").focus();
        }
        // $("#housestable").colResizable({liveDrag:true});
        //loadOpt();
        // alert((document.getElementById('houseAddress')).value);
        // alert((document.getElementById('milesrange')).value);
    });

    /*
    TODO:(1)add link to initialize a GET request to server to get house info
         (2)add link to initialize a GET request to server to get houseowner info
    
    */
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


                mapMovecenter(search_geo);



                var tablehtml = "";
                if(data.length>0){

                    $("#showResult").show();
                    resultSM = makeResuiltSM();

                    for(var i=0;i<data.length;++i)
                    {
                        var loc = new google.maps.LatLng(data[i].latitude,data[i].longitude);
                        var address = data[i].houseAddress+','+data[i].city+','+data[i].state;
                        var marker = new google.maps.Marker({
                            position:loc,
                            title: data[i].fullHouseID,
                            map:map
                        });

                        google.maps.event.addListener(marker,'click',infocallbackClosure(marker,data[i].fullHouseID,data[i].numberID,address,setinfohtml));
                        housemarkers.push(marker);
                        if (data[i]['rentShared'] == '1') {
                            data[i]['rentShared'] = 'Whole';
                        } else if (data[i]['rentShared'] == '-1') {
                            data[i]['rentShared'] = 'Share';
                        } else {
                            data[i]['rentShared'] = 'Either';
                        }
                        data[i]['minStayTerm'] = data[i]['minStayTerm'] + ' ' + data[i]['minStayUnit'];

                        var rowhtml = "<tr id='house_" + data[i]['numberID'] + "'>";
                        var numberID = data[i].numberID;
                        for(var j =0 ; j< itemsToShow.length;++j){

                            // if(j==0){
                            //     rowhtml += "<td class='left'>";
                            // }
                            // if(j==itemsToShow.length-1){
                            //     rowhtml += "<td class='right'>";
                            // }

                            if(!data[i][itemsToShow[j]]){
                                rowhtml += "<td>N/A</td>";
                                continue;
                            }


                            if(itemsToShow[j]=='numberID'){
                                rowhtml += "<td><a href='#map_div' onclick = 'makeMarkerBounce("+i+");' >" + 
                                            numberID + "</a></td>";
                            }
                            else if(itemsToShow[j] == 'OwnerName'){
                                rowhtml +=  "<td>"+data[i].first + ' ' + data[i].last + "</td>";
                            }
                            else 
                                rowhtml += "<td>"+data[i][itemsToShow[j]] + "</td>"; 
                            //console.log(rowhtml);
                        }

                        //rowhtml += "<td><a onclick=' retrieveHouseInfo("+numberID+");' > View House Info</td>";
                        rowhtml += "<td><button type='button' class='btm btn-info' onclick='retrieveHouseInfo("+data[i].numberID+");resultSM.toHousePage("+i+")'>"+"View House Info"+"</button></td>";
                        rowhtml += "<td><button type='button' class='btm btn-info' onclick='resultSM.toOwnerPage("+i+")'>View Owner Info</button></td>";
                        attachHouseOwnerDiv(data[i],i);

                        rowhtml += "</tr>";
                        tablehtml += rowhtml;
                    }
                    showMarkers();

                    $('#fillArea').html(tablehtml);
                }
                else
                {
                    $("#showResult").hide();
                    // Notice that there is no result
                }
            }
        });
    });

    function setinfohtml(title,id,addr)
    {
        html = "<div>"+
                "<h4>" + title + "</h4><h5>No:"+ id + " </h5><p>Address:" + addr + "<br>"+
                "<a href='#house_"+id+"   'onclick=''>View Details</a></p></div>";
        infowindow.setContent(html);
    }

    function infocallbackClosure(marker,title,id,addr,callback){
        return function(){
            var caller = event.target;
            callback(title,id,addr);
            infowindow.open(map,marker);
        }   
    }

    function makeMarkerBounce(index){
        var marker = housemarkers[index];
        marker.setAnimation(google.maps.Animation.BOUNCE); 
        setTimeout(function(){ marker.setAnimation(null); }, 2000);  
    }
    function mapMovecenter(search_geo)
    {
        var loc = search_geo['location'];
        var radius = (document.getElementById('milesrange')).value*1000;
        map.setCenter(loc);
        if(!rangemarker){
            rangemarker = new google.maps.Circle({
              strokeColor: '#FF0000',
              strokeWeight: 2,
              map: map,
              center: loc,
              radius: radius
            });
        }
        else{
            rangemarker.setCenter(loc);
            rangemarker.setRadius(radius);
        }
    }

    function setMapOnAll(map){
        if(!map)
        {
            for(var i=0;i<housemarkers.length;++i){
                housemarkers[i].setMap(map);
            }
        }
        else{
            var bounds = new google.maps.LatLngBounds();
            for(var i=0;i<housemarkers.length;++i)
            {
                housemarkers[i].setMap(map);
                bounds.extend(housemarkers[i].getPosition());
            }
            map.fitBounds(bounds);
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

    function geolocate(){
        var place = autocomplete.getPlace();
        //console.log(JSON.stringify(place));
        if(place){
            for(var i = 0 ;i < place.address_components.length;i++){
                var addressType = place.address_components[i].types[0];
                if(componentForm[addressType]){
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
            search_geo = place.geometry;
            document.getElementById('address').value = document.getElementById('houseAddress').value;
        }
        else {
            alert("something wrong");
        }
    }


    function retrieveHouseInfo(id){
        $.ajax({
            type:"GET",
            url:"/house/info/"+id,
            datatype:'json',
            success: function(data){
                //alert(JSON.stringify(data));
                $('#houseid_info').text(data.numberID);
                $('#houseOwnerID_info').text(data.houseOwnerID);
                $('#houseIDByOwner_info').text((data.houseIDByOwner?data.houseIDByOwner:"N/A"));
                $('#country_info').text(data.country);
                $('#state_info').text(data.state);
                $('#city_info').text(data.city);
                $('#region_info').text(data.region);
                $('#houseAddress_info').text(data.houseAddress);
                $('#houseZip_info').text(data.houseZip);
                $('#houseType_info').text(data.houseType);
                $('#size_info').text(data.size);
                $('#numOfRooms_info').text(data.numOfRooms);
                $('#numOfBaths_info').text(data.numOfBaths);
                $('#numOfBeds_info').text(data.numOfBeds);
                $('#maxNumOfGuest_info').text(data.maxNumOfGuest);
                $('#onOtherWebsite_info').text(data.onOtherWebsite);
            }
        });
    }

    function attachHouseOwnerDiv(data,index){
        var houseownerhtml= "<div class='col-sm-6' id=ownerinfo_"+index+" style='width=\"50%\";display:none'>";
        houseownerhtml+= "<table class='table table-bordered table-striped text-center' style='font-size:12px;' >";
        houseownerhtml += "<thead></thead><tbody><col width = '20%'><col width='80%'>"

        var displayedfield = ['Name','ownerCompanyName','ownerUsPhoneNumber','ownerPhone2Number','ownerEmail','ownerWechatUserName'];

        for(var i =0;i<displayedfield.length;++i){
            switch(displayedfield[i]){
                case 'Name':houseownerhtml += "<tr><td>Owner Name</td>"+
                                                "<td>"+data.first+' '+data.last+"</td></tr>";
                                break;
                case 'ownerCompanyName': houseownerhtml += "<tr><td> Company Name </td>"+
                                                           "<td>"+(data[displayedfield[i]]?data[displayedfield[i]]:"Individual")+"</td><tr>";
                                                           break;
                case 'ownerUsPhoneNumber':houseownerhtml += "<tr><td>US Phone Number</td>"+
                                                           "<td>"+data[displayedfield[i]]+"</td><tr>";
                                                           break;
                case 'ownerPhone2Number': houseownerhtml += "<tr><td>Other Phone Number</td>"+
                                                           "<td>"+(data[displayedfield[i]]?data[displayedfield[i]]:"N/A")+"</td><tr>";
                                                           break;
                case 'ownerEmail': houseownerhtml += "<tr><td>Email</td>"+
                                                           "<td>"+(data[displayedfield[i]]?data[displayedfield[i]]:"N/A")+"</td><tr>";
                                                           break; 
                case 'ownerWechatUserName': houseownerhtml += "<tr><td>Wechat Username</td>"+
                                                           "<td title='Wechat ID:"+data.ownerWechatID+"'>"+(data[displayedfield[i]]?data[displayedfield[i]]:"N/A")+"</td><tr>";
                                                           break;
            }
        }
        houseownerhtml+= "</tbody></table></div>";

        $('#ownerdiv').append(houseownerhtml);
    }



    var makeResuiltSM = function(){
        var states = -1 ;  
        var divindex = -1;

        function changestate(stat){
            switch(stat){
                case "Table": states=0; break;
                case "House": states=1; break;
                case "Owner": states=2; break;
            }
        }  
        function getstates(){
            switch(states){
                case 0: return "Table";
                case 1: return "House";
                case 2: return "Owner";
            }
        }

        function setDivindex(val){
            divindex = val;
        }

        function getDivindex(){
            return divindex;
        }
        return {
            toOwnerPage:function(index){
                $('#housestable').fadeOut();
                //$('#ownerdiv').show();
                $('#ownerinfo_'+index).show();
                $("#back_menu").show();
                changestate("Owner");
                setDivindex(index);
            },
            toHousePage: function(index){
                $('#housestable').fadeOut();
                $('#housediv').fadeIn();
                $('#back_menu').show();
                changestate("House");
                setDivindex(index);
            },
            toTablePage:function(){
                $('#housestable').fadeIn();
                if(getstates()=="Owner"){
                    //$('#ownerdiv').hide();
                    $('#ownerinfo_'+getDivindex()).hide();
                    //$("#back_menu").css("visibility", "hidden");
                    setDivindex(-1);
                }
                if(getstates()=="House"){
                    //$("#back_menu").css("visibility", "hidden");
                    $('#housediv').fadeOut();
                    setDivindex(-1);
                }
                changestate("Table");
            }
        }
    }


</script>
</body>
</html>
