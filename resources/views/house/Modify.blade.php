
<!DOCTYPE html>
<html>
	<head>
		<title>House Search</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
	   <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

		<!-- jquery -->
		<script src="{{asset('js/jquery.min.js')}}"></script>


		<!-- bootstrap -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

		<script src="{{asset('js/bootstrap.min.js')}}"></script>

		<!-- bootstrap phone (local file) -->
		<script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>

		<!-- alert box -->
		<script src="{{asset('js/bootbox.min.js')}}"></script>
		<link rel="stylesheet" href="{{asset('css/self.css')}}">
		<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/priceswitch.css')}}">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
		<script src="{{asset('js/util.js')}}"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
			  
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
			a {
				text-decoration: none;
				display: inline-block;
				padding: 8px 16px;
			}
			a:hover {
				background-color: #ddd;
				color: black;
			}
			.previous {
				background-color: #f1f1f1;
				color: black;
			}
			#map_div{
				height: 650px;
				width: 100%;
			}
			#map {
				height: 100%;
				width: 100%;
			}
			i.arrow {
				border: solid black;
				border-width: 0 3px 3px 0;
				display: inline-block;
				padding: 3px;
			}
			.left{
				transform: rotate(135deg);
				-webkit-transform: rotate(135deg);
			}

			#houseroomswitch-inner:before {
				content: "House";
			}
			#houseroomswitch-inner:after {
				content: "Room";
			}

			#monthdailyswitch-inner:before{
				content: "Monthly";
			}
			#monthdailyswitch-inner:after{
				content: "Daily";
			}

		</style>

		<script async defer src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAAIAQT72snLXj_BITkOc5TMZjpTrzbYRw&language=en&callback=initAutoComplete"></script>

		<script>
			function initAutoComplete(){
				var options = {
					// bounds: new google.maps.LatLngBounds(southwest, northeast),
					componentRestrictions: {country: "us"}//Make the range fixed
				}

				autocomplete = new google.maps.places.Autocomplete(document.getElementById('houseAddress'), options);
				autocomplete.addListener('place_changed',geolocate);
			}

			function geolocate(){
				var place = autocomplete.getPlace();
				//console.log(JSON.stringify(place));
				if(place){
					console.log(place);
					console.log(place.geometry.location['lat']);
					for(var i = 0 ;i < place.address_components.length;i++){
				
					}
					loc = place.geometry.location;
				}
				else {
					alert("something wrong");
				}
			}

			$(document).ready(function() {
				$('#address_search').submit(function() {
					var toSend = $('#address_search').serializeArray();

					if(loc){
						toSend.push({'name':'latitude','value':loc['lat']});
						toSend.push({'name':'longitude','value':loc['lng']});
					}
					console.log(toSend);
					$.ajax({
						type:"POST",
						url:"/house/searchByAddress",
						data:$.param(toSend),
						datatype:'json',
						success: function(data) {
							html = "";
							for (i = 0; i < data.length; i++) {
								html += "<tr><td><button class='btn btn-primary btn-sm' onclick=window.location.href='modify/" + data[i].numberID + "'>Modify</button></td>";
								html += '<td>' +  data[i].fullHouseID+ '</td>';
								html += '<td>' +  data[i].houseAddress+ '</td>';
								html += '<td>' +  data[i].city+ '</td>';
								html += '<td>' +  data[i].state+ '</td>';
								html += '<td>' +  data[i].houseowner.first + ' ' + data[i].houseowner.last + '</td>';
							}
							$('#t_content').html(html);
							$('#houseList').show();
						}
					});
				});

				$('#houseid_search').submit(function() {
					var toSend = $('#houseid_search').serializeArray();
					console.log(toSend);
					$.ajax({
						type:"POST",
						url:"/house/searchByID",
						data:$.param(toSend),
						datatype:'json',
						success: function(data) {
							html = "";
							for (i = 0; i < data.length; i++) {
								html += '<tr><td><button class="btn btn-primary btn-sm">Modify</button></td>';
								html += '<td>' +  data[i].fullHouseID+ '</td>';
								html += '<td>' +  data[i].houseAddress+ '</td>';
								html += '<td>' +  data[i].city+ '</td>';
								html += '<td>' +  data[i].state+ '</td>';
								html += '<td>' +  data[i].houseowner.first + ' ' + data[i].houseowner.last + '</td>';
							}
							$('#t_content').html(html);
							$('#houseList').show();
						}
					});
				});

				$('#owner_search').submit(function() {
					var toSend = $('#owner_search').serializeArray();
					console.log(toSend);
					$.ajax({
						type:"POST",
						url:"/house/searchOwner",
						data:$.param(toSend),
						datatype:'json',
						success: function(data) {
							html = "";
							for (i = 0; i < data.length; i++) {
								html += "<tr><td><button class='btn btn-primary btn-sm' onclick=selectOwner(" + data[i].houseOwnerID + ")>Select</button></td>";
								html += '<td>' +  data[i].houseOwnerID + '</td>';
								html += '<td>' +  data[i].first + '</td>';
								html += '<td>' +  data[i].last + '</td>';
								html += '<td>' +  data[i].ownerUsPhoneNumber + '</td>';
								html += '<td>' +  data[i].ownerWechatUserName + '</td>';
								html += '<td>' +  data[i].ownerWechatID + '</td>';
							}
							$('#t_content_owner').html(html);
							$('#ownerList').show();
						}
					});
				});
			});

			function selectOwner(id) {
				console.log(id);
				toSend = Array();
				toSend.push({'name':'id', 'value':id});
				console.log(toSend);
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type:"POST",
					url:"/house/searchByOwner",
					data: toSend,
					datatype:'json',
					success: function(data) {
						html = "";
						for (i = 0; i < data.length; i++) {
								html += "<tr><td><button class='btn btn-primary btn-sm'>Modify</button></td>";
								html += '<td>' +  data[i].fullHouseID+ '</td>';
								html += '<td>' +  data[i].houseAddress+ '</td>';
								html += '<td>' +  data[i].city+ '</td>';
								html += '<td>' +  data[i].state+ '</td>';
								html += '<td>' +  data[i].houseowner.first + ' ' + data[i].houseowner.last + '</td>';
							}
						$('#t_content').html(html);
						$('#houseList').show();
					}
				});
			}

			function hideDiv() {
				$('#ownerList').hide();
				$('#houseList').hide();
			}
		</script>


	</head>

<body class="marginMe">
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" style="padding-top:5px;"><img src="{{asset("img/icon.png")}}" class="img-rounded img-responsive" width="45px" height="45px" alt=""></a>
			  <a class="navbar-brand" href="/MainPage">91bnb Manage System</a>
		</div>

		<div id="navbar" class="navbar-collapse collapse">
			<!-- navbar left -->
			<ul class="nav navbar-nav">
				<li class=""><a href="/MainPage">Home</a></li>
				<li class="active"><a>Modify House</a></li>
			</ul>
			<!-- navbar right -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-user"></span>
						{{$rep->repUserName}}
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li><a href="#">Change Password</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="/logout">Log Out</a></li>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div><!--/ container -->
</nav>
<!-- Fixed navbar -->

<div class="container" style="margin-top:70px;">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#address" onclick=hideDiv()>Search By Address</a></li>
		<li><a data-toggle="tab" href="#houseID" onclick=hideDiv()>Search By House ID</a></li>
		<li><a data-toggle="tab" href="#houseOwner" onclick=hideDiv()>Search By House Owner</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="address">
			<form style="margin-left:40px;" method = "post" id="address_search" onsubmit='return false;'>
				{{csrf_field()}}
				<div class="row gap">
					<div class="col-sm-6">
						<label>House Address</label>
						<input class="form-control input-sm"  type="text" id="houseAddress" name="houseAddress" placeholder="Enter and address,neighborhood,city" >
					</div>

					<div class="col-sm-2">
						<label>Apply Range</label>
						<select class="form-control input-sm" id="milesrange" name="milesrange">
							<OPTION value=1>&nbsp;&nbsp;1 Mile</OPTION>
							<OPTION value=2 selected>&nbsp;&nbsp;2 Miles</OPTION>
							<OPTION value=5 >&nbsp;&nbsp;5 Miles</OPTION>
							<OPTION value=10>10 Miles</OPTION>
							<OPTION value=20>20 Miles</OPTION>
							<OPTION value=30>30 Miles</OPTION>
						</select>
					</div>
				</div>

				<div class="row gap">
					<div class="col-lg-2">
						<button class="btn btn-primary btn-sm" type="submit">Search Houses</button>
					</div>
				</div>
			</form>
		</div>

		<div class="tab-pane fade" id="houseID">
			<form style="margin-left:40px;" method = "post" id="houseid_search" onsubmit='return false;'>
				{{csrf_field()}}
				<div class="row gap">
					<div class="col-sm-6">
						<label>House ID</label>
						<input type="text" name="fullHouseID" size="30" class="form-control input-sm" placeholder="91bnb_State_City_Num">
					</div>
				</div>

				<div class="row gap">
					<div class="col-lg-2">
						<button class="btn btn-primary btn-sm" type="submit">Search Houses</button>
					</div>
				</div>
			</form>
		</div>

		<div class="tab-pane fade" id="houseOwner">
			<form style="margin-left:40px;" method = "post" id="owner_search" onsubmit='return false;'>
				{{csrf_field()}}
				<div class="row gap">
					<div class="col-lg-2">
						<label>First Name</label>
						<input type="text" name="first" class="form-control input-sm" placeholder="First Name">
					</div>

					<div class="col-lg-2">
						<label>Last Name</label>
						<input type="text" name="last" class="form-control input-sm" placeholder="Last Name">
					</div>

					<div class="col-lg-2">
						<label>Owner ID</label>
						<input type="number" name="houseOwnerID" class="form-control input-sm" placeholder="Owner ID">
					</div>

					<div class="col-lg-3">
						<label>Owner WeChat Username</label>
						<input type="text" name="ownerWechatUserName" class="form-control input-sm" placeholder="Owner WeChat Username">
					</div>

					<div class="col-lg-2">
						<label>Owner WeChat ID</label>
						<input type="text" name="ownerWechatID" class="form-control input-sm" placeholder="Owner Wechat ID">
					</div>
				</div>

				<div class="row gap">
					<div class="col-lg-2">
						<button class="btn btn-primary btn-sm" type="submit">Search Houses</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="container" id='ownerList' style="margin-top:20px;display:none;">
	<div class='well' style='background:white;'>
		<!-- <nav class='navbar navbar-default'>
			<h3 align=middle>House List</h3>
		</nav> -->
		<!-- <div class='table-responsive' style='padding:15px;'> -->
		<table class="table table-hover">
			<thead>
				<th></th><th>Owner ID</th><th>First Name</th><th>Last Name</th><th>US Phone</th><th>WeChat Username</th><th>WeChat ID</th>
			</thead>
			<tbody id='t_content_owner'>
			</tbody>
		</table>
		<!-- </div> -->
		<div id='pagination'>
		</div>
	</div>
</div>

<div class="container" id='houseList' style="margin-top:20px;display:none;">
	<div class='well' style='background:white;'>
		<!-- <nav class='navbar navbar-default'>
			<h3 align=middle>House List</h3>
		</nav> -->
		<!-- <div class='table-responsive' style='padding:15px;'> -->
		<table class="table table-hover">
			<thead>
				<th></th><th>House ID</th><th>Address</th><th>City</th><th>State</th><th>Hosue Owner Name</th>
			</thead>
			<tbody id='t_content'>
			</tbody>
		</table>
		<!-- </div> -->
		<div id='pagination'>
		</div>
	</div>
</div>

</body>
</html>
