@extends('navbar')
@section('title', 'Modify Inquiry')

@section('head')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

	<script src="{{asset('js/jquery-ui.js')}}"></script>
	
@endsection
@section('content')
	<div class="container" style="margin-top:70px;">
		<form method="post" id="modifyForm" action="/inquiry/update/{{$inquiry->inquiryID}}">
			{{csrf_field()}}
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#basic">Basic</a></li>
				<li><a data-toggle="tab" href="#house">House and Date</a></li>
				<li><a data-toggle="tab" href="#note">Special Note</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="basic">
					<div class='row'>
						<!-- inquiry ID -->
						<div class='col-lg-2'>
							<label>Inquiry ID</label>
							<input name='inquiryID' value="{{$inquiry->inquiryID}}" class='form-control input-sm' disable>
						</div>
						<!-- house owner ID -->
						<div class='col-lg-2'>
							<label>House Owner ID</label>
							<input name='houseOwnerID' value="DD" class='form-control input-sm' readonly>
						</div>
						<!-- representative -->
						<div class='col-lg-3'>
							<label>Representative</label>
							<select id="repID" class="form-control" name="repWithOwner">
							@foreach ($Allreps as $repre)
								@if ($repre->repUserName == $inquiry->represent->repUserName)
									<option selected value={{$repre->repID}}>{{$repre->repUserName}}</option>
								@else
									<option value={{$repre->repID}}>{{$repre->repUserName}}</option>
								@endif
							@endforeach
							</select>
						</div>
						<div class="col-lg-2">
							<label>Priority Level</label>
							<select id="inquiryPriorityLevel" name = "inquiryPriorityLevel" type = "number" class="form-control">
								<option @if($inquiry->inquiryPriorityLevel ==1) selected @endif>1</option>
								<option @if($inquiry->inquiryPriorityLevel ==2) selected @endif>2</option>
								<option @if($inquiry->inquiryPriorityLevel ==3) selected @endif>3</option>
								<option @if($inquiry->inquiryPriorityLevel ==4) selected @endif>4</option>
								<option @if($inquiry->inquiryPriorityLevel ==5) selected @endif>5</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<label>Country<span style='color:red;'>*</span></label>
							<input id="country" name="country" class="form-control input-sm" onchange="georesponse(this)" value="{{$inquiry->country}}" list="countrylist">
							<datalist id="countrylist" class="country">
							</datalist>
						</div>
						<div class="col-lg-2">
							<label>State or Province<span style='color:red;'>*</span></label>
							<input id="state" name="state" class="form-control input-sm" onchange="georesponse(this)" value="{{$inquiry->state}}" list="statelist">
							<datalist id="statelist">
							</datalist>
						</div>
						<div class="col-lg-2">
							<label>City<span stype='color:red;'>*</span></label>
							<input id= "city" name="city" class="form-control input-sm" value="{{$inquiry->city}}" list="citylist">
							<datalist id="citylist">
							</datalist>
						</div>
						<div class="col-lg-3">
							<div>
								<label>City Other</label>
								<input name="cityOther" id="cityOther" class="form-control" type="search" value="{{$inquiry->cityOther}}">
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-2">
							<div>
								<label>Source</label>
								<select id="inquirySource" class="form-control" name="inquirySource" value="{{$inquiry->inquirySource}}">
								</select>
							</div>
						</div>
						<div class="col-lg-2" id="inquirySourceOtherDiv" style="display:none;">
								<label>Source Other</label>
								<input id="inquirySourceOther" class="form-control" name="inquirySourceOther" placeholder="Enter Source" value="{{$inquiry->inquirySourceOther}}">
						</div>
						<div class="col-lg-2">
							<div>
								<label>Purpose</label>
								<select id="purpose" class="form-control purpose" name="purpose">
								</select>
							</div>
						</div>

						<div class="col-lg-2" id="purposeOtherDiv" style="display:none;">
							<label>Purpose Other</label>
							<input id="purposeOther" class="form-control" name="purposeOther" placeholder="Enter Purpose" value="{{$inquiry->purposeOther}}">
						</div>
					</div>
				</div>
				<div id="house" class="tab-pane fade" >
					<div class="row">
						<div class="col-lg-3">
							<div>
								<label>Inquiry Date</label>
								<input name="inquiryDate" id="inquiryDate" class="form-control" type="search" value="{{$inquiry->inquiryDate}}" placeholder="mm/dd/yyyy">
							</div>
						</div>

						<div class="col-lg-3">
							<div>
								<label>Check-In Date</label>
								<input name = "checkIn" class="form-control" type = "search" id="checkIn" value="{{$inquiry->checkIn}}" placeholder="mm/dd/yyyy">
							</div>
						</div>

						<div class="col-lg-3">
							<div>
								<label>Check-Out Date</label>
								<input name = "checkOut" class="form-control" type = "search" id="checkOut" value="{{$inquiry->checkOut}}" placeholder="mm/dd/yyyy">
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-3">
							<div>
								<label>House ID</label>
								<input name = "fullHouseID" type = "search" id="fullHouseID" class="form-control" value="{{$inquiry->fullHouseID}}">
							</div>
						</div>

						<div class="col-lg-3">
							<div>
								<label>Whole/Share</label>
								<SELECT id='share' name='share' class="form-control">
								<OPTION value =  0  @if($inquiry->share ==0) selected @endif>Either</OPTION>
								<OPTION value =  -1 @if($inquiry->share ==-1)selected @endif>Share</OPTION>
								<OPTION value = 1   @if($inquiry->share ==1) selected @endif>Whole</OPTION>
								</SELECT>
							</div>
						</div>

						<div class="col-lg-3">
							<div>
								<label>House Type</label>
								<select name = "houseType" id="houseType" class="form-control">
								</select>
							</div>
						</div>

						<div class="col-lg-3" id="houseTypeOtherDiv" style="display:none;">
							<label>House Type Other</label>
							<input id = "houseTypeOther" name = "houseTypeOther" class="form-control" placeholder="Enter House Type" value="{{$inquiry->houseTypeOther}}">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<label>Number of Rooms</label>
							@if($inquiry->rooms)
								<input type = "number" name = "rooms" id = "rooms" min="0" value="{{$inquiry->rooms}}" class="form-control"/>
							@else
								<input type = "number" name = "rooms" id = "rooms" min="0" value="0" class="form-control">
							@endif
						</div>
						<div class="col-lg-3">
							<div>
								<label>Add room type (max 2)</label>
								<button id='addRoomType' type="button" class="btn btn-primary form-control">+</button>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-2" id='room1TypeDiv' style="display:none;">
							<label>Room 1 Type</label>
							<select name = "room1Type" id="room1Type" class="form-control roomType">
							</select>
						</div>

						<div class="col-lg-2" id="room1TypeOtherDiv" style="display:none;">
							<label>Room 1 Type Other</label>
							<input name = "room1TypeOther" type = "search" id="room1TypeOther" class="form-control" placeholder="Enter Room Type" value="{{$inquiry->room1TypeOther}}">
						</div>

						<div class="col-lg-2" id='room2TypeDiv' style="display:none;">
							<label>Room 2 Type</label>
							<select name = "room2Type" id="room2Type" class="form-control roomType">
							</select>
						
						</div>

						<div class="col-lg-2" id="room2TypeOtherDiv" style="display:none;">
							<label>Room 2 Type Other</label>
							<input name = "room2TypeOther" type = "search" id="room2TypeOther" class="form-control" placeholder="Enter Room Type" value="{{$inquiry->room2TypeOther}}">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<div>
								<label>Number of Adult</label>
								@if($inquiry->numOfAdult)
									<input name="numOfAdult" type = "number" size = "1" min="0" id="numOfAdult" class="form-control" value="{{$inquiry->numOfAdult}}">
								@else
									<input name="numOfAdult" type = "number" size = "1" min="0" id="numOfAdult" class="form-control" value="0">
								@endif
							</div>
						</div>

						<div class="col-lg-2">
							<div>
								<label>Number of Kids</label>
								@if($inquiry->numOfChildren)
									<input name="numOfChildren" type = "number" size = "1" min="0" id="numOfChildren" class="form-control" value="{{$inquiry->numOfChildren}}">
								@else
									<input name="numOfChildren" type = "number" size = "1" min="0" id="numOfChildren" class="form-control" value="0">
								@endif
							</div>
						</div>

						<div class="col-lg-2">
							<div>
								<label>Kids Age</label>
								@if($inquiry->childAge)
									<input name="childAge" type = "search" id="childAge" class="form-control" value="{{$inquiry->childAge}}">
								@else 
									<input name="childAge" type = "search" id="childAge" class="form-control" value="0">
								@endif
							</div>
						</div>

						<div class="col-lg-2">
							<div>
								<label>Baby</label>
								<SELECT name="hasBaby" id="hasBaby" class="form-control">
								<OPTION value = 1 @if($inquiry->hasBaby ==1) selected @endif>Yes</OPTION>
								<OPTION value = 0 @if($inquiry->hasBaby ==0) selected @endif>No</OPTION>
								</SELECT>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-2">
							<div>
								<label>Pregnant</label>
								<SELECT id='pregnancy' name='pregnancy' class="form-control">
								<OPTION value = 0 @if($inquiry->pregnancy ==0) selected @endif>N/A</OPTION>
								<OPTION value = 1 @if($inquiry->pregnancy ==1) selected @endif>Yes</OPTION>
								<OPTION value =-1 @if($inquiry->pregnancy ==-1) selected @endif>No</OPTION>
								</SELECT>
							</div>
						</div>

						<div class="col-lg-2">
							<div>
								<label>Pets</label>
								<SELECT id='pet' name='pet' class="form-control">
								<OPTION value = 0 @if($inquiry->pet == 0) selected @endif>N/A</OPTION>
								<OPTION value = 1 @if($inquiry->pet == 1) selected @endif>Yes</OPTION>
								<OPTION value =-1 @if($inquiry->pet == -1) selected @endif>No</OPTION>
								</SELECT>
							</div>
						</div>

						<div class="col-lg-2">
							<div id="petTypeDiv">
								<label>Pet Type</label>
								<input name="petType" type = "search" id="petType" class="form-control">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4">
							<div>
								<label>Budget</label>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">From $</span>
										<input class="form-control" name="budgetLower" id="budgetLower" type = "search" size = "10" value="{{$inquiry->budgetLower}}">
										<span class="input-group-addon" id="basic-addon1">to $</span>
										<input class="form-control" name="budgetUpper" id="budgetUpper" type = "search" size = "10" value="{{$inquiry->budgetUpper}}">
									</div>
							</div>
						</div>

						<div class="col-lg-2">
							<div>
								<label>Budget Unit</label>
								<select name = "budgetUnit" id="budgetUnit" class="form-control">
								<option value="0" @if($inquiry->budgetUnit == 0) selected @endif>Per Day</option>
								<option value="1" @if($inquiry->budgetUnit == 1) selected @endif>Per Month</option>
								</select>
							</div>
						</div>
					</div>
					
				</div>
				<div id="note" class="tab-pane fade">
					<div class="row">
						<div class="col-lg-6">
							<label>Special Note</label>
							<textarea class="form-control" name="specialNote" id="specialNote" rows=10 cols=100 >{{$inquiry->note}}</textarea>
						</div>
					</div>
				</div>
				
			</div>
			<div style='text-align:center; margin: 25px 0 200px 0;'>
				<button class="btn btn-primary btn-sm" type="submit">Save Modified Info</button>
			</div>
		</form>

		
	</div>
@endsection

@section('script')
	

	<script type="text/javascript">
		// load util.js
		//load_saving_data();
		//load_saving_data();
		//load_saving_data();
		// var inquirySource = "{{$inquiry->inquirySource}}";
		// var purpose = "{{$inquiry->purpose}}";
		// var room1Type = "{{$inquiry->room1Type}}";
		// var room2Type = "{{$inquiry->room2Type}}";

		var predataset = {'inquirySource':"{{$inquiry->inquirySource}}",'purpose':"{{$inquiry->purpose}}",
						  'houseType':"{{$inquiry->houseType}}",
							};

		window.onload = function(){
			document.getElementById("inquirySource").value = "{{$inquiry->inquirySource}}";
			document.getElementById("purpose").value = "{{$inquiry->purpose}}";
			document.getElementById("houseType").value = "{{$inquiry->houseType}}";
			document.getElementById("room1Type").value = "{{$inquiry->room1Type}}";
			document.getElementById("room2Type").value = "{{$inquiry->room2Type}}";
		}

		function load_saving_data(){
			document.getElementById("inquirySource").value = "{{$inquiry->inquirySource}}";
			document.getElementById("purpose").value = "{{$inquiry->purpose}}";
			document.getElementById("houseType").value = "{{$inquiry->houseType}}";
			document.getElementById("room1Type").value = "{{$inquiry->room1Type}}";
			document.getElementById("room2Type").value = "{{$inquiry->room2Type}}";

		}

		$(document).ready(function() {
			loadOpt();
			loadDataList();
			bindhandler();
		});

		// console.log("{{$inquiry->inquirySource}}");
		
		// console.log("{{$inquiry->inquirySource}}");
		



		// set default saving value
		// document.getElementById("state").value = "{{$inquiry->state}}";
		// document.getElementById("city").value = "{{$inquiry->city}}";
				


		$("#inquiryDate").datepicker({
			  dateFormat: "mm-dd-yy",
			  maxDate: 0
			});
		$("#inquiryDate").datepicker("setDate", new Date());

		$('#checkIn').datepicker({
		  dateFormat: "mm-dd-yy",
		  beforeShow: function () {
		  $('#checkIn').datepicker('option', 'minDate', 0);
		  }
		});

		$('#checkOut').datepicker({
		  dateFormat: "mm-dd-yy",
		  beforeShow: function () {
			var checkIn = $('#checkIn').datepicker("getDate");
			if(checkIn){
				checkIn.setDate(checkIn.getDate() + 1);
				$('#checkOut').datepicker('option', 'minDate', checkIn);
			}
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
				$('#state').val("");
				$('#city').val("");
				if(value){
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
			}
			else if(elem===$('#state')[0]){
				$('#city').val("");
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
				if(ele.value=="Other"){
					$('#cityOther').parent.show();
				}
			}

		}

		function loadDataList(){
			if($('#country').val()){
				var value = $('#country').val();
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
				if($('#state').val()){
					var value = $('#state').val();
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
			}	
		}

	</script>


@endsection