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
		<link rel="stylesheet" href="{{asset('css/animate.css')}}">
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

        #ownerknownswitch-inner:before{
            content:"I don't know";
        }
        #ownerknownswitch-inner:after{
            content:"I know";
        }
        .searchdiv{
        	margin: auto;
        	width:60%;
        }
        .searchtypediv{
            /*margin-left: 5px;*/
            border-left: 4px solid red;
            background-color: WhiteSmoke;
        }
	</style>
	<script>
		var autocomlete;
		var componentForm = {
            //street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'short_name',
            postal_code: 'short_name'
        };
        var itemsToShow = [
            'numberID', 'state', 'city', 'houseAddress',
            'numOfRooms', 'numOfBaths',
            'OwnerName', 'ownerUsPhoneNumber','ownerWechatUserName',
            //'costMonthPrice', 'costDayPrice', 'nextAvailableDate',
            'houseType','minStayTerm','rentShared',
            // ,'OwnerName', 'ownerUsPhoneNumber', 'ownerWechatUserName','ownerWechatID'
        ];		
        function initAutoComplete(){
            var options = {
            // bounds: new google.maps.LatLngBounds(southwest, northeast),
            componentRestrictions: {country: "us"}//Make the range fixed
            }

            autocomplete = new google.maps.places.Autocomplete(
                (document.getElementById('houseAddress')),
                options);
            autocomplete.addListener('place_changed',geolocate);
        }

        function initialize(){
            //initMap();
            initAutoComplete();
        }
        function geolocate(){
            var place = autocomplete.getPlace();
            //console.log(JSON.stringify(place));
            if(place){
                for(var i = 0 ;i < place.address_components.length;i++){
                    var addressType = place.address_components[i].types[0];
                    if(componentForm[addressType]){
                        var val = place.address_components[i][componentForm[addressType]];
                        document.getElementById(addressType).value = val;
                    }
                }
                search_geo = place.geometry;
                document.getElementById('address').value = document.getElementById('houseAddress').value;
                $('#search_latitude').val(search_geo['location']['lat']);
                $('#search_longitude').val(search_geo['location']['lng']);

            }
            else {
                alert("something wrong");
            }
        }
		function changeswitchview(){
            /*
            *display the proper content based on the ownerknownswitch
            */
            if(document.getElementById("ownerknownswitch").checked){
                $('#knowowneridDiv').show();
                $('#dontknowowneridDiv').hide();
            }
            else{
                $('#knowowneridDiv').hide();
                $('#dontknowowneridDiv').show();
            }
        }
        function doload(){
            changeswitchview();
        }
	</script>
</head>

<body class="marginMe" onload="doload()">
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
	              <a class="navbar-brand" style="padding-top:5px;"><img src="../img/icon.png" class="img-rounded img-responsive" width="45px" height="45px" alt=""></a>
	              <a class="navbar-brand" href="mainPage">91bnb Manage System</a>
	        </div>

	    <div id="navbar" class="navbar-collapse collapse">
	          <!-- navbar left -->
	          <ul class="nav navbar-nav">
	            <li class=""><a href="/MainPage">Home</a></li>
	            <li class="active"><a>House Search</a></li>
	          </ul>
	          <!-- navbar right -->
	          <ul class="nav navbar-nav navbar-right">
	              <li class="dropdown">
	                  <a href="#" class=
	                  "dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	                      <span class="glyphicon glyphicon-user"></span>
	                        {{$Rep->repUserName}}
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
	<div class="searchdiv" style="margin-top:70px;">
		<div class = "col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#aboutLocation">Basic Search</a></li>
                <!-- <li><a data-toggle="tab" href="#aboutdetail">aboutdetail</a></li> -->
            <!-- <li><a data-toggle="tab" href="#aboutCheckin">Check-In/Out Date</a></li> -->
                <!-- <li><a data-toggle="tab" href="#aboutCondition">House Condition</a></li> -->
                <!-- <li><a data-toggle="tab" href="#aboutPrice">House/Room Price</a></li> -->
                <li><a data-toggle="tab" href="#advancedsearch">Advanced search</a></li>
            </ul>

            <div class="tab-content">

                    <!-- house condition -->
                <div class="tab-pane fade in active" id="aboutLocation">
                    <form id="houseSearchForm" action="/houses/results" method="GET">
                    <!-- {{csrf_field()}} -->
                        <div class="row">
            				<div class="row">
        						<div class="col-sm-4">
        							<label>Inquerier ID</label>
                                    @if(isset($inquirerID))
                                    <input class="form-control input-sm" type="text" id="inquirerID" name="inquirerID" value="{{$inquirerID}}" readonly>
                                    @else
                                    <input class="form-control input-sm" type="text" id="inquirerID" name="inquirerID" readonly>
                                    @endif
        								
        						</div>

        						<div class="col-sm-4">
        							<label>Representatives</label>
                                    @if(isset($searchrepID))
                                    <input class="form-control input-sm" type="text" id="repWithOwner" name="repWithOwner" value="{{$repID}}" readonly>
                                    @else
                                    <input class="form-control input-sm" type="text" id="repWithOwner" name="repWithOwner" readonly>
        							@endif
        						</div>
            				</div>
                            <!-- <div clas="searchtype"> -->
                            <div class="row" hidden>
                                    <input name = "country"  id="country">
                                    <input id="administrative_area_level_1" name="state">
                                    <input id="locality" name="city">
                                    <input id="route" name="route">
                                    <input id="address" diabled>
                                    <input id='postal_code' name="zipcode" maxlength="5">
                                    <input id='search_latitude' name='search_latitude'>
                                    <input id='search_longitude' name='search_longitude'>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <label>House Address <span style="color:red;">*<span></label>
                                    <input class="form-control input-sm"  type="text" id="houseAddress" name="houseAddress" placeholder="Enter and address,neighborhood,city,zipcode" >
                                </div>

                                <div class="col-sm-3">
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

                            <div>
                                <label>Rent Type:</label>
                                <div class="tab">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            @if(isset($Query)|| (isset($Query->share)&&$Query->share==1))
                                                <input type="radio" id="rentWhole" name="rentShareWhole" value="1" checked> Whole
                                            @else
                                                <input type="radio" id="rentWhole" name="rentShareWhole" value="1"> Whole
                                            @endif
                                        </div>
                                        <div class="col-sm-4">
                                            @if(isset($Query) && (isset($Query->share)&&$Query->share==-1))
                                                <input type="radio" id="rentShare" name="rentShareWhole" value="-1" checked> Shared
                                            @else
                                                <input type="radio" id="rentShare" name="rentShareWhole" value="-1"> Shared
                                            @endif
                                        </div>
                                        <div class="col-sm-4">
                                            @if((isset($Query)&&isset($Query->share)&&$Query->share==0) || !isset($Query) )
                                                <input type="radio" id="rentEither" name="rentShareWhole" value="0" checked> Either
                                            @else 
                                                <input type="radio" id="rentEither" name="rentShareWhole" value="0" > Either
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div>
                                <label>Guests constraints</label>
                                <div class="tab">
                                     <div class="row">
                                        <div class="col-sm-2">
                                            <input type="checkbox" value="1" name="allowPregnant" 
                                                @if(!isset($Query)&&isset($Query->pregnancy)&&$Query->pregnancy==1){
                                                    checked
                                                @endif
                                                >&nbspPregnant
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="checkbox" value="1" name="allowBaby"
                                                @if(!isset($Query)&&isset($Query->hasBaby)&&$Query->hasBaby==1)
                                                    checked
                                                @endif
                                                >&nbspBaby
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="checkbox" value="1" name="allowKid" id="allowKid"
                                                @if(!isset($Query)&&isset($Query->numOfChildren)&&$Query->numOfChildren>0)
                                                    checked
                                                @endif
                                                >&nbspKid
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="checkbox" value="1" name="allowPets" id="allowPets"
                                                @if(!isset($Query)&&isset($Query->pet)&& $Query->pet==1)
                                                    checked
                                                @endif
                                                >&nbspPet
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="checkbox" value="1" name="havePet" id="havePet">Have Pet
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Number of Rooms</label>
                                    <div class="input-group beddiv">
<!--                                     <span class="input-group-addon">Range from</span> -->
                                        @if(!isset($Query)&&isset($Query->rooms))
                                        <input class="form-control input-sm" type="number" id="numOfRoomsFrom" name="numOfRoomsFrom" value="{{$Query->number}}" min="1">
                                        @else
                                        <input class="form-control input-sm" type="number" id="numOfRoomsFrom" name="numOfRoomsFrom" value="1" min="1">
                                        @endif
                                        <span class="input-group-addon">to</span>
                                        <input class="form-control input-sm" type="number" id="numOfRoomsTo" name="numOfRoomsTo" value="1" min="1">
<!--                                     <span class="input-group-addon">Rooms Per House</span> -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Number of Adults</label>
                                    @if(!isset($Query)&&isset($Query->numOfAdult))
                                    <input class="form-control input-sm" type="number" id="numOfAdults" name="numOfAdults" value="{{$Query->numOfAdult}}">
                                    @else
                                    <input class="form-control input-sm" type="number" id="numOfAdults" name="numOfAdults" value="0">
                                    @endif
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Monthly Price Approximate</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                            <input class="form-control input-sm" type="number" id="Price" name="Price" min='0' value='0' step='100'>
                                        <span class="input-group-addon">with Up/Down Rate of</span>
                                        <SELECT id='houseMonthlyRate' class='form-control input-sm' name="Rate">
                                                <OPTION value=5 selected>&nbsp;&nbsp;5%</OPTION>
                                                <OPTION value=10>10%</OPTION>
                                                <OPTION value=20>20%</OPTION>
                                                <OPTION value=50>50%</OPTION>
                                        </SELECT>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="col-sm-6">
                                        <div class="onoffswitch" style="margin: auto;">
                                            <input type="checkbox" name="houseroomswitch" class="onoffswitch-checkbox" id="houseroomswitch" checked>
                                            <label class="onoffswitch-label" for="houseroomswitch">
                                                <span class="onoffswitch-inner" id="houseroomswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="onoffswitch" style="margin: auto;">
                                            <input type="checkbox" name="monthdailyswitch" class="onoffswitch-checkbox" id="monthdailyswitch" checked>
                                            <label class="onoffswitch-label" for="monthdailyswitch">
                                                <span class="onoffswitch-inner" id="monthdailyswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-warning">
                                        <h5><i class="fa fa-info-circle" aria-hidden="true"></i><em><strong> Note:</strong> * indicates required field. </em>
                                      </h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div> <!-- / house condition -->

                    <!-- share -1, whole 1, either 0 -->
                    <!-- / Whole or Share -->
                    <!-- <div class="tab-pane fade" id="aboutCheckin">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Check-In Date</label>
                                @if(!isset($Query)&&isset($Query->checkIn))
                                <input class="form-control input-sm" type="search" id="checkin" name="checkin" value="{{$Query->checkIn}}">
                                @else
                                <input class="form-control input-sm" type="search" id="checkin" name="checkin">
                                @endif
                            </div>

                            <div class="col-sm-3">
                                <label>Check-Out Date</label>
                                @if(!isset($Query)&&isset($Query->checkOut))
                                <input class="form-control input-sm" type="search" id="checkout" name="checkout" value="{{$Query->checkOut}}">
                                @else
                                <input class="form-control input-sm" type="search" id="checkout" name="checkout">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-warning">
                                    <h5><i class="fa fa-info-circle" aria-hidden="true"></i><em><strong> Note:</strong> If guest didn't indicate the exact date, please apply the 1st of the month
                                    for Check-In date, and the end of the month for Check-Out date.</em>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-warning">
                                    <h5><i class="fa fa-info-circle" aria-hidden="true"></i><em><strong> Note:</strong> * indicates required field. </em>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id='checkDateCheck'></div>
                            </div>
                        </div>
                    </div> --><!-- / Check in and check out -->


                <div class="tab-pane fade" id="advancedsearch">
                    <form id="adhouseSearchForm">
                        {{csrf_field()}}
                        <div class="row">
                            <h5>Search By House ID:</h5>
                        </div>
                        <div class="row searchtypediv">
                            <div class="col-sm-8">
                                <!-- <label>House ID</label> -->
                                @if(isset($fullHouseID))
                                <input class="form-control input-sm" type="text" id="houseID" name="houseID" placeholder="Format: 91bnb_State_City_0000" value="{{$fullHouseID}}">
                                @else
                                <input class="form-control input-sm" type="text" id="houseID" name="houseID" placeholder="Format: 91bnb_State_City_0000">
                                @endif
                            </div>
                        </div>

                            <!-- <div class="row searchtypediv">
                                <div class="col-sm-10">
                                    <label>Cross Road Between</label>
                                    <div class="input-group">
                                        <input class="form-control input-sm" type="text" id="crossroadA" name="crossroadA" placeholder="Road A">
                                        <span class="input-group-addon">and</span>
                                        <input class="form-control input-sm" type="text" id="crossroadB" name="crossroadB" placeholder="Road B">
                                    </div>
                                </div>
                            </div> -->
                        <div class="row">
                            <h5>Search By Owner:</h5>
                        </div>
                        <div class="row">
                            <label>DO YOU KNOW OWNER ID?</label>
                            <div class="onoffswitch" style="margin: auto;">
                                <input type="checkbox" class="onoffswitch-checkbox" id="ownerknownswitch" unchecked >
                                <label class="onoffswitch-label" for="ownerknownswitch" >
                                    <span class="onoffswitch-inner" id="ownerknownswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row searchtypediv" id="knowowneridDiv" style="display:none;">
                            <div class="col-lg-2">
                                <label>Owner ID</label>
                                <input type="text" name="houseOwnerID" id="houseOwnerID" class="form-control input-sm" placeholder="Owner ID">
                            </div>
                        </div>

                        <div class="row searchtypediv" id="dontknowowneridDiv" style="display:none;">
                            <div class="col-lg-2">
                                <label>First Name</label>
                                <input type="text" name="first" class="form-control input-sm" placeholder="First Name">
                            </div>

                            <div class="col-lg-2">
                                <label>Last Name</label>
                                <input type="text" name="last" class="form-control input-sm" placeholder="Last Name">
                            </div>

                            <div class="col-lg-3">
                                <label>WeChat Username</label>
                                <input type="text" name="ownerWechatUserName" class="form-control input-sm" placeholder="Owner WeChat Username">
                            </div>

                            <div class="col-lg-2">
                                <label>WeChat ID</label>
                                <input type="text" name="ownerWechatID" class="form-control input-sm" placeholder="Owner Wechat ID">
                            </div>

                            <div class="col-lg-2">
                                <label style="visibility:hidden">Owner Search</label>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#search_result_modal" id="ownersearch" type="button" >Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div style="margin-top:30px; margin-bottom:50px;  margin:auto; width:50%">

                            <button class="btn btn-success" type="button" id="myBtn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search </button>
                            <button class="btn btn-warning disToLeft" type="reset" id = "refreshPage" onclick="location.reload(true);"><span class="glyphicon glyphicon-refresh"></span> Reset </button>
                            <!-- <button id="extall" type="button" class="btn btn-primary disToLeft"><span class="glyphicon glyphicon-download-alt"></span>
                                Export Filtered Result to Excel
                            </button> -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="search_result_modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">House Owner Search Result</h4>
                    </div>
                    <div id="display_search_result" class="modal-body">
                        <!-- display search result here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

	</div>


	<script async defer
	src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAAIAQT72snLXj_BITkOc5TMZjpTrzbYRw&language=en&callback=initialize">
	</script>
	<script>

		$(document).ready(function(){
			$("#ownersearch").click(function(){
		        var toSend = $('#adhouseSearchForm').serialize();
		        $.ajax({
		            type:"POST",
		            url:"/houseowner/search/similar",
		            data:toSend,
		            datatype:'json',
		            success: function(data){
		                var htmlcont = "";
		                if(data.length==0){
		                    htmlcont = "<span style='color:red;'>No records found.</span>";
		                }
		                else{
		                    htmlcont += "<div style='overflow:auto'>"+
		                                "<table class='table table-striped table-bordered'>"+
		                                "<tr>"+
		                                "<th></th>"+
		                                "<th style='min-width:100px;'>First Name</th>"+
		                                "<th style='min-width:100px;'>Last Name</th>"+
		                                "<th style='min-width:100px;'>WeChat ID</th>"+
		                                "<th style='min-width:160px;'>WeChat Username</th>"+
		                                "<th style='min-width:50px;'>ID</td>"+
		                                "</tr>"
		                for(i = 0 ;i<data.length;++i)
		                {
		                    htmlcont += "<tr><td data-dismiss='modal' style='cursor:pointer; text-decoration:underline; color:blue;' onclick=vieweffect(" + data[i].houseOwnerID + ")>Select</td>"+
		                                    "<td>"+data[i].first+"</td>"+
		                                    "<td>"+data[i].last +"</td>"+
		                                    "<td>"+data[i].ownerWechatID+"</td>"+
		                                    "<td>"+data[i].ownerWechatUserName+"</td>"+
		                                    "<td>"+data[i].houseOwnerID+"</td></tr>";
		                }
		                htmlcont += "</table></div>";
		                }
		                $("#display_search_result").html(htmlcont);


		            }
		        });
			
		    });
		    /*
		    TODO:(1)add link to initialize a GET request to server to get house info
		         (2)add link to initialize a GET request to server to get houseowner info
		    
		    */
		    $("#myBtn").click(function() {

		        if(!houseSearchcheck()){
		            return;
		        }
		        $('#houseSearchForm').submit();
		        // var toSend = $('#houseSearchForm').serializeArray();
		        // if($('#houseOwnerID').val()){
		        //     var houseownernode = document.getElementById('houseOwnerID');
		        //     toSend.push({'name':houseownernode.name,'value':houseownernode.value});
		        // }
		        // if($('#houseID').val()){
		        //     var houseidnode= document.getElementById('houseID');
		        //     toSend.push({'name':houseidnode.name,'value':houseidnode.value});
		        // }
		        // if(search_geo){
		        //     var location = search_geo['location'];
		        //     toSend.push({'name':'search_latitude','value':location['lat']});
		        //     toSend.push({'name':'search_longitude','value':location['lng']});
		        // }

		        // $.ajax({
		        //     type:"GET",
		        //     url:"/house/search",
		        //     data:$.param(toSend),
		        //     datatype:'json',
		        //     success: function(data){
		        //         if(map){
		        //             deleteMarkers();
		        //         }
		        //         //alert(JSON.stringify(data));

		        //         var houses = data.houses;
		        //         if(houses){
		        //             var tablehtml = "";
		        //             if(houses.length>0){

		        //                 $("#showResult").show();
		        //                 resultSM = makeResuiltSM();

		        //                 for(var i=0;i<houses.length;++i)
		        //                 {
		        //                     var loc = new google.maps.LatLng(houses[i].latitude,houses[i].longitude);
		        //                     var address = houses[i].houseAddress+','+houses[i].city+','+houses[i].state;
		        //                     var marker = new google.maps.Marker({
		        //                         position:loc,
		        //                         title: houses[i].fullHouseID,
		        //                         map:map
		        //                     });

		        //                     google.maps.event.addListener(marker,'click',infocallbackClosure(marker,houses[i].fullHouseID,houses[i].numberID,address,setinfohtml));
		        //                     housemarkers.push(marker);
		        //                     if (houses[i]['rentShared'] == '1') {
		        //                         houses[i]['rentShared'] = 'Whole';
		        //                     } else if (houses[i]['rentShared'] == '-1') {
		        //                         houses[i]['rentShared'] = 'Share';
		        //                     } else {
		        //                         houses[i]['rentShared'] = 'Either';
		        //                     }
		        //                     houses[i]['minStayTerm'] = houses[i]['minStayTerm'] + ' ' + houses[i]['minStayUnit'];

		        //                     var rowhtml = "<tr id='house_" + houses[i]['numberID'] + "'>";
		        //                     var numberID = houses[i].numberID;
		        //                     for(var j =0 ; j< itemsToShow.length;++j){

		        //                         if(itemsToShow[j]=='numberID'){
		        //                             rowhtml += "<td><a href='#map_div' onclick = 'makeMarkerBounce("+i+");' >" + 
		        //                                         numberID + "</a></td>";
		        //                         }
		        //                         else if(itemsToShow[j] == 'OwnerName'){
		        //                             rowhtml +=  "<td>"+houses[i].first + ' ' + houses[i].last + "</td>";
		        //                         }
		        //                         else if(itemsToShow[j] == 'ownerWechatUserName' ){
		        //                             rowhtml += "<td title='Wechat ID: " + houses[i]['ownerWechatID']+"'>"+houses[i][itemsToShow[j]] +"</td>";
		        //                         }
		        //                         else if(!houses[i][itemsToShow[j]]){
		        //                             rowhtml += "<td>N/A</td>";
		        //                         }
		        //                         else{
		        //                             rowhtml += "<td>"+houses[i][itemsToShow[j]] + "</td>"; 
		        //                         }
		        //                         //console.log(rowhtml);
		        //                     }

		        //                     //rowhtml += "<td><a onclick=' retrieveHouseInfo("+numberID+");' > View House Info</td>";
		        //                     rowhtml += "<td><button type='button' class='btm btn-info' onclick='retrieveHouseInfo("+houses[i].numberID+");resultSM.toHousePage("+i+")'>"+"View House Info"+"</button></td>";
		        //                     rowhtml += "<td><button type='button' class='btm btn-info' onclick='resultSM.toOwnerPage("+i+")'>View Owner Info</button></td>";
		        //                     rowhtml += "<td><button type='button' class='btm btn-info' href='MainPage'>Modify</button></td>"
		        //                     attachHouseOwnerDiv(houses[i],i);

		        //                     rowhtml += "</tr>";
		        //                     tablehtml += rowhtml;
		        //                 }
		        //                 showMarkers();

		        //                 $('#fillArea').html(tablehtml);
		        //             }
		        //             else
		        //             {
		        //                 $("#showResult").hide();
		        //                 // Notice that there is no result
		        //             }
		        //         }

		        //         if(search_geo){
		        //             mapMovecenter(search_geo);
		        //         }
		        //         else{
		        //             //alert(JSON.stringify(data.geo_center));
		        //             var loc = new google.maps.LatLng(data.geo_center.location.lat,data.geo_center.location.lng);
		        //             search_geo = {'location': loc};
		        //             mapMovecenter(search_geo);
		        //         }

		        //         search_geo=null;
		        //     }
		        // });
		    });
		});
		
		$('#ownerknownswitch').change(changeswitchview);

		function vieweffect(id) {
        	$('#houseOwnerID').val(id);
        	$('#ownerknownswitch').attr( "checked",true);
        	changeswitchview();
    	}

    	function houseSearchcheck(){
	        if(!$('#houseAddress').val()){
	            if($('#houseID').val()||$('#houseOwnerID').val()){
	                return true;
	            }
	            else {
	                bootbox.dialog({
	                    message:"Please Enter House Address for searching",
	                    title: "Error",
	                    buttons: {
	                        main: {
	                            label: "OK",
	                            className: "btn-primary"
	                        }
	                    }
	                });
	                return false;
	            }
	        }
	        return true;
    	}
	</script>

</body>
</html>
