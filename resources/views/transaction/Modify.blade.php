@extends('navbar')
@section('title', 'Modify Transaction')

@section('head')
	<style>
		
	</style>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#modifyForm').submit(function() {
				var toSend = $('#modifyForm').serializeArray();
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: "POST",
					url: "/transaction/modify/store",
					data: $.param(toSend),
					success: function(data) {
						bootbox.dialog({
							message: 'Successfully modified!',
							title: 'Success',
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
					}
				});
			});
		});
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="well" style='background-color:white;'>
			<form method = "post" id="modifyForm" onsubmit='return false;'>

				<div class='row'>
					<div class='col-sm-3'>
						<label>Transaction ID</label>
						<input class='form-control input-sm' name="transactionID" value="{{$tran->transactionID}}" readonly>
					</div>
					<div class='col-sm-4'>
						<label>Full House ID</label>
						<input class='form-control input-sm' name="fullHouseID" value="{{$tran->house->fullHouseID}}" readonly>
					</div>
					<div class='col-sm-3'>
						<label>Inquiry ID</label>
						<input class='form-control input-sm' name="inquiryID" value="{{$tran->inquiryID}}" readonly>
					</div>
				</div>

				<div class='row'>
					<div class='col-sm-3'>
						<label>Daily price</label>
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" name="dayprice" class="form-control input-sm" value ="{{$tran->dayprice}}" step='10'>
						</div>
					</div>
					<div class='col-sm-3'>
						<label>Discount</label>
						<div class="input-group">
							<input type="number" name="discount" class="form-control input-sm" value ="{{$tran->discount}}">
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class='col-sm-3'>
						<label>Amount</label>
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" name="amount" class="form-control input-sm" value ="{{$tran->amount}}" step='10'>
						</div>
					</div>
				</div>

				<div class='row'>
					<div class='col-sm-3'>
						<label>Status</label>
						<select id="xxx" name="status" class="form-control input-sm">
							<option @if($tran->status == 0) selected @endif value = 0 >Completed</option>
							<option @if($tran->status == 1) selected @endif value = 1 >Waiting for Payment</option>
							<option @if($tran->status == -1) selected @endif value = -1 >Cancelled</option>
						</select>
					</div>
				</div>

				<hr>
				<div style='text-align:center;'>
					<button class="btn btn-primary btn-sm" type="submit" onsubmit="return false;">Save Modified Info</button>
				</div>

			</form>
		</div>
	</div>
@endsection

@section('script')
	
@endsection

