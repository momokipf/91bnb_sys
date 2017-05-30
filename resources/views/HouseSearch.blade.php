
<!DOCTYPE html>
<html>
	<head>
	<title>House Search</title>

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
			  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpF-_i-utIH6cZl94zpu4C5vx_FBDDI9s&libraries=places&language=en"></script>

		<style>
			html {width:100%; height:100%;}
			body { line-height: 100%; line-height: 100%; width:100%; height:100%;}
            .marginMe { padding-left: 8%; padding-right: 8%; }
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
				margin-top:20px;width:100%;height:60%;display:none;
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


<div class="" style="margin-top:70px;width:100%;height:100%">

     <!-- form here !!!-->
    <form id="myForm">
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
						<div class="col-sm-3">
							<label>Inquerier ID</label>
                            @if(isset($inquirerID))
                            <input class="form-control input-sm" type="text" id="inquirerID" name="inquirerID" value="{{$inquirerID}}" readonly>
                            @else
                            <input class="form-control input-sm" type="text" id="inquirerID" name="inquirerID" readonly>
                            @endif
								
						</div>

						<div class="col-sm-3">
							<label>Representatives</label>
                            @if(isset($searchrepID))
                            <input class="form-control input-sm" type="text" id="repWithOwner" name="repWithOwner" value="{{$repID}}" readonly>
                            @else
                            <input class="form-control input-sm" type="text" id="repWithOwner" name="repWithOwner" readonly>
							@endif
						</div>
				</div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>Country*</label>
                        <select class="form-control input-sm" name = "country"  id="country" >
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label>State/Province*</label>
                        <select class="form-control input-sm" id="state" name="state"> 
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label>City*</label>
                        <select class="form-control input-sm" id="city" name="city">
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-3">
                        <label>House ID</label>
                        @if(isset($fullHouseID))
                        <input class="form-control input-sm" type="text" id="houseID" name="houseID" placeholder="Format: 91bnb_State_City_0000" value="{{$fullHouseID}}">
                        @else
                        <input class="form-control input-sm" type="text" id="houseID" name="houseID" placeholder="Format: 91bnb_State_City_0000">
                        @endif
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-4">
                        <label>House Address</label>
                        <input class="form-control input-sm"  type="text" id="houseAddress" name="houseAddress" onFocus="initialize()" placeholder="Input House Address" >
                    </div>
                </div>

                 <div class="row">
                    <div class="col-sm-6">
                        <label>Cross Road Between</label>
                        <div class="input-group">
                            <input class="form-control input-sm" type="text" id="crossroadA" name="crossroadA" placeholder="Road A">
                            <span class="input-group-addon">and</span>
                            <input class="form-control input-sm" type="text" id="crossroadB" name="crossroadB" placeholder="Road B">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>Apply Range</label>
                        <select class="form-control input-sm" id="milesrange" name="milesrange">
														<OPTION value=1>&nbsp;&nbsp;1 Mile</OPTION>
                            <OPTION value=2>&nbsp;&nbsp;2 Miles</OPTION>
                            <OPTION value=5 selected>&nbsp;&nbsp;5 Miles</OPTION>
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

             </div> <!-- / house condition -->


            <!-- share -1, whole 1, either 0 -->
            <div class="tab-pane fade" id="aboutShare">
                <div class="row">
                    <div class="col-sm-12">
                        @if(empty($Query) || (isset($Query->share)&&$Query->share==1))
                            <input type="radio" id="rentWhole" name="rentShareWhole" value="1" checked> Rent Whole
                        @else
                            <input type="radio" id="rentWhole" name="rentShareWhole" value="1"> Rent Whole
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @if(!empty($Query) && (isset($Query->share)&&$Query->share==-1))
                            <input type="radio" id="rentShare" name="rentShareWhole" value="-1" checked> Rent Share
                        @else
                            <input type="radio" id="rentShare" name="rentShareWhole" value="-1"> Rent Share
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @if(!empty($Query)&& (isset($Query->share)&&$Query->share==0))
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
                        @if(!empty($Query)&&isset($Query->checkIn))
                        <input class="form-control input-sm" type="search" id="checkin" name="checkin" value="{{$Query->checkIn}}">
                        @else
                        <input class="form-control input-sm" type="search" id="checkin" name="checkin">
                        @endif
                    </div>

                    <div class="col-sm-2">
                        <label>Check-Out Date</label>
                        @if(!empty($Query)&&isset($Query->checkOut))
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
                            @if(!empty($Query)&&isset($Query->rooms))
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
                        @if(!empty($Query)&&isset($Query->numOfAdult))
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
                            @if(!empty($Query)&&isset($Query->pregnancy)&&$Query->pregnancy==1){
                                checked
                            @endif
                            >Allow Pregnant
                    </div>
                    <div class="col-sm-2">
                        <input type="checkbox" value="1" name="allowBaby"
                            @if(!empty($Query)&&isset($Query->hasBaby)&&$Query->hasBaby==1)
                                checked
                            @endif
                            >Allow Baby
                    </div>
                    <div class="col-sm-2">
                        <input type="checkbox" value="1" name="allowKid" id="allowKid"
                            @if(!empty($Query)&&isset($Query->numOfChildren)&&$Query->numOfChildren>0)
                                checked
                            @endif
                            >Allow Kid
                    </div>
                    <div class="col-sm-2">
                        <input type="checkbox" value="1" name="allowPets" id="allowPets"
                            @if(!empty($Query)&&isset($Query->pet)&& $Query->pet==1)
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
                            @if(!isset($Query)&&($Query->childAge<=3||$Query->numOfChildren<=0))
                                disabled
                            @else 
                                value= {{$Query->numOfChildren}}
                            @endif
                            placeholder="Allow Kids Age">
                    </div>
                    <div class="col-sm-2">
                        <input id="allowPetType" type="text" name="allowPetType" class="form-control input-sm" 
                            @if(!empty($Query)&&$Query->pet!=1)
                                disabled
                            @endif
                            placeholder="Allow Pet Type" 
                            @if(!empty($Query)&&isset($Query->petType))
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






<script>
//fix 0201 suppose all is formatted
function convertPhoneFormat(phone) {
    return phone;
}


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

$("#refreshPage").click(function(){
	location.reload();
});
var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();
var previousmarker=false;
$("#myBtn").click(function() {

    $.post("Henrysearch.php",
       $("#myForm").serialize(),
      //  var app =  $("#myForm").serialize(),
        //alert(response+"");
       function(response) {

           console.log(response+"");
            var data = JSON.parse(response);
            if (data.length == 0) {
								$("#map_canvas").hide();
                $("#showResult").hide();
                $("#noResult").show();
								$("#showForm").hide();
            } else {
                $("#noResult").hide();
                $("#showResult").show();
								$("#map_canvas").show();
                //console.log(data);
                var itemsToShow = ['numberID','fullHouseID', 'state', 'city', 'houseAddress','numOfRooms', 'numOfBaths','latitude','longitude',
                            'houseType','houseOwnerID', 'costMonthPrice', 'costDayPrice', 'nextAvailableDate',
                            'minStayTerm','rentShared', 'first', 'last', 'ownerUsPhoneNumber', 'ownerWechatUserName','ownerWechatID'];
                var myStr = "";
								geocoder = new google.maps.Geocoder();
								map = new google.maps.Map(
									document.getElementById("map_canvas"), {
										center: new google.maps.LatLng(37.4419, -122.1419),
										zoom: 13,
										mapTypeId: google.maps.MapTypeId.ROADMAP
									});
                for (var i = 0; i < data.length; i++) {
										var location = new Array(data[i]['fullHouseID'], data[i]['houseAddress']+", "+data[i]['city']+", "+data[i]['state'],data[i]['latitude'],data[i]['longitude'],data[i]['numberID']);
										geocodeAddress(location);
										// convert number to 'whole, share, either'
                    if (data[i]['rentShared'] == '1') {
                        data[i]['rentShared'] = 'Whole';
                    } else if (data[i]['rentShared'] == '-1') {
                        data[i]['rentShared'] = 'Share';
                    } else {
                        data[i]['rentShared'] = 'Either';
                    }

										//Specific for housetype
										// if(data[i]['housetype']==""||data[i]['housetype']==null){
										// 	data[i]['housetype']=="N/A";
										// }
                    // convert pure number to US format phone number
                    data[i]['ownerUsPhoneNumber'] = convertPhoneFormat(data[i]['ownerUsPhoneNumber']);
                    // add '$' before Prices
                    data[i]['costMonthPrice'] = '$ ' + data[i]['costMonthPrice'];
                    data[i]['costDayPrice']   = '$ ' + data[i]['costDayPrice'];
                    // min stay term
                    data[i]['minStayTerm'] = data[i]['minStayTerm'] + ' ' + data[i]['minStayUnit'];

                    // output items in each row
                    myStr += "<tr id='my" + i + "' class='hello'>";
                    //fix 0207
                    for (var j = 0; j < itemsToShow.length; j++) {
												if(itemsToShow[j] == 'latitude' || itemsToShow[j] == 'longitude')	continue;
                        if (itemsToShow[j] == 'numberID') {
                            myStr += "<td><a href='###' onclick='selecthouse(" + data[i]['numberID'] + ")' id='" + data[i]['numberID'] + "'  class='showdetails' >" +
                                data[i][itemsToShow[j]] + "</a></td>";
                        } else if(data[i][itemsToShow[j]].trim()==""||data[i][itemsToShow[j]]==null||data[i][itemsToShow[j]]=="00/00/0000"||data[i][itemsToShow[j]]=="01/01/3000"){
														myStr += "<td>" + "N/A" + "</td>";
												}
													else if(itemsToShow[j] == 'minStayTerm'&& data[i][itemsToShow[j]].charAt(0)=="0"){
                            myStr += "<td>" + "N/A" + "</td>";
                        }	else if(itemsToShow[j] == 'costDayPrice'&& data[i][itemsToShow[j]].charAt(2)=="0"){
														myStr += "<td>" + "No price" + "</td>";
												}
												else if(itemsToShow[j] == 'costMonthPrice'&& data[i][itemsToShow[j]].charAt(2)=="0"){
														myStr += "<td>" + "No price" + "</td>";
												}
												else{
														myStr += "<td>" + data[i][itemsToShow[j]] + "</td>";
												}
                    }
                    myStr += "</tr>";
                }
                $("#fillArea").html(myStr);
							}

        } // function response
    );
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
function geocodeAddress(locations) {
	  var title = locations[0];
		var address = locations[1];
	  var lat = locations[2];
		var lng = locations[3];
		var id = locations[4];
	  //var url = locations[4];
		var position = new google.maps.LatLng(locations[2],locations[3]);
		var marker = new google.maps.Marker({
				icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
				map: map,
				position: position,
			  title: title,
				animation: google.maps.Animation.DROP,
				address: address
				});
				infoWindow(marker, map, title, address, id);
				bounds.extend(marker.getPosition());
				map.fitBounds(bounds);
				google.maps.event.addListener(marker, 'mouseover', function(event) {
		          this.setIcon('http://maps.google.com/mapfiles/ms/icons/red.png');
		      });
				google.maps.event.addListener(marker, 'mouseout', function(event) {
           this.setIcon('http://maps.google.com/mapfiles/ms/icons/blue.png');
       });

	}

function infoWindow(marker, map, title, address, id) {
	  google.maps.event.addListener(marker, 'click', function() {
			if(previousmarker != false){
				previousmarker.close();
			}
	    var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a onclick='selecthouse("+id+")'>View Details</a></p></div>";
	    iw = new google.maps.InfoWindow({
	      content: html,
	      maxWidth: 350
	    });
	    iw.open(map, marker);
			previousmarker = iw;
	  });
}

function initialize(){
	var input = document.getElementById('houseAddress');
	var geoinfo = "https://maps.googleapis.com/maps/api/geocode/json?address="+$("#city").val()+$("#state").val()+$("#country").val()+"&language=en";
	console.log(geoinfo);
	var southwest = null, northeast = null;
	jQuery.ajax({
		type:"POST",
		url: geoinfo,
		dataType: "json",
		async : false,
		success: function(data){
							var geo = eval(data);
						if(geo["results"] != ""){
								if(geo["results"][0]["geometry"]["bounds"] == null){
									southwest =geo["results"][0]["geometry"]["viewport"]["southwest"];
									northeast =geo["results"][0]["geometry"]["viewport"]["northeast"];
								}
								else{
									southwest = geo["results"][0]["geometry"]["bounds"]["southwest"];
									northeast = geo["results"][0]["geometry"]["bounds"]["northeast"];
								}
						}
		}
	});
	var options = {
		bounds: new google.maps.LatLngBounds(southwest, northeast),
		componentRestrictions: {country: "us"}//Make the range fixed
	}
	var autocomplete = new google.maps.places.Autocomplete(input,options);
	google.maps.event.addListener(autocomplete, 'place_changed', function(){
		var mylocation = autocomplete.getPlace();
		var zip = mylocation.formatted_address.split(",")[2].split(" ")[2];//use split to get the zip code
		var city = mylocation.formatted_address.split(",")[1].trim();
		var state = getState(mylocation.formatted_address.split(",")[2].split(" ")[1]).trim().replace(" ","_");
		input.value = mylocation.name;
		$("#houseZip").val(zip);
		if(state.indexOf("select") < 0 && city != $("#city").val()){
			bootbox.dialog({
					message: 'The city is different from previous choice. Do you want to change it?',
					title: 'Modify Confirmation',
					buttons: {
					success: {
						label: 'Yes',
						className: 'btn-success',
						callback: function() {
							var i=0;
							for(;i<document.getElementById("city").options.length;i++)
							{
								if(document.getElementById("city").options[i].value == city)
								{
									document.getElementById("city").options[i].selected=true;
									$("#city").change();
									break;
								}
							}
							if(i == document.getElementById("city").options.length){
									alert("Sorry, You should choose City or State first");
							}
						}
					},
					danger: {
						label: 'No',
						className: 'btn-danger',
						callback: function() {}
					}
					}
			});
		}
		if(state != $("#state").val()){
			bootbox.dialog({
					message: 'The state is different from previous choice. Do you want to change it?',
					title: 'Modify Confirmation',
					buttons: {
					success: {
						label: 'Yes',
						className: 'btn-success',
						callback: function() {
							var i=0;
							for(;i<document.getElementById("state").options.length;i++)
							{
								if(document.getElementById("state").options[i].value == state)
								{
									document.getElementById("state").options[i].selected=true;
									$("#state").change();
									break;
								}
							}
							if(i == document.getElementById("state").options.length){
									alert("Sorry, we don't have this state in our database right now.");
							}
						}
					},
					danger: {
						label: 'No',
						className: 'btn-danger',
						callback: function() {
						}
					}
					}
			});
		}
	});
}

function selecthouse(numberID) {
	$.ajax({
		type: "POST",
		dataType: "html",//data type expected from server
		url: "housedetailinshowhouse.php",
		data: 'numberID='+numberID,
		success: function(data) {
			$("#showForm").html(data);
				// -----------------------------------------------
											$("#btnDiscard").click(function() {
													$("#houseID_search_form").submit();
											});


											$("#allowKid").change(function(){
													if ($("#allowKid").is(":checked")) {
															$("#allowKidAge").removeAttr('disabled');
													} else {
															$("#allowKidAge").attr('disabled', 'true');
																// $("#allowKidAge").removeAttr('value');
															$("#allowKidAge").val('');

													}
											});

											$("#allowPets").change(function(){
													if ($("#allowPets").is(":checked")) {
															$("#allowPetType").removeAttr("disabled");
													} else {
															$("#allowPetType").attr("disabled", "true");
															$("#allowPetType").val('');
													}
											});

											$("#havePet").change(function(){
													if ($("#havePet").is(":checked")) {
															$("#havePetType").removeAttr("disabled");
													} else {
															$("#havePetType").attr("disabled", "true");
															$("#havePetType").val('');
													}
											});
		}

	});
}
</script>
</body>
</html>
