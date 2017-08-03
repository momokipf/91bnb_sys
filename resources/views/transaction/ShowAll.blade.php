@extends('navbar')
@section('title', 'Show All Transactions')

@section('head')
	<style>
		
	</style>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#transactionTable').DataTable({
				"columnDefs": [
					{
						"targets": [ 7 ],
						"sortable": false
					}
				]
			});
		});
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="well" style='background-color:white;'>
			<table id="transactionTable" class="table table-hover">
				<thead>
					<th>Transaction ID</th><th>Inquirer Name</th><th>Full House ID</th><th>House Owner Name</th><th>Checkin Date</th><th>Checkout Date</th><th>Amount</th><th></th>
				</thead>
				<tbody>
					@foreach ($tran as $tr)
						<tr>
							<td>{{$tr->transactionID}}</td>
							<td>{{$tr->inquiry->quirer->inquirerFirst}} {{$tr->inquiry->quirer->inquirerLast}}</td>
							<td>{{$tr->house->fullHouseID}}</td>
							<td>{{$tr->house->houseowner->first}} {{$tr->house->houseowner->last}}</td>
							<td>{{$tr->inquiry->checkIn}}</td>
							<td>{{$tr->inquiry->checkOut}}</td>
							<td>{{$tr->amount}}</td>
							<td align='right' style='padding-right:20px'>
								<button type="button" class="btn btn-primary" onclick="detail('{{$tr}}')">View Details</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class='modal fade' id='myModal' style='text-align:center;' role='dialog'>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Details</h4>
					</div>
					<div id="modalBody" class="modal-body" style="height: 500px; overflow-y: auto;">
					</div>
					<div class="modal-footer">
						<button type='button' class='btn btn-primary btn-sm'>Modify</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		function detail(data) {
			console.log(data);
			tran = JSON.parse(data);
			html = "<table class='table table-hover'><tbody>"
			html += "<tr><td>Transaction ID: </td><td>" + tran.transactionID + "</td></tr>";
			html += "<tr><td>Full Hosue ID: </td><td>" + tran.house.fullHouseID + "</td></tr>";
			html += "<tr><td>Hosue Address: </td><td>" + tran.house.houseAddress + "</td></tr>";
			html += "<tr><td>Check In Date </td><td>" + tran.inquiry.checkIn + "</td></tr>";
			html += "<tr><td>Check Out Date </td><td>" + tran.inquiry.checkOut + "</td></tr>";
			html += "<tr><td>Inquirer First Name: </td><td>" + tran.inquiry.quirer.inquirerFirst + "</td></tr>";
			html += "<tr><td>Inquirer Last Name: </td><td>" + tran.inquiry.quirer.inquirerLast + "</td></tr>";
			html += "<tr><td>Inquirer Phone </td><td>" + tran.inquiry.quirer.inquirerUsPhoneNumber + "</td></tr>";
			html += "<tr><td>Inquirer Wechat ID </td><td>" + tran.inquiry.quirer.inquirerWechatID + "</td></tr>";
			html += "<tr><td>Inquirer Wechat Name </td><td>" + tran.inquiry.quirer.inquirerWechatUserName + "</td></tr>";
			html += "<tr><td>House Owner First Name: </td><td>" + tran.house.houseowner.first + "</td></tr>";
			html += "<tr><td>House Owner Last Name: </td><td>" + tran.house.houseowner.last + "</td></tr>";
			html += "<tr><td>House Owner Phone </td><td>" + tran.house.houseowner.ownerUsPhoneNumber + "</td></tr>";
			html += "<tr><td>House Owner Wechat ID </td><td>" + tran.house.houseowner.ownerWechatID + "</td></tr>";
			html += "<tr><td>House Owner Wechat Name </td><td>" + tran.house.houseowner.ownerWechatUserName + "</td></tr>";
			html += "<tr><td>Amount </td><td>" + tran.amount + "</td></tr>";
			html += "</tbody></table>"
			$("#modalBody").html(html);
			$("#myModal").modal();
		}
	</script>
@endsection

