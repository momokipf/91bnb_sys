<html>
	<head>
	<!-- jquery -->
		<script src="../js/jquery.min.js"></script>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/bootstrap-formhelpers-phone.js"></script>
		<script src="../js/bootbox.min.js"></script>
		<link rel="stylesheet" href="../css/self.css">
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpF-_i-utIH6cZl94zpu4C5vx_FBDDI9s&libraries=places&language=en"></script>

		<script src="../js/canvasjs.min.js"></script>
		<script src="../js/canvas2image.js"></script>
		<script src="../js/html2canvas.js"></script>
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
			s}
		</style>
		<script type="text/javascript">
			var arr = new Array();
			var drawUSA = "";
			var drawUSAcity ="";
				
			var elementsArrOri=new Array();
			$(document).ready(function(){
				// statistic();
				$("#country").load("/list/hotCountryList");
				$("#houseType").load("/list/HouseTypeOptionList");
				$("#country").change(function(){         
					$("#state").load("/list/Country_State_Option/"+$(this).val().replace(/\s/g, '') + "_StateListOption"); 
					console.log("china us uk");            
				});
				$("#state").change(function(){         
					var state = $(this).val().replace(/\s/g, '');
					console.log(state);
					$("#city").load('/list/State_City_Option/' + state + 'CityListOption');        
				});
			});
		</script>
	</head>

	<body>
		<div class="container-fluid">
			<div id="map" class="tab-pane fade in">
				<p class="text-center" style="font-size: 20px; font-weight: 700">House Location in Map</p>         
				<div id='forSearch'>
				<form id="myForm">
					<div class="tab-content">
						<div class="row">
							<div class="col-sm-2">
								<label>Country</label>
								<select type="text" name="country" id="country" class="form-control input-sm">
								</select>
							</div>
							<div class="col-sm-2">
								<label>State or Province</label>
								<select id="state" name="state" class="form-control input-sm">
									<option selected>Please Select State</option>
								</select>
							</div>
							<div class="col-sm-2">
								<label>City</label>
								<select name="city" id="city" class="form-control input-sm">
									<option selected>Please Select City</option>
								</select>
							</div>
							<div class="col-sm-2">
								<label>Zip Code</label>
								<input name="houseZip" id="houseZip" class="form-control input-sm"></input>
							</div>
						</div>
						<!-- row2 -->
						<div class="row">
							<div class="col-sm-2">
								<label>Whole/Share</label>
								<select name="rentShared" id='rentShared' class="form-control input-sm">
									<option value = 0 >Either</option>
									<option value = 1 >Whole</option>
									<option value = -1 >Share</option>
								</select>
							</div>
							<div class="col-sm-2">
								<label>House Type</label>
								<select type="text" name = "houseType" id="houseType" class="form-control input-sm">                          
								</select>
							</div>
						</div>

					</div>

					<div style="margin-top:30px; margin-bottom:50px;">
						<button class="btn btn-success" type="button" id="myBtn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Apply Filter</button>
						<button class="btn btn-warning disToLeft" type="reset" id = "refreshPage"><span class="glyphicon glyphicon-refresh"></span> Reset Filter</button>
						<button id="extall" type="button" class="btn btn-primary disToLeft"><span class="glyphicon glyphicon-download-alt"></span>
							Export Filtered Result to Excel
						</button>
					</div>
				</form>
			</div> <!--forsearch-->
				<div id='generalInfo'></div>
				<div id='map_canvas'></div>
				<div id='fillArea'></div>
				<div id='showForm'></div>
			</div>
		</div>
	</body>

	<script>
		console.log("test 10");
		var geocoder;
		var map;
		var bounds = new google.maps.LatLngBounds();
		var previousmarker=false;
		$("#myBtn").click(function() {
			console.log("test 57");
			console.log($("#country").val()+$("#state").val()+$("#city").val());
			$.post("getHouseInfo.php", 
				$("#myForm").serialize(),
				function(response) {
					console.log(response+"");
					// var data = JSON.parse(response);
					var data = JSON.parse(response+"");
					//summary
					var generalInfo="<h4 style='text-align:center'>";
					var tmpCountry=$("#country").val();
					var tmpState=$("#state").val();
					var tmpCity=$("#city").val();
					var tmpZip=$("#houseZip").val();
					var tmpHouseType=$("#houseType").val();
					var tmpWholeShared=$("#rentShared").val();
					if(tmpCountry=='Select Country'&&tmpZip==''&tmpHouseType==='All'&&tmpWholeShared===0){
						generalInfo+='Total hosues: '+data.length+"</h4>";
					} else {
						if(tmpCountry!=='Select Country'){
							generalInfo+=tmpCountry+", ";
						}                          
						if(tmpState!=='Please Select State'){
							generalInfo+=tmpState+", ";
						}               
						if(tmpCity!=='Please Select City'){
							generalInfo+=tmpCity+", ";
						}              
						if(tmpZip!==''){
							generalInfo+="Zip "+tmpZip+", ";
						}
						generalInfo+="has "+data.length;
						if(tmpWholeShared==='1'){
							generalInfo+=" Whole Type"+" ";
						} else if(tmpWholeShared==='-1'){
							generalInfo+=" Share Type"+" ";
						}  
						if(tmpHouseType!==''){
							generalInfo+=tmpHouseType+" ";
						}
						 generalInfo+=" house</h4>"
					   
					}           
					$("#generalInfo").html(generalInfo);
					if (data.length == 0) {
						$("#map_canvas").hide();
						$("#showResult").hide();
						$("#noResult").show();
						$("#showForm").hide();
					} else {
						$("#noResult").hide();
						$("#showResult").show();
						$("#map_canvas").show();
						//console.log(data);
						var itemsToShow = ['numberID','fullHouseID', 'state', 'city', 'houseAddress','numOfRooms', 'numOfBaths','latitude','longitude',
									'houseType','houseOwnerID', 'costMonthPrice', 'costDayPrice', 'nextAvailableDate',
									'minStayTerm','rentShared', 'first', 'last', 'ownerUsPhoneNumber', 'ownerWechatUserName','ownerWechatID'];
						var myStr = "";
						geocoder = new google.maps.Geocoder();
						map = new google.maps.Map(
							document.getElementById("map_canvas"), {
							center: new google.maps.LatLng(37.4419, -122.1419),
							zoom: 13,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						});
						for (var i = 0; i < data.length; i++) {
							var location = new Array(data[i]['fullHouseID'], data[i]['houseAddress']+", "+data[i]['city']+", "+data[i]['state'],data[i]['latitude'],data[i]['longitude'],data[i]['numberID']);
							geocodeAddress(location);
							// convert number to 'whole, share, either'
							if (data[i]['rentShared'] == '1') {
								data[i]['rentShared'] = 'Whole';
							} else if (data[i]['rentShared'] == '-1') {
								data[i]['rentShared'] = 'Share';
							} else {
								data[i]['rentShared'] = 'Either';
							}
							// data[i]['ownerUsPhoneNumber'] = convertPhoneFormat(data[i]['ownerUsPhoneNumber']);
							// add '$' before Prices
							data[i]['costMonthPrice'] = '$ ' + data[i]['costMonthPrice'];
							data[i]['costDayPrice']   = '$ ' + data[i]['costDayPrice'];
							// min stay term
							data[i]['minStayTerm'] = data[i]['minStayTerm'] + ' ' + data[i]['minStayUnit'];

							// output items in each row
							myStr += "<tr id='my" + i + "' class='hello'>";
							//fix 0207
							for (var j = 0; j < itemsToShow.length; j++) {
								if(itemsToShow[j] == 'latitude' || itemsToShow[j] == 'longitude') continue;
								if (itemsToShow[j] == 'numberID') {
									myStr += "<td><a href='###' onclick='selecthouse(" + data[i]['numberID'] + ")' id='" + data[i]['numberID'] + "'  class='showdetails' >" +
										data[i][itemsToShow[j]] + "</a></td>";
								} else if(data[i][itemsToShow[j]].trim()==""||data[i][itemsToShow[j]]==null||data[i][itemsToShow[j]]=="00/00/0000"||data[i][itemsToShow[j]]=="01/01/3000"){
									myStr += "<td>" + "N/A" + "</td>";
								}
								  else if(itemsToShow[j] == 'minStayTerm'&& data[i][itemsToShow[j]].charAt(0)=="0"){
									myStr += "<td>" + "N/A" + "</td>";
								} else if(itemsToShow[j] == 'costDayPrice'&& data[i][itemsToShow[j]].charAt(2)=="0"){
									myStr += "<td>" + "No price" + "</td>";
								}
								else if(itemsToShow[j] == 'costMonthPrice'&& data[i][itemsToShow[j]].charAt(2)=="0"){
									myStr += "<td>" + "No price" + "</td>";
								}
								else{
									myStr += "<td>" + data[i][itemsToShow[j]] + "</td>";
								}
							}
							myStr += "</tr>";
						}
						// $("#fillArea").html(myStr);
					}
				} // function response
			);
		});

		function geocodeAddress(locations) {
			var title = locations[0];
			var address = locations[1];
			var lat = locations[2];
			var lng = locations[3];
			var id = locations[4];
			//var url = locations[4];
			var position = new google.maps.LatLng(locations[2],locations[3]);
			var marker = new google.maps.Marker({
				icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
				map: map,
				position: position,
				title: title,
				animation: google.maps.Animation.DROP,
				address: address
			});
			infoWindow(marker, map, title, address, id);
			bounds.extend(marker.getPosition());
			map.fitBounds(bounds);
			google.maps.event.addListener(marker, 'mouseover', function(event) {
				this.setIcon('http://maps.google.com/mapfiles/ms/icons/red.png');
			});
			google.maps.event.addListener(marker, 'mouseout', function(event) {
				this.setIcon('http://maps.google.com/mapfiles/ms/icons/blue.png');
			});
		}

		function infoWindow(marker, map, title, address, id) {
			google.maps.event.addListener(marker, 'click', function() {
				if(previousmarker != false){
					previousmarker.close();
				}
				var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a onclick='selecthouse("+id+")'>View Details</a></p></div>";
				iw = new google.maps.InfoWindow({
					content: html,
					maxWidth: 350
				});
				iw.open(map, marker);
				previousmarker = iw;
			});
		}

		function selecthouse(numberID) {
			console.log("select house"+numberID);
			$.ajax({
				type: "POST",
				dataType: "html",//data type expected from server
				url: "housedetailinshowhouse.php",
				data: 'numberID='+numberID,
				success: function(data) {
					$("#showForm").html(data);
					// -----------------------------------------------
					$("#btnDiscard").click(function() {
						$("#houseID_search_form").submit();
					});
					$("#allowKid").change(function(){
						if ($("#allowKid").is(":checked")) {
							$("#allowKidAge").removeAttr('disabled');
						} else {
							$("#allowKidAge").attr('disabled', 'true');
							// $("#allowKidAge").removeAttr('value');
							$("#allowKidAge").val('');
						}
					});
					$("#allowPets").change(function(){
						if ($("#allowPets").is(":checked")) {
							$("#allowPetType").removeAttr("disabled");
						} else {
							$("#allowPetType").attr("disabled", "true");
							$("#allowPetType").val('');
						}
					});

					$("#havePet").change(function(){
						if ($("#havePet").is(":checked")) {
							$("#havePetType").removeAttr("disabled");
						} else {
							$("#havePetType").attr("disabled", "true");
							$("#havePetType").val('');
						}
					});
					// -----------------------------------------------
				}
			});
		}
	</script>
</html>