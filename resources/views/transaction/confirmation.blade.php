@extends('navbar')
@section('title','Transaction confirmation')

@section('head')
	<style>
		.bigbox{
			margin:auto;
			margin-top: 50px;
			border: 3px solid #73AD21;
			/*height:400px;*/
			padding-top:10px; 
			padding-left:10px;
			font-size:13px;
		}

		.price{
			width: inherit;
			background-color: lightgrey;
		}
		#pricecalculator{
			border-collapse: collapse;
			margin-left: 50%;
			width: 50%;
			background-color: lightgrey;
		}
		#pricecalculator .left{
			text-align:left;
		}
		#pricecalculator .right{
			text-align:right;

		}
		#pricecalculator .middle{
			text-align:center;
			font-size:15px;
		}
		#pricecalculator .verticalline{
			border-bottom: 2px solid black;
		}
	</style>
	
@endsection

@section('content')
	<div class="container">
		<div class = "row">
			<div class="col-sm-6">
				<div class="bigbox">
					<p><label>House Name:</label><span id="fullHouseID" style="margin-left:10px">{{$house->fullHouseID}}</span></p>
					<p><label>House Country:</label><span id="housecountry" style="margin-left:10px">{{$house->country}}</span></p>
					<p><label>House State:</label><span id="housestate" style="margin-left:10px">{{$house->state}}</span></p>
					<p><label>House City:</label><span id="housecity" sytle="margin-left:10px">{{$house->city}}</span></p>
					<p><label>House Address:</label><span id="houseAddress" style="margin-left:10px">{{$house->houseAddress}}</span></p>
					<p><label>House Zipcode:</label><span id="housezip" style="margin-left:10px">{{$house->houseZip}}</span></p>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="bigbox">
					<p><label>Customer Name:</label><span id='inquirerName' style = "margin-left:10px">{{$inquiry->quirer->inquirerFirst}} {{$inquiry->quirer->inquirerLast}}</span></p>
					<p><label>Customer Phone Number: </label><span id='inquirerPhoneNumber' style = "margin-left:10px">{{$inquiry->quirer->inquirerUsPhoneNumber}}</span></p>
					<p><label>Customer Email: </label><span id="inquirerEmail" style = "margin-left:10px">{{$inquiry->quirer->inquirerEmail}}</span></p>
					<p><label>Check In Date: </label><span id="checkIn" style = "margin-left:10px">{{$inquiry->checkIn}} </span></p>
					<p><label>Check Out Date: </label><span id='checkOut' style = "margin-left:10px">{{$inquiry->checkOut}}</span></p>
					<p><label>Num of Guests: </label><span id="numofGuests" style="margin-left:10px">{{$inquiry->numOfAdult+$inquiry->numOfChildren}}</span></p>
				</div>
			</div>
		</div>

		<div style="margin-top: 50px;">
			<form action="" method="POST" id="transform">
				<div class="row">
					<div class="col-sm-6">
					</div>
					<div class = "col-sm-6">
						<table id = "pricecalculator">
							<tr>
								<td class="left">Day Cost</td>
								<td></td>
								<td id="costDayPrice" class="right" >{{$house->houseprice->costDayPrice}}</th>
							</tr>
							<tr class="verticalline">
								<td class="left">Days</td>
								<td class="middle" >x</td>
								<td class="right" id="numberOfdays"></td>
							</tr>
							<tr >
								<td class="left"></td>
								<td class="middle" ></td>
								<td class="right" id="rawsumbeforediscount"></td>
							</tr>
							<tr class="verticalline">
								<td class="left">Discount</td>
								<td class="middle" >x</td>
								<td class="right" id="disrate">90<span sytle="font-size:8px;">%</span></td>
							</tr>

							<tr>
								<td class="left">Sum</td>
								<td class="middle"></td>
								<td class="right" id="rawsumafterdiscount"> </td>
							</tr>

							<tr class="verticalline">
								<td class="left">Cleaning</td>
								<td class="middle">+</td>
								<td class="right">{{$house->houseprice->costCleaning}}</td>
							</tr>




							<tr>
								<td class="left">Total</td>
								<td class="middle">=</td>
								<td class="right" id="total"> </td> 
							</tr>
						</table>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection


@section('script')
	<script>
		function calnumberOfDays(checkin,checkout){
			var oneDay = 24*60*60*1000;
			var d1 = new Date(checkin);
			var d2 = new Date(checkout);
			return Math.round((d2.getTime()-d1.getTime())/oneDay);
		}

		$(document).ready(function(){
			$('#numberOfdays').html(calnumberOfDays($('#checkIn').html(),$('#checkOut').html()));
			$('#rawsumbeforediscount').html(  parseInt($('#costDayPrice').html()) * parseInt($('#numberOfdays').html())); 
			// $('#rawsumafterdiscount').html( parseInt($('#rawsumbeforediscount').html()) * ())
			$('#total').html(    );
		})


	</script>
	
@endsection

