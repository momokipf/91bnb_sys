@extends('navbar')
@section('title', 'House Search')

@section('head')
    <link rel="stylesheet" href="{{asset('css/priceswitch.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">


    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />  
    
    <script src="{{asset('js/bootbox.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>
    

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
@endsection

@section('inbody', ' class=marginMe onload=doload()')

@section('content')
    <!-- Fixed navbar -->
    <div class="searchdiv">
        <div class = "col-sm-12">
            <ul class="nav nav-tabs" id="searchbar">
                <li class="active"><a data-toggle="tab" href="#aboutLocation" onclick="$('#houseID').val('');">Basic Search</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Advanced search<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#searchByHouseID" data-toggle="tab">Search by House ID</a></li>
                        <li><a href="#searchByOwner" data-toggle="tab">Search by Owner</a></li>
                    </ul>
                </li>
            </ul>

            <div class="tab-content">
                    <!-- house condition -->
                <div class="tab-pane fade in active" id="aboutLocation">
                    <form id="houseSearchForm" action="/houses/results" method="GET">
                    <!-- {{csrf_field()}} -->
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Inquerier ID</label>
                                    @if(isset($inquirerID))
                                    <input class="form-control input-sm" type="text" id="inquirerID" name="inquirerID" value="{{$inquirerID}}" readonly>
                                    @else
                                    <input class="form-control input-sm" type="text" id="inquirerID" name="inquirerID" readonly>
                                    @endif
                                        
                                </div>

                                <div class="col-lg-4">
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
                                    @if(!isset($Query))
                                        <input id="address" >
                                    @else
                                        <input id="address" value="{{$Query->country}} {{$Query->state}} {{$Query->city}}" >
                                    @endif
                                    <input id='postal_code' name="zipcode" maxlength="5">
                                    <input id='search_latitude' name='search_latitude'>
                                    <input id='search_longitude' name='search_longitude'>
                                    <input name='houseID' >
                                    <input name='houseOwnerID' >
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <label>House Address <span style="color:red;">*</span></label>
                                    @if(!isset($Query))
                                    <input class="form-control input-sm"  type="text" id="houseAddress" name="houseAddress" placeholder="Enter and address,neighborhood,city,zipcode" >
                                    @else
                                    <input class="form-control input-sm"  type="text" id="houseAddress" name="houseAddress" placeholder="Enter and address,neighborhood,city,zipcode" readonly>
                                    @endif
                                </div>

                                <div class="col-lg-3">
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

                            <div class="row">
                                <div class="col-lg-8">
                                <label> Calendar </label>
                                @if(!isset($Query))
                                    <input type="text" id="daterange" class="form-control" value="" />
                                @else
                                    <input type="text" id="daterange" class="form-control" value="07/28/2017 - 08/01/2017" >
                                @endif
                                </div>
                                <input name = "checkIn" hidden>
                                <input name = "checkOut" hidden>

                            </div>


                            <label>Rent Type</label>
                            <div class="row">
                                <div class="col-lg-4">
                                    @if(isset($Query)|| (isset($Query->share)&&$Query->share==1))
                                        <input type="radio" id="rentWhole" name="rentShareWhole" value="1" checked> Whole
                                    @else
                                        <input type="radio" id="rentWhole" name="rentShareWhole" value="1"> Whole
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    @if(isset($Query) && (isset($Query->share)&&$Query->share==-1))
                                        <input type="radio" id="rentShare" name="rentShareWhole" value="-1" checked> Shared
                                    @else
                                        <input type="radio" id="rentShare" name="rentShareWhole" value="-1"> Shared
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    @if((isset($Query)&&isset($Query->share)&&$Query->share==0) || !isset($Query) )
                                        <input type="radio" id="rentEither" name="rentShareWhole" value="0" checked> Either
                                    @else 
                                        <input type="radio" id="rentEither" name="rentShareWhole" value="0" > Either
                                    @endif
                                </div>
                            </div>


                            <label>Guests constraints</label>
                            <div class="row">
                                <div class="col-lg-2">
                                    <input type="checkbox" value="1" name="allowPregnant" 
                                        @if(!isset($Query)&&isset($Query->pregnancy)&&$Query->pregnancy==1){
                                            checked
                                        @endif
                                        >&nbspPregnant</input>
                                </div>
                                <div class="col-lg-2">
                                    <input type="checkbox" value="1" name="allowBaby"
                                        @if(!isset($Query)&&isset($Query->hasBaby)&&$Query->hasBaby==1)
                                            checked
                                        @endif
                                        >&nbspBaby</input>
                                </div>
                                <div class="col-lg-2">
                                    <input type="checkbox" value="1" name="allowKid" id="allowKid"
                                        @if(!isset($Query)&&isset($Query->numOfChildren)&&$Query->numOfChildren>0)
                                            checked
                                        @endif
                                        >&nbspKid</input>
                                </div>
                                <div class="col-lg-2">
                                    <input type="checkbox" value="1" name="allowPets" id="allowPets"
                                        @if(!isset($Query)&&isset($Query->pet)&& $Query->pet==1)
                                            checked
                                        @endif
                                        >&nbspPet
                                </div>
                                <div class="col-lg-2">
                                    <input type="checkbox" value="1" name="havePet" id="havePet">Have Pet</input>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
                                    <label>Number of Adults</label>
                                    @if(!isset($Query)&&isset($Query->numOfAdult))
                                    <input class="form-control input-sm" type="number" id="numOfAdults" name="numOfAdults" value="{{$Query->numOfAdult}}">
                                    @else
                                    <input class="form-control input-sm" type="number" id="numOfAdults" name="numOfAdults" value="0">
                                    @endif
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-12">
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
                                <div class="col-lg-8">
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
                                <div class="col-lg-12">
                                    <div class="alert alert-warning">
                                        <h5><i class="fa fa-info-circle" aria-hidden="true"></i><em><strong> Note:</strong> * indicates required field. </em>
                                      </h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div> <!-- / house condition -->

                <div class="tab-pane fade" id="searchByHouseID">
                    <form id ="houseIDsearchForm" class="searchtypediv">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-8">
                                <label> House ID </label>
                                @if(isset($fullHouseID))
                                <input class="form-control input-sm" type="text" id="houseID" name="houseID" placeholder="Format: 91bnb_State_City_0000" value="{{$fullHouseID}}">
                                @else
                                <input class="form-control input-sm" type="text" id="houseID" name="houseID" placeholder="Format: 91bnb_State_City_0000">
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="searchByOwner">
                    <form id ="ownersearchForm" class="searchtypediv">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-10">
                            <label>DO YOU KNOW OWNER ID?</label>
                            <div class="onoffswitch" style="margin: auto;">
                                <input type="checkbox" class="onoffswitch-checkbox" id="ownerknownswitch" unchecked >
                                <label class="onoffswitch-label" for="ownerknownswitch" >
                                    <span class="onoffswitch-inner" id="ownerknownswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div id="knowowneridDiv" style="display:none;">
                                <div class="col-lg-12">
                                    <label>Owner ID</label>
                                    <input type="text" name="houseOwnerID" id="houseOwnerID" class="form-control input-sm" placeholder="Owner ID">

                                </div>

                            </div>
                        </div>
                        <div id="dontknowowneridDiv" style="display:none;">
                            <div class="row">
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

                                <div class="col-lg-3">
                                    <label>WeChat ID</label>
                                    <input type="text" name="ownerWechatID" class="form-control input-sm" placeholder="Owner Wechat ID">
                                </div>
                            </div>
                            <div class="row" style="margin: auto;">
                                <!-- <div > -->
                                <label style="visibility:hidden">Owner Search</label>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#search_result_modal" id="ownerIDsearch" type="button" >
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search ownerID</button>
                                <!-- <button class="btn btn-success" type="button" id="myBtn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Apply Filter</button> -->
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
@endsection

@section('script')
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
                $('#dontknowowneridDiv').find('input').val('');
            }
        }
        function doload(){
            changeswitchview();
        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAAIAQT72snLXj_BITkOc5TMZjpTrzbYRw&language=en&callback=initialize">
    </script>
    <script>

        $(document).ready(function(){
            $("#ownerIDsearch").click(function(){
                var toSend = $('#ownersearchForm').serialize();
                $.ajax({
                    type:"POST",
                    url:"/houseowner/search",
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


                if($('#houseOwnerID').val()){
                    $('#houseSearchForm').find("input[name='houseOwnerID']").val($('#houseOwnerID').val());
                }
                if($('#houseID').val()){
                    $('#houseSearchForm').find("input[name='houseID']").val($('#houseID').val());
                }
                $('#houseSearchForm').submit();
            });
        });
        
        $('#ownerknownswitch').change(changeswitchview);

        $('#daterange').daterangepicker({
            startDate: 0,
        }).on('change',function(){
            var date = $(this).val().split('-');
            $('#houseSearchForm').find('input[name="checkIn"]').val(converttimetosql(date[0]));
            $('#houseSearchForm').find('input[name="checkOut"]').val(converttimetosql(date[1]));
        });

        function vieweffect(id) {
            $('#houseOwnerID').val(id);
            $('#ownerknownswitch').prop( "checked",true);
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
@endsection

<!DOCTYPE html>
<html>
<head>
		
	
	
</head>

<body>
	
	


	

</body>
</html>
