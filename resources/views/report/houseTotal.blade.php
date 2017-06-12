<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Rental Location</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"> -->


		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
		<!-- <link rel="stylesheet" href="../css/loader.css"> -->

		<!-- // <script src="../js/jquery.min.js"></script> -->
		<!-- // <script src="../js/bootstrap.min.js"></script> -->
		<!-- // <script src="../js/canvasjs.min.js"></script> -->
		<!-- // <script src="../js/canvas2image.js"></script> -->
		<!-- // <script src="../js/html2canvas.js"></script> -->
		<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/datatables.min.css"/> -->
		<!-- // <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/datatables.min.js"></script> -->

		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqAxQ3alRNJkwsZpV9NSF2EpBUh2VWu4I&callback=initMap">
		</script>

		<style>
			/*
				tr, th {
					text-align: center;
				}
			*/
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
				height: 650px; }

			iframe {
				margin-top: 10px;
				width: 100%;
				height: 650px;
			}

		  /*  .totalTable td{
				font-size: 20px; font-weight: 700;
			}*/
		/*    .table2 td{
				border:none !important; 
			}*/

			.panel-heading a{
				text-decoration: none;
			}
			/*.panel-heading{
				background-color: white !important;
			}*/
		/*    .panel-heading{
				text-align: center;
			}*/
			.panel-heading h3{
				font-family:Helvetica;
				font-weight: 400;
				margin:0;
				font-size: 1.17em;
				color: #73879C;
			}
			.chartletter p{
				background: #fff!important;
				border: 1px solid #fff!important;
				color: #73879C;
				background: #2A3F54;
				font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
				font-size: 13px;
				font-weight: 400;
				line-height: 1.471;
			}
			.progress{
				margin-bottom: 17px !important;
			}
			.bg-green {
				background: #1ABB9C!important;
				/*border: 1px solid #1ABB9C!important;*/
				color: #fff;
			}
		</style>
	</head>

	<body>

			<!----------------- initial hidden ------------------>
	<!-- <div class="loaderDiv">
		<div class="loader"></div>
		<div class="loaderLabel text-center"><h4>Processing</h4><h4>Please Wait...</h4></div>
	</div> -->


	<!--     <div class="col-md-2" id="left-nav" role="tablist">
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="#USA" aria-controls="table" role="tab" data-toggle="tab">Total Houses</a></li>
				<li><a href="HouseTotal.html#print_inquiry" aria-controls="table" role="tab" data-toggle="tab">Whole/Share</a></li>
				<li><a href="#levelpiechart" aria-controls="graph" role="tab" data-toggle="tab">House Type</a></li>
			</ul>
		</div> -->

		<div class="tab-content col-md-10 col-md-offset-1" >

			<div id="USA" class="tab-pane fade in active" style=''>                   
				<div class='panel panel-default'>
					<div class='panel-heading' style='border:0px;'>
						<div class='row' style='font-size: 20px; font-weight: 700;text-align:center;'> Total House Information</div>
					</div>
					<div class='panel-body' style='border:0px;'>
						<div>Last Update House: <div id='lastUpdate'>{{$lastHouse->fullHouseID}}</div></div>
						<!-- <div class="col-md-12 col-xs-14"> -->
						<!-- <div class='panel-group' id='myGroup'> -->
						<div class='panel panel-default ' style='margin-top:1em;border-left:0px;border-right:0px;border-bottom:0px;'>
							<div class="panel-heading" >
								<a data-toggle="collapse" data-parent="#myGroup" data-target="#collapseTotalHouse"href="#collapseTotalHouse" ><h3>Total Houses</h3></a>
								</div>
								<div id='collapseTotalHouse' >
									<div class="panel-body " >  
										<div class="col-md-6 col-md-offset-1">
										<table class="table table-responsive table2" style='border-left:0px;border-right:0px;'>
										<tr><td class='col-md-5'>Houses</td><td class='col-md-3'id='totalHouses'></td><td>{{$count}}</td></tr></table>
									</div>   
								</div>
							</div>                                                                                                                    	 
						</div> 
						<div class='panel panel-default' style='margin-top:1em;border-left:0px;border-right:0px;border-bottom:0px;'>
							<div class="panel-heading" >
								<a data-toggle="collapse" data-parent="#myGroup"  href="#collapseTotalHouseByWholeShare"><h3>Total Houses By Whole or Share</h3></a>
							</div>
							<div id='collapseTotalHouseByWholeShare' class='collapse'>
								<div class="panel-body " >  
									<div class="col-md-6 col-md-offset-1">
										<table class="table table-responsive table2" style='border-left:0px;border-right:0px;'>
											<thead>
												<tr><th>House Type</th><th>Amount</th><th>Percentage</th></tr>
											</thead>                                                      
											<tr style='border-bottom:0px;'>
												<td class='col-md-5'>Whole Houses</td>
												<td class='col-md-3' id='totalWholeHouses'>{{$wholeCount}}</td>
												<td class='col-md-3' id='totalWholeHousesper'>{{number_format(100*$wholeCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td>Share Houses</td>
												<td id='totalShareHouses'>{{$shareCount}}</td>
												<td id='totalShareHousesper'>{{number_format(100*$shareCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Either Houses</td>
												<td id='totalEitherHouses'>{{$eitherCount}}</td>
												<td id='totalEitherHousesper'>{{number_format(100*$eitherCount/$count, 2)}}%</td>
											</tr>
										</table>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-12 bg-white chartletter">
										<div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-6" style='margin-top:46px;'>
											<div>
												<div class="progress">
													<div class="progress progress_sm" id='totalWholeHousesbar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$wholeCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='totalShareHousesbar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$shareCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='totalEitherHousesbar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$eitherCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class='panel panel-default' style='margin-top:1em;border-left:0px;border-right:0px;border-bottom:0px;'>
							<div class="panel-heading" >
								<a data-toggle="collapse" data-parent="#myGroup"  href="#collapseTotalHouseByHouseType"><h3>Total Houses By House Type</h3></a>
							</div>
							<div id='collapseTotalHouseByHouseType' class='collapse'>
								<div class="panel-body " >  
									<div class="col-md-6 col-md-offset-1">
										<table class="table table-responsive table2 table-hover" style='border-left:0px;border-right:0px;'>
											<thead>
												<tr><th>House Type</th><th>Amount</th><th>Percentage</th></tr>
											</thead>                      
											<tr style='border-bottom:0px;'>
												<td class='col-md-5'>Apartment </td>
												<td class='col-md-3 'id='totalApartment'>{{$aptCount}}</td>
												<td class='col-md-3' id='perApartment'>{{number_format(100*$aptCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Boat</td>
												<td id='totalBoat'>{{$boatCount}}</td>
												<td id='perBoat'>{{number_format(100*$boatCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Condo</td>
												<td id='totalCondo'>{{$condoCount}}</td>
												<td id='perCondo'>{{number_format(100*$condoCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Loft</td>
												<td id='totalLoft'>{{$loftCount}}</td>
												<td id='perLoft'>{{number_format(100*$loftCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Mansion</td>
												<td id='totalMansion'>{{$mansionCount}}</td>
												<td id='perMansion'>{{number_format(100*$mansionCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >RV</td>
												<td id='totalRV'>{{$RVCount}}</td>
												<td id='perRV'>{{number_format(100*$RVCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Studio</td>
												<td id='totalStudio'>{{$studioCount}}</td>
												<td id='perStudio'>{{number_format(100*$studioCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Single House</td>
												<td id='totalSingleHouse'>{{$singleCount}}</td>
												<td id='perSingleHouse'>{{number_format(100*$singleCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Townhouse</td>
												<td id='totalTownhouse'>{{$townCount}}</td>
												<td id='perTownhouse'>{{number_format(100*$townCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Villa</td>
												<td id='totalVilla'>{{$villaCount}}</td>
												<td id='perVilla'>{{number_format(100*$villaCount/$count, 2)}}%</td>
											</tr>
											<tr>
												<td >Other</td>
												<td id='totalOther'>{{$otherCount}}</td>
												<td id='perOther'>{{number_format(100*$otherCount/$count, 2)}}%</td>
											</tr>
										</table>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-12 bg-white chartletter">
										<div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-6" style='margin-top:46px;'>
											<div>
												<!-- <p>Apartment</p> -->
												<div class="progress">
													<div class="progress progress_sm" id='Apartmentbar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$aptCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='Boatbar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$boatCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='Condobar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$condoCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='Loftbar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$loftCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='Mansionbar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$mansionCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='RVbar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$RVCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='Studiobar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$studioCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='SingleHousebar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$singleCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='Townhousebar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$townCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='Villabar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$villaCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
											<div>
												<!-- <p>Boat</p> -->
												<div class="progress">
													<div class="progress progress_sm"  id='Otherbar'>
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" style="width:{{number_format(100*$otherCount/$count, 2)}}%"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
				<!-- </table> -->
				<!-- <table id="USAtable" class="table table-striped"></table>
				<table id="USAcitytable" class="table table-striped"></table> -->
			</div>
		</div>
	</body>
</html>
