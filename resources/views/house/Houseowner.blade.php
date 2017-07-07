@extends('navbar')
@section('title', 'House Search')

@section('head')
	<style>
		html {width:100%; height:100%;}
		body { line-height: 100%; line-height: 100%; width:100%; height:100%;}
        .marginMe { padding-left: 2%; padding-right: 2%; }
        .row { margin-bottom: 15px;}
        .my-left {margin-left: 15px;}
        .table-bordered th{ text-align: center;}
        .disToLeft { margin-left: 20px;}
        .tab-content {
            padding: 20px;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-radius: 0px 0px 5px 5px;
        	}
		.modal-dialog{
		    width: 80%; /* respsonsive width */
		}
	</style>
@endsection

@section('inbody','class=marginMe')

@section('content')
	<div class="col-sm-6" id="ownerinfo" style="overflow:auto;margin-bottom:100px;margin-bottom:60px;">
			<!-- <div class="row"> -->
		@if(isset($houseowner))
		<table class="table table-bordered table-striped text-center" style="font-size:12px;">
			<thead>
				<td colspan="2">House Owner Infomation</td>
			</thead>
			<tbody>
				<col width="20%">
					<col width="80%">
				<tr>
					<td width="min-width:50px;"> Owner Name </td>
					<td id = "ownername">{{$houseowner->first}}&nbsp{{$houseowner->last}}</td>
				</tr>
				<tr>
					<td width="min-width:50px;"> Company Name </td>
					<td id="ownerCompanyName"> @if($houseowner->ownerCompanyName) {{$houseowner->ownerCompanyName}}@else Individual @endif </td>
				</tr>
				<tr>
					<td width="min-width:50px;"> US Phone Number</td>
					<td id="ownerUsPhoneNumber">@if($houseowner->ownerUsPhoneNumber){{$houseowner->ownerUsPhoneNumber}}@else N/A @endif</td>
				</tr>
				<tr>
					<td width="min-width:50px;"> Other Phone Number</td>
					<td id="ownerPhone2Number">@if($houseowner->ownerPhone2Number) {{$houseowner->ownerPhone2Number}} @endif
					</td>
				</tr>
				<tr>
					<td width="min-width:50px;" > Email </td>
					<td id="ownerEmail">@if($houseowner->ownerEmail){{$houseowner->ownerEmail}}@endif
					</td>
				</tr>
				<tr>
					<td width="min-width:50px;" > Wechat Username </td>
					<td id="ownerWechatID" title='Wechat ID: {{$houseowner->ownerWechatID}}'>{{$houseowner->ownerWechatUserName}}</td>
				</tr>
				<tr> 
					<td > Properties</td>
					<td id="housepropertys" > 
						<table class="table table-bordered table-striped text-center" style="font-size:12px; ">
							<thead>
								<tr>
									<td> Full House ID </td>
									<td> </td>
								</tr>
							</thead>
							<tbody>
								@foreach($houseowner->houses as $house)
									<tr> 
										<td> {{$house->fullHouseID}}</td>
										<td> <button class="btn btn-primary btn-sm viewmore" value={{$house->numberID}}> View info</button></td>
									</tr>
								@endforeach
							</tbody>
						</table>

						<!-- TODO:: Implemete view all assets on map  -->
						<a onclick="showonMap()" href="#"> View on Map</a>
					</td>
				</tr>
			</tbody>
		</table>
		@else
			<h4 style="color:red">No records</h4>
		@endif
		<!-- </div> -->
	</div>
	<div class="modal fade" id="HouseinfoFieldModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">House Infomation</h4>
				</div>
				<div class="modal-body">
					<div class="" id="house" style="margin-top:60px;overflow:auto;margin-bottom:60px;">
    					<table class="table table-bordered table-striped text-center" style="font-size:12px;">
    						<thead>
				                <tr>
				                    <th style="min-width:50px;">Number ID</th>
				                    <th style="min-width:100px;">House ID</th>
				                    <th style="min-width:100px;">State</th>
				                    <th style="min-width:100px;">City</th>
				                    <th style="min-width:150px;">House Address</th>
				                    <th style="min-width:50px;">Number of Rooms</th>
				                    <th style="min-width:50px;">Number of Baths</th>

				                    <th style="min-width:100px;">House Type</th>
				                    <th style="min-width:100px;">Price per Month</th>
				                    <th style="min-width:100px;">Price per Day</th>
				                    <th style="min-width:150px;">Next Available Date</th>

				                    <th style="min-width:100px;">Minimum Stay Term</th>
				                    <th style="min-width:100px;">Whole/Share</th>
				                </tr>
				            </thead>
				            <tbody>
				            </tbody>
    					</table>
    				</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		function showonMap(house){
			var pageurl = window.location.href;
			pageurl = pageurl.slice(0, -1);
			$.ajax({
				type:"GET",
				url:pageurl+"/true",
				datatype:'json',
				success: function(data){		
				}
			});
		}

		$(document).ready(function(){
		});


		$('.viewmore').click(function(){
			var numberID =$(this).val();
			$.ajax({
				type:"GET",
				url:"/house/"+numberID,
				datatype:'json',
				success: function(data){
					alert(JSON.stringify(data));
				}
			});
			$('#HouseinfoFieldModal').modal('toggle');
		});

	</script>
@endsection