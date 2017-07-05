@extends('navbar')
@section('title', 'Modify Inquiry')

@section('head')
@endsection
@section('content')
	<div class="container" style="margin-top:70px;">
		<form method="post" id="modifyForm">
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
						<div class='col-sm-2'>
							<label>Inquiry ID</label>
							<input name='inquiryID' value="{{$inquiry->inquiryID}}" class='form-control input-sm' disabled>
						</div>
						<!-- house owner ID -->
						<div class='col-sm-2'>
							<label>House Owner ID</label>
							<input name='houseOwnerID' value="DD" class='form-control input-sm' disabled>
						</div>
						<!-- representative -->
						<div class='col-sm-3'>
							<label>Representative</label>
							<select id="repID" class="form-control" name="repWithOwner">
							@foreach ($Allreps as $repre)
								@if ($repre->repUserName == $inquiry->represent->repUserName)
									<option selected>{{$repre->repUserName}}</option>
								@else
									<option>{{$repre->repUserName}}</option>
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
							<div>
								<label>Country</label>
								<select name = "country" type = "search" id="country" class="form-control country">
								</select>
							</div>
						</div>
						<div class="col-lg-2">
							<div>
								<label>State or Province</label>
								<select id="state" name="state" class="form-control">
								<option selected>Select State</option>
								</select>
							</div>
						</div>
						<div class="col-lg-2">
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
								<input name="cityOther" id="cityOther" class="form-control" type="search" value="{{$inquiry->cityOther}}">
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-2">
							<div>
								<label>Source</label>
								<select id="inquirySource" class="form-control" name="inquirySource">
								</select>
							</div>
						</div>
						<div class="col-lg-2">
							<div style="display:none;" id="inquirySourceOtherDiv">
								<label>Source Other</label>
								<input id="inquirySourceOther" class="form-control" name="inquirySourceOther" placeholder="Enter Source">
							</div>
						</div>
						<div class="col-lg-2">
							<div>
								<label>Purpose</label>
								<select id="Purpose" class="form-control" name="Purpose">
								</select>
							</div>
						</div>

						<div class="col-lg-2">
							<div style="display:none;" id="PurposeOtherDiv">
								<label>Purpose Other</label>
								<input id="PurposeOther" class="form-control" name="PurposeOther" placeholder="Enter Purpose">
							</div>
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
								<input type = "number" name = "rooms" id = "rooms" min="0" value="{{$inquiry->rooms}}" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<div id='room1TypeDiv'>
								<label>Room 1 Type</label>
								<select name = "room1Type" id="room1Type" class="form-control">
								<?//php listtoselect("../list/roomTypeList"); ?>
								</select>
							</div>
						</div>

						<div class="col-lg-2">
							<div id="room1TypeOtherDiv" style="display:none;">
								<label>Room 1 Type Other</label>
								<input name = "room1TypeOther" type = "search" id="room1TypeOther" class="form-control" placeholder="Enter Room Type">
							</div>
						</div>

						<div class="col-lg-2">
							<div id='room2TypeDiv'>
								<label>Room 2 Type</label>
								<select name = "room2Type" id="room2Type" class="form-control">
								<?//php listtoselect("../list/roomTypeList"); ?>
								</select>
							</div>
						</div>

						<div class="col-lg-2">
							<div id="room2TypeOtherDiv" style="display:none;">
								<label>Room 2 Type Other</label>
								<input name = "room2TypeOther" type = "search" id="room2TypeOther" class="form-control" placeholder="Enter Room Type">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<div>
								<label>Number of Adult</label>
								<input name="numOfAdult" type = "number" size = "1" min="0" id="numOfAdult" class="form-control" value="{{$inquiry->numOfAdult}}">
							</div>
						</div>

						<div class="col-lg-2">
							<div>
								<label>Number of Kids</label>
								<input name="numOfChildren" type = "number" size = "1" min="0" id="numOfChildren" class="form-control" value="{{$inquiry->numOfChildren}}">
							</div>
						</div>

						<div class="col-lg-2">
							<div>
								<label>Kids Age</label>
								<input name="childAge" type = "search" id="childAge" class="form-control" value="{{$inquiry->childAge}}">
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
								<option value="0">Per Day</option>
								<option value="1">Per Month</option>
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
	</script>


@endsection