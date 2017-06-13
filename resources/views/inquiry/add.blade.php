<!DOCTYPE html>
<html>
	<head>
		<title> Add New Inquiry</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

		<!-- jquery -->
		<script src="{{asset('js/jquery.min.js')}}"></script>

		<!-- jquery ui -->
		<script src="{{asset('js/jquery-ui.js')}}"></script>

		<!-- bootstrap -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

		<script src="{{asset('js/bootstrap.min.js')}}"></script>

		<!-- bootstrap phone (local file) -->
		<script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>

		<script src="{{asset('js/util.js')}}"></script>
		<!-- alert box -->
		<script src="{{asset('js/bootbox.min.js')}}"></script>
		<link rel="stylesheet" href="{{asset('css/self.css')}}">

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
			  .form-control {

			  }
			  .title-lg {
				  color: #337AB7;
				  font-size: 20px;
				  font-weight: bold;
			  }
			  .title-sm {
				  color: #337AB7;
				  font-size: 15px;
				  font-weight: bold;
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


		</style>
	</head>

	<body>
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
					  <a class="navbar-brand" style="padding-top:5px;"><img src="{{asset('img/icon.png')}}" class="img-rounded img-responsive" width="45px" height="45px" alt=""></a>
					  <a class="navbar-brand" href="/MainPage">91bnb Manage System</a>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<!-- navbar left -->
					<ul class="nav navbar-nav">
						<li><a href="/MainPage">Home</a></li>
						<li class="active"><a>Add New Inquiry</a></li>
					</ul>
					<!-- navbar right -->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$Rep->repUserName}}<span class="caret"></span></a>
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
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<a role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<span class="title-lg">① </span> <span class="title-sm">Select or Create Inquirer ID</span>
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

								<div class="form-group">
										<div class="col-sm-6 col-sm-offset-4">
											<button class="btn btn-primary btn-sm" type ="submit">Search</button>
											<!-- clear input by refresh page -->
											<button class="btn btn-warning btn-sm" type="reset">Clear</button>   
										</div>
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
									<button class="btn btn-primary" type="submit" id="inquirerStillSubmitBtn">Still Submit</button>
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
						<a class="collapsed" role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<span class="title-lg">② </span> <span class="title-sm">Add New Inquiry</span>
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
											<div>
												<label>Country</label>
												<select name = "country" type = "search" id="country" class="form-control country">
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div>
												<label>State or Province</label>
												<select id="state" name="state" class="form-control">
												<option selected>Select State</option>
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div>
												<label>City</label>
												<select name="city" id="city" class="form-control">
												<option selected>Select City</option>
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div>
												<label>City Other</label>
												<input name="cityOther" id="cityOther" class="form-control" type="search">
											</div>
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
												<select id="Purpose" class="form-control" name="Purpose">
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div style="display:none;" id="PurposeOtherDiv">
												<label>Purpose Other</label>
												<input id="PurposeOther" class="form-control" name="PurposeOther" placeholder="Enter Purpose">
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

										<div class="col-lg-3">
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
												<select name = "houseType" id="houseType" class="form-control">
													<?//php listtoselect("../list/houseTypeList"); ?>
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div id="houseTypeOtherDiv" style="display:none;">
												<label>House Type Other</label>
												<input id = "houseTypeOther" name = "houseTypeOther" class="form-control" placeholder="Enter House Type">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-3">
											<div>
												<label>Number of Rooms</label>
												<input type = "number" name = "rooms" id = "rooms" min="0" class="form-control"/>
											</div>
										</div>
										<div class="col-lg-3">
											<div>
												<label>Add room type (max 2)</label>
												<button id='addRoomType' type="button" class="btn btn-primary form-control">+</button>
											</div>
										</div>
									</div>

									<div id="roomTypeDiv">
										<div class="row">
											<div class="col-lg-3">
												<div id='room1TypeDiv' style="display:none;">
													<label>Room 1 Type</label>
													<select name = "room1Type" id="room1Type" class="form-control">
													<?//php listtoselect("../list/roomTypeList"); ?>
													</select>
												</div>
											</div>

											<div class="col-lg-3">
												<div id="room1TypeOtherDiv" style="display:none;">
													<label>Room 1 Type Other</label>
													<input name = "room1TypeOther" type = "search" id="room1TypeOther" class="form-control" placeholder="Enter Room Type">
												</div>
											</div>

											<div class="col-lg-3">
												<div id='room2TypeDiv' style="display:none;">
													<label>Room 2 Type</label>
													<select name = "room2Type" id="room2Type" class="form-control">
													<?//php listtoselect("../list/roomTypeList"); ?>
													</select>
												</div>
											</div>

											<div class="col-lg-3">
												<div id="room2TypeOtherDiv" style="display:none;">
													<label>Room 2 Type Other</label>
													<input name = "room2TypeOther" type = "search" id="room2TypeOther" class="form-control" placeholder="Enter Room Type">
												</div>
											</div>

										</div>

										<!-- <div class="row">
											<div class="col-lg-3">
												<div>
													<label>Room 2 Type</label>
													<select name = "room2Type" id="room2Type" class="form-control">
													<?//php listtoselect("../list/roomTypeList"); ?>
													</select>
												</div>
											</div>

											<div class="col-lg-3">
												<div id="room2TypeOtherDiv" style="display:none;">
													<label>Room 2 Type Other</label>
													<input name = "room2TypeOther" type = "search" id="room2TypeOther" class="form-control" placeholder="Enter Room Type">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-lg-3">
												<div>
													<label>Room 3 Type</label>
													<select name = "room3Type" id="room3Type" class="form-control">
													<?//php listtoselect("../list/roomTypeList"); ?>
													</select>
												</div>
											</div>

											<div class="col-lg-3">
												<div id="room3TypeOtherDiv" style="display:none;">
													<label>Room 3 Type Other</label>
													<input name = "room3TypeOther" type = "search" id="room3TypeOther" class="form-control" placeholder="Enter Room Type">
												</div>
											</div>
										</div> -->
									</div>


									<div id="residentInfo">
										<div class="row">
											<div class="col-lg-2">
												<div>
													<label>Number of Adult</label>
													<input name="numOfAdult" type = "number" size = "1" min="0" id="numOfAdult" class="form-control">
												</div>
											</div>

											<div class="col-lg-2">
												<div>
													<label>Number of Kids</label>
													<input name="numOfChildren" type = "number" size = "1" min="0" id="numOfChildren" class="form-control">
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
													<SELECT name="hasBaby" id="hasBaby" class="form-control">
													<OPTION value =  1>Yes</OPTION>
													<OPTION value =  0 selected>No</OPTION>
													</SELECT>
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
			</div>

		</div>  <!-- end of well container -->
		<div class="" style="height:5%"></div>
	</div>
</body>

	<script>

		function loadList(type,element){
			$.get("resource/"+type),function(data,status){
				element.empty();
				for(i=0;i<data.length;++i)
				{
					var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					element.append(option);
				}
			};
		}

		function vieweffect_1(){
			// $('#collapseTwo').collapse({toggle: true, parent: '#accordion'});
			// $('#collapseTwo').collapse({toggle: false});
			$('#collapseOne').collapse('hide');
			$('#collapseTwo').collapse('show');
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
					console.log(data);
					// console.log(Object.keys(data));
					if (Object.keys(data).length === 0) {
						bootbox.dialog({
							message: 'The inquiry is successfully added',
							title: 'Success',
							buttons: {
							  success: {
								  label: 'OK',
								  className: 'btn-primary'
							  }
							}
						});
						$('#adjustLineSpacing')[0].reset();
						vieweffect_2();
					}
					else {
						m = [];
						for (var each in data) {
							m.push(data[each] + " ");
						}
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
				},
				error : function(xhr, ajaxOptions, thrownError){
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
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#inquiryDate").datepicker({
			  dateFormat: "mm/dd/yy",
			  maxDate: 0
			});
			$("#inquiryDate").datepicker("setDate", new Date());

			$('#checkIn').datepicker({
			  dateFormat: "mm/dd/yy",
			  beforeShow: function () {
			  $('#checkIn').datepicker('option', 'minDate', 0);
			  }
			});

			$('#checkOut').datepicker({
			  dateFormat: "mm/dd/yy",
			  beforeShow: function () {
				var checkIn = $('#checkIn').datepicker("getDate");
				if(checkIn){
					checkIn.setDate(checkIn.getDate() + 1);
					$('#checkOut').datepicker('option', 'minDate', checkIn);
				}
			  }
			});


			$("#search_form").submit(function(){
				var toSend = $(this).serialize();
				// $.ajaxSetup({
				//     headers: {
				//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				//     }
				// });
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


			$("#inquirySource").change(function(){
				if($(this).val().trim() == "Other"){
					$("#inquirySourceOtherDiv").show();
				}else{

					$("#inquirySourceOtherDiv").hide();
					$('#inquirySourceOther').val('');//empty input
				}
			});

			$("#Purpose").change(function(){
				if($(this).val().trim() == "Other"){
					$("#PurposeOtherDiv").show();
				}else{
					$("#PurposeOtherDiv").hide();
					$('#PurposeOtherDiv').val('');//empty input
				}
			});

			$("#houseType").change(function(){
				if($(this).val().trim() == "Other"){
					$("#houseTypeOtherDiv").show();
				}else{
					$("#houseTypeOtherDiv").hide();
					$('#houseTypeOtherDiv').val('');//empty input
				}
			});

			$('#addRoomType').click(function() {
				console.log($('#room1TypeDiv').css('display'));
				if ($('#room1TypeDiv').css('display') != 'none') {
					$('#room2TypeDiv').show();
				}
				else {
					$('#room1TypeDiv').show();
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

			// Load list 
			loadOpt();
		});
		
	</script>	

	<script>
		function findSimilarInquirers(){
			$("#similarResult").empty();
			var toSend = $("#new_inquirer_form").serialize();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "POST",
				dataType: "json",//data type expected from server
				url: "/inquirer/search/similar=0",
				data: toSend,
				success: function(data) {
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
	</script>

</html>