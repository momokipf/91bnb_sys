@extends('navbar')
@section('title', 'Representatives')

@section('head')

	<script src="{{asset('js/bootbox.min.js')}}"></script>

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
@endsection

@section('content')

	<div class='content container'>
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
						<!-- <th>Rep Name</th> -->
						<th style="min-width:100px;">Rep Priority</th>
						<th>Rep Position</th>
						<!-- <th>Employee ID</th> -->
						<th>Rep FirstName</th>
						<th>Rep LastName</th>
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
								<td><input type='password' id='repPassword{{$thisrep->repID}}' value="******"></td>
								<!-- <td><input type='text' id='repName{{$thisrep->repID}}' value={{ $thisrep->repName }}></td> -->
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
								<!-- <td><input type='text' id='employeeID{{$thisrep->repID}}' value={{ $thisrep->employeeID }}></td> -->
								<td><input type='text' id='repFirstName{{$thisrep->repID}}' value={{ $thisrep->repFirstName }}></td>
								<td><input type='text' id='repLastName{{$thisrep->repID}}' value={{ $thisrep->repLastName }}></td>
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
			<form onsubmit='return false;' method='POST' id="addForm" class='form-horizontal'>
			<!-- <form method='POST' id="addForm" class='form-horizontal' action='/representatives/add'> -->
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
								<div class="alert alert-danger" id='errorDiv' style="display:none">
									<!-- <strong>Whoops!</strong> There were some problems with your input.
									<br/>
									<ul>
										@foreach($errors->all() as $error)
										<li>{{ $error }}</li>
										@endforeach
									</ul> -->
								</div>
								<div class='row' style='margin-bottom:5px;'>
									<div class='col-sm-5 control-label'><span style="color:red">*</span>Representative User Name: </div>
									<div class='col-sm-4'><input class="form-control input-sm" type='text' name="repUserName" id='UserName' autocomplete='off' ></div>
								</div>
								<div class='row' style='margin-bottom:5px;'>
									<div class='col-sm-5 control-label'><span style="color:red">*</span>Representative Password: </div>
									<div class='col-sm-4'><input class="form-control input-sm" type='password' name="password" id='Password' autocomplete='off' ></div>
								</div>
								<!-- <div class='row'>
									<div class='col-sm-5'>Representative Name: </div>
									<div class='col-sm-7'><input type='search' name="repName" id='repName' autocomplete='off' ></div>
								</div> -->
								<div class='row' style='margin-bottom:5px;'>
									<div class='col-sm-5 control-label'>Representative Priority: </div>
									<div class='col-sm-4'>
										<select class="form-control input-sm" id='repPriority' name="repPriority">
											<option value=1 selected>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option><option value=5>5</option>
										</select>
									</div>
								</div>
								<div class='row' style='margin-bottom:5px;'>
									<div class='col-sm-5 control-label'>Representative Position: </div>
									<div class='col-sm-4'>
										<select class="form-control input-sm" id='repPosition' name="repPosition">
											<option value='Admin' selected>Admin</option><option value='ACCT'>ACCT</option><option value='BD'>BD</option><option value='IT'>IT</option><option value='Marketing'>Marketing</option><option value='Temp'>Temp</option>
										</select>
									</div>
								</div>
								<div class='row' style='margin-bottom:5px;'>
									<hr>
								</div>
								<!-- <div class='row'>
									<div class='col-sm-5'>Employee ID: </div>
									<div class='col-sm-7'><input type='search' name="employeeID" id='employeeID' ></div>
								</div> -->
								<div class='row' style='margin-bottom:5px;'>
									<div class='col-sm-5 control-label'>Rep First Name: </div>
									<div class='col-sm-4'><input class="form-control input-sm" type='text' name="repFirstName" id='repFirstName' autocomplete='off' ></div>
								</div>
								<div class='row' style='margin-bottom:5px;'>
									<div class='col-sm-5 control-label'>Rep Last Name: </div>
									<div class='col-sm-4'><input class="form-control input-sm" type='text' name="repLastName" id='repLastName' autocomplete='off' ></div>
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
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js/jquery-1.11.3.js') }}"></script>
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
							var password = document.getElementById('repPassword'+repID).value;
							// var repName = document.getElementById('repName'+repID).value;
							var repPriority = document.getElementById('repPriority'+repID).value;
							var repPosition = document.getElementById('repPosition'+repID).value;
							// var employeeID = document.getElementById('employeeID'+repID).value;
							var repFirstName = document.getElementById('repFirstName'+repID).value;
							var repLastName = document.getElementById('repLastName'+repID).value;

							if (password == "******") {
								toSend = {"repID": repID, "active": active, "repUserName": repUserName, "repPriority": repPriority, "repPosition": repPosition, "repFirstName": repFirstName, "repLastName": repLastName};
							}
							else {
								toSend = {"repID": repID, "active": active, "repUserName": repUserName, "password": password, "repPriority": repPriority, "repPosition": repPosition, "repFirstName": repFirstName, "repLastName": repLastName};								
							}
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
												callback: function() {
													location.reload();
												}
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
												className: "btn-danger",
												callback: function() {
													location.reload();
												}
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
				dataType: "json",
				url: "representatives/add",
				data: toSend,
				success: function(data) {
					console.log(data);
					bootbox.dialog({
						message: "Successfully added a new representative (ID: " + data['id'] + ").",
						title: "Success",
						buttons: {
							main: {
								label: "OK",
								className: "btn-primary",
								callback: function() {
									location.reload();
								}
							}
						}
					});
					$('#myModal').modal('toggle');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr);
					html = "<strong>Whoops!</strong> There were some problems with your input."
					html += "<br><ul>";
					for (i = 0; i < xhr.responseJSON.length; i++) {
						html += "<li>" + xhr.responseJSON[i] + "</li>";
					}
					$("#errorDiv").html(html);
					$("#errorDiv").show();
				}
			});
		});
	</script>


@endsection

