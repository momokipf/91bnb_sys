<!DOCTYPE html>
<html>
	<head> 
		<title>Add New House</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<!-- jquery -->
		<script src="../js/jquery.min.js"></script>

		<!-- jquery ui -->
		<script src="../js/jquery-ui.js"></script>
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

		<!-- bootbox ui -->
		<script src="../js/bootbox.min.js"></script>

		<!-- bootstrap -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">

		<script src="../js/bootstrap.min.js"></script>

		<!-- bootstrap phone (local file) -->
		<script src="../js/bootstrap-formhelpers-phone.js"></script>
		<script src="{{asset('js/util.js')}}"></script>
        <link rel="stylesheet" href	="../css/self.css">
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpF-_i-utIH6cZl94zpu4C5vx_FBDDI9s&libraries=places&language=en"></script>
		<style type="text/css">
			body {
				background-color: white;
			}
			#adjustLineSpacing div, #new_house_owner_form div {
				margin-bottom: 5px;
			}
            label { font-weight: normal}
            .gap-top { margin-top: 15px;}
            .panel-padding { padding: 20px;}
            .row { margin-bottom: 8px;}
            input[type="checkbox"] {font-size: 15px;}
						#ErrorMsg {color: RED; margin-top:5px;}
						.pac-container{width:150%}
		</style>
	</head>

	<body>

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
					<a class="navbar-brand" href="../mainPage.php">91bnb Manage System</a>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
				<!-- navbar left -->
					<ul class="nav navbar-nav">
						<li><a href="/MainPage">Home</a></li>
						<li class="active"><a>Add New House</a></li>
					</ul>
				<!-- navbar right -->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-user"></span>{{$Rep->repUserName}}<span class="caret"></span></a>
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

		<div class="container" style="margin-top:70px;">
			<div class="well">
				<h4>Existing house owner?</h4>
				<form id="search_form",style="margin-bottom:0;" onsubmit="return false;">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-2">
	                        <label>First Name</label>
	                        <input type="text" name="first" class="form-control input-sm">
	                    </div>
	                    <div class="col-sm-2">
	                        <label>Last Name</label>
	                        <input type="text" name="last" class="form-control input-sm">
	                    </div>
	                    <div class="col-sm-2">
	                        <label>WeChat ID</label>
	                        <input type="text" name="ownerWechatID" class="form-control input-sm">
	                    </div>
	                    <div class="col-sm-2">
	                        <label>WeChat Username</label>
	                        <input type="text" name="ownerWechatUserName" class="form-control input-sm">
	                    </div>
					</div>

					<div class="row">
	                    <div class="col-sm-2">
					        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#search_result_modal" type="submit" >Search</button>
	                        <button class="btn btn-warning btn-sm" type="reset">Clear</button>
	                    </div>
	                </div>
				</form>

				<div class="modal fade" id="search_result_modal" role="dialog">
					<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">House Owner Search Result</h4>
						</div>
						<div id="display_search_result" class="modal-body">
							<!-- display search result here -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
					</div>
				</div>

				<hr>
		        <h4>New house owner?</h4>
		        <div class="row">
		            <div class="col-sm-2">
		                <button data-toggle="modal" data-target="#new_house_owner_modal" class="btn btn-primary btn-sm" onclick="$('#similarResult').empty(); $('#ownerSubmitBtn').show();" type="button">Add New House Owner</button>
		            </div>
		        </div>
			</div>

			<div class="modal fade" id="new_house_owner_modal" role="dialog">
				<div class="modal-dialog">

					<div class ="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add New House Owner</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" method='post' id='new_house_owner_form'>
								<div class="row">
                                    <div class="col-sm-4 control-label"><span style="color:red">*</span>First Name:
                                    </div>
                                <div class="col-sm-4"><input class="form-control input-sm" type='text' name='first'></div>
                                </div>    

								<div class="row">
									<div class="col-sm-4 control-label"><span style="color:red">*</span>Last Name:</div>
									<div class="col-sm-4"><input class="form-control input-sm" type='text' name='last'></div>
								</div>

								<div class="row">
				                    <div class="col-sm-4 control-label">Company Name:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='ownerCompanyName'></div>
				                </div>

				                <div class="row">
				                    <div class="col-sm-4 control-label">U.S. Phone Number:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm bfh-phone" type='text' data-format="(ddd) ddd-dddd" name='ownerUsPhoneNumber'></div>
				                </div>

				                <div class="row">
                    				<div class="col-sm-4 control-label">Other Phone Country:</div>
                    				<div class="col-sm-4">
                      					<select class="form-control input-sm PhoneCountry" type='text' name='ownerPhone2Country' >
                      					</select>
                      				</div>
                      			</div>
                      			<div class="row">
				                    <div class="col-sm-4 control-label">Phone 2 Number:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='ownerPhone2Number'></div>
				                </div>
				                <div class="row">
				                    <div class="col-sm-4 control-label">Email:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='ownerEmail'></div>
				                </div>
				                <div class="row">
				                    <div class="col-sm-4 control-label">WeChat Username:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='ownerWechatUserName'></div>
				                </div>
				                <div class="row">
				                    <div class="col-sm-4 control-label">WeChat ID:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='ownerWechatID'></div>
				                </div>
				                <div class="row">
				                    <div class="col-sm-4 control-label">Other ID:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='ownerOtherID'></div>
				                </div>
				                <div class="row">
				                    <div class="col-sm-4 control-label">Bank Account Name:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='bankAccountName'></div>
				                </div>
				                <div class="row">
				                    <div class="col-sm-4 control-label">Bank Name:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='bankName'></div>
				                </div>
				                <div class="row">
				                    <div class="col-sm-4 control-label">Bank Account Routing Number:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='bankRountingNumber'></div>
				                </div>
				                <div class="row">
				                    <div class="col-sm-4 control-label">Bank Account Number:</div>
				                    <div class="col-sm-4"><input class="form-control input-sm" type='text' name='bankAccountNumber'></div>
				                </div>
				            </form>
				            <div id="similarResult"></div>
				        </div>
				        <div class="modal-footer">
				        	<button class="btn btn-primary" onclick="findSimilarOwners();" type="button" id="ownerSubmitBtn">Submit</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				<ul class="nav nav-tabs">
			        <li class="active"><a data-toggle="tab" href="#home">House</a></li>
			        <li><a data-toggle="tab" href="#menu1">Condition</a></li>
			        <li><a data-toggle="tab" href="#menu2">Availability</a></li>
			        <li><a data-toggle="tab" href="#menu3">Price</a></li>
			        <li><a data-toggle="tab" href="#menu4">Room (Optional)</a></li>
				</ul>

				<form action = "newHouseSaver.php" method = "post" id="adjustLineSpacing" onsubmit="return Check(this);">
					<div class="tab-content">
						<div id="home" class="tab-pane fade in active">
			            <br>
							<div class="row">
								<div class="col-sm-2">
									<label>House Owner ID (Select)<span style='color:red'>*</span></label>
									<input readonly class="form-control input-sm" type="text" name="houseOwnerID" required="required" id="houseOwnerID">
								</div>
								<div class="col-sm-2">
						            <label>Date House Added</label>
						            <input type="search" name="dateHouseAdded" class="form-control input-sm" disabled value=<?php echo date("m/d/Y");?> >
						        </div>
						        <div class="col-sm-2">
				                    <label>House ID by Owner</label>
				                    <input type="text" name="houseIDByOwner" class="form-control input-sm">
				                </div>
				                <div class="col-sm-2">
				                    <label>Representative ID</label>
				                    <!-- get rep names here -->
				                </div>
				            </div>

							<div class="row">
								<div class="col-sm-2">
								<label>Country<span style='color:red'>*</span></label>
								<select type="text" name="country" id="hotcountry" class="form-control input-sm Country">
								</select>
								</div>

								<div class="col-sm-2">
									<label>State or Province<span style='color:red'>*</span></label>
									<select id="state" name="state" class="form-control input-sm">
										<option selected>Please Select State</option>
									</select>
								</div>

								<div class="col-sm-2">
									<label>City<span style='color:red'>*</span></label>
										<select name="city" id="city" class="form-control input-sm">
										<option selected>Please Select City</option>
										</select>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-2">
								<label>Region</label>
								<input type="text" name="region" class="form-control input-sm" maxlength="10">
								</div>

								<div class="col-sm-4">
										<label>House Address</label>
										<input type="text" name="houseAddress" id = "houseAddress" onFocus="initialize()" class="form-control input-sm">
								</div>

								<div class="col-sm-2">
									<label>Zip</label>
									<input type="text" name="houseZip" id = "houseZip" class="form-control input-sm" maxlength="5">
								</div>
							</div>

							<div class="row">
								 <div class="col-sm-2">
                    				<label>House Type</label>
                    				<select name = "houseType" id="houseType" class="form-control input-sm">
									</select>
                				</div>

                				<div class="col-sm-2" style="display:none;" id="houseTypeOtherDiv">
				                    <label>House Type Other</label>
				                    <input type="text" name="houseTypeOther" id="houseTypeOther" class="form-control input-sm">
				                </div>

								<div class="col-sm-2">
									<label>Size</label>
									<div class="input-group">
										<input type="number" name="size" class="form-control input-sm">
										<span class="input-group-addon">Sq.ft.</span>
									</div>
								</div>
							</div>

							<div class="row">
				                <div class="col-sm-2">
				                    <label>Num of Rooms</label>
				                    <input type="number" name="numOfRooms" class="form-control input-sm">
				                </div>

				                <div class="col-sm-2">
				                    <label>Num of Baths</label>
				                    <input type="number" name="numOfBaths" class="form-control input-sm">
				                </div>

				                <div class="col-sm-2">
				                    <label>Num of Beds</label>
				                    <input type="number" name="numOfBeds" class="form-control input-sm">
				                </div>

				                <div class="col-sm-2">
				                    <label>Max Num of Guests</label>
				                    <input type="number" name="maxNumOfGuests" class="form-control input-sm">
				                </div>

							</div>

							<div class="row">
				                <div class="col-sm-8">
				                    <label>On Other Website</label>
				                    <input type="text" name="onOtherWebsite" class="form-control input-sm" >
				                </div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<a class="btn btn-primary btnPrevious" style="width:100px">Previous</a>
								</div>
								<div class="col-lg-6">
									<a class="btn btn-primary pull-right btnNext" style="width:100px">&nbsp;&nbsp;Next&nbsp;&nbsp;</a>
								</div>

							</div>

						</div>
						<!-- end of table HOUSE -->

						<div id="menu1" class="tab-pane fade" style="padding:20px; font-size:12px;" >
							<h5>Guests Info</h5>
							<div class="row">
				                <div class="col-sm-2">
				                    <input type="checkbox" value="1" name="allowPregnant"> Allow Pregnant
				                </div>
				                <div class="col-sm-2">
				                    <input type="checkbox" value="1" name="allowBaby"> Allow Baby
				                </div>
				                <div class="col-sm-2">
				                    <input type="checkbox" value="1" name="allowKid" id="allowKid"> Allow Kid
				                </div>
				                <div class="col-sm-2">
				                    <input type="checkbox" value="1" name="allowPets" id="allowPets"> Allow Pet
				                </div>
				                <div class="col-sm-2">
				                    <input type="checkbox" value="1" name="havePet" id="havePet"> Have Pet
				                </div>
				            </div>

				            <div class="row">
				                <div class="col-sm-2"></div>
				                <div class="col-sm-2"></div>
				                <div class="col-sm-2">
				                    <input id="allowKidAge" type="text" name="allowKidAge" class="form-control input-sm" disabled placeholder="Allow Kids Age">
				                </div>
				                <div class="col-sm-2">
				                    <input id="allowPetType" type="text" name="allowPetType" class="form-control input-sm" disabled placeholder="Allow Pet Type">
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
				                    <textarea name="additionalNote" ROWS=10 COLS=100 class="form-control input-sm"></textarea>
				                </div>
				            </div>

							<div class="row">
								<div class="col-lg-6">
									<a class="btn btn-primary btnPrevious" style="width:100px">Previous</a>
								</div>
								<div class="col-lg-6">
									<a class="btn btn-primary pull-right btnNext" style="width:100px">&nbsp;&nbsp;Next&nbsp;&nbsp;</a>
								</div>

							</div>
						</div>

						 <!--end of table HOUSINGCONDITION -->
						 <!-- beginning of table HOUSEAVAILABILITY -->

						 <div id="menu2" class="tab-pane fade panel-padding">
				            <div class="row">
				                <div class="col-sm-2">
				                    <label>Whole/Share</label>
				                    <select name="rentShared" class="form-control input-sm">
				                        <option value = 0 >Either</option>
				                        <option value = 1 >Whole</option>
				                        <option value = -1 >Share</option>
				                    </select>
				                </div>
				            </div>

				            <div class="row">
								<div class="col-sm-2">
									<label>Availability</label>
									<select name="availability" id="availability" class="form-control input-sm">
									<!--  <option value = 0 >N/A</option>
									<option value = 1 >Yes</option>
									<option value = -1 >No</option> -->
									<option value = 1 >Yes</option>
									<option value = 0 >Yes, but not now</option>
									<option value = -1 selected>No</option>
									</select>
								</div>

								<div class="col-sm-2" id="nextAvailableDateDiv" style="display:none;">
									<label>Next Available Date</label>
									<!--<input type="date" name="nextAvailableDate" id="nextAvailableDate" class="form-control input-sm">-->
									<input type="search" name="nextAvailableDate" id="nextAvailableDate" class="form-control input-sm" placeholder="mm/dd/yyyy">
								</div>
							</div>

							<div class="row">
								<div class="col-sm-2">
									<label>Minimum Stay Unit</label>
									<select name="minStayUnit" class="form-control input-sm">
										<option value = "Day" >Day</option>
										<option value = "Week" >Week</option>
										<option value = "Month" >Month</option>
										<option value = "Year" >Year</option>
									</select>
								</div>

								<div class="col-sm-2">
									<label>Minimum Stay Term</label>
									<input type="number" name="minStayTerm" class="form-control input-sm">
								</div>
							</div>

							<div class="row">
								<div class="col-sm-2">
									<label>Allow Cooking</label>
									<select name="allowCooking" class="form-control input-sm">
									<option value = 0 >N/A</option>
									<option value = 2 >Occasional</option>
									<option value = 1 >Yes</option>
									<option value = -1 >No</option>
									</select>
								</div>

								<div class="col-sm-2">
									<label>Furnished</label>
									<select name="furnished" class="form-control input-sm">
										<option value = 0 >N/A</option>
										<option value = 2 >Simple</option>
										<option value = 1 >Yes</option>
										<option value = -1 >No</option>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4">
									<label>Availability Note</label>
									<textarea class="form-control" rows="4" cols="50" name="availabilityNote"></textarea>
								</div>               
							</div>

							<div class="row">
								<div class="col-lg-6">
									<a class="btn btn-primary btnPrevious" style="width:100px">Previous</a>
								</div>
								<div class="col-lg-6">
									<a class="btn btn-primary pull-right btnNext" style="width:100px">&nbsp;&nbsp;Next&nbsp;&nbsp;</a>
								</div>
							</div>

						</div>
					<!--end of table HOUSEAVAILABILITY -->

					<div id="menu3" class="tab-pane fade panel-padding">
						<!-- beginning of table HOUSEPRICE -->
						<div class="row">
							<div class="col-sm-2">
								<label>Cost Day Price</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="costDayPrice" class="form-control input-sm">
								</div>
							</div>

							<div class="col-sm-2">
								<label>Cost Week Price</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="costWeekPrice" class="form-control input-sm">
								</div>
							</div>

							<div class="col-sm-2">
								<label>Cost Month Price</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="costMonthPrice" class="form-control input-sm">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-2">
								<label>Cost Utility</label>
								<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="costUtility" class="form-control input-sm">
								</div>
							</div>
						</div>

						<div class="row">
			                <div class="col-sm-4">
			                    <label>Utility Note</label>
			                    <textarea class="form-control" rows="4" cols="50" name="utilityNote" placeholder="What's included? Ex: Wi-Fi, Electricity, Water, Gas..."></textarea>
			                </div>
			            </div>

			            <div class="row">
			            	<div class="col-sm-2">
								<label>Cost Cleaning</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="costCleaning" class="form-control input-sm">
								</div>
							</div>

							<div class="col-sm-2">
								<label>Cost Security Deposit</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="costSecurityDeposit" class="form-control input-sm">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-4">
								<label>Cost Note</label>
								<textarea class="form-control" rows="4" cols="50" name="costNote"></textarea>
							</div>               
						</div>

						<div class="row">
							<div class="col-sm=2">
								<label>Retail Day Price</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="retailDayPrice" class="form-control input-sm">
								</div>
							</div>

							<div class="col-sm-2">
								<label>Retail Week Price</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="retailWeekPrice" class="form-control input-sm">
								</div>
							</div>

							<div class="col-sm-2">
								<label>Retail Month Price</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="retailMonthPrice" class="form-control input-sm">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-2">
								<label>Retail Utility</label>
								<div class="input-group">
									<!--    <span class="input-group-addon">$</span>
									<input type="number" name="retailUtility" class="form-control input-sm"> -->                     
									<input type="text" name="retailUtility" class="form-control input-sm">
								</div>
							</div>

							<div class="col-sm-2">
								<label>Retail Cleaning</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="retailCleaning" class="form-control input-sm">
								</div>
							</div>

							<div class="col-sm-2">
								<label>Retail Security Deposit</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" name="retailSecurityDeposit" class="form-control input-sm">
								</div>
							</div>
						</div>

						<div class="row">
                			<div class="col-sm-2">
                    			<label>Upsell Percent</label>
                    				<div class="input-group">
                          				<input type="number" name="upsellPercent" class="form-control input-sm">
                          				<span class="input-group-addon">%</span>
                    				</div>
                			</div>

							<div class="col-sm-2">
								<label>TOT Percent</label>
								<div class="input-group">
									<input type="number" name="totpercent" class="form-control input-sm">
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<a class="btn btn-primary btnPrevious" style="width:100px">Previous</a>
							</div>
							<div class="col-lg-6">
								<a class="btn btn-primary pull-right btnNext" style="width:100px">&nbsp;&nbsp;Next&nbsp;&nbsp;</a>
							</div>

						</div>
					</div>

					<div id="menu4" class="tab-pane fade">
					<!-- beginning of table HOUSEROOM -->
						<br>

					</div>
				</form>
				<p id = 'ErrorMsg'></p>
			</div>
		</div>
	</body>

	<script>
		$(document).ready(function(){
			$("#search_form").submit(function(){
				var toSend = $(this).serialize();
				$.ajax({
					type:"post",
					dataType: "json",
					url:'/houseowner/search',
					data: toSend,
					success: function(data){
						
						var htmlcont = "";
						if(data.length==0){
							htmlcont = "<span style='color:red;'>No records found.</span>";
						}
						else{
							htmlcont += "<div style='overflow:auto'>"+
										"<table class='table table-striped table-bordered'>"+
										"<tr>"+
										"<th></th>"+
										"<th style='min-width:100px;'>First Name</th>"+
										"<th style='min-width:100px;'>Last Name</th>"+
										"<th style='min-width:100px;'>WeChat ID</th>"+
										"<th style='min-width:160px;'>WeChat Username</th>"+
										"<th style='min-width:50px;'>ID</td>"+
										"</tr>"
						for(i = 0 ;i<data.length;++i)
						{
							htmlcont += "<tr><td data-dismiss='modal' style='cursor:pointer; text-decoration:underline; color:blue;' onclick ='$(\'#inquirerID\').val("+data[i].houseOwnerID+");'>Select</td>"+
										    "<td>"+data[i].first+"</td>"+
										    "<td>"+data[i].last +"</td>"+
										    "<td>"+data[i].ownerWechatID+"</td>"+
										    "<td>"+data[i].ownerWechatUserName+"</td>"+
										    "<td>"+data[i].houseOwnerID+"</td></tr>";
						}
						htmlcont += "</table></div>";
						}
						$("#display_search_result").html(htmlcont);
					}

				});
			});
			$.get("/resource/countryCode",function(data,status){
				$('.PhoneCountry').empty();
				for(i=0;i<data.length;++i){
					var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					$('.PhoneCountry').append(option);
				}
			});

			$.get("/resource/hotcountry",function(data,status){
				$('#hotcountry').empty();
				for(i=0;i<data.length;++i){
					// var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					var option = data[i];
					$('#hotcountry').append(option);
				}
			});

			loadOpt();
		});

		
		$('#hotcountry').change(function(){
			var country = $(this).val().trim();
			if(country == "Other"){
				// choose contry from other list
			}
			else{
				$.get("/resource/"+country , function(data,status){
					$('#state').empty();
					for(i=0;i<data.length;++i){
						var option = $("<option></option>").attr("value", data[i]).text(data[i]);
						$('#state').append(option);
					}
				});
			}
		});

		$('#state').change(function(){
			var country = $('#hotcountry').val().trim();
			var state = $(this).val().replace(/\s/g, '').trim();
			if(state == "Other"){
			}
			else{
				$.get("/resource/"+country+'/'+state,function(data,status){
					$('#city').empty();
					for(i=0;i<data.length;++i){
						var option = data[i];
						$('#city').append(option);
					}
				});
			}
		});

	</script>




</html>