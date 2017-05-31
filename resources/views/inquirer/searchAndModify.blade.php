<!doctype html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>Modify Inquirer</title>

		<!-- JQuery -->
		<script src="{{asset('js/jquery.min.js')}}"></script>

		<!-- Bootstrap -->
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/self.css')}}">

		<!-- bootstrap phone -->
		<script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>

		<style type="text/css">
			body {
				line-height: 200%;
			}
			.row {
				margin-bottom: 18px;
			}
			.btn-width { 
				width: 150px;
			}
			.gap-top { 
				margin-top:25px;
			}
			.gap-left {
				margin-left: 25px;
			}
			.bg1 { 
				background-color: #F5F5F5;
				padding: 10px;
			}
			.badge {
				font-size: 25px; 
				background-color: #5CB85C
			};
		</style>

		<script type="text/javascript">
			function phoneFormatting(num){
				num = num.trim();
				num = num.replace(/[^0-9\.]/g, '');
				if(num.length!=0){
					return "(" + num.substring(0,3) + ") " + num.substring(3,6) + "-" + num.substring(6,10);
				} else {
				  return "";
				}
			}

			function selectInquirer(json) {
				$("#modifyForm").hide();
				$("#modifyForm").show();
				console.log(json);

				$("#inquirerID").val(json.inquirerID);
				$("#inquirerFirst").val(json.inquirerFirst);
				$("#inquirerLast").val(json.inquirerLast);
				$("#inquirerUsPhoneNumber").val(json.inquirerUsPhoneNumber);
				$("#inquirerPhoneCountry").val(json.inquirerPhoneCountry);
				$("#inquirerPhoneNumber").val(json.inquirerPhoneNumber);
				$("#inquirerEmail").val(json.inquirerEmail);
				$("#inquirerTaobaoUserName").val(json.inquirerTaobaoUserName);
				$("#inquirerWechatUserName").val(json.inquirerWechatUserName);
				$("#inquirerWechatID").val(json.inquirerWechatID);
				$("#inquirerCountry").val(json.inquirerCountry);

				if(json.inquirerCountry == 'China' || json.inquirerCountry == 'United States' || json.inquirerCountry == 'United Kingdom'){
					$.ajax({
						type: "GET",
						dataType: "json",//data type expected from server
						url: "/resource/" + json.inquirerCountry,
						success: function(data) {
							$("#inquirerState").html("");
							for (i = 0; i < data.length; i++) {
								$("#inquirerState").append("<option value='" + data[i] + "'>" + data[i] + "</option>");
							}
							$("#inquirerState").val(json.inquirerState);
							$('#inquirerCityOther').val('');
							$('#inquirerStateOther').val('');
							$(".inquirerStateOtherDiv").hide();
							$.ajax({
								type: "GET",
								dataType: "html",//data type expected from server
								url: "/resource/" + json.inquirerCountry + "/" + json.inquirerState,
								success: function(data) {
									$("#inquirerCity").html(data);
									$("#inquirerCity").val(json.inquirerCity);
									console.log(json.inquirerCity);
									if(json.inquirerCity == "Other"){
										$("#inquirerCityOtherDiv").show();
										$('#inquirerCityOther').val(json.inquirerCityOther);//empty input
									} else {
										$("#inquirerCityOtherDiv").hide();
										$('#inquirerCityOther').val('');//empty input
									  
									}
								}
							});
						}
					});
				} else {
					console.log("other country");
					// $("#inquirerState").hide();
					$(".inquirerStateOtherDiv").show();
					$('#inquirerState').empty();
					$("#inquirerState").append("<option value='InputState'>Input State</option>");  //添加一项option                  
					$('#inquirerStateOther').val(json.inquirerState);

					$('#inquirerCity').empty();
					$('#inquirerCityOther').val(json.inquirerCity);
					$("#inquirerCity").append("<option value='InputCity'>Input City</option>");
					$("#inquirerCityOtherDiv").show();
				}
			}

			$(document).ready(function(){
				$("#modifyForm").hide();
				$("#resetBtn").click(function() {
					$("#inquirerList").hide();
					$("#modifyForm").hide();
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
						$(".inquirerStateOtherDiv").hide();
						$("#inquirerCityOtherDiv").hide();
						$('#inquirerStateOther').val('');//empty input
						$('#inquirerCityOther').val('');//empty input
						// $("#inquirerCity").load('../list/State_City_Option/' + state + 'CityListOption');
					} else {
						console.log("other country");
						// $("#inquirerState").hide();
						$(".inquirerStateOtherDiv").show();
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

				$("#inquirer_search_form").submit(function(){
					$('.alert').alert('close')
					var toSend = $(this).serialize();
					console.log(toSend);
					$("#modifyForm").hide();
					$.ajax({
						type: "POST",
						dataType: "json",//data type expected from server
						url: "searchForModify",
						data: toSend,
						success: function(data) {
							html = "";
							if (data.length == 0) {
								html = "<span style='color:red;'>No inquirer is found.</span>";
							}
							else {
								html += "<h4><span class='badge'>2</span> Select Inquirer</h4><hr>";
								html += "<div style='overflow:auto'>";
								html += "<table class='table table-striped table-bordered'>";
								html += "<tr>";
								html += "<th style='min-width:50px;'></th>";
								html += "<th style='min-width:130px;'>Inquirer ID</th>";
								html += "<th style='min-width:110px;'>First Name</th>";
								html += "<th style='min-width:110px;'>Last Name</th>";
								html += "<th style='min-width:200px;'>U.S. Phone Number</th>";
								html += "<th style='min-width:200px;'>Other Phone Country</th>";
								html += "<th style='min-width:180px;'>Phone Number</th>";
								html += "<th style='min-width:150px;'>Email</th>";
								html += "<th style='min-width:200px;'>Inquirer Taobao Username</th>";
								html += "<th style='min-width:200px;'>WeChat Username</th>";
								html += "<th style='min-width:150px;'>WeChat ID</th>";
								html += "<th style='min-width:150px;'>Origin Country</th>";
								html += "<th style='min-width:150px;'>Origin State</th>";
								html += "<th style='min-width:150px;'>Origin City</th>";
								html += "<th style='min-width:150px;'>Origin City Other</th>";
								html += "</tr>";
								
								for (i = 0; i < data.length; i++) {
									html += "<tr>";
									html += "<td style='cursor:pointer; text-decoration:underline; color:blue;' onClick='selectInquirer(" + JSON.stringify(data[i]) + ")'>Select</td>";
									html += "<td>" + data[i]['inquirerID'] + "</td>";
									html += "<td>" + data[i]['inquirerFirst'] + "</td>";
									html += "<td>" + data[i]['inquirerLast'] + "</td>";
									html += "<td>" + phoneFormatting(data[i]['inquirerUsPhoneNumber']) + "</td>";
									html += "<td>" + data[i]['inquirerPhoneCountry'] + "</td>";
									html += "<td>" + data[i]['inquirerPhoneNumber'] + "</td>";
									html += "<td>" + data[i]['inquirerEmail'] + "</td>";
									html += "<td>" + data[i]['inquirerTaobaoUserName'] + "</td>";
									html += "<td>" + data[i]['inquirerWechatUserName'] + "</td>";
									html += "<td>" + data[i]['inquirerWechatID'] + "</td>";
									html += "<td>" + data[i]['inquirerCountry'] + "</td>";
									html += "<td>" + data[i]['inquirerState'] + "</td>";
									html += "<td>" + data[i]['inquirerCity'] + "</td>";
									html += "<td>" + data[i]['inquirerCityOther'] + "</td>";
									html += "</tr>";
								}
							}
							$("#inquirerList").html(html);
							$("#inquirerList").show();
						}
					});
					return false;
				});

			});
		</script>
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
						<li class="active"><a>Show All Inquirers</a></li>
					</ul>
					<!-- navbar right -->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-user"></span>
								<span id="username"> {{$rep->repUserName}} </span>
								<span class="caret"></span>
							</a>
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
			<form method = "post" id="inquirer_search_form" onsubmit="return false">
				{{ csrf_field() }}
				<h4><span class="badge">1</span> Inquirer Filter</h4>
				<hr>
				<div class="row">
					<div class="col-lg-2">
						<label>First Name</label>
						<input type="text" name="inquirerFirst" class="form-control">
					</div>
					<div class="col-lg-2">
						<label>Last Name</label>
						<input type="text" name="inquirerLast" class="form-control">
					</div>
				</div>



				<div class="row">
					<div class="col-lg-2">
						<label>U.S. Phone Number</label>
						<input type="text" name="inquirerUsPhoneNumber" class="bfh-phone form-control" data-format="(ddd) ddd-dddd">
					</div>

					<div class="col-lg-3">
						<label>Email</label>
						<input type="text" name="inquirerEmail" class="form-control">
					</div>
				</div>


				<div class="row">
					<div class="col-lg-2">
						<label>Taobao Username</label>
						<input type="text" name="inquirerTaobaoUserName" class="form-control">
					</div>

					<div class="col-lg-2">
						<label>WeChat ID</label>
						<input type="text" name="inquirerWechatID" class="form-control">
					</div>
				</div>

				<div class="row gap-top">
					<div class="col-lg-2">
						<button class="btn btn-success form-control" type="submit" name="inquirer_search_submit">Get Inquirer Info</button>
					</div>
					<div class="col-lg-1">
						<button id="resetBtn" class="btn btn-warning form-control" type="reset">Clear</button>
					</div>
				</div>
				<hr>
			</form>
		</div>

		@if (Session::has('status'))
			<div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-left:150px;margin-right:150px;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Success!</strong> The inquirer has been modified.
			</div>

			<!-- <div class="alert alert-success fade in alert-dismissable" style="margin-left:150px;margin-right:150px;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
				<strong>Success!</strong> The inquirer has been modified.
			</div> -->
		@endif
	
		<div id="inquirerList" class="container"></div>

		<div id="modifyForm" class="container" style="display:none;">
			<hr>
			<h4><span class="badge">3</span> Modify Inquirer</h4>
			<hr>
			<form style='margin-bottom:5px;' action='modifyInquirer' method = 'post'>
				{{ method_field('PATCH') }}
				{{ csrf_field() }}
				<div class="row">
					<div class="col-lg-2">
						<label>Inquirer ID</label>
						<input type="text" name='inquirerID' id='inquirerID' class="form-control" readonly>
					</div>

					<div class="col-lg-2">
						<label>First Name</label>
						<input type="text" name='inquirerFirst' id='inquirerFirst' class="form-control">
					</div>

					<div class="col-lg-2">
						<label>Last Name</label>
						<input type="text" name='inquirerLast' id='inquirerLast' class="form-control">
					</div>
				</div>


				<div class="row">
					<div class="col-lg-2">
						<label>U.S. Phone Number</label>
						<input type="text" name='inquirerUsPhoneNumber' id='inquirerUsPhoneNumber' class="bfh-phone form-control" data-format="(ddd) ddd-dddd">
					</div>
					<div class="col-lg-2">
						<label>Other Phone Country</label>
						<select class="form-control" type='search' name='inquirerPhoneCountry' id='inquirerPhoneCountry'>
						</select>
					</div>
					<div class="col-lg-2">
						<label>Other Phone Number</label>
						<input type="text" name='inquirerPhoneNumber' id='inquirerPhoneNumber' class="form-control">
					</div>
				</div>



				<div class="row">
					<div class="col-lg-2">
						<label>Email</label>
						<input type="text" name='inquirerEmail' id='inquirerEmail' class="form-control">
					</div>
				</div>


				<div class="row">
					<div class="col-lg-2">
						<label>Taobao Username</label>
						<input type="text" name='inquirerTaobaoUserName' id='inquirerTaobaoUserName' class="form-control">
					</div>
					<div class="col-lg-2">
						<label>WeChat Username</label>
						<input type="text" name='inquirerWechatUserName' id='inquirerWechatUserName' class="form-control">
					</div>
					<div class="col-lg-2">
						<label>WeChat ID</label>
						<input type="text" name='inquirerWechatID' id='inquirerWechatID' class="form-control">
					</div>
				</div>


				<div class="row">
					<div class="col-lg-2">
						<label>Origin Country</label>
						<select name = "inquirerCountry" id="inquirerCountry" class="form-control">
						</select>
					</div>

					<div class="col-lg-2">
						<label>Origin State</label>
						<select name = "inquirerState" id="inquirerState" class="form-control">
						</select>
					</div>

					<div class="col-lg-2">
						<label>Origin City</label>
						<select name = "inquirerCity" id="inquirerCity" class="form-control">
						</select>
					</div>
			 <!--        <div class="col-lg-2" id="inquirerCityOtherDiv">
						<label>Origin City Other</label>
						<input name = "inquirerCityOther" id="inquirerCityOther" class="form-control">               
					</div> -->
				</div>
				<!-- fix 0309 -->
				<div class="row">
					<div class="col-lg-2">
					</div>
					<div class="col-lg-2" >
						<input name = "inquirerStateOther" id="inquirerStateOther" class="form-control inquirerStateOtherDiv">
					</div>
					<div class="col-lg-2" id='inquirerCityOtherDiv'>
						<input name = "inquirerCityOther" id="inquirerCityOther" class="form-control">
					</div>
				</div>


				<hr>
				<div class="row">
					<div class="col-lg-2">
					  <button class='btn btn-success form-control' type='submit'>Save Modified Info</button>
					</div>
				</div>

			</form>
		</div>
	</body>
</html>
