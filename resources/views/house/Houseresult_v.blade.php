@extends('navbar')
@section('title', 'House Result_reversion')

@section('head')
    <link rel="stylesheet" href="{{asset('css/priceswitch.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">


    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />  
    <link type="text/css" rel="stylesheet" href="{{asset('css/simplePagination.css')}}"/>

    <script src="{{asset('js/bootbox.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.simplePagination.js')}}"></script>


    @php
        function checkKey(&$arr){
            if(!array_key_exists('houseAddress', $arr)){
                $arr['houseAddress']=NULL;
            }
            if(!array_key_exists("country",$arr)){
                $arr['country']=NULL;
            }
            if(!array_key_exists("state",$arr)){
                $arr['state']=NULL;
            }
            if(!array_key_exists('city', $arr)){
                $arr['city']=NULL;
            }
            if(!array_key_exists('zipcode', $arr)){
                $arr['zipcode'] = NULL;
            }
            if(!array_key_exists('search_latitude', $arr)){
                $arr['search_latitude']=NULL;
            }
            if(!array_key_exists('search_longitude', $arr)){
                $arr['search_longitude']=NULL;
            }
            if(!array_key_exists('milesrange', $arr)){
                $arr['milesrange']=5;
            }
        }

        parse_str($_SERVER['QUERY_STRING'], $parameter);
        checkKey($parameter);
    @endphp
    <style>
        @import url("//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css");
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
        /*a {
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px;
        }*/
        /*a:hover {
            background-color: #ddd;
            color: black;
        }*/
        .container-fluid{
            overflow: hidden;
        }
        .previous {
            background-color: #f1f1f1;
            color: black;
        }
        #map_div{
            height: 650px;
            width: 100%;
            float: clear ;
        }
        #map {
          height: 100%;
          width: 100%;
         }

        #housedisplay{
            height: 650px;
            overflow-y: scroll;
        }

        ul.searchbar{
            /*height:40px;*/
            list-style: none;
            margin:0;
            padding:0;
            height:50px;
            /*overflow:hidden;*/
        }
        ul.searchbar li{
            float: left;
            text-align: -webkit-match-parent;
        }
        li#search{
            /*position: relative;*/
            font-size: 16px;
            width:250px;
        }
        input#houseAddress{ 
            height: 35px;
            margin-right: 100px;
            background: #fcfcfc;
            border: 1px solid #aaa;
            border-radius: 5px;
            box-shadow: 0 0 3px #ccc, 0 10px 15px #ebebeb;
            font-size: 12px;

            text-indent: 32px;
        }
        .searchicondiv{
            display: inline-block;
            position:relative;
            top:-35px;
            width:32px;
            height:35;
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

        .crop {
            /*position: absolute;*/
            clip: rect(0px,300px,200px,0px);

        }

        .searchtypediv{
            /*margin-left: 5px;*/
            border-left: 4px solid red;
            background-color: WhiteSmoke;
        }

        #loadele{
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) 
            url('http://sampsonresume.com/labs/pIkfp.gif') 
            50% 50% 
            no-repeat;
        }

        #loadele.loading{
            overflow:hidden;
            display:block;
        }

        #loadele.loading .modal{
            display:block;
        }


        div.thumbnail {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 300px;
            height: 225px;
            vertical-align: bottom;
        }

        div.thumbnail:hover {
            border: 1px solid #777;
        }

        div.thumbnail:hover a.glyphicon-trash{
           display:inline-block;
        }

        div.thumbnail{
            background-size: 300px 225px;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }


        /*for image wall*/
        /*------IMG_CONTAINER------*/
        .img_container {
          width: 100%;
          margin: 0 auto 50px auto;
        }

        /*------MEDIA QUERIES------*/
        @media screen and (max-width: 1120px) {
          .img_container {width: 840px;}
        }
         
        @media screen and (max-width: 840px) {
          .img_container {width: 560px;}
        }
         
        @media screen and (max-width: 560px) {
          .img_container {width: 280px;}
        }

        /*------LIST------*/
        .img_container ul {
          list-style-type: none;
        }
         
        .img_container li {
          float: left;
          position: relative;
          width: 280px;
          height: 187px;
          overflow: hidden;
        }
         
        .img_container li:hover {
          cursor: pointer;
        }

        /*------PARAGRAPH------*/
        .img_container li p {
          color: transparent;
          background: transparent;
          font: 200 30px/187px 'Arvo', Helvetica, Arial, sans-serif;
          text-align: center;
          text-transform: uppercase;
          
          position: absolute;
          top: 0;
          left: 0;
          width: 280px;
          height: 187px; 
         
         
          -webkit-transition: all 1s ease;
          -moz-transition: all 1s ease;
          -o-transition: all 1s ease;
          -ms-transition: all 1s ease;
          transition: all 1s ease;
        }
         
        .img_container li:hover p {
          color: white;
          background: #000; /*fallback for old browsers*/
          background: rgba(0,0,0,0.7);
        }

        /*------IMAGES------*/
        .img_container img {
          width: 280px;
          height: 187px;
          
          -webkit-transition: all 1s ease;
          -moz-transition: all 1s ease;
          -o-transition: all 1s ease;
          -ms-transition: all 1s ease;
          transition: all 1s ease;
        }
         
        .img_container li:hover img {
          width: 320px;
          height: 213px;
        }



    </style>
@endsection
@section('inbody', ' class=marginMe onload=doload()')

@section('content')
    <div class="container-fluid">
        <ul class="searchbar" > 
            <li id='search'>
            <form id="houseSearchForm" style="height:40px;">
                <input class="form-control input-sm" type="text" id="houseAddress" name="houseAddress" value="{{$parameter['houseAddress']}}">
                <div class='searchicondiv'>
                    <button type='submit' aria-label="Submit" style='height:35px;'><i class="fa fa-search"></i></button>
                </div>
<!--                 <div>
                    <label> Calendar </label>
                    <input type="text"  id="daterange" class ="form-control" value="" />
                </div> -->

                <div style="display:none">
                    <input name = "checkIn" hidden>
                    <input name = "checkOut" hidden>
                    <input name = "country"  id="country" value="{{$parameter['country']}}">
                    <input id="administrative_area_level_1" name="state" value="{{$parameter['state']}}">
                    <input id="locality" name="city" value="{{$parameter['city']}}">
                    <input id="route" name="route">
                    <input id="address" diabled>
                    <input id='postal_code' name="zipcode" maxlength="5" value="{{$parameter['zipcode']}}">
                    <input name="milesrange" id="milesrange" value="{{$parameter['milesrange']}}">
                    <input name ="search_latitude" value="{{$parameter['search_latitude']}}">
                    <input name ="search_longitude" value="{{$parameter['search_longitude']}}">
                </div>
            </form>
            </li>
            <li>
                <div class="dropdown" style>
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Distance Mileage
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><input type='checkbox' >1 Miles</li>
                    <li><a href="#">2 Miles</a></li>
                    <li><a href="#">5 Miles</a></li>
                    <li><a href="#">10 Miles</a></li>
                    <li><a href="#">20 Miles</a></li>
                    <li><a href="#">30 Miles</a></li>

                  </ul>
                </div>
            </li>
        </ul>


        <!-- <div class="row">
            
            <div class="col-sm-6">
                <div id="map_div">
                    <div id="map">
                    </div>
                </div>
            </div>
            <div class="col-sm-6" id= "housedisplay">
            </div>
        </div> -->
        <div class='row' style='clear:both;'>
            <div class='col-sm-6'>
                <div id="map_div">
                    <div id="map">
                    </div>
                </div>
            </div>
            <div class='col-sm-6'>
                <div id='housedisplay'>
                    <table>
                        <tbody id='imgArea'>

                        </tbody>
                    </table>
                </div>
            </div>    
        </div>


        <div class = "none">

        </div>

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
    </div>
    <div class="modal" id="loadele"></div>
@endsection

@section('script')

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
        var housesbuf;
        var itemsOnPage = 10;

        function autoCallback(predictions,status){
            // *Callback from async google places call
            if(status != "OK"){
                //show that this address is an error
                document.getElementById('houseAddress').className='error';
                return;
            }
            $('#houseAddress').addClass('success');
            $('#houseAddress').val(predictions[0].description);
        }

        function queryAutocomplete(input){
            var service = new google.maps.places.AutocompleteService();
            service.getPlacePredictions({
                input: input,
                componentRestrictions: {
                    country: 'us'
                }
            }, autoCallback);
        }


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
            if(typeof place.address_components == 'undefined'){
                console.log(result.name);
                //queryAutocomplete(result.name);
            }
            else{
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
                $('#dontknowowneridDiv').find('input').val(' ');
            }
        }
        function doload(){
            
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
            loadDatafromServer();

            $('#checkIn').change(function(){
                var date = $(this).datepicker('getDate');
                $('#houseSearchForm').find('input[name="checkIn"]').val(converttimetosql(date));
            });
            $('#checkOut').change(function(){
                var date = $(this).datepicker('getDate');
                $('#houseSearchForm').find('input[name="checkOut"]').val(converttimetosql(date));
            });


            $('#daterange').daterangepicker({
                locale: {
                    format: 'MM/DD/YYYY'
                }
            }).on('change',function(){
                var date = $(this).val().split('-');
                $('#houseSearchForm').find('input[name="checkIn"]').val(converttimetosql(date[0]));
                $('#houseSearchForm').find('input[name="checkOut"]').val(converttimetosql(date[1]));
            });

            if(document.getElementById('address').value){
                document.getElementById('houseAddress').value =  document.getElementById('address').value;
                $("#houseAddress").focus();
            }
        });

        function showHousedetail(ele){
            alert("click the div");
        }

        /*
        TODO:(1)add link to initialize a GET request to server to get house info
             (2)add link to initialize a GET request to server to get houseowner info
        
        */
        function loadDatafromServer(){
            if(!$('#houseSearchForm').find('input[name="search_latitude"]').val()||!$('#houseSearchForm').find('input[name="search_longitude"]').val()){
                if(getSearchParams('houseID')||getSearchParams('houseOwnerID')){
                    var toSend = $('#houseSearchForm').serializeArray();
                    if(getSearchParams('houseID')){
                        toSend.push({'name':'houseID','value':getSearchParams('houseID')});
                    }
                    if(getSearchParams('houseOwnerID')){
                        toSend.push({'name':'houseOwnerID','value':getSearchParams('houseOwnerID')});
                    }
                    console.log(toSend);
                    realsearch(toSend);
                    return ;
                }


                var houseaddress = $('#houseAddress').val();
                if(!houseaddress){
                    houseaddress = $('#country').val()+' '+$('#administrative_area_level_1').val()+' '+$('#locality').val();
                }
                if(!houseaddress.trim()){
                    alert('no data passing by');
                    return ;
                }
                else{
                    console.log(houseaddress);
                    $.ajax({
                        url:'https://maps.googleapis.com/maps/api/geocode/json?',
                        type:'GET',
                        data: {'address':houseaddress, 'key':'AIzaSyCpF-_i-utIH6cZl94zpu4C5vx_FBDDI9s'},
                        datatype:'json',
                        success: function(data){
                            if(data.results.length==0){

                            }
                            else{
                                var longitude=data.results[0].geometry.location.lng;
                                var latitude =data.results[0].geometry.location.lat;
                                $('#houseSearchForm').find('input[name="search_latitude"]').val(latitude);
                                $('#houseSearchForm').find('input[name="search_longitude"]').val(longitude);
                            }

                            search_geo = data.results[0].geometry;

                            realsearch();
                        },
                        error: function(){

                        }
                    });
                }
            }
            else{
                var loc = new google.maps.LatLng($('#houseSearchForm').find('input[name="search_latitude"]').val(),$('#houseSearchForm').find('input[name="search_longitude"]').val());
                search_geo = {'location': loc};
                realsearch();
            }
        }

        function realsearch(toSend){
            if(toSend=== undefined){
                var toSend = $('#houseSearchForm').serializeArray();
            }
            $('#loadele').addClass("loading");
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
                housesbuf  =  data.houses;
                if(houses.length!=0){
                    console.log(houses);
                    // var tablehtml = "";
                    // var picturehtml = "<div class = \"img_container\"><ul>";
                    var picturehtml = "";
                    $('#imgArea tr').remove();
                    if(houses.length>0){
                        $("#showResult").show();
                        resultSM = makeResuiltSM();

                        for(var i=0;i<houses.length;++i)
                        {
                            // table part
                            var loc = new google.maps.LatLng(houses[i].latitude,houses[i].longitude);
                            var address = houses[i].houseAddress+','+houses[i].city+','+houses[i].state;
                            var marker = new google.maps.Marker({
                                position:loc,
                                title: houses[i].fullHouseID,
                                map:map
                            });

                            google.maps.event.addListener(marker,'click',infocallbackClosure(marker,houses[i].fullHouseID,houses[i].numberID,address,i,setinfohtml));
                            housemarkers.push(marker);
                            if (houses[i]['rentShared'] == '1') {
                                houses[i]['rentShared'] = 'Whole';
                            } else if (houses[i]['rentShared'] == '-1') {
                                houses[i]['rentShared'] = 'Share';
                            } else {
                                houses[i]['rentShared'] = 'Either';
                            }
                            houses[i]['minStayTerm'] = houses[i]['minStayTerm'] + ' ' + houses[i]['minStayUnit'];
                            if((i&1)==0){
                                picturehtml += '<tr>'
                            }
                            // for server use storage
                            if(houses[i]['coverurl']){
                                // picturehtml +="<li><p>"+houses[i]['numberID']+"</p><img src=\""+houses[i]['ImagePath']+"\"></li>";
                                // picturehtml += "<td><img src=\""+houses[i]['ImagePath']+"\"></td>";

                                picturehtml += "<td><a href='#' onclick ='showHousedetail(this);'> <div class='thumbnail' value="+ houses[i]['coverurl']+" style='background-image:url("+houses[i]['coverurl']+");''>"+
                                                "<input name='numberID' hidden>"+
                                                "<div><p style='color: white'>"+houses[i].houseAddress+"</p></div>"+
                                                "<div><p style='color: white'>"+houses[i].fullHouseID+"</p></div>"+
                                                "</div></a>";
                            }
                            else{
                                picturehtml +="<td><div class='thumbnail'><p> No Image in this house</p></div></td>"; 
                            }
                            if((i&1)==1){
                                picturehtml +='</tr>'
                            }
                        }
                        $('#imgArea').html(picturehtml);
                        showMarkers();
                    }
                    else
                    {
                        $("#showResult").hide();
                        // Notice that there is no result
                    }
                    if(search_geo){
                        //drawCircle(search_geo,,$('#milesrange').val());
                    }
                    else{
                        //alert(JSON.stringify(data.geo_center));
                        var loc = new google.maps.LatLng(data.geo_center.location.lat,data.geo_center.location.lng);
                        search_geo = {'location': loc};
                        //drawCircle(search_geo,$('#milesrange').val());
                    }
                    search_geo=null;
                }

                $('#loadele').removeClass("loading");
                // if(search_geo){
                //     mapMovecenter(search_geo);
                // }
                // else if($('#houseSearchForm').find('input[name="search_longitude"]').val()&&$('#houseSearchForm').find('input[name="search_latitude"]').val()){
                //     var loc = new google.maps.LatLng($('#houseSearchForm').find('input[name="search_latitude"]').val(),$('#houseSearchForm').find('input[name="search_longitude"]').val());
                //     search_geo = {'location': loc};
                //     mapMovecenter(search_geo);
                // }
                // else{
                //     //alert(JSON.stringify(data.geo_center));
                //     var loc = new google.maps.LatLng(data.geo_center.location.lat,data.geo_center.location.lng);
                //     search_geo = {'location': loc};
                //     mapMovecenter(search_geo);
                // }

                // //search_geo=null;
                }
            });
        }

        function vieweffect(id) {
            $('#houseOwnerID').val(id);
            $('#ownerknownswitch').prop( "checked",true);
            changeswitchview();
        }

        function setinfohtml(index,title,id,addr)
        {
            html = "<div>"+
                    "<h4>" + title + "</h4><h5>No:"+ id + " </h5><p>Address:" + addr + "<br>"+
                    "<a onclick=jumptableTospecific("+ index +");>View Details</a></p></div>";
            infowindow.setContent(html);
        }

        function infocallbackClosure(marker,title,id,addr,index,callback){
            return function(){
                var caller = event.target;
                callback(index,title,id,addr);
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

        function addToTrand(numberID){
            var data = {};
            data['inquiryID'] = $('#inquiryID').val()
            data['houseID'] = numberID

            var para = $.param(data);
            window.location.assign("/transaction/confirm"+'?'+para);
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
