@extends('navbar')
@section('title', ' Add New Inquiry')

@section('head')

	<style type="text/css">
		body {
			/*line-height: 200%;*/
			/*background-image: url("../background.jpg");*/
/*				background-color: #82CAFA;*/
			font-size: 14px;
			line-height: normal;
		}
		#adjustLineSpacing div, #new_inquirer_form div {
			margin-bottom: 5px;
		}
		.control-label {
			font-weight: normal;
		}
		/*.form-control {

		}*/
		.title-lg {
			color: #337AB7;
			font-size: 20px;
			font-weight: bold;
		}
		.title-sm {
			color: #337AB7;
			font-size: 18px;
			font-weight: bold;
		}
		.badge {
			font-size: 25px; 
			background-color: #5CB85C;
		}
		.inactiveLink {
			pointer-events: none;
			cursor: default;
		}
		hr {
			-moz-border-bottom-colors: none;
			-moz-border-image: none;
			-moz-border-left-colors: none;
			-moz-border-right-colors: none;
			-moz-border-top-colors: none;
			color: #3C3F41;
			border-color: #EEEEEE -moz-use-text-color #FFFFFF;
			border-style: solid none;
			border-width: 1px 0;
			margin: 8px 0;
		}
		input[type="search"]::-webkit-search-cancel-button{
			-webkit-appearance: searchfield-cancel-button;
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

		</style>

@endsection

@section('content')
	<div class="container">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<span class="badge" style="background-color:#5CB85C;">1</span>
					<a role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<span class="title-sm" style='padding-left:5px;'> Select or Create Inquirer</span>
					</a>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				<!-- <div class="row"> -->
					<div class="panel-body">
						<div class="col-sm-6">
							<h5>Existing Inquirer?</h5>
							<form id="search_form" class="form-horizontal"  onsubmit="return false;">
								{{ csrf_field() }}
								<div class="form-group">
									<label class="col-sm-4 control-label">First Name</label>
									<div class="col-sm-6">
										<input type="search" class="form-control input-sm" name="inquirerFirst" placeholder="First Name">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Last Name</label>
									<div class="col-sm-6">
										<input type="search" class="form-control input-sm" name="inquirerLast" placeholder="Last Name">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">WeChat ID</label>
									<div class="col-sm-6">
										<input type="search" class="form-control input-sm" name="inquirerWechatID" placeholder="Wechat ID">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">WeChat Username</label>
									<div class="col-sm-6">
										<input type="search" class="form-control input-sm" name="inquirerWechatUserName" placeholder="Wechat Name">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Taobao Username</label>
									<div class="col-sm-6">
										<input type="search" class="form-control input-sm" name="inquirerTaobaoUserName" placeholder="Taobao Username">
									</div>
								</div> <!-- button get -->

								<div class="col-sm-6 col-sm-offset-4">
									<button class="btn btn-primary btn-sm" type ="submit">Search</button>
									<!-- clear input by refresh page -->
									<button class="btn btn-warning btn-sm" type="reset">Clear</button>   
								</div>
							</form>
						</div>
						<div class="col-sm-6">
							<h5>New inquirer?</h5>
								<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addInquirerFieldModal"  onclick="$('#similarResult').empty(); $('#inquirerSubmitBtn').show(); $('#inquirerStillSubmitBtn').hide();">Add New Inquirer</button> 
						</div>
					</div>
				</div>


				<form method = "POST" id = "new_inquirer_form" class='form-horizontal' onsubmit="return false;">
					{{ csrf_field() }}
					<!-- Modal add -->
					<div class="modal fade" id="addInquirerFieldModal" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Add New Inquirer</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-sm-4 control-label"><span style="color:red">*</span>First Name:</div>
										<div class="col-sm-4"><input class="form-control input-sm" type='search' name='inquirerFirst'></div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label"><span style="color:red">*</span>Last Name:</div>
										<div class="col-sm-4"><input class="form-control input-sm" type='search' name='inquirerLast'></div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">U.S. Phone Number:</div>
										<div class="col-sm-4"><input class="form-control input-sm bfh-phone" type='text' name='inquirerUsPhoneNumber' data-format="(ddd) ddd-dddd" ></div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">Phone Country:</div>
										<div class="col-sm-4">
											<select class="form-control input-sm" type='search' id='inquirerPhoneCountry' name='inquirerPhoneCountry'>
												<?//php //listtoselect("../list/phoneCountryCode"); ?>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">Phone Number:</div>
										<div class="col-sm-4"><input class="form-control input-sm" type='search' name='inquirerPhoneNumber'></div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">Email:</div>
										<div class="col-sm-4"><input class="form-control input-sm" type='search' name='inquirerEmail'></div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">Taobao Username:</div>
										<div class="col-sm-4"><input class="form-control input-sm" type='search' name='inquirerTaobaoUserName'></div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">WeChat Username:</div>
										<div class="col-sm-4"><input class="form-control input-sm" type='search' name='inquirerWechatUserName'></div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">WeChat ID:</div>
										<div class="col-sm-4"><input class="form-control input-sm" type='search' name='inquirerWechatID'></div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">Original Country:</div>
										<div class="col-sm-4">
											<select name = "inquirerCountry" id="inquirerCountry" class="form-control input-sm">
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">Original State:</div>
										<div class="col-sm-4" id='forInquirerState'>
											<select name = "inquirerState" id="inquirerState" class="form-control input-sm">
											</select>
										</div>
										<div class="col-sm-4">
											<div style="display:none;" id="inquirerStateOtherDiv">
												<input id="inquirerStateOther" class="form-control" name="inquirerStateOther" placeholder="Enter State">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 control-label">Original City:</div>
										<div class="col-sm-4" id='forInquirerCity'>
											<select name = "inquirerCity" id="inquirerCity" class="form-control input-sm">
											</select>
										</div>
										<div class="col-sm-4">
											<div style="display:none;" id="inquirerCityOtherDiv">
											<!-- <label>Other City</label> -->
												<input id="inquirerCityOther" class="form-control" name="inquirerCityOther" placeholder="Enter City">
											</div>
										</div>
									</div>
									<div id="similarResult"></div>
								</div> <!-- body -->
							<div class="modal-footer" id="testAddNewInquirer">
								<button class="btn btn-primary" onclick="findSimilarInquirers();" type="button" id="inquirerSubmitBtn">Submit</button>
								<button class="btn btn-primary" type="button" id="inquirerStillSubmitBtn">Still Submit</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</form>

				<div class="modal fade" id="getInquirerIDResModal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Inquirer Search Result</h4>
							</div>
							<div id="getInquirerIDRes" class="modal-body">
								<!-- display search result here -->
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- </div> -->

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<span class="badge" style="background-color:#5CB85C;">2</span>
					<a id='link2' class="collapsed inactiveLink" role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<span class="title-sm" style='padding-left:5px;'>Add New Inquiry</span>
					</a>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					<div class="panel-body">
						<form action="#" method="post" id="adjustLineSpacing" name="toshowhousepage">
							{{ csrf_field() }}
							<!-- <div class="well"> -->
								<div class="row">
									<div class="col-lg-3">
										<div>
											<label>Inquirer ID (Please select from above)</label>
											<input readonly id="inquirerID" class="form-control" name="inquirerID" type="search"/>
										</div>
									</div>


									<div class="col-lg-3">
										<div>
											<label>Representative</label>
											<select id="repID" class="form-control" name="repWithOwner">
											@foreach ($Allreps as $repre)
												@if ($repre->repUserName == $Rep->repUserName)
													<option selected>{{$repre->repUserName}}</option>
												@else
													<option>{{$repre->repUserName}}</option>
												@endif
											@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-3">
										<label>Inquiry Priority Level</label>
										<select id="inquiryPriorityLevel" name = "inquiryPriorityLevel" type = "number" class="form-control">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-3">
										<label>Country<span style='color:red;'>*</span></label>
										<!-- <select name = "country" type = "search" id="country" class="form-control country">
										</select> -->
										<input id="country" name="country" class="form-control input-sm" onchange="georesponse(this)" list="countrylist">
										<datalist id="countrylist" class="country">
										</datalist>
									</div>

									<div class="col-lg-3">
										<label>State or Province<span style='color:red;'>*</span></label>
										<!-- <select id="state" name="state" class="form-control">
										<option selected>Select State</option>
										</select> -->
										<input id="state" name="state" class="form-control input-sm" onchange="georesponse(this)" list="statelist">
										<datalist id="statelist">
										</datalist>
									</div>

									<div class="col-lg-3">
										<label>City<span stype='color:red;'>*</span></label>
										<!-- <select name="city" id="city" class="form-control">
										<option selected>Select City</option>
										</select> -->
										<input id= "city" name="city" class="form-control input-sm" list="citylist">
										<span id = "validity"></span>
										<datalist id="citylist">
										</datalist>
									</div>
									<div class="col-lg-3">
										<label>City Other</label>
										<input name="cityOther" id="cityOther" class="form-control" type="search">
									</div>
								</div>


								<div class="row">
									<div class="col-lg-3">
										<div>
											<label>Source</label>
											<select id="inquirySource" class="form-control" name="inquirySource">
											</select>
										</div>
									</div>
									<div class="col-lg-3">
										<div style="display:none;" id="inquirySourceOtherDiv">
											<label>Source Other</label>
											<input id="inquirySourceOther" class="form-control" name="inquirySourceOther" placeholder="Enter Source">
										</div>
									</div>

									<div class="col-lg-3">
										<div>
											<label>Purpose</label>
											<select id="purpose" class="form-control purpose" name="purpose">
											</select>
										</div>
									</div>

									<div class="col-lg-3">
										<div style="display:none;" id="purposeOtherDiv">
											<label>Purpose Other</label>
											<input id="purposeOther" class="form-control" name="purposeOther" placeholder="Enter Purpose">
										</div>
									</div>
								</div>

								<div style='height:30px'></div>
								<hr>
								<div style='height:30px'></div>

								<div class="row">
									<div class="col-lg-3">
										<div>
											<label>Inquiry Date</label>
											<input name="inquiryDate" id="inquiryDate" class="form-control" type="search" placeholder="mm/dd/yyyy">
										</div>
									</div>

									<!-- <div class="col-lg-3">
										<div>
											<label>Check-In Date</label>
											<input name = "checkIn" class="form-control" type = "search" id="checkIn" placeholder="mm/dd/yyyy">
										</div>
									</div>

									<div class="col-lg-3">
										<div>
											<label>Check-Out Date</label>
											<input name = "checkOut" class="form-control" type = "search" id="checkOut" placeholder="mm/dd/yyyy">
										</div>
									</div> -->
									<div class="col-lg-3">
										<label>Check-In & Out Date</label>
										<div class="input-daterange input-group" id="calendar">
											<input type="text" id="checkIn" name="checkIn" class="form-control" placeholder="mm/dd/yyyy" >
											<span class="input-group-addon">to</span>
											<input type="text" id="checkOut" name="checkOut" class="form-control" placeholder="mm/dd/yyyy">
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-lg-3">
										<div>
											<label>House ID</label>
											<input name = "fullHouseID" type = "search" id="fullHouseID" class="form-control">
										</div>
									</div>

									<div class="col-lg-3">
										<div>
											<label>Whole/Share</label>
											<SELECT id='share' name='share' class="form-control">
											<OPTION value =  0>Either</OPTION>
											<OPTION value =  -1>Share</OPTION>
											<OPTION value = 1>Whole</OPTION>
											</SELECT>
										</div>
									</div>

									<div class="col-lg-3">
										<div>
											<label>House Type</label>
											<select name = "houseType" id="houseType" class="form-control" onchange="houseTypechange">
												<?//php listtoselect("../list/houseTypeList"); ?>
											</select>
										</div>
									</div>

									<div class="col-lg-3" id="houseTypeOtherDiv" style="display:none;">
											<label>House Type Other</label>
											<input id = "houseTypeOther" name = "houseTypeOther" class="form-control" placeholder="Enter House Type">
									</div>
								</div>

								<div class="row">
									<div class="col-lg-3">
										<label>Number of Rooms</label>
										<input type = "number" name = "rooms" id = "rooms" min="0" class="form-control"/>
									</div>
									<div class="col-lg-3">
										<label>Add room type (max 2)</label>
										<button id='addRoomType' type="button" class="btn btn-primary form-control">+</button>
									</div>
									<div class="col-lg-3" style="display:none;">
										<label>Remove room</label>
										<button id='removeRoomType' type='button' class='btn btn-primary form-control'>-</button>
									</div>
								</div>

								<div id="roomTypeDiv">
									<div class="row">
										<div class="col-lg-3" id='room1TypeDiv' style="display:none;">
											<label>Room 1 Type</label>
											<select name = "room1Type" id="room1Type" class="form-control roomType">
											</select>
										</div>

										<div class="col-lg-3" id="room1TypeOtherDiv" style="display:none;">
											<label>Room 1 Type Other</label>
											<input name = "room1TypeOther" type = "search" id="room1TypeOther" class="form-control" placeholder="Enter Room Type">
										</div>

										<div class="col-lg-3" id='room2TypeDiv' style="display:none;">
											<label>Room 2 Type</label>
											<select name = "room2Type" id="room2Type" class="form-control roomType">
											</select>
										</div>

										<div class="col-lg-3" id="room2TypeOtherDiv" style="display:none;">
											<label>Room 2 Type Other</label>
											<input name = "room2TypeOther" type = "search" id="room2TypeOther" class="form-control" placeholder="Enter Room Type">
										</div>

									</div>

								</div>

								<div id="residentInfo">
									<div class="row">
										<div class="col-lg-2">
											<div>
												<label>Number of Adult</label>
												<input name="numOfAdult" type = "number" size = "1" min="1" id="numOfAdult" class="form-control" value='1'>
											</div>
										</div>

										<div class="col-lg-2">
											<div>
												<label>Number of Kids</label>
												<input name="numOfChildren" type = "number" size = "1" min="0" id="numOfChildren" class="form-control" value='0'>
											</div>
										</div>

										<div class="col-lg-2">
											<div>
												<label>Kids Age</label>
												<input name="childAge" type = "search" id="childAge" class="form-control">
											</div>
										</div>

										<div class="col-lg-2">
											<div>
												<label>Baby</label>
												<!-- <SELECT name="hasBaby" id="hasBaby" class="form-control">
												<OPTION value =  1>Yes</OPTION>
												<OPTION value =  0 selected>No</OPTION>
												</SELECT> -->
												<input name="hasBaby" type="number" min='0' id="hasBaby" class="form-control">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-2">
											<div>
												<label>Pregnant</label>
												<SELECT id='pregnancy' name='pregnancy' class="form-control">
												<OPTION value =  0>N/A</OPTION>
												<OPTION value =  1>Yes</OPTION>
												<OPTION value = -1>No</OPTION>
												</SELECT>
											</div>
										</div>

										<div class="col-lg-2">
											<div>
												<label>Pets</label>
												<SELECT id='pet' name='pet' class="form-control">
												<OPTION value =  0>N/A</OPTION>
												<OPTION value =  1>Yes</OPTION>
												<OPTION value = -1>No</OPTION>
												</SELECT>
											</div>
										</div>

										<div class="col-lg-2">
											<div id="petTypeDiv" style="display:none;">
												<label>Pet Type</label>
												<input name="petType" type = "search" id="petType" class="form-control">
											</div>
										</div>
									</div>

								</div>

								<div id="otherinfo">
									<div class="row">
										<div class="col-lg-4">
											<div>
												<label>Budget</label>
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon1">From $</span>
														<input class="form-control" name="budgetLower" id="budgetLower" type = "search" size = "10">
														<span class="input-group-addon" id="basic-addon1">to $</span>
														<input class="form-control" name="budgetUpper" id="budgetUpper" type = "search" size = "10">
													</div>
											</div>
										</div>

										<div class="col-lg-2">
											<div>
												<label>Budget Unit</label>
												<select name = "budgetUnit" id="budgetUnit" class="form-control">
												<option value="0">Per Day</option>
												<option value="1">Per Month</option>
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6" style="color:#F4D03F;">
											Budget Note: Please obtain Monthly or Daily only rate. (If share, then the rate of the total # of requested rooms.)
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6">
											<label>Special Note</label>
											<textarea class="form-control" name="specialNote" id="specialNote" rows=10 cols=100></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12 text-center">
										<input class="btn btn-primary text-center" style="width:200px;" type="button" onclick="addinquirydata()" value="Submit">
									</div>
								</div>
							<!-- </div> -->
						</form>
					</div>
				</div>


			</div>

			<div class="modal fade" id="inquiry_modal" role="dialog" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Information</h4>
						</div>
						<div class="modal-body">
							<p id="inquiry_display"></p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#inquiry_modal').toggle();location.reload(true);">Add another one</button>
							<button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#inquiry_modal').toggle();location.reload(true);HousePair();" > House Pair</button>
							<a href="/MainPage" class="btn btn-info" role="button">MainPage</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>  <!-- end of well container -->
	<div id="loadele"></div>
	@endsection

	@section('script')
	<script>

		function vieweffect_1(){
			// $('#collapseTwo').collapse({toggle: true, parent: '#accordion'});
			// $('#collapseTwo').collapse({toggle: false});
			$('#collapseOne').collapse('hide');
			$('#collapseTwo').collapse('show');
			$("#link2").removeClass('inactiveLink');
		}

		function vieweffect_2(){
			$('#collapseOne').collapse('show');
			$('#collapseTwo').collapse('hide');
		}

		function addinquirydata(){
			var quiryinfo = $('#adjustLineSpacing').serializeArray();
			var quiryinfojson = {};
			for(var i =0;i<quiryinfo.length;++i){
				quiryinfojson[quiryinfo[i]['name']] = quiryinfo[i]['value'];
			}

			quiryinfojson.inquiryDate = converttimetosql(quiryinfojson.inquiryDate);
			quiryinfojson.checkIn = converttimetosql(quiryinfojson.checkIn);
			quiryinfojson.checkOut = converttimetosql(quiryinfojson.checkOut);
			if(quiryinfojson.checkOut < quiryinfojson.checkIn)
			{
				bootbox.dialog({
					message: 'Check-In Date must be earlier than Check-Out Date',
					title: 'Error in the Form',
					buttons: {
					  success: {
					  label: 'OK',
					  className: 'btn-danger'
					  }
					}
				});
				return ;
			}
			if(quiryinfojson.inquiryDate > checkIn){
				bootbox.dialog({
					message: 'Inquiry Date must be earlier than Check-In Date',
					title: 'Error in the Form',
					buttons: {
					  success: {
					  label: 'OK',
					  className: 'btn-danger'
					  }
					}
				  });
				return ;
			}

			if(quiryinfojson.state.includes("Select")){
				quiryinfojson.state = "";


			}
			if(quiryinfojson.city.includes("Select")){
				quiryinfojson.city="";
			}
			var toSend = jQuery.param(quiryinfojson);
			$.ajax({
				type:"POST",
				dataType: "json",//data type expected from server
				url: "/inquiry/add",
				data: toSend,
				cache:false,
				success: function(data){
					$('#loadele').removeClass("loading");
					if(data.length==0||data.status=="error"){
						bootbox.dialog({
							message: m,
							title: 'Error',
							buttons: {
							  success: {
								  label: 'OK',
								  className: 'btn-primary'
							  }
							}
						});
					}
					else{
						$('#inquiry_modal').modal();
						vieweffect_2();
					}
				},
				error : function(xhr, ajaxOptions, thrownError){
					$('#loadele').removeClass("loading");
					bootbox.dialog({
						message: "Something's wrong, try again later.",
						title: 'Error',
						buttons: {
						  success: {
						  label: 'OK',
						  className: 'btn-primary'
						  }
						}
					});
				}
			});
			$('#loadele').addClass("loading");
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			loadOpt();// Load list
			bindhandler();
			$("#inquiryDate").datepicker({
			  dateFormat: "mm/dd/yy",
			  maxDate: 0,
			  autoclose:true
			});
			$("#inquiryDate").datepicker("setDate", new Date());

			$('#calendar').datepicker({
			  dateFormat: "mm/dd/yy",
			  disabledInputs: ['07/14/2017'],
			  minDate: 0,
			  // beforeShow: function () {
			  // $('#checkIn').datepicker('option', 'minDate', 0);
			  // }
			});
			$('#checkIn').change(function(){
				$('#checkIn').datepicker('hide');
				$('#checkOut').focus();
			});
			$('#checkOut').change(function(){
				$(this).datepicker('hide');
			});


			// $('.input-daterange').each(function(){
			// 	$(this).datepicker({
			// 		startDate: 0,
			// 		dateFormat: "mm/dd/yy",
			// 	});
			// });

			// $('#checkOut').datepicker({
			//   dateFormat: "mm/dd/yy",
			//   beforeShow: function () {
			// 	var checkIn = $('#checkIn').datepicker("getDate");
			// 	if(checkIn){
			// 		checkIn.setDate(checkIn.getDate() + 1);
			// 		$('#checkOut').datepicker('option', 'minDate', checkIn);
			// 	}
			//   }
			// });


			$("#search_form").submit(function(){
				var toSend = $(this).serialize();
				
				$.ajax({
					type: "POST",
					dataType: "json",//data type expected from server
					url: '/inquirer/search',
					data: toSend,
					success: function(data) {
						var htmlcont = "";
						if(data.length==0){
							htmlcont = "<span style='color:red;'>No records found.</span>";
						}
						else{
							htmlcont +=  "<div style='overflow:auto'> "+
											"<table class='table table-striped table-bordered'>"+
											"<tr>"+
											"<th></th>"+
											"<th>ID</th> "+
											"<th>First Name</th>"+
											"<th>Last Name</th>"+
											"<th>U.S. Phone Number</th>"+
											"<th>Wechat ID</th> "+
											"<th>Wechat Username</th>"+
											"<th>Taobao Username</th>"+
											"</tr>";

							for(i =0 ;i<data.length;++i){
								htmlcont += "<tr><td data-dismiss=\"modal\" style=\"cursor:pointer; text-decoration:underline; color:blue;\" onclick=\"$(\'#inquirerID\').val(" +data[i].inquirerID+ ");vieweffect_1();\">Select</td>"+
											"<td>"+data[i].inquirerID + "</td>"+
											"<td>"+data[i].inquirerFirst+"</td>"+
											"<td>"+data[i].inquirerLast+"</td>"+
											"<td>"+data[i].inquirerUsPhoneNumber + "</td>"+
											"<td>"+data[i].inquirerWechatID+"</td>"+
											"<td>"+data[i].inquirerWechatUserName+"</td>"+
											"<td>"+data[i].inquirerTaobaoUserName+"</td>"+
											"</tr>";

							}
							htmlcont += "</table></div>";
							//alert(htmlcont);
						}
						$("#getInquirerIDRes").html(htmlcont);
						$('#getInquirerIDResModal').modal('toggle');
						return false;
					},
					error: function (xhr, ajaxOptions, thrownError) {
						bootbox.dialog({
							message: "Something's wrong, try again later.",
							title: "Failed",
							buttons: {
								main: {
									label: "OK",
									className: "btn-primary"
								}
							}
						});
					}
				});
			});

			$('#addRoomType').click(function() {
				console.log($('#room1TypeDiv').css('display'));
				$("#removeRoomType").parent().show();
				if ($('#room1TypeDiv').css('display') != 'none') {
					if($('#rooms').val()<2){
						$('#rooms').val(2);
					}
					$('#room2TypeDiv').show();
				}
				else {
					if($('#rooms').val()<1){
						$('#rooms').val(1);
					}
					$('#room1TypeDiv').show();
				}
			});

			$('#removeRoomType').click(function(){
				if($('#room2TypeDiv').css('display')!='none' ){
					$('#room2TypeDiv').hide();
				}
				else if($('#room1TypeDiv').css('display') != 'none'){
					$('#room1TypeDiv').hide();
					$(this).parent().hide();
				}
			});

			$("#room1Type").change(function(){
				if($(this).val().trim() == "Other"){
					$("#room1TypeOtherDiv").show();
				}else{
					$("#room1TypeOtherDiv").hide();
					$('#room1TypeOtherDiv').val('');//empty input
				}
			});

			$("#room2Type").change(function(){
				if($(this).val().trim() == "Other"){
					$("#room2TypeOtherDiv").show();
				}else{
					$("#room2TypeOtherDiv").hide();
					$('#room2TypeOtherDiv').val('');//empty input
				}
			});

			$("#pet").change(function(){
				if($("#pet").val() == 1){
					$("#petTypeDiv").show();
				}else{
					$("#petTypeDiv").hide();
					$('#petTypeDiv').val('');//empty input
				}
			});
			$.ajax({
				type: "GET",
				dataType: "json",//data type expected from server
				url: "/resource/countries",
				success: function(data) {
					for (i = 0; i < data.length; i++) {
						$("#inquirerCountry").append("<option value='" + data[i] + "'>" + data[i] + "</option>");
					}
				}
			});

			$.ajax({
				type: "GET",
				dataType: "json",//data type expected from server
				url: "/resource/countryCode",
				success: function(data) {
					for (i = 0; i < data.length; i++) {
						$("#inquirerPhoneCountry").append("<option value='" + data[i] + "'>" + data[i] + "</option>");
					}
				}
			});

			$("#inquirerCountry").change(function(){//fix 0309
				// $("#inquirerState").load("../list/Country_State_Option/" + $(this).val().replace(/\s/g, '') + "_StateListOption");
				if($(this).val() == "China" || $(this).val() == "United Kingdom" || $(this).val() == "United States"){
					console.log("china us uk");            
					$("#inquirerState").load("/list/Country_State_Option/" + $(this).val().replace(/\s/g, '') + "_StateListOption");
					$("#inquirerCity").html("");
					$("#inquirerStateOtherDiv").hide();
					$("#inquirerCityOtherDiv").hide();
					$('#inquirerStateOther').val('');//empty input
					$('#inquirerCityOther').val('');//empty input
					// $("#inquirerCity").load('../list/State_City_Option/' + state + 'CityListOption');
				} else {
					console.log("other country");
					// $("#inquirerState").hide();
					$("#inquirerStateOtherDiv").show();
					$('#inquirerState').empty();
					$('#inquirerStateOther').val('');
					$("#inquirerState").append("<option value='InputState'>Input State</option>");  //添加一项option
					console.log( $('#inquirerState').val());

					$('#inquirerCity').empty();
					$('#inquirerCityOther').val('');
					$("#inquirerCity").append("<option value='InputCity'>Input City</option>");
					$("#inquirerCityOtherDiv").show();
				}
			});

			$("#inquirerState").change(function(){
				var state = $(this).val().replace(/\s/g, '');
				//console.log(state);	
				$("#inquirerCity").load('/list/State_City_Option/' + state + 'CityListOption');
				$("#inquirerCityOtherDiv").hide();
				$('#inquirerCityOther').val('');//empty input
			});

			$("#inquirerCity").change(function(){
				if($(this).val() == "Other"){
					$("#inquirerCityOtherDiv").show();
				} else {
					$("#inquirerCityOtherDiv").hide();
					$('#inquirerCityOther').val('');//empty input
				}
			});

			$('#inquirerStillSubmitBtn').click(function() {
				$('#new_inquirer_form').submit();
			});

			$('#new_inquirer_form').submit(function(){
				var toSend = $(this).serialize();
				$.ajax({
					type:"POST",
					dataType:"html",
					url:"/inquirer/add",
					data:toSend,
					success: function(data) {
						if (data.substring(data.length-5, data.length) == "error") {
							bootbox.dialog({
								message: "Failed to add new inquirer. Please try again later.",
								title: "Failed",
								buttons: {
									main: {
										label: "OK",
										className: "btn-primary"
									}
								}
							});
						} else {
							bootbox.dialog({
								message: "Successfully added new inquirer. ID: " + data,
								title: "Confirmation",

								buttons: {
									main: {
										label: "OK",
										className: "btn-primary"
									}
								}
							});
							//fix 0307 maybe this causes modal block not sure
							$("#inquirerID").val(data);
							vieweffect_1();
							$('#addInquirerFieldModal').modal('toggle');
							//test 0309 
							// return true;
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						bootbox.dialog({
							message: "Failed to add new inquirer.",
							title: "Failed",
							buttons: {
								main: {
									label: "OK",
									className: "btn-primary"
								}
							}
						});
					}
				});
			});

		});
		
	</script>	

	<script>
		
		function findSimilarInquirers(){
			var check = $("#new_inquirer_form").serializeArray();
			var flag = 0;
			for (var each in check) {
				console.log(each);
			    if (check[each]['name'] != "_token" && check[each]['value'] != "" && check[each]['value'] != null) {
			    	flag = 1;
			    	break;
			    }
			}
			if (flag == 0) {
				bootbox.dialog({
					message: "At least one field should be filled!",
					title: "Failed",
					buttons: {
						main: {
							label: "OK",
							className: "btn-primary"
						}
					}
				});
				return;
			}

			$("#similarResult").empty();
			var toSend = $("#new_inquirer_form").serialize();

			$.ajax({
				type: "POST",
				dataType: "json",//data type expected from server
				url: "/inquirer/search/similar=0",
				data: toSend,
				success: function(data) {
					console.log(data);
					if (data.length == 0) {
						$("#new_inquirer_form").submit();
					} 
					else {
						$('#inquirerSubmitBtn').hide();
						$('#inquirerStillSubmitBtn').show();						
						html = "";
						html += "<div style='color:red'>We found some similar owners, do you mean any of them?<br></div>";
						html += "<div style='overflow:auto'>";
						html += "<table class=\"table table-striped table-bordered\">";
						html += "<tr>";
						html += "<th></th>";
						html += "<th style=\"min-width:100px;\">First Name</th>";
						html += "<th style=\"min-width:100px;\">Last Name</th>";
						html += "<th style=\"min-width:120px;\">Phone Number</th>";
						html += "<th style=\"min-width:150px;\">Email</th>";
						html += "<th style=\"min-width:150px;\">Taobao Username</td>";
						html += "<th style=\"min-width:100px;\">WeChat ID</td>";
						html += "<th style=\"min-width:100px;\">Inquirer ID</td>";
						html += "</tr>";
						for (i = 0; i < data.length; i++) {
							html += "<tr>";
							// data-dismiss="modal" is to close the pop up window when clicked
							html += "<td data-dismiss=\"modal\" style='cursor:pointer; text-decoration:underline; color:blue;' onclick='$(\"#inquirerID\").val(\"" + data[i]['inquirerID'] + "\"); vieweffect_1();'>Select</td>";
							html += "<td>" + data[i]['inquirerFirst'] + "</td>";
							html += "<td>" + data[i]['inquirerLast'] + "</td>";
							html += "<td>" + data[i]['inquirerPhoneNumber'] + "</td>";
							html += "<td>" + data[i]['inquirerEmail'] + "</td>";
							html += "<td>" + data[i]['inquirerTaobaoUserName'] + "</td>";
							html += "<td>" + data[i]['inquirerWechatID'] + "</td>";
							html += "<td>" + data[i]['inquirerID'] + "</td>";
							html += "</tr>";
						}
						html +=  "</table></div>";
						$("#similarResult").html(html);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					bootbox.dialog({
						message: "Something's wrong, try again later.",
						title: "Failed",
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
				if(value){
					$(elem)[0].setCustomValidity('Please select a valid value.');
						return;
				}
				else{
					if(elem===$('#country')[0]){
						$('#state').val('');
						$('#city').val('');
					}
					else if(elem===$('#state')[0]){
						$('#city').val('');
					}
				}
			}

			//var url = "/resource/";
			if(elem===$('#country')[0]){
				//url += value.trim();
				$('#state').val('');
				$('#statelist').empty();
				$('#city').val('');
				$.get({
					url:"/resource/"+value,
					type:"GET",
					success: function(data){
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
				$('#city').val('');
				$('#citylist').empty();
				$.get({
					url:"/resource/"+$('#country').val()+'/'+value,
					type:"GET",
					success:function(data){
							$('#citylist').html(data);
						},
					error: function(jqXHR,error){
						alert();
						errorhandler(jqXHR);
					}

				});	
			}
			else{
				if(ele.value=="Other"){
					$('#cityOther').parent.show();
				}
			}

		}

		function HousePair(){
			var data={};
			data['country'] = $('#country').val();
			data['state'] = $('#state').val();
			data['city'] = $('#city').val();
			var para = $.param(data);
			console.log(para);
			window.location.replace("/houses/results?"+para);
		}
	</script>

@endsection
