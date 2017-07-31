@extends('navbar')
@section('title', 'Show All Transactions')

@section('head')
	<style>
		
	</style>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#transactionTable').DataTable({
				"columnDefs": [
					{
						"targets": [ 6 ],
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
					<th>Transaction ID</th><th>Inquirer Name</th><th>Full House ID</th><th>Checkin Date</th><th>Checkout Date</th><th>Amount</th><th></th>
				</thead>
				<tbody>
					@foreach ($tran as $tr)
						<tr>
							<td>{{$tr->transactionID}}</td>
							<td>{{$tr->inquiry->quirer->inquirerFirst}} {{$tr->inquiry->quirer->inquirerLast}}</td>
							<td>{{$tr->house->fullHouseID}}</td>
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
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		function detail(data) {
			console.log(data);
			tran = JSON.parse(data);
			console.log(tran);
		}
	</script>
@endsection

