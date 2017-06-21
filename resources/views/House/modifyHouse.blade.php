
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
	<form style="margin-left:40px;" method = "post" id="modifyForm" onsubmit='return false;'>
		{{csrf_field()}}
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#house">House</a></li>
			<li><a data-toggle="tab" href="#condition">Condition</a></li>
			<li><a data-toggle="tab" href="#availability">Availability</a></li>
			<li><a data-toggle="tab" href="#price">Price</a></li>
			<li><a data-toggle="tab" href="#room">Room (Optional)</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade in active" id="house">
				<div class='row'>
                    <div class='col-sm-3'>
                        <label>House ID</label>
                        <input class='form-control input-sm' value='".$fullHouseID."' readonly>
                    </div>

                    <div class='col-sm-2'>
                        <label>House Owner ID</label>
                        <input name='houseOwnerID' value='".$row['houseOwnerID']."' class='form-control input-sm'>
                    </div>

                    <div class='col-sm-2'>
                        <label>Date House Added</label>
                        <input type='search' name='dateHouseAdded' value='".$newHouseAddedDate."' class='form-control input-sm'>
                    </div>
              	</div>



              	<div class='row'>
                    <div class='col-sm-2'>
                        <label>House ID by Owner</label>
                        <input type='text' name='houseIDByOwner' value='".$row['houseIDByOwner']."' class='form-control input-sm'>
                    </div>

                    <div class='col-sm-3'>
                        <label>Representative with Owner</label>
                        <select name='repWithOwner' class='form-control input-sm'>";
                        printListRep($row['repWithOwner']);
                   	</select>
                    </div>
              	</div>";



         		<div class='row'>
					<div class='col-sm-2'>
						<label>Country</label>
						<select class='form-control input-sm' type='text' name='country' id='country'>";
							list_to_select("../list/countryList", $row["country"]);
						</select>
					</div>

                    <div class='col-sm-2'>
                        <label>State or Province</label>
                        <select id='state' name='state' class='form-control input-sm'>";
                    	</select>
                    </div>

                    <div class='col-sm-2'>
                        <label>City</label>
						<select id='city' name='city' class='form-control input-sm'>";
													
                  		</select>
                    </div>
              	</div>


         		<div class='row'>
					<div class='col-sm-2'>
							<label>Region</label>
							<input class='form-control input-sm' type='text' name='region' value=".$row['region'].">
					</div>

					<div class='col-sm-4'>
							<label>House Address</label>
							<input type='text' name='houseAddress' id='houseAddress' onFocus='initialize()' value='".$row['houseAddress']."' class='form-control input-sm'>
					</div>

                    <div class='col-sm-2'>
                        <label>Zip</label>
                        <input class='form-control input-sm' type='text' name='houseZip' value=".$row['houseZip'].">
                    </div>
              	</div>

         		<div class='row'>
                    <div class='col-sm-2'>
                        <label>House Type</label>
						<select class='form-control input-sm' id='houseType' name='houseType'>";
	    				</select>
					</div>

					<div class='col-sm-2' id='houseTypeOtherDiv'>
	                    <label>House Type Other</label>
	                    <input type='text' name='houseTypeOther' id='houseTypeOther' class='form-control input-sm' value=".$row['houseTypeOther']." >
	                </div>

                    <div class='col-sm-2'>
                        <label>Size</label>
                        <div class='input-group'>
                            <input name='size' value=".$row['size']." class='form-control input-sm'>
                            <span class='input-group-addon'>Sq.ft.</span>
                        </div>
                    </div>
              	</div>



         		<div class='row'>
                    <div class='col-sm-2'>
                        <label>Number of Rooms</label>
                        <input name='numOfRooms' value=".$row['numOfRooms']." class='form-control input-sm'>
                    </div>

                    <div class='col-sm-2'>
                        <label>Number of Baths</label>
                        <input name='numOfBaths' value=".$row['numOfBaths']." class='form-control input-sm'>
                    </div>

                    <div class='col-sm-2'>
                        <label>Number of Beds</label>
                        <input name='numOfBeds' value=".$row['numOfBeds']." class='form-control input-sm'>
                    </div>

					<div class='col-sm-2'>
					   <label>Max Number of Guests</label>
					   <input name='maxNumOfGuests' value=".$row['maxNumOfGuests']." class='form-control input-sm'>
					</div>
              	</div>

		 		<div class='row'>
		 			<div class='col-sm-8'>
		 				<label>On Other Website</label>
           				<input type=\"text\" name=\"onOtherWebsite\" class=\"form-control input-sm\" value=".$row['onOtherWebsite'].">
        			</div>
        		</div>
			</div>

			<div class="tab-pane fade" id="condition">
				<div class="row gap">
					<div class="col-sm-6">
						<label>House ID</label>
						<input type="text" name="fullHouseID" size="30" class="form-control input-sm" placeholder="91bnb_State_City_Num">
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="availability">
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
			</div>

			<div class="tab-pane fade" id="price">
				<div class="row gap">
					<div class="col-sm-6">
						<label>House ID</label>
						<input type="text" name="fullHouseID" size="30" class="form-control input-sm" placeholder="91bnb_State_City_Num">
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="room">
				<div class="row gap">
					<div class="col-sm-6">
						<label>House ID</label>
						<input type="text" name="fullHouseID" size="30" class="form-control input-sm" placeholder="91bnb_State_City_Num">
					</div>
				</div>
			</div>
		</div>

		<div style='text-align:center; margin: 25px 0 200px 0;'>
			<button class="btn btn-primary btn-sm" type="submit">Save Modified Info</button>
		</div>
	</form>
</div>

</body>
</html>
