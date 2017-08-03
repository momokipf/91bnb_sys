@extends('navbar')
@section('title', 'Show All Transactions')

@section('head')
	<style>
		.detailBar {
			margin-bottom: 10px;
		}
		
	</style>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

	<script src="{{asset('js/bootbox.min.js')}}"></script>

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
			$("#myCarousel").carousel({interval: false});
			$("#backBtn").click(function() {
				$("#myCarousel").carousel("prev");
			});
		});
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="well" style='background-color:white;'>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="item active">
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

					<div class="item">
						<div class="detailBar">
							<button id="backBtn" type="button" class="btn btn-default">
								<i class="fa fa-chevron-left fa-lg" id='back' aria-hidden="true"></i>
							</button>
							<span style="font-size:14pt;">Details</span>
							<button id="deleteBtn" type="button" class="btn btn-default pull-right">
								<i id='trash' class="fa fa-trash fa-lg" aria-hidden="true"></i>
							</button>
						</div>

						<div id="detailDiv">
						</div>

						<hr>
						<div style='text-align:center;margin:25px 0 0 0;'>
							<button id="modifyBtn" type="button" class="btn btn-primary"> Modify </button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class='modal fade' id='myModal' style='text-align:center;' role='dialog'>
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
		</div> -->
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		function detail(data) {
			console.log(data);
			tran = JSON.parse(data);
			$("#myCarousel").carousel("next");
			html = "<table class='table table-hover' style='text-align:left;'><tbody>"
			html += "<tr><td>Transaction ID: </td><td>" + tran.transactionID + "</td></tr>";
			html += "<tr><td>Full Hosue ID: </td><td>" + tran.house.fullHouseID + "</td></tr>";
			html += "<tr><td>Hosue Address: </td><td>" + tran.house.houseAddress + "</td></tr>";
			html += "<tr><td>Check In Date </td><td>" + tran.inquiry.checkIn + "</td></tr>";
			html += "<tr><td>Check Out Date </td><td>" + tran.inquiry.checkOut + "</td></tr>";
			html += "<tr><td>Inquirer Info:</td><td><table class='table table-hover'>"
			html += "<tr><td>Inquirer First Name: </td><td>" + tran.inquiry.quirer.inquirerFirst + "</td></tr>";
			html += "<tr><td>Inquirer Last Name: </td><td>" + tran.inquiry.quirer.inquirerLast + "</td></tr>";
			html += "<tr><td>Inquirer Phone </td><td>" + tran.inquiry.quirer.inquirerUsPhoneNumber + "</td></tr>";
			html += "<tr><td>Inquirer Wechat ID </td><td>" + tran.inquiry.quirer.inquirerWechatID + "</td></tr>";
			html += "<tr><td>Inquirer Wechat Name </td><td>" + tran.inquiry.quirer.inquirerWechatUserName + "</td></tr>";
			html += "</table></td></tr>";
			html += "<tr><td>House Owner Info:</td><td><table class='table table-hover'>"
			html += "<tr><td>House Owner First Name: </td><td>" + tran.house.houseowner.first + "</td></tr>";
			html += "<tr><td>House Owner Last Name: </td><td>" + tran.house.houseowner.last + "</td></tr>";
			html += "<tr><td>House Owner Phone </td><td>" + tran.house.houseowner.ownerUsPhoneNumber + "</td></tr>";
			html += "<tr><td>House Owner Wechat ID </td><td>" + tran.house.houseowner.ownerWechatID + "</td></tr>";
			html += "<tr><td>House Owner Wechat Name </td><td>" + tran.house.houseowner.ownerWechatUserName + "</td></tr>";
			html += "</table></td></tr>";
			html += "<tr><td>Amount </td><td>$ " + tran.amount + "</td></tr>";
			if (tran.status == 0) {
				html += "<tr><td>Status </td><td> Complete </td></tr>";
			}
			else if (tran.status == -1) {
				html += "<tr><td>Status </td><td> Cancelled </td></tr>";
			}
			else if (tran.status == 1) {
				html += "<tr><td>Status </td><td> Waiting for payment </td></tr>";
			}
			html += "</tbody></table>"

			$("#detailDiv").html(html);
			$("#modifyBtn").click(function() {
				window.location.href="modify/" + tran.transactionID;
			});
			
			$("#deleteBtn").click(function() {
				bootbox.dialog({
					message: 'Continue deleting?',
					title: 'Delete Confirmation',
					buttons: {
						success: {
							label: 'Yes',
							className: 'btn-success',
							callback: function() {
								toSend = {"transactionID": tran.transactionID};
								$.ajax({
									headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									},
									type: "POST",
									url: '/transaction/delete',
									data: toSend,
									success: function(data) {
										bootbox.dialog({
											message: 'Success!',
											title: 'Delete Status',
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
							}
						}
					}
				});
			});
			// $("#modalBody").html(html);
			// $("#myModal").modal();
		}
	</script>
@endsection

