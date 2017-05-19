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
		              <a class="navbar-brand" href="MainPage">91bnb Manage System</a>
		        </div>

		    <div id="navbar" class="navbar-collapse collapse">
		          <!-- navbar left -->
		          <ul class="nav navbar-nav">
		            <li><a href="MainPage">Home</a></li>
		            <li class="active"><a>Add New Inquiry</a></li>
		          </ul>
		          <!-- navbar right -->
		          <ul class="nav navbar-nav navbar-right">
		              <li class="dropdown">
		                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
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

	<div class="container" style="margin-top:70px;">
		<div class="well">
			<span class="title-lg">① </span> <span class="title-sm">Select or Create Inquirer ID</span>
			<hr>
			<div class="row">
			<div class="col-sm-6">
				<h5>Existing inquier?</h5>
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
                                <button class="btn btn-primary btn-sm" type ="sumnit">Search</button>
                                <!-- clear input by refresh page -->
                                <button class="btn btn-warning btn-sm" type="reset">Clear</button>   
                            </div>
                    </div>
				</form>
			</div>
			<div class="col-sm-6">
				<h5>New inquirer?</h5>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addInquirerFieldModal"  onclick="$('#similarResult').empty(); $('#inquirerSubmitBtn').show();">Add New Inquirer</button> 
			</div>
			</div>


			<form method = "POST" id = "nwq_inquirer_form" class='form-horizontal' onsubmit="return false;">
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
										<select class="form-control input-sm" type='search' name='inquirerPhoneCountry'>
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

			<!-- to showHouse.php -->
			<form action="#" method="post" id="adjustLineSpacing" name="toshowhousepage">
				<div class="well">
					<span class="title-lg">② </span> <span class="title-sm">Add New Inquiry</span>
					<hr>
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
								<? //php printHere(); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-3">
							<div>
								<label>Source</label>
								<select id="inquirySource" class="form-control" name="inquirySource">
									<? //php listtoselect("../list/inquirySourceList"); ?>
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
								  <?//php listtoselect("../list/purpose"); ?>
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
								<label>Country</label>
								<select name = "country" type = "search" id="country" class="form-control">
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
								<label>House ID</label>
								<input name = "fullHouseID" type = "search" id="fullHouseID" class="form-control">
							</div>
						</div>

						<div class="col-lg-3">
							<div>
								<label>Number of Rooms</label>
								<input type = "number" name = "rooms" id = "rooms" min="0" class="form-control"/>
							</div>
						</div>
					</div>

					<div class="row">
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
					</div>

					<div id="roomTypeDiv">
						<div class="row">
							<div class="col-lg-3">
								<div>
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
								<div id="room1TypeOtherDiv" style="display:none;">
									<label>Room 1 Type Other</label>
									<input name = "room1TypeOther" type = "search" id="room1TypeOther" class="form-control" placeholder="Enter Room Type">
								</div>
							</div>
						</div>

						<div class="row">
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
						</div>
					</div>

					<div id="houseTypeDiv">
						<div class="row">

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
									<SELECT name="Baby" id="Baby" class="form-control">
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

						<div class="row">
							<div class="col-lg-2">
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
					</div>

					<div class="row">
						<div class="col-lg-12 text-center">
							<input class="btn btn-primary text-center" style="width:200px;" type="button" onclick="addinquirydata()" value="Submit">
						</div>
					</div>
				</div>
			</form>

		</div>  <!-- end of well container -->
		<div class="" style="height:5%"></div>
	</div>
</body>

	<script type="text/javascript">
			$(document).ready(function(){
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
						url: 'inquiry/search',
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
									htmlcont += "<tr><td data-dismiss='modal' style='cursor:pointer; text-decoration:underline; color:blue;'>Select</td>"+
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
						}
						,
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

				$('#new_inquirer_form').submit(function(){
					var toSend = $(this).serialize();
					$.ajax({
						type:"POST",
						dataType:"json",
						url:"#",
						data:toSend,
						success: function(){
							alert("success");
						}
						,
						error: function(xhr, ajaxOptions, thrownError){
							alert("error");
						}
					}
					);
				});
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
					url: "inquiry/search/similar=0",
					data: toSend,
					success: function(data) {
						if (data.length==0) {
							$("#new_inquirer_form").submit();
						} 
						else {
							$('#inquirerSubmitBtn').hide();
							$("#similarResult").html(data);             
						}
					}
					,
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