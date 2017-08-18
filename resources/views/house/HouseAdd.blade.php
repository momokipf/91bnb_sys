@extends('navbar')
@section('title', 'Add New House')

@section('head')
	<link rel="stylesheet" href="{{asset('css/animate.css')}}">


	<script src="{{asset('js/bootbox.min.js')}}"></script>
	<script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>


	<style type="text/css">
		body {
			background-color: white;
		}
		.badge {
			font-size: 25px; 
			background-color: #5CB85C;
		}
		.title-sm {
			color: #337AB7;
			font-size: 18px;
			font-weight: bold;
		}
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

		#loadele{
			display:    none;
		    position:   fixed;
		    z-index:    1000;
		    top:        0;
		    left:       0;
		    height:     100%;
		    width:      100%;
		    background: rgba( 255, 255, 255, .8 ) 
            url('http://sampsonresume.com/labs/pIkfp.gif') 
            50% 50% 
            no-repeat;
		}

		#loadele.loading{
			overflow:hidden;
			display:block;
		}


		#loadele.loading .modal{
			display:block;
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
@endsection

@section('content')
	<div class="container">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<span class="badge" style="background-color:#5CB85C;">1</span>
					<a role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<span class="title-sm" style='padding-left:5px;'> Select or Create House Owner</span>
					</a>
				</div>
<!-- 					</div>
			</div>

			<hr>
	        <h4>New house owner?</h4>
	        <div class="row">
	            <div class="col-sm-2">
	                <button data-toggle="modal" data-target="#new_house_owner_modal" class="btn btn-primary btn-sm" onclick="$('#similarResult').empty(); $('#ownerSubmitBtn').show();$('#ownerStillSubmitBtn').hide()" type="button">Add New House Owner</button>
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
						<form class="form-horizontal" method='post' id='new_house_owner_form'> -->


				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				<!-- <div class="row"> -->
					<div class="panel-body">
						<h4>Existing house owner?</h4>
						<form id="search_form",style="margin-bottom:0;" onsubmit="return false;">
							{{ csrf_field()}}
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
				                <button data-toggle="modal" data-target="#new_house_owner_modal" class="btn btn-primary btn-sm" onclick="$('#similarResult').empty(); $('#ownerSubmitBtn').show();$('#ownerStillSubmitBtn').hide()" type="button">Add New House Owner</button>
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
											{{ csrf_field()}}
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
							        	<button class="btn btn-primary" onclick="findSimilarOwners()" type="button" id="ownerSubmitBtn">Submit</button>
							        	<button class="btn btn-primary" type="button" id="ownerStillSubmitBtn" onclick='$("#new_house_owner_form").submit();return false;' style="display:none">Still submit</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<span class="badge" style="background-color:#5CB85C;">2</span>
					<a id='link2' class="collapsed inactiveLink" role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<span class="title-sm" style='padding-left:5px;'>Add New House</span>
					</a>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					<div class="panel-body">
						<div>
							<p id = 'ErrorMsg'></p>
						</div>
						<form  id="houseinfoform" >
							{{ csrf_field()}}
							<ul class="nav nav-tabs">
						        <li class="active"><a data-toggle="tab" href="#home">House</a></li>
						        <li><a data-toggle="tab" href="#menu1">Condition</a></li>
						        <li><a data-toggle="tab" href="#menu2">Availability</a></li>
						        <li><a data-toggle="tab" href="#menu3">Price</a></li>
						        <li><a data-toggle="tab" href="#menu4">Room (Optional)</a></li>
							</ul>

							<div class="tab-content">
								<div id="home" class="tab-pane fade in active">
					            	<br>
									<div class="row">
										<div class="col-sm-3">
											<label>House Owner ID (Select)<span style='color:red'>*</span></label>
											<input readonly class="form-control input-sm" type="text" name="houseOwnerID" required="required" id="houseOwnerID">
										</div>
										<div class="col-sm-2">
								            <label>Date House Added</label>
								            <input type="search" name="dateHouseAdded" id="dateHouseAdded" class="form-control input-sm" value=<?php echo date("m/d/Y");?> >
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
						            	<div class="col-sm-3">
										<label>Country<span style='color:red;'>*</span></label>
											<input id="country" name="country" class="form-control input-sm Country" onchange="georesponse(this)" list="hotcountry">
											<span id = "validity"></span> 
											<!-- <select type="text" name="country" id="hotcountry" class="form-control input-sm Country">
											</select> -->
											<datalist id="hotcountry">
											</datalist>
										</div>
										<div class="col-sm-3">
										<label>State<span style='color:red;'>*</span></label>
											<input id = "state" name="state" class="form-control input-sm" onchange="georesponse(this)" list="statelist">
											<span id = "validity"></span>
											<datalist id="statelist">
											</datalist>
										</div>
										<div class="col-sm-3">
											<label>City<span stype='color:red;'>*</span></label>
											<input id= "city" name="city" class="form-control input-sm" list="citylist">
											<span id = "validity"></span>
											<datalist id="citylist">
											</datalist>
										</div>

						            </div>

									<div class="row" hidden>
										<!-- <input id="state" name="state"> -->
		                                <input id="route" name="route">
		                                <input id="room_num" name="room_num">
<!-- 			                                <input id="search_latitude" name="search_latitude">
		                                <input id="search_longitude" name="search_longitude"> -->
		                                <input id="address" diabled>
									</div>

									<div class="row">

										<div class="col-sm-4">
												<label>House Address</label>
												<input type="text" name="houseAddress" id = "houseAddress" class="form-control input-sm" placeholder="Enter and address,neighborhood,city">
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
						                    <input type="number" name="numOfRooms" class="form-control input-sm" value = "1" min="1">
						                </div>

						                <div class="col-sm-2">
						                    <label>Num of Baths</label>
						                    <input type="number" name="numOfBaths" class="form-control input-sm" value = "1" min="1">
						                </div>

						                <div class="col-sm-2">
						                    <label>Num of Beds</label>
						                    <input type="number" name="numOfBeds" class="form-control input-sm" value = "1" min="1">
						                </div>

						                <div class="col-sm-2">
						                    <label>Max Num of Guests</label>
						                    <input type="number" name="maxNumOfGuests" class="form-control input-sm" value="1" min="1">
						                </div>

									</div>

									<div class="row">
						                <div class="col-sm-8">
						                    <label>On Other Website</label>
						                    <input type="text" name="onOtherWebsite" class="form-control input-sm" >
						                </div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<a class="btn btn-primary btnPrevious" style="width:100px">Previous</a>
										</div>
										<div class="col-sm-6">
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
										<div class="col-sm-6">
											<a class="btn btn-primary btnPrevious" style="width:100px">Previous</a>
										</div>
										<div class="col-sm-6">
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
												<input type="number" name="costDayPrice" class="form-control input-sm" value = '0' step='100'>
											</div>
										</div>

										<div class="col-sm-2">
											<label>Cost Week Price</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="number" name="costWeekPrice" class="form-control input-sm" value ='0' step ='100'>
											</div>
										</div>

										<div class="col-sm-2">
											<label>Cost Month Price</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="number" name="costMonthPrice" class="form-control input-sm" value ='0' step='1000'>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-2">
											<label>Cost Utility</label>
											<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="number" name="costUtility" class="form-control input-sm" value ='0' step='10'>
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
												<input type="number" name="costCleaning" class="form-control input-sm" value='0' step='10'>
											</div>
										</div>

										<div class="col-sm-2">
											<label>Cost Security Deposit</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="number" name="costSecurityDeposit" class="form-control input-sm" value ='0' step='10'>
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
										<div class="col-sm-2">
											<label>Retail Day Price</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="number" name="retailDayPrice" class="form-control input-sm" value='0' step= '10'>
											</div>
										</div>

										<div class="col-sm-2">
											<label>Retail Week Price</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="number" name="retailWeekPrice" class="form-control input-sm" value='0' step= '10'>
											</div>
										</div>

										<div class="col-sm-2">
											<label>Retail Month Price</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="number" name="retailMonthPrice" class="form-control input-sm" value='0' step= '100'>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-2">
											<label>Retail Utility</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="number" name="retailUtility" class="form-control input-sm" value='0' step= '10'>                     
											</div>
										</div>

										<div class="col-sm-2">
											<label>Retail Cleaning</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="number" name="retailCleaning" class="form-control input-sm" value='0' step= '10'>
											</div>
										</div>

										<div class="col-sm-2">
											<label>Retail Security Deposit</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="number" name="retailSecurityDeposit" class="form-control input-sm" value='0' step= '10'> 
											</div>
										</div>
									</div>

									<div class="row">
			                			<div class="col-sm-2">
			                    			<label>Upsell Percent</label>
			                    				<div class="input-group">
			                          				<input type="number" name="upsellPercent" class="form-control input-sm" value='0' step= '10'>
			                          				<span class="input-group-addon">%</span>
			                    				</div>
			                			</div>

										<div class="col-sm-2">
											<label>TOT Percent</label>
											<div class="input-group">
												<input type="number" name="totpercent" class="form-control input-sm" >
												<span class="input-group-addon">%</span>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<a class="btn btn-primary btnPrevious" style="width:100px">Previous</a>
										</div>
										<div class="col-sm-6">
											<a class="btn btn-primary pull-right btnNext" style="width:100px">&nbsp;&nbsp;Next&nbsp;&nbsp;</a>
										</div>

									</div>

										
								</div>

								<div id="menu4" class="tab-pane fade">
								<!-- beginning of table HOUSEROOM -->
									<div id = "roomsdiv">

									</div>
									<br>
									<div class="row">
										<div class="col-sm-3">
											<button class="btn btn-success btn-sm" type="button" id="addRoom">Add a Room</button>
											<button class="btn btn-danger btn-sm" type="button" id="removeRoom">Remove a Room</button>
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
									<hr>
									<div style="text-align:center; margin-bottom:10px;">
										<button class="btn btn-primary btn-md" id="btnConfirm" style="width:200px;" type="button" >Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="house_A_result_modal" role="dialog" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Information</h4>
						</div>
						<div class="modal-body">
							<p id="house_A_display"></p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#house_A_result_modal').toggle();location.reload(true);">Add another one</button>
							<a href="/MainPage" class="btn btn-info" role="button">MainPage</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="loadele"></div>
@endsection

@section('script')
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpF-_i-utIH6cZl94zpu4C5vx_FBDDI9s&libraries=places&language=en&callback=initialize"></script>
	<script>

		var autocomplete;
		var search_geo;
		var componentForm = {
	        //street_number: 'short_name',
	        route: 'long_name',
	        locality: 'long_name',
	        administrative_area_level_1: 'long_name',
	        country: 'long_name',
	        postal_code: 'short_name'
	    };

	    var componentMap ={
	    	route: 'route',
	    	locality: 'city',
	    	administrative_area_level_1: 'state',
	    	country: 'country',
	    	postal_code: 'houseZip'
	    }

	    var roomtype,bedtype;
	    function initAutoComplete(){
	    	var options = {
	    		componentRestrictions: {country: "us"}
	    	}

	    	autocomplete = new google.maps.places.Autocomplete(
	    		(document.getElementById('houseAddress')),
	    		options);
	    	autocomplete.addListener('place_changed',geolocate);
	    }

	    function initialize(){
	    	initAutoComplete();
	    }

	    function geolocate(){
	        var place = autocomplete.getPlace();
	        //console.log(JSON.stringify(place));
	        if(place){
	            for(var i = 0 ;i < place.address_components.length;i++){
	                var addressType = place.address_components[i].types[0];
	                if(componentForm[addressType]){
	                    var val = place.address_components[i][componentForm[addressType]];
	                    if(!document.getElementById(componentMap[addressType]).value){
	                    	document.getElementById(componentMap[addressType]).value = val;
	                	}
	                	else if(document.getElementById(componentMap[addressType]).value!=val){
	                		document.getElementById(componentMap[addressType]).value = val;
	                		alert("there is conflict on "+componentMap[addressType]+'\n Autocorrected');
	                	}
	                }
	            }
	            //document.getElementById('address').value = document.getElementById('houseAddress').value;
	            search_geo = place.geometry;
	        }
	        else {
	            alert("something wrong");
	        }

	    }

	    function getisocontrycode(country){
	    	var countrydict = {
	    		'China': 'CN',
	    		'United States':'US',
	    		'United Kingdom':'UK',
	    	}
	    		return countrydict[country];
	    }

	    function vieweffect(id) {
	    	$('#houseOwnerID').val(id);
	    	$('#collapseOne').collapse('hide');
			$('#collapseTwo').collapse('show');
	    }

		$(document).ready(function(){
			loadOpt();
			$("#search_form").submit(function(){
				var toSend = $(this).serializeArray();
				$.ajax({
					type:"post",
					dataType: "json",
					url:'/houseowner/search/similar',
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
							htmlcont += "<tr><td data-dismiss='modal' style='cursor:pointer; text-decoration:underline; color:blue;' onclick=vieweffect(" + data[i].houseOwnerID + ")>Select</td>"+
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
			$('#btnConfirm').click(function(){
				//
				if(check()){
					var toSend = $('#houseinfoform').serializeArray();
					//toSend.push({'name':'dateHouseAdded','value':converttimetosql($('#dateHouseAdded').val())});
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
					if(search_geo){
						var location = search_geo['location'];
			            toSend.push({'name':'search_latitude','value':location['lat']});
			            toSend.push({'name':'search_longitude','value':location['lng']});
					}
					toSend.push({'name':'room_num','value':document.getElementById('roomsdiv').childElementCount});
					$.post({
						type:"POST",
						url:"/house/add",
						data:$.param(toSend),
						datatype:'json',
						success: function(data){
							// console.log(data);
							if(data.status=='success'){
								var str = "House ID: "+ data.houseinfo.fullHouseID + " has been stored.";  
								$('#house_A_display').text(str);
							}
							else{

							}
							$('#loadele').removeClass("loading");
							$('#house_A_result_modal').modal();
						}
					});
					$('#loadele').addClass("loading");
				}
			});

			$("#new_house_owner_form").submit(function(){
				var toSend = $(this).serialize();//ownerWechatID=XXXX
				$.ajax({
					type: "POST",
					dataType: "json",//data type expected from server
					url: "/houseowner/add",
					data: toSend,
					success: function(data) {
						//alert(JSON.stringify(data));
						if(data.duplicate){
							bootbox.dialog({
								message:"Failed to add new house owner. ",
								title: "Fialed: Existing same owner",
								buttons: {
									main: {
										label: "OK",
										className: "btn-primary"
									}
								}
							});
						}
						else{
							$('#new_house_owner_modal').modal('toggle');
							bootbox.dialog({
								message:"Succussfully added new house owner. ID: " + data.ownerid,
								title: "Confirmation",
								buttons: {
									main: {
										label: "OK",
										className: "btn-primary"
									}
								}
							});
							vieweffect(data.ownerid);
						}
					}
					,
					error: function (xhr, ajaxOptions, thrownError) {
						alert("Failed to add new house owner.");
					}
				});
				return false;
			});

			$('#addRoom').click(function(){
				// var htmlstr = "<div class='well' ";
				var count = document.getElementById('roomsdiv').childElementCount+1;
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
				if(document.getElementById("roomsdiv").childElementCount>0){
					var allroomchild = document.getElementById("roomsdiv");
					allroomchild.removeChild(allroomchild.lastChild);
				}
			});

			// ToDO: if the isocode 
			
			$('.btnNext').click(function(){
				$('.nav-tabs > .active').next('li').find('a').trigger('click');
			});

			$('.btnPrevious').click(function(){
				$('.nav-tabs > .active').prev('li').find('a').trigger('click');
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


			$.get("/resource/roomTypes",function(data,status){
				roomtype = "";
				for(i=0;i<data.length;++i){
					// var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					// $('#room1Type').append(option);
					// $('#room2Type').append("<option>" + data[i] + "</option>");
					var option = "<option> "+data[i]+"</option>";
					roomtype += option;
				}
			});

			$.get("/resource/bedTypes",function(data,status){
				bedtype = "";
				for(i=0;i<data.length;++i){
					// var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					// $('#room1Type').append(option);
					// $('#room2Type').append("<option>" + data[i] + "</option>");
					var option = "<option> "+data[i]+"</option>";
					bedtype += option;
				}
			});


			//$('#forbounce').animateCss('bounce 1s infinite');
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
		// function addBed(ele){
		// 	var tableele = $(ele).parents('table');
		// 	var rowCount = $('tr', $(tableele).find('tbody')).length-1;
		// 	var markup = "<tr><td>"+rowCount+"</td><td><select class='form-control input-sm' onchange='bedtypechange(this)'>"+bedtype+"</select> </td></tr>"
		// 	$('tr:nth-child('+rowCount+')',$(tableele).find('tbody')).after(markup);
		// 	// tableele.append( markup );
		// }	
		function roomtypechange(ele){
			var count = ele.id.split('_')[1];
			if(ele.value=='Other'){
				$('#roomTypeOtherDiv_'+count).show();
			}
			else{
				$('#roomTypeOtherDiv_'+count).hide();
			}
		}

		// function bedtypechange(ele){
		// 	//alert(ele.id+" change");
		// 	var count = ele.id.split('_')[1];
		// 	if(ele.value=='Other'){
		// 		$('#roomBedTypeotherdiv_'+count).show();
		// 	}
		// 	else{
		// 		$('#roomBedTypeotherdiv_'+count).hide();
		// 	}
		// }


		//TODO: This can be integrated with the sarch reaction function

		function findSimilarOwners(){
			$("#similarResult").empty();
			var toSend = $("#new_house_owner_form").serialize();//ownerWechatID=XXXX
			$.ajax({
				type:"post",
				dataType: "json",
				url:'/houseowner/search/similar',
				data: toSend,
				success: function(data) {
					//alert(JSON.stringify(data));
					var htmlcont = "";
					if (data.length==0) {//no similar results found
						$("#new_house_owner_form").submit();
					} else {
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
							htmlcont += "<tr><td data-dismiss='modal' style='cursor:pointer; text-decoration:underline; color:blue;' onclick='$(\"#houseOwnerID\").val( "+ data[i].houseOwnerID+ ")'>Select</td>"+
										    "<td>"+data[i].first+"</td>"+
										    "<td>"+data[i].last +"</td>"+
										    "<td>"+data[i].ownerWechatID+"</td>"+
										    "<td>"+data[i].ownerWechatUserName+"</td>"+
										    "<td>"+data[i].houseOwnerID+"</td></tr>";
						}
						htmlcont += "</table></div>";

						$("#similarResult").html(htmlcont);
						$('#ownerSubmitBtn').hide();
						$('#ownerStillSubmitBtn').show();
					}
				}
				,
				error: function (xhr, ajaxOptions, thrownError) {
					alert("Something's wrong, try again later.");
				}
			});
		}

		function georesponse(elem){
			var value = $(elem).val();
			var optionFound = false;
			var datalist = $(elem)[0].list;
			for(var i=0;i<datalist.options.length;i++){
				if(value==datalist.options[i].value){
					optionFound = true;
					break;
				}
			}

			if(!optionFound){
				$(elem)[0].setCustomValidity('Please select a valid value.');
					return;
			}

			//var url = "/resource/";
			if(elem===$('#country')[0]){
				//url += value.trim();
				$.get({
					url:"/resource/"+value,
					type:"GET",
					success: function(data){
						$('#statelist').empty;
						for(var i=0;i<data.length;++i){
							var option = $("<option></option>").attr("value", data[i]).text(data[i]);
							$('#statelist').append(option);
						}
					},
					error: function(jqXHR,error){
						errorhandler(jqXHR);
					}
				});
			}
			else if(elem===$('#state')[0]){
				$.get({
					url:"/resource/"+$('#country').val()+'/'+value,
					type:"GET",
					success:function(data){
							$('#citylist').empty;
							$('#citylist').html(data);
						},
					error: function(jqXHR,error){
						alert();
						errorhandler(jqXHR);
					}

				});	
			}
			else{
			}

		}

		function errorhandler(jqXHR){
				bootbox.dialog({
                    message:jqXHR.statusText,
                    title: "Error",
                    buttons: {
                        main: {
                            label: "OK",
                            className: "btn-primary"
                        }
                    }
                });
			}

		function check(){
			if($("#houseOwnerID").val() == ""){
				$("#ErrorMsg").html("House Owner ID cannot be empty.");

				return false;
			}

			if($('.country').val()==""){
				$('#ErrorMsg').html("Country Field country cannot be empty");
				return false;
			}

			if($('#state').val()==""){
				$('#ErrorMsg').html("State Field cannot be empty");
				return false;
			}

			if($('#city').val()==""){
				$('#ErrorMsg').html("City Field cannot be empty");
				return false;
			}

			if($("#houseAddress").val() == ""){
				$("#ErrorMsg").html("Please input a valid home address");
				return false;
			}

			if($('#houseZip').val()==""){
				$('#ErrorMsg').html("please enter a valid zip code");
				return false;
			}

			return true;
			// if($("#houseZip").val() == ""){
			// 	$("#ErrorMsg").html("Please input a valid zip code");
			// 	return false;
			// }
		}

	</script>
@endsection
