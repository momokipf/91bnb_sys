<!doctype html>
<html lang="{{ config('app.locale') }}">
	<head>
		<title>Show All Representatives</title>

		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!--  Bootstrap CSS  -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

		<!--  Defined CSS  -->
		<link rel="stylesheet" href="{{asset('css/self.css')}}">
		<link rel="stylesheet" href="{{asset('css/loader.css')}}">
		<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

		<script type="text/javascript" src="{{ asset('js/jquery-1.11.3.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js')}}"></script>
		<script src="{{ asset('js/bootstrap-formhelpers-phone.js')}}"></script>
		<script src="{{ asset('js/bootbox.min.js')}}"></script>

		<style>
			body{
	/*       	font-family: "Serif";*/
				background-image: url(../img/bg_sf2.jpg);
				background-size: cover;
			}
			input[type="search"]::-webkit-search-cancel-button{
				-webkit-appearance: searchfield-cancel-button;
			}
			.glyphicon.glyphicon-time{
				font-size: 25px;
			}
			.table-bordered tr,
				.table-bordered td {
				border: 1px solid #C1C1C1 !important;
			}
			.trans{
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3f000000',endColorstr='#3f000000');
				background-color:rgba(255, 255, 255, 0.78)
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
						<li class="active"><a>Representatives</a></li>
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
								<li><a href="../logout.php">Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div><!--/.nav-collapse -->

			</div><!--/ container -->
		</nav>

		<div class='content container' style='margin-top:50px;'>
			<div class='well trans' style='margin-top:10px;'>
				<h3 style="text-align:center;">
					Represenataives
				</h3>
				<div class="table-responsive">
					<table style='text-align:center;' class='table table-bordered'>
						<tr>
							<th style="min-width:110px;">Active or Not</th>
							<th>Modify</th>
							<th>Active</th>
							<th>Rep UserName</th>
							<th>Rep Password</th>
							<th>Rep Name</th>
							<th style="min-width:100px;">Rep Priority</th>
							<th>Rep Position</th>
							<th>Employee ID</th>
							<th>Employee FirstName</th>
							<th>Employee LastName</th>
						</tr>

						<tbody id="mytable">
							@foreach ($reps as $thisrep)
								<tr style='text-align:center;'>

									@if ($thisrep->active == 1)
										<td><i class="glyphicon glyphicon-time" style="color:green"></i></td>
									@else
										<td><i class="glyphicon glyphicon-time" style="color:grey"></i></td>
									@endif
									<td>
										<button type='button' class='btn btn-primary btn-sm' onclick='modifyRow({{$thisrep->repID}})'>
											<span class='glyphicon glyphicon-edit'></span>
											Modify
										</button>
									</td>
									@if ($thisrep->active == 1)
										<td><select id='active{{$thisrep->repID}}'><option value=1 selected>Yes</option><option value=0>No</option></td>
									@else
										<td><select id='active{{$thisrep->repID}}'><option value=1>Yes</option><option value=0 selected>No</option></td>
									@endif
									<td><input type='text' id='repUserName{{$thisrep->repID}}' value={{ $thisrep->repUserName }}></td>
									<td><input type='text' id='repPassword{{$thisrep->repID}}' value={{ $thisrep->repPassword }}></td>
									<td><input type='text' id='repName{{$thisrep->repID}}' value={{ $thisrep->repName }}></td>
									<td style="min-width:100px;">
										<select id='repPriority{{$thisrep->repID}}'>
											@for ($i = 1; $i <= 5; $i++)
												@if ($thisrep->repPriority == $i)
													<option value="{{$i}}" selected>{{$i}}</option>
												@else
													<option value="{{$i}}">{{$i}}</option>
												@endif
											@endfor
										</select>
									</td>
									<td>
										<select id='repPosition{{$thisrep->repID}}'>
											@foreach (["Admin", "ACCT", "BD", "IT", "Marketing", "Temp"] as $position)
												@if ($thisrep->repPosition == $position)
													<option value="{{$position}}" selected>{{$position}}</option>
												@else
													<option value="{{$position}}">{{$position}}</option>
												@endif
											@endforeach
										</select>
									</td>
									<td><input type='text' id='employeeID{{$thisrep->repID}}' value={{ $thisrep->employeeID }}></td>
									<td><input type='text' id='employeeFirstName{{$thisrep->repID}}' value={{ $thisrep->employeeFirstName }}></td>
									<td><input type='text' id='employeeLastName{{$thisrep->repID}}' value={{ $thisrep->employeeLastName }}></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div align="center">
					{{ $reps->links() }}
				</div>

				<div style='padding:10px;'>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
						<span class='glyphicon glyphicon-plus'></span>
						New Representatives
					</button>
				</div>

				<!------------------------- modal fade of add representative form -------------->
				<form method='POST' onsubmit='return false;' id="addForm">
					{{ csrf_field() }}
					<div class='modal fade' id='myModal' role='dialog'>
						<div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">
										<span style='color:#337AB7' class='glyphicon glyphicon-plus'></span> Add New Representative
									</h4>
								</div>
								<div class="modal-body">
									<div class='row'>
										<div class='col-sm-5'>Representative User Name: </div>
										<div class='col-sm-7'><input type='search' name="repUserName" id='UserName' autocomplete='off' ></div>
									</div>
									<div class='row'>
										<div class='col-sm-5'>Representative Password: </div>
										<div class='col-sm-7'><input type='search' name="repPassword" id='Password' autocomplete='off' ></div>
									</div>
									<div class='row'>
										<div class='col-sm-5'>Representative Name: </div>
										<div class='col-sm-7'><input type='search' name="repName" id='repName' autocomplete='off' ></div>
									</div>
									<div class='row'>
										<div class='col-sm-5'>Representative Priority: </div>
										<div class='col-sm-7'>
											<select id='repPriority' name="repPriority">
												<option value=1 selected>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option><option value=5>5</option>
											</select>
										</div>
									</div>
									<div class='row'>
										<div class='col-sm-5'>Representative Position: </div>
										<div class='col-sm-7'>
											<select id='repPosition' name="repPosition">
												<option value='Admin' selected>Admin</option><option value='ACCT'>ACCT</option><option value='BD'>BD</option><option value='IT'>IT</option><option value='Marketing'>Marketing</option><option value='Temp'>Temp</option>
											</select>
										</div>
									</div>
									<div class='row'>
										<hr>
									</div>
									<div class='row'>
										<div class='col-sm-5'>Employee ID: </div>
										<div class='col-sm-7'><input type='search' name="employeeID" id='employeeID' ></div>
									</div>
									<div class='row'>
										<div class='col-sm-5'>Employee First Name: </div>
										<div class='col-sm-7'><input type='search' name="employeeFirstName" id='employeeFirstName' autocomplete='off' ></div>
									</div>
									<div class='row'>
										<div class='col-sm-5'>Employee Last Name: </div>
										<div class='col-sm-7'><input type='search' name="employeeLastName" id='employeeLastName' autocomplete='off' ></div>
									</div>
								</div>
								<div class="modal-footer">
									<button type='submit' class='btn btn-primary'>Submit</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

	</body>
	<script>
		function modifyRow(repID) {
			bootbox.dialog({
				message: 'Do you really want to modify?',
				title: 'Modify Confirmation',
				buttons: {
					success: {
						label: 'Yes',
						className: 'btn-success',
						callback: function() {
							var active = document.getElementById('active'+repID).value;
							var repUserName = document.getElementById('repUserName'+repID).value;
							var repPassword = document.getElementById('repPassword'+repID).value;
							var repName = document.getElementById('repName'+repID).value;
							var repPriority = document.getElementById('repPriority'+repID).value;
							var repPosition = document.getElementById('repPosition'+repID).value;
							var employeeID = document.getElementById('employeeID'+repID).value;
							var employeeFirstName = document.getElementById('employeeFirstName'+repID).value;
							var employeeLastName = document.getElementById('employeeLastName'+repID).value;

							toSend = {"repID": repID, "active": active, "repUserName": repUserName, "repPassword": repPassword, "repName": repName, "repPriority": repPriority, "repPosition": repPosition, "employeeID": employeeID, "employeeFirstName": employeeFirstName, "employeeLastName": employeeLastName};
							//toSend = {name: "John"};
							$.ajax({
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								type: "POST",
								url: '/representatives/update',
								data: toSend,
								success: function(data) {
									bootbox.dialog({
										message: 'Successfully Modified',
										title: 'Modify Status',
										buttons: {
											success: {
												label: 'OK',
												className: 'btn-success',
											}
										}
									});
								},
								error: function (xhr, ajaxOptions, thrownError) {
									bootbox.dialog({
										message: "Unsuccessfully Modified",
										title: "Modify Status",
										buttons: {
											success: {
												label: "OK",
												className: "btn-danger"
											}
										}
									});
								}
							});
						}
					},
					danger: {
						label: 'No',
						className: 'btn-danger'
					}
				}
			});
		}

		$("#addForm").submit(function() {
			var toSend = $("#addForm").serialize();
			console.log(toSend);
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: "POST",
				dataType: "html",
				url: "representatives/add",
				data: toSend,
				success: function(data) {
					if (data.substring(data.length-5, data.length) == "error") {
						bootbox.dialog({
							message: "Failed to add new inquirer. Please try again later.",
							title: "Modify Status",
							buttons: {
								main: {
									label: "OK",
									className: "btn-primary"
								}
							}
						});
					} else {
						bootbox.dialog({
							message: "Successfully added new representative. ID: " + data,
							title: "Modify Status",
							buttons: {
								main: {
									label: "OK",
									className: "btn-primary"
								}
							}
						});
						$('#myModal').modal('toggle');
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
	</script>
</html>
