@extends('navbar')
@section('title', 'House Search')

@section('head')
    <link rel="stylesheet" href="{{asset('css/priceswitch.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">

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

        #ownerknownswitch-inner:before{
            content:"I don't know";
        }
        #ownerknownswitch-inner:after{
            content:"I know";
        }

        .tab{
            margin-left: 5px;
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
    <div class="container-fluid" style="width:100%;height:100%">
        <div class="row equal">
            <div class = "col-sm-6">
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
                        <form id="houseSearchForm">
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
                                <div>
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
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Number of Rooms</label>
                                        <div class="input-group beddiv">
    <!--                                     <span class="input-group-addon">Range from</span> -->
                                            @if(!isset($Query)&&isset($Query->rooms))
                                            <input class="form-control input-sm" type="text" id="numOfRoomsFrom" name="numOfRoomsFrom" value="{{$Query->number}}">
                                            @else
                                            <input class="form-control input-sm" type="text" id="numOfRoomsFrom" name="numOfRoomsFrom" value=1 >
                                            @endif
                                            <span class="input-group-addon">to</span>
                                            <input class="form-control input-sm" type="text" id="numOfRoomsTo" name="numOfRoomsTo">
    <!--                                     <span class="input-group-addon">Rooms Per House</span> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Number of Adults</label>
                                        @if(!isset($Query)&&isset($Query->numOfAdult))
                                        <input class="form-control input-sm" type="number" id="numOfAdults" name="numOfAdults" value="{{$Query->numOfAdult}}">
                                        @else
                                        <input class="form-control input-sm" type="number" id="numOfAdults" name="numOfAdults">
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
                    <div style="margin-top:30px; margin-bottom:50px;">
                                <button class="btn btn-success" type="button" id="myBtn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Apply Filter</button>
                                <button class="btn btn-warning disToLeft" type="reset" id = "refreshPage" onclick="location.reload(true);"><span class="glyphicon glyphicon-refresh"></span> Reset Filter</button>
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

            <div class="col-sm-6">
                <div id="map_div">
                    <div id="map">
                    </div>
                </div>
            </div>
        </div>


        <hr>

        <div class="" id="showResult" style="width='100%';margin-top:60px;display:none" >
            <div class="row" id="back_menu" sytle="visibility:hidden">
                <!-- <button><p><i class="arrow left" ></i>Back</p></button> -->
                <a class="previous" onclick="resultSM.toTablePage()" >&laquo; Previous</a>
            </div>
            <table id="housestable" class="table table-bordered table-striped text-center" style="font-size:12px;">
                <thead>
                    <tr>
                        <th style="min-width:50px;">Number ID</th>
                        <!-- <th style="min-width:100px;">House ID</th> -->
                        <th style="min-width:100px;">State</th>
                        <th style="min-width:100px;">City</th>
                        <th style="min-width:150px;">House Address</th>
                        <th style="min-width:50px;">Number of Rooms</th>
                        <th style="min-width:50px;">Number of Baths</th>

                        <th style="min-width:170px;">Owner Name</th>
                        <th style="min-width:170px;">Owner Phone Number</th>
                        <th style="min-width:150px;">WeChat Name</th>

                        <th style="min-width:100px;">House Type</th>
    <!--                     <th style="min-width:100px;">Price per Month</th>
                        <th style="min-width:100px;">Price per Day</th>
                        <th style="min-width:150px;">Next Available Date</th> -->

                        <th style="min-width:100px;">Minimum Stay Term</th>
                        <th style="min-width:100px;">Whole/Share</th>
                        <th style="min-width:150px;">View House info</th>
                        <th style="min-width:150px;">View Owner info</th>
                        <th style="min-width:100px;">Modify</th>
                        <!--<th style="min-width:170px;">Owner Phone Number</th>
                        <th style="min-width:170px;">Owner Name</th>
                        <th style="min-width:150px;">WeChat Name</th>
                        <th style="min-width:100px;">WeChat ID</th> -->
                    </tr>
                </thead>
                <tbody id="fillArea">

                </tbody>

            </table>
            <div id = "ownerdiv" >
            </div>
            <div id = "housediv" class="container" style="display:none">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#HouseBasicinfo">Basic Info</a></li>
                    <li><a data-toggle="tab" href="#HouseCondition">Condition</a></li> 
                    <li><a data-toggle="tab" href="#HouseAvailability">Availability</a></li>
                    <li><a data-toggle="tab" href="#HousePrice">Price</a></li>
                    <!-- <li><a data-toggle -->
                </ul>
                <div class="tab-content">
                    <div id="HouseBasicinfo" class="tab-pane fade in active" style="pading:20px;">
                        <div class="row" >
                            <div class="col-sm-2 input-w">
                                <label>House ID:</label><p id="houseid_info"></p>
                             </div>  
                            <div class='col-sm-2'>
                                <label>House Owner ID:</label>
                                <p id='houseOwnerID_info'></p>
                            </div> 
                            <div class='col-sm-2'>
                                <label>House ID in Owner:</label>
                                <p id='houseIDByOwner_info'></p>
                            </div> 
                        </div>

                        <div class='row'>
                            <div class="col-sm-2 input-w">
                                <label for="country_info">Country:</label><p id="country_info"></p>
                            </div>
                            <div class="col-sm-2 input-w">
                                <label>State:</label><p id="state_info"></p>
                            </div>
                            <div class="col-sm-2 input-w">
                                <label>City:</label><p id="city_info"></p>
                            </div>
                            <div class='col-sm-2'>
                                <label>Region:</label>
                                <p id='region_info'></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class='col-sm-6'>
                                <label>House Address:</label>
                                <p id='houseAddress_info'></p>
                            </div>
                            <div class='col-sm-2'>
                                <label>Zip:</label>
                                <p id='houseZip_info'></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class='col-sm-4'>
                                <label>House Type:</label>
                                <p id="houseType_info"></p>
                            </div>
                            <div class='col-sm-4'>
                                <label>Size:</label>
                                <p id="size_info"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class='col-sm-2'>
                                <label>Number Of Rooms:</label>
                                <p id='numOfRooms_info'></p>
                            </div>
                            <div class='col-sm-2'>
                                <label>Number Of Baths:</label>
                                <p id='numOfBaths_info'></p>
                            </div>
                            <div class='col-sm-2'>
                                <label>Number Of Beds:</label>
                                <p id='numOfBeds_info'></p>
                            </div>
                            <div class='col-sm-2'>
                                <label>Max Number of Guests</label>
                                <p id='maxNumOfGuest_info'></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class='col-sm-4'>
                                <label>On Other Website</label>
                                <p id='onOtherWebsite_info'></p>
                            </div>
                        </div>
                    </div>

                    <div id="HouseCondition" class="tab-pane fade" style="padding:20px;font-size:12px">

                    </div>

                    <div id="HouseAvailability" class="tab-pane fade" style="padding:20px;font-size:12px">
                        <p><label>Whole/Share: </label><span id='rentShared'><span></p>
                        <p><label>Availablitity: </label><span id='availability'><span></p>
                        <p><label>Minimum Stay: </label><span id='minStayTerm'></span><span id='minStayUnit'></span></p>
                        <p><label>Allow Cooking: </label><span id='allowCooking'><span></p>
                        <p><label>Furnished: </label><span id='furnished'><span></p>
                        <p><label>Availability Note: </label><span id='availabilityNote'><span></p>
                    </div>

                    <div id="HousePrice" class="tab-pane fade" style="padding:20px;font-size:12px">
                        <p><label>Day Price:  $</label><span id='costDayPrice'><span></p>
                        <p><label>Week Price:  $</label><span id='costWeekPrice'><span></p>
                        <p><label>Month Price:  $</label><span id='costMonthPrice'><span></p>
                        <p><label>Utility:  $</label><span id='costUtility'><span></p>
                        <p><label>Cleaning Fee:  $</label><span id='costCleaning'><span></p>
                        <p><label>Deposite:  $</label><span id='costSecurityDeposit'><span></p>
                        <p><label>Utility Note:</label><span id='utilityNote'><span></p>
                        <p><label>Cost Note:</label><span id='costNote'><span></p>

                        <p><label>Retail Day Price:  $</label><span id='retailDayPrice'><span></p>
                        <p><label>Retail Week Price:  $</label><span id='retailWeekPrice'><span></p>
                        <p><label>Retail Month Price:  $</label><span id='retailMonthPrice'><span></p>
                        <p><label>Retail Utility:  $</label><span id='retailUtility'><span></p>
                        <p><label>Retail Cleaning Fee:  $</label><span id='retailCleaning'><span></p>
                        <p><label>Retail Deposite:  $</label><span id='retailSecurityDeposit'><span></p>

                        <p><label>Upsell Percent:</label><span id='upsellPercent'><span>%</p>
                        <p><label>TOT Percent:</label><span id='totPercent'><span>%</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- <div class="container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href"#"> -->

    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script>
        var autocomplete; 
        var search_geo;
        var map;
        var housemarkers = [];
        var componentForm = {
            //street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'short_name',
            postal_code: 'short_name'
        };
        var rangemarker;
        var itemsToShow = [
            'numberID', 'state', 'city', 'houseAddress',
            'numOfRooms', 'numOfBaths',
            'OwnerName', 'ownerUsPhoneNumber','ownerWechatUserName',
            //'costMonthPrice', 'costDayPrice', 'nextAvailableDate',
            'houseType','minStayTerm','rentShared',
            // ,'OwnerName', 'ownerUsPhoneNumber', 'ownerWechatUserName','ownerWechatID'
        ];
        var infowindow ;
        var resultSM;


        function initMap(){
            uluru = {lat: 36.778259, lng: -119.417931};
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: uluru
            });
            infowindow = new google.maps.InfoWindow({
            maxWidth:350
        });
            // var cityCircle = new google.maps.Circle({
            //   strokeColor: '#FF0000',
            //   strokeOpacity: 0.8,
            //   strokeWeight: 2,
            //   fillColor: '#FF0000',
            //   fillOpacity: 0.35,
            //   map: map,
            //   center: uluru,
            //   radius: 2000
            // });
        }

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
            initMap();
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
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAAIAQT72snLXj_BITkOc5TMZjpTrzbYRw&language=en&callback=initialize">
    </script>
    <script>

        $.fn.extend({
        animateCss: function (animationName) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            this.addClass('animated ' + animationName).one(animationEnd, function() {
                $(this).removeClass('animated ' + animationName);
            });
        }
        });


    //fix 0201 suppose all is formatted
    $(document).ready(function() {
        // locations
            $("#country").change(function(){
                if($(this).val().length!=0){
                    var countryfile = $(this).val().replace(' ','');
                    $.get("/resource/"+countryfile,function(data,status){
                    $('#state').empty();
                    for(i=0;i<data.length;++i){
                        var option = $("<option></option>").attr("value", data[i]).text(data[i]);
                        $('#state').append(option);
                    }
                    });
                }
            });

            $('#state').change(function(){
                if($(this).val().length!=0){
                    var cityfile = $("#country").val().replace(' ','')+"_"+$(this).val().replace(' ','');
                    $.get("/resource/"+cityfile,function(data,status){
                    $('#city').empty();
                    for(i=0;i<data.length;++i){
                        var option = $("<option></option>").attr("value", data[i]).text(data[i]);
                        $('#city').append(option);
                    }
                    });
                }
            });
            
            $("#allowKid").change(function(){
                if ($("#allowKid").is(":checked")) {
                    $("#allowKidAge").removeAttr("disabled");
                } else {
                    $("#allowKidAge").attr("disabled", "true");
                }
            });

            $("#allowPets").change(function(){
                if ($("#allowPets").is(":checked")) {
                    $("#allowPetType").removeAttr("disabled");
                } else {
                    $("#allowPetType").attr("disabled", "true");
                }
            });

            $("#havePet").change(function(){
                if ($("#havePet").is(":checked")) {
                    $("#havePetType").removeAttr("disabled");
                } else {
                    $("#havePetType").attr("disabled", "true");
                }
            });

            $('#ownerknownswitch').change(changeswitchview);

           $('#checkin').datepicker({
              dateFormat: "mm/dd/yy",
              beforeShow: function () {
                $('#checkin').datepicker('option', 'minDate', 0);
               
              },
              /*
              Display and send Date in different format 
              */
              onSelect:function(){
                var checkOutDate = $('#checkout').datepicker('getDate');
                var curCheckInDate= $('#checkin').datepicker('getDate');
                if(curCheckInDate>checkOutDate)
                {
                     // alert("error date");
                     var text='<div class="alert alert-warning"><h5><i class="fa fa-info-circle" aria-hidden=true></i><em><strong> Note:</strong>The Check-In Date should be earlier than Check-Out Date.</em></h5></div>';
                     $('#checkDateCheck').html(text);
                }else{
                    $('#checkDateCheck').html('');
                }
            
              }
             
             
            });

            $('#checkout').datepicker({
              dateFormat: "mm/dd/yy",
              beforeShow: function () {
                var checkin = $('#checkin').datepicker('getDate');
                checkin.setDate(checkin.getDate() + 1);
                $('#checkout').datepicker('option', 'minDate', checkin);
              }
            });

            if(document.getElementById('address').value){
                document.getElementById('houseAddress').value =  document.getElementById('address').value;
                $("#houseAddress").focus();
            }

            // $("#housestable").colResizable({liveDrag:true});
            //loadOpt();
            // alert((document.getElementById('houseAddress')).value);
            // alert((document.getElementById('milesrange')).value);


        });

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
            var toSend = $('#houseSearchForm').serializeArray();
            if($('#houseOwnerID').val()){
                var houseownernode = document.getElementById('houseOwnerID');
                toSend.push({'name':houseownernode.name,'value':houseownernode.value});
            }
            if($('#houseID').val()){
                var houseidnode= document.getElementById('houseID');
                toSend.push({'name':houseidnode.name,'value':houseidnode.value});
            }
            if(search_geo){
                var location = search_geo['location'];
                toSend.push({'name':'search_latitude','value':location['lat']});
                toSend.push({'name':'search_longitude','value':location['lng']});
            }

            $.ajax({
                type:"GET",
                url:"/houses/realsearch",
                data:$.param(toSend),
                datatype:'json',
                success: function(data){
                    if(map){
                        deleteMarkers();
                    }
                    //alert(JSON.stringify(data));

                    var houses = data.houses;
                    if(houses){
                        var tablehtml = "";
                        if(houses.length>0){

                            $("#showResult").show();
                            resultSM = makeResuiltSM();

                            for(var i=0;i<houses.length;++i)
                            {
                                var loc = new google.maps.LatLng(houses[i].latitude,houses[i].longitude);
                                var address = houses[i].houseAddress+','+houses[i].city+','+houses[i].state;
                                var marker = new google.maps.Marker({
                                    position:loc,
                                    title: houses[i].fullHouseID,
                                    map:map
                                });

                                google.maps.event.addListener(marker,'click',infocallbackClosure(marker,houses[i].fullHouseID,houses[i].numberID,address,setinfohtml));
                                housemarkers.push(marker);
                                if (houses[i]['rentShared'] == '1') {
                                    houses[i]['rentShared'] = 'Whole';
                                } else if (houses[i]['rentShared'] == '-1') {
                                    houses[i]['rentShared'] = 'Share';
                                } else {
                                    houses[i]['rentShared'] = 'Either';
                                }
                                houses[i]['minStayTerm'] = houses[i]['minStayTerm'] + ' ' + houses[i]['minStayUnit'];

                                var rowhtml = "<tr id='house_" + houses[i]['numberID'] + "'>";
                                var numberID = houses[i].numberID;
                                for(var j =0 ; j< itemsToShow.length;++j){

                                    if(itemsToShow[j]=='numberID'){
                                        rowhtml += "<td><a href='#map_div' onclick = 'makeMarkerBounce("+i+");' >" + 
                                                    numberID + "</a></td>";
                                    }
                                    else if(itemsToShow[j] == 'OwnerName'){
                                        rowhtml +=  "<td>"+houses[i].first + ' ' + houses[i].last + "</td>";
                                    }
                                    else if(itemsToShow[j] == 'ownerWechatUserName' ){
                                        rowhtml += "<td title='Wechat ID: " + houses[i]['ownerWechatID']+"'>"+houses[i][itemsToShow[j]] +"</td>";
                                    }
                                    else if(!houses[i][itemsToShow[j]]){
                                        rowhtml += "<td>N/A</td>";
                                    }
                                    else{
                                        rowhtml += "<td>"+houses[i][itemsToShow[j]] + "</td>"; 
                                    }
                                    //console.log(rowhtml);
                                }

                                //rowhtml += "<td><a onclick=' retrieveHouseInfo("+numberID+");' > View House Info</td>";
                                rowhtml += "<td><button type='button' class='btm btn-info' onclick='retrieveHouseInfo("+houses[i].numberID+");resultSM.toHousePage("+i+")'>"+"View House Info"+"</button></td>";
                                rowhtml += "<td><button type='button' class='btm btn-info' onclick='resultSM.toOwnerPage("+i+")'>View Owner Info</button></td>";
                                rowhtml += "<td><a href='/house/modify/"+houses[i].numberID+"' class='btn btn-info' role='button'>Modify</a></td>"
                                attachHouseOwnerDiv(houses[i],i);

                                rowhtml += "</tr>";
                                tablehtml += rowhtml;
                            }
                            showMarkers();

                            $('#fillArea').html(tablehtml);
                        }
                        else
                        {
                            $("#showResult").hide();
                            // Notice that there is no result
                        }
                    }

                    if(search_geo){
                        mapMovecenter(search_geo);
                    }
                    else{
                        //alert(JSON.stringify(data.geo_center));
                        var loc = new google.maps.LatLng(data.geo_center.location.lat,data.geo_center.location.lng);
                        search_geo = {'location': loc};
                        mapMovecenter(search_geo);
                    }

                    search_geo=null;
                }
            });
        });

        function vieweffect(id) {
            $('#houseOwnerID').val(id);
            $('#ownerknownswitch').attr( "checked",true);
            changeswitchview();
        }

        function setinfohtml(title,id,addr)
        {
            html = "<div>"+
                    "<h4>" + title + "</h4><h5>No:"+ id + " </h5><p>Address:" + addr + "<br>"+
                    "<a href='#house_"+id+"' onclick=\"$('#house_"+id+"\').animateCss('bounce 1s')\";>View Details</a></p></div>";
            infowindow.setContent(html);
        }

        function infocallbackClosure(marker,title,id,addr,callback){
            return function(){
                var caller = event.target;
                callback(title,id,addr);
                infowindow.open(map,marker);
            }   
        }

        function makeMarkerBounce(index){
            var marker = housemarkers[index];
            marker.setAnimation(google.maps.Animation.BOUNCE); 
            setTimeout(function(){ marker.setAnimation(null); }, 2000);  
        }
        function mapMovecenter(search_geo)
        {
            var loc = search_geo['location'];
            var radius = (document.getElementById('milesrange')).value*1000;
            map.setCenter(loc);
            if(!rangemarker){
                rangemarker = new google.maps.Circle({
                  strokeColor: '#FF0000',
                  strokeWeight: 2,
                  map: map,
                  center: loc,
                  radius: radius
                });
            }
            else{
                rangemarker.setCenter(loc);
                rangemarker.setRadius(radius);
            }
        }

        function setMapOnAll(map){
            if(!map)
            {
                for(var i=0;i<housemarkers.length;++i){
                    housemarkers[i].setMap(map);
                }
            }
            else{
                var bounds = new google.maps.LatLngBounds();
                for(var i=0;i<housemarkers.length;++i)
                {
                    housemarkers[i].setMap(map);
                    bounds.extend(housemarkers[i].getPosition());
                }
                map.fitBounds(bounds);
            }
        }

        function clearMarker(){
            setMapOnAll(null);
        }

        function showMarkers(){
            setMapOnAll(map);
        }

        function deleteMarkers(){
            clearMarker();
            housemarkers=[];
        }


        function retrieveHouseInfo(id){
            $.ajax({
                type:"GET",
                url:"/house/info/"+id,
                datatype:'json',
                success: function(data){
                    //alert(JSON.stringify(data[house_price]));
                    $('#houseid_info').text(data.numberID);
                    $('#houseOwnerID_info').text(data.houseOwnerID);
                    $('#houseIDByOwner_info').text((data.houseIDByOwner?data.houseIDByOwner:"N/A"));
                    $('#country_info').text(data.country);
                    $('#state_info').text(data.state);
                    $('#city_info').text(data.city);
                    $('#region_info').text(data.region);
                    $('#houseAddress_info').text(data.houseAddress);
                    $('#houseZip_info').text(data.houseZip);
                    $('#houseType_info').text(data.houseType);
                    $('#size_info').text(data.size);
                    $('#numOfRooms_info').text(data.numOfRooms);
                    $('#numOfBaths_info').text(data.numOfBaths);
                    $('#numOfBeds_info').text(data.numOfBeds);
                    $('#maxNumOfGuest_info').text(data.maxNumOfGuest);
                    $('#onOtherWebsite_info').text(data.onOtherWebsite);

                    var housecondition = data.housingcondition;
                    var houseprice = data.house_price;
                    var houseavailability = data.houseavailability;
                    if(housecondition){

                    }
                    if(houseprice){
                        $('#costDayPrice').text((houseprice.costDayPrice?houseprice.costDayPrice:"N/A"));
                        $('#costWeekPrice').text((houseprice.costWeekPrice?houseprice.costWeekPrice:"N/A"));
                        $('#costMonthPrice').text((houseprice.costMonthPrice?houseprice.costMonthPrice:"N/A"));
                        $('#costUtility').text((houseprice.costUtility?houseprice.costUtility:"N/A"));
                        $('#utilityNote').text((houseprice.utilityNote?houseprice.utilityNote:"N/A"));
                        $('#costCleaning').text((houseprice.costCleaning?houseprice.costCleaning:"N/A"));
                        $('#costSecurityDeposit').text((houseprice.costSecurityDeposit?houseprice.costSecurityDeposit:"N/A"));
                        $('#costNote').text((houseprice.costNote?houseprice.costNote:"N/A"));

                        $('#retailDayPrice').text((houseprice.retailDayPrice?houseprice.retailDayPrice:"N/A"));
                        $('#retailWeekPrice').text((houseprice.retailWeekPrice?houseprice.retailWeekPrice:"N/A"));
                        $('#retailMonthPrice').text((houseprice.retailMonthPrice?houseprice.retailMonthPrice:"N/A"));
                        $('#retailUtility').text((houseprice.retailUtility?houseprice.retailUtility:"N/A"));
                        $('#retailCleaning').text((houseprice.retailCleaning?houseprice.retailCleaning:"N/A"));
                        $('#retailSecurityDeposit').text((houseprice.retailSecurityDeposit?houseprice.retailSecurityDeposit:"N/A"));

                        $('#upsellPercent').text((houseprice.upsellPercent?houseprice.upsellPercent:"N/A"));
                        $('#totPercent').text((houseprice.totPercent?houseprice.totPercent:"N/A"));
                    }
                    if(houseavailability){
                        if(houseavailability.rentShared==1){
                            $('#rentShared').text('Whole');
                        }
                        else if(houseavailability.rentShared==-1){
                            $('#rentShared').text('Shared');
                        }
                        else{
                            $('#rentShared').text('Either');
                        }

                        if(houseavailability.availability==1){
                            $('#availability').text("Yes");
                        }
                        else if(houseavailability.availability==0){
                            $('#availability').text('Yes, Not Now');
                        }
                        else{
                            $('#availability').text("No");
                        }
                        $('#minStayTerm').text(houseavailability.minStayTerm);
                        $('#minStayUnit').text(houseavailability.minStayUnit);
                        if(houseavailability.allowCooking==1){
                            $('#allowCooking').text("Yes");
                        }
                        else if(houseavailability.allowCooking==2){
                            $('#allowCooking').text("Occasional");
                        }
                        else if(houseavailability.allowCooking==0){
                            $('#allowCooking').text("N/A");
                        }
                        else {
                            $('#allowCooking').text("No");
                        }

                        if(houseavailability.furnished==0){
                            $('#furnished').text("N/A");
                        }
                        else if(houseavailability.furnished==2){
                            $('#furnished').text("Simple");
                        }
                        else if(houseavailability.furnished==1){
                            $('#furnished').text("Yes");
                        }
                        else if(houseavailability.furnished==-1){
                            $('#furnished').text("No");
                        }

                        $('#availabilityNote').text(houseavailability.availabilityNote);
                    }
                }
            });
        }

        function attachHouseOwnerDiv(data,index){
            var houseownerhtml= "<div class='col-sm-6' id=ownerinfo_"+index+" style='width=\"50%\";display:none'>";
            houseownerhtml+= "<table class='table table-bordered table-striped text-center' style='font-size:12px;' >";
            houseownerhtml += "<thead></thead><tbody><col width = '20%'><col width='80%'>"

            var displayedfield = ['Name','ownerCompanyName','ownerUsPhoneNumber','ownerPhone2Number','ownerEmail','ownerWechatUserName'];

            for(var i =0;i<displayedfield.length;++i){
                switch(displayedfield[i]){
                    case 'Name':houseownerhtml += "<tr><td>Owner Name</td>"+
                                                    "<td>"+data.first+' '+data.last+"</td></tr>";
                                    break;
                    case 'ownerCompanyName': houseownerhtml += "<tr><td> Company Name </td>"+
                                                               "<td>"+(data[displayedfield[i]]?data[displayedfield[i]]:"Individual")+"</td><tr>";
                                                               break;
                    case 'ownerUsPhoneNumber':houseownerhtml += "<tr><td>US Phone Number</td>"+
                                                               "<td>"+data[displayedfield[i]]+"</td><tr>";
                                                               break;
                    case 'ownerPhone2Number': houseownerhtml += "<tr><td>Other Phone Number</td>"+
                                                               "<td>"+(data[displayedfield[i]]?data[displayedfield[i]]:"N/A")+"</td><tr>";
                                                               break;
                    case 'ownerEmail': houseownerhtml += "<tr><td>Email</td>"+
                                                               "<td>"+(data[displayedfield[i]]?data[displayedfield[i]]:"N/A")+"</td><tr>";
                                                               break; 
                    case 'ownerWechatUserName': houseownerhtml += "<tr><td>Wechat Username</td>"+
                                                               "<td title='Wechat ID:"+data.ownerWechatID+"'>"+(data[displayedfield[i]]?data[displayedfield[i]]:"N/A")+"</td><tr>";
                                                               break;
                }
            }
            houseownerhtml+= "</tbody></table></div>";

            $('#ownerdiv').append(houseownerhtml);
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

        var makeResuiltSM = function(){
            var states = -1 ;  
            var divindex = -1;

            function changestate(stat){
                switch(stat){
                    case "Table": states=0; break;
                    case "House": states=1; break;
                    case "Owner": states=2; break;
                }
            }  
            function getstates(){
                switch(states){
                    case 0: return "Table";
                    case 1: return "House";
                    case 2: return "Owner";
                }
            }

            function setDivindex(val){
                divindex = val;
            }

            function getDivindex(){
                return divindex;
            }
            return {
                toOwnerPage:function(index){
                    $('#housestable').fadeOut();
                    //$('#ownerdiv').show();
                    $('#ownerinfo_'+index).show();
                    $("#back_menu").css("visibility", "visible");
                    changestate("Owner");
                    setDivindex(index);
                },
                toHousePage: function(index){
                    $('#housestable').fadeOut();
                    $('#housediv').fadeIn();
                    $("#back_menu").css("visibility", "visible");
                    changestate("House");
                    setDivindex(index);
                },
                toTablePage:function(){
                    $('#housestable').fadeIn();
                    if(getstates()=="Owner"){
                        //$('#ownerdiv').hide();
                        $('#ownerinfo_'+getDivindex()).hide();
                        //$("#back_menu").css("visibility", "hidden");
                        setDivindex(-1);
                    }
                    if(getstates()=="House"){
                        //$("#back_menu").css("visibility", "hidden");
                        $('#housediv').fadeOut();
                        setDivindex(-1);
                    }
                    $("#back_menu").css("visibility", "hidden");
                    changestate("Table");
                }
            }
        }


    </script>
@endsection
