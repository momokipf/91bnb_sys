
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
	    @php
            parse_str($_SERVER['QUERY_STRING'], $parameter);
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
            #searchbar{
                height:40px;
            }
            .search{
                position: relative;
                color: #aaa;
                font-size: 16px;
            }
            .search input { 
                width: 250px;
                  height: 32px;

                  background: #fcfcfc;
                  border: 1px solid #aaa;
                  border-radius: 5px;
                  box-shadow: 0 0 3px #ccc, 0 10px 15px #ebebeb;
                text-indent: 32px;}
            .search .fa-search { 
              position: absolute;
              top: 10px;
              left:10px;
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


<div class="container-fluid" style="margin-top:70px;width:100%;height:100%">
    <div class="row equal" id="searchbar"> 
        <form id="houseSearchForm">   
            <div class="col-sm-3">
                <div class="search">
                    <span class="fa fa-search"></span>
                    <input class="form-control input-sm" type="text" id="houseAddress" name="houseAddress" value="{{$parameter['houseAddress']}}"
                    >
                </div>
            </div>
            <div class="col-sm-9">

            </div>
            <div style="display:none">
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
    </div>
    <div class="row equal">
        
        <div class="col-sm-6">
            <div id="map_div">
                <div id="map">
                </div>
            </div>
        </div>
        <div class="col-sm-6">

        </div>
    </div>

 
    <hr>
</div>
    <div class="test">
        <p>@php @endphp</p>
    </div>
    

    <!-- <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href"#"> -->

</div>

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
    });

    /*
    TODO:(1)add link to initialize a GET request to server to get house info
         (2)add link to initialize a GET request to server to get houseowner info
    
    */
    function loadDatafromServer(){
        var toSend = $('#houseSearchForm').serializeArray();
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
                        rowhtml += "<td><button type='button' class='btm btn-info' href='MainPage'>Modify</button></td>"
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
            else if($('#houseSearchForm').find('input[name="search_longitude"]').val()&&$('#houseSearchForm').find('input[name="search_latitude"]').val()){
                var loc = new google.maps.LatLng($('#houseSearchForm').find('input[name="search_latitude"]').val(),$('#houseSearchForm').find('input[name="search_longitude"]').val());
                search_geo = {'location': loc};
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
    }

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
</body>
</html>
