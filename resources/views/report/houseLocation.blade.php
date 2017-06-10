<html>
	<head>
		<!-- jquery -->
		<script src="{{asset('js/jquery.min.js')}}"></script>
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		<script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>
		<script src="{{asset('js/bootbox.min.js')}}"></script>
		<link rel="stylesheet" href="{{asset('css/self.css')}}">
		<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpF-_i-utIH6cZl94zpu4C5vx_FBDDI9s&libraries=places&language=en"></script>

		<script src="{{asset('js/canvasjs.min.js')}}"></script>
		<script src="{{asset('js/canvas2image.js')}}"></script>
		<script src="{{asset('js/html2canvas.js')}}"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/datatables.min.js"></script>
	
		<style>
			html {width:100%; height:100%;}
			body { line-height: 100%; line-height: 100%; width:100%; height:100%;}
				.marginMe { padding-left: 8%; padding-right: 8%; }
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
			/*  #map_canvas{
				margin-top:20px;width:100%;height:60%;display:none;
			}*/
			#map_canvas{
				margin-top:80px;width:90%;height:60%;display:none;
			}
			#USAcitytable{
				display: none;
			}
			#USAcitySelectTable{
				display: none;
			}
			#totalinfo, p {
				font-size: 20px;
				font-weight: 700;
			}
			#worldMap {
				width: 100%;
				height: 650px;
			}
		</style>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#back').hide();
				$('#USAtable').DataTable( {
					"paging":false,
					"info":false,
					"searching":false,
					"columnDefs": [
						{
							"targets": [ 3 ],
							"sortable": false
						}
					],
					"order": [[ 0, "asc" ]]
				});
				data = [];

				var state = "{{$state_count}}";
				state = state.replace(/&quot;/g, '"');
				var re = new RegExp('count', 'g');
				state = state.replace(re, 'y');
				state = JSON.parse(state);
				// console.log(state[0]);

				var chart = new CanvasJS.Chart("state_level_chart",
				{
					title:{
						text: "State-Level Pie Chart"
					},
					height: 500,
					width: 1100,
					exportEnabled: true,
					legend: {
						maxWidth: 1100,
						itemWidth: 180,
					},
					data: [{
						type: "pie",
						toolTipContent: "{state}: {y} - #percent %",
						showInLegend: true,
						indexLabel: "{state}: {y} (#percent %)",
						legendText: "{state}",
						dataPoints: state
					}
					]
				});
				chart.render();

				$('#city_level').hide();

				$('#state_select').change(function() {
					if ($('#state_select').val() == "Choose") {
						$('#city_level').hide();
					}
					else {
						$('#city_level').show();
						$.ajax({
							type: "get",
							url: "getCityCount/"+$('#state_select').val(),
							datatype: "json",
							success: function(response) {
								data = JSON.stringify(response);
								var re = new RegExp('count', 'g');
								data = data.replace(re, 'y');
								// console.log(data);
								data = JSON.parse(data);
								var chart = new CanvasJS.Chart("city_level_chart",
								{
									title:{
										text: "City-Level Pie Chart"
									},
									height: 500,
									width: 1100,
									exportEnabled: true,
									legend: {
										maxWidth: 1100,
										itemWidth: 180,
									},
									data: [{
										type: "pie",
										toolTipContent: "{city}: {y} - #percent %",
										showInLegend: true,
										indexLabel: "{city}: {y} (#percent %)",
										legendText: "{city}",
										dataPoints: data
									}
									]
								});
								chart.render();
							}
						});
					}
				});

			});
			function view_Cities(state, count) {
				console.log(state);
				$.ajax({
					type: "get",
					url: "getCityCount/"+state,
					datatype: "json",
					success: function(response) {
						data = response;
						console.log(response);
						$('#statetitle').hide();
						$('#back').show();
						$('#citytitle').show();
						$('#citytitle').html("House Location Table for " + state + " (by City)");
						var html = "";
						for (i = 0; i < response.length; i++) {
							html += "<tr><td>" + response[i].city + "</td><td>" + response[i].count + "</td><td>" + (100*response[i].count/count).toFixed(2) + "%</td></tr>";
						}
						$('#tablecontent').html(html);
						$('#USAcitytable').show();
						$('#USAtable').hide();
					}
				});
			}

			function back() {
				$('#statetitle').show();
				$('#back').hide();
				$('#citytitle').hide();
				$('#USAcitytable').hide();
				$('#USAtable').show();
			}

			function sort(index) {
				if (index == 1) {
					console.log($("#font1").css("color"));
					if ($("#font1").css("color") == 'rgb(128, 128, 128)') {
						$("#font1").removeClass('fa-sort');
						$("#font1").removeClass('fa-sort-amount-desc');
						$("#font1").addClass('fa-sort-amount-asc');
						$("#font2").removeClass('fa-sort-amount-asc');
						$("#font2").removeClass('fa-sort-amount-desc');
						$("#font2").addClass('fa-sort');
						$("#font3").removeClass('fa-sort-amount-asc');
						$("#font3").removeClass('fa-sort-amount-desc');
						$("#font3").addClass('fa-sort');

						$("#font1").css("color", "black");
						$("#font2").css("color", "grey");
						$("#font3").css("color", "grey");

						data.sort(function (a, b) {
							// console.log(a.state + ", " + b.state + ", " + a.state > b.state);
							if (a.city > b.city) {
								return 1;
							}
							else {
								return -1;
							}
						});
					}
					else {
						$("#font1").toggleClass('fa-sort-amount-desc');
						$("#font1").toggleClass('fa-sort-amount-asc');
						data.reverse();
					}
				}
				else if (index == 2) {
					console.log($("#font1").css("color"));
					if ($("#font2").css("color") == 'rgb(128, 128, 128)') {
						$("#font2").removeClass('fa-sort');
						$("#font2").removeClass('fa-sort-amount-desc');
						$("#font2").addClass('fa-sort-amount-asc');
						$("#font1").removeClass('fa-sort-amount-asc');
						$("#font1").removeClass('fa-sort-amount-desc');
						$("#font1").addClass('fa-sort');
						$("#font3").removeClass('fa-sort-amount-asc');
						$("#font3").removeClass('fa-sort-amount-desc');
						$("#font3").addClass('fa-sort');

						$("#font1").css("color", "grey");
						$("#font2").css("color", "black");
						$("#font3").css("color", "grey");

						data.sort(function (a, b) {
							return a.count - b.count;
						});
					}
					else {
						$("#font2").toggleClass('fa-sort-amount-desc');
						$("#font2").toggleClass('fa-sort-amount-asc');
						data.reverse();
					}
				}
				else {
					if ($("#font3").css("color") == 'rgb(128, 128, 128)') {
						$("#font3").removeClass('fa-sort');
						$("#font3").removeClass('fa-sort-amount-desc');
						$("#font3").addClass('fa-sort-amount-asc');
						$("#font1").removeClass('fa-sort-amount-asc');
						$("#font1").removeClass('fa-sort-amount-desc');
						$("#font1").addClass('fa-sort');
						$("#font2").removeClass('fa-sort-amount-asc');
						$("#font2").removeClass('fa-sort-amount-desc');
						$("#font2").addClass('fa-sort');

						$("#font1").css("color", "grey");
						$("#font2").css("color", "grey");
						$("#font3").css("color", "black");

						data.sort(function (a, b) {
							return a.count - b.count;
						});
					}
					else {
						$("#font3").toggleClass('fa-sort-amount-desc');
						$("#font3").toggleClass('fa-sort-amount-asc');
						data.reverse();
					}
				}
				var html = "";
				var count = 0;
				for (i = 0; i < data.length; i++) {
					count += data[i].count;
				}
				for (i = 0; i < data.length; i++) {
					html += "<tr><td>" + data[i].city + "</td><td>" + data[i].count + "</td><td>" + (100*data[i].count/count).toFixed(2) + "%</td></tr>";
				}
				$('#tablecontent').html(html);
			}
		</script>
	</head>

	<body>
		<div class="container-fluid">
			<div class="col-md-2" id="left-nav" style="padding-left: 0;"role="tablist">
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="#USA" aria-controls="table" role="tab" data-toggle="tab">House Location Table</a></li>
					<li><a href="#levelpiechart" aria-controls="graph" role="tab" data-toggle="tab">Pie Chart</a></li>
				</ul>
			</div>
			<div class="tab-content col-md-10">
				<div id="USA" class="tab-pane fade in active">
					<div class="well" style='padding:0; background-color:white;'>
						<!-- <p class="text-center" style="font-size: 20px; font-weight: 700">House Location Table (US)</p>   -->
						<nav class='navbar navbar-default' style='padding-top:15px; height: 61px;'>
							<button id='back' type="button" class="btn btn-default" style="margin-left:20px; float:left;" onclick="back()">Back</button>
							<div style='font-size:20px; font-weight:700; padding-top:10px' id = 'statetitle' style='padding-top:10px' align='middle'>
								House Location Table for US (by States)
							</div>
							<div style='font-size:20px; font-weight:700; padding-top:10px' id = 'citytitle' align='middle'>
							</div>
						</nav>
						<div class='table-responsive' style='padding: 0 20px'>
							<table id="USAtable" class="datatable-class table table-hover">
								<thead>
									<th>States</th><th>Count</th><th>Percentage</th><th></th>
								</thead>
								<tbody>
									@foreach ($state_count as $s_count)
										<tr>
											<td>{{$s_count->state}}</td>
											<td>{{$s_count->count}}</td>
											<td>{{number_format(100*$s_count->count/$count, 2)}}%</td>
											<td align='right' style='padding-right:20px'>
												<button type="button" onclick="view_Cities('{{$s_count->state}}', {{$s_count->count}})" class="btn btn-primary">View Cities</button>
											</td>
										</tr>
									@endforeach
									<!-- <tr>
										<td>Total</td>
										<td>{{$count}}</td>
										<td>100%</td>
										<td></td>
									</tr> -->
								</tbody>
							</table>
							<table id="USAcitytable" class="datatable-class table table-hover">
								<thead>
									<th class='sorting'>
										Cities
										<a href='#' onclick='sort(1);return false;'>
											<i id='font1' style='color:black;width:75%;display:inline-block;text-align:right;' class="fa fa-sort-amount-asc" aria-hidden="true"></i>
										</a>
									</th>
									<th>
										Count
										<a href='#' onclick='sort(2);return false;'>
											<i id='font2' style='color:grey;width:75%;display:inline-block;text-align:right;' class="fa fa-sort" aria-hidden="true"></i>
										</a>
									</th>
									<th>
										Percentage
										<a href='#' onclick='sort(3);return false;'>
											<i id='font3' style='color:grey;width:75%;display:inline-block;text-align:right;' class="fa fa-sort" aria-hidden="true"></i>
										</a>
									</th>
									</thead>
								<tbody id='tablecontent'>
								</tbody>
							</table>
						</div>
					</div>
					<button id="extall" type="button" class="btn btn-primary">
						<span class="glyphicon glyphicon-download-alt"></span>
						Export Filtered Result to Excel
					</button>
				</div>

				<div id="levelpiechart" class="tab-pane fade">
					<div id="state_level" style="padding-left: 30px; padding-right: 30px; padding-bottom: 20px; background-color: white">
						<div id="state_level_chart" style="height: 500px; width: 100%;"></div>	
					</div>
					<hr>
					<span style="font-size:18px; font-weight:700; padding-right: 20px;">Choose State to show city-level pie chart:</span>
					<select id="state_select">
						<option value="Choose" selected="selected">Choose</option>
						@foreach ($state_count as $s_count)
							<option value="{{$s_count->state}}">{{$s_count->state}}</option>
						@endforeach
					</select>
					<hr>
					<div id="city_level" style="padding-left: 30px; padding-right: 30px; padding-bottom: 20px; background-color: white">
						<div id="city_level_chart" style="height: 500px; width: 100%;"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>