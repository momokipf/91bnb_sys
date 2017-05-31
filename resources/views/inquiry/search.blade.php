<!DOCTYPE html>
<html>
	<head>
		<title>Search/Modify/Add Follow up Inquiry</title>

		<meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

        <link rel="stylesheet" href="{{asset('css/self.css')}}">

        <link rel="stylesheet" href="{{asset('css/loader.css')}}">

		<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

		<style>
			body{
          background-color:black;
					background-image: url(../img/bg_la2.jpg);
        	background-size: cover;
        	background-repeat: no-repeat;
			}
			input[type="search"]::-webkit-search-cancel-button{
				-webkit-appearance: searchfield-cancel-button;
			}
			.glyphicon.glyphicon-time{
    		font-size: 25px;
			}
      .myWidth {
				width: 50px;
      }
      .trans{
			  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3f000000',endColorstr='#3f000000');
			  background-color:rgba(255, 255, 255, 0.7)
      }
      .table-bordered th,
      .table-bordered td {
          border: 1px solid black !important;
      }

		</style>
</head>
<body>
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
				<a class="navbar-brand" href="MainPage">91bnb Manage System</a>
			</div>

		<div id="navbar" class="navbar-collapse collapse">
		<!-- navbar left -->
			<ul class="nav navbar-nav">
				<li><a href="/MainPage">Home</a></li>
				<li class="active"><a>Search Inquiry</a></li>
			</ul>
		<!-- navbar right -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<span class="glyphicon glyphicon-user"></span><span id='username'>{{$Rep->repUserName}}</span><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Profile</a></li>
				<li><a href="#">Change Password</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="/logout.php">Log Out</a></li>
			</ul>
				</li>
			</ul>

		</div><!--/.nav-collapse -->
		</div><!--/ container -->
	</nav>

	<div class='content container' style="margin-top:80px">
		<div class='well trans' style="margin-top:10px">
			<h3 class="text-center" style="margin-bottom:30px;">Search Inquiry</h3>
			<!--<div id='nav_test'>
				<ul class='nav nav-pills nav-justified'>
					<li class="active"><a data-toggle="tab" href="#searchbyID">Search By Inquirier Info</a></li>
					<li><a data-toggle="tab" href="#searchByinquier">Search By Inquiry ID</a></li>
					<li><a data-toggle="tab" href="#searchbyDate">Search By Date</a></li>
				</ul> 
				<div class="tab-content">
					<div id="searchbyID" class="tab-pane fade in active">
						<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label for="InquiryID">Inquiry ID</label>
							<div class="input-group"><span class="input-group-addon">IQ#
							</span><input type="search" class="form-control input-sm" id="InquiryID" name='inquiryID' placeholder="Inquiry ID">
							</div>
						</div>
					</div>
					</div>
					<div id="searchByinquier" class="tab-pane fade">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3">
								<label for="">Inquirer First Name</label>
								<input type="search" class="form-control input-sm" id="searchInquirerFirst" name='inquirerFirst' placeholder="First Name">
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3">
								<label for="searchInquirerLast">Inquirer Last Name</label>
								<input type="search" class="form-control input-sm" id="searchInquirerLast" name='inquirerLast' placeholder="Last Name">
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3">
								<label for="searchInquirerWechatID">Inquirer Wechat ID</label>
								<input type="search" class="form-control input-sm" id="searchInquirerWechatID" name='inquirerWechatID' placeholder="Wechat ID">
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3">
								<label for="WechatName">Wechat Name</label>
								<input type="text" class="form-control input-sm" id="WechatName">
							</div>
						</div>
					</div>
					<div id="searchbyDate" class="tab-pane fade">
						<h3>Menu 2</h3>
						<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
					</div>

				</div>
				<br>

				<div class="text-center">
					<BUTTON type='button' class="btn btn-success" id='searchInquirySubmit' onclick='filterInquiry();'>Search</BUTTON>&nbsp&nbsp
					<BUTTON type='button' class="btn btn-primary" onclick="location.reload();">Reset</BUTTON>
				</div>
			</div> -->
			<form id = 'inquiryinfo' action='search/result' method='GET'>
				{{ csrf_field() }}
				<div class="col-lg-3 col-md-3 col-sm-3">
					<label for="">Inquirer First Name</label>
					<input type="search" class="form-control input-sm" id="searchInquirerFirst" name='inquirerFirst' placeholder="First Name">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3">
					<label for="searchInquirerLast">Inquirer Last Name</label>
					<input type="search" class="form-control input-sm" id="searchInquirerLast" name='inquirerLast' placeholder="Last Name">
				</div>

				<div class="col-lg-3 col-md-3 col-sm-3">
					<label for="searchInquirerWechatID">Inquirer Wechat ID</label>
					<input type="search" class="form-control input-sm" id="searchInquirerWechatID" name='inquirerWechatID' placeholder="Wechat ID">
				</div>

				<div class="col-lg-3 col-md-3 col-sm-3">
					<label for="InquiryID">Inquiry ID</label>
					<div class="input-group"><span class="input-group-addon">IQ#</span><input type="search" class="form-control input-sm" id="inquiryID" name='inquiryID' placeholder="Inquiry ID"></div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-sm-12">
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label>Inquiry Date</label>
							<input name="inquiryDate" class="form-control input-sm" id="inquiryDate" type="search" placeholder="mm/dd/yyyy">
							<input type="hidden" name = 'inquiryDate' id = 'altinquiryDate'> 
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label>Inquiry Date Range From </label>
							<input type="search" class="form-control input-sm" id="inquiryDateFrom" name="inquiryDateFrom" placeholder="mm/dd/yyyy">
							<input type="hidden" name='inquiryDateFrom' id='altinquiryDateFrom'>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-3">
							<label>Inquiry Date Range To </label>
							<input type="search" class="form-control input-sm" id="inquiryDateTo" name="inquiryDateTo" placeholder="mm/dd/yyyy">
							<input type="hidden" name = 'inquiryDateTo' id = 'altinquiryDateTo'> 
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label>Checkin Date Range</label>
							<input type="search" class="form-control input-sm" id="CheckinDateFrom" name="CheckinDateFrom" placeholder="mm/dd/yyyy">
							<input type="hidden" name = 'CheckinDateFrom' id = 'altCheckinDateFrom'> 
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">

						<div class="col-lg-3 col-md-3 col-sm-3">
								<label for="InquiryPriority">Inquiry Priority Level</label>
								<select class="form-control input-sm" id="InquiryPriority" name ='inquiryPriorityLevel'>
										<option value='0'></option>
										<option value='1'>1</option>
										<option value='2'>2</option>
										<option value='3'>3</option>
										<option value='4'>4</option>
										<option value='5'>5</option>
								</select>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label for="InquiryCity">Inquiry City</label>
							<input type="text" class="form-control input-sm" id="InquiryCity">
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label for="WechatName">Wechat Name</label>
							<input type="text" class="form-control input-sm" id="WechatName">
						</div>
					</div>
				</div>
				<br>

				<div class="text-center">
					<BUTTON type='button' class="btn btn-success" id='searchInquirySubmit' onclick='filterInquiry();'>Search</BUTTON>&nbsp&nbsp
					<BUTTON type='button' class="btn btn-primary" onclick="location.reload();">Reset</BUTTON>
				</div>
				<br>
				<div style="text-align:center;">
					<span id="error" style="color:red;"></span>
				</div>
			</form>

		</div>
		<hr>
	</div>

	<div class='content container' hidden>
		<div class='well trans'>
			<div class="table-responsive">
				<div id='modal'></div>
				<table id="searchtable" style='text-align:center;' class='table table-bordered'>
					<tr style='text-align:center;'>
						<td style="min-width:130px;">Pass Due or Not</td>
						<td>Modify</td>
						<td style="min-width:130px;">Add Follow Up</td>
						<td style="min-width:150px;">Show All Follow Up</td>
						<td style="min-width:100px;">Rep. Name</td>
						<td>RepID</td>
						<td style="min-width:80px;">Inquiry ID</td>
						<td style="min-width:110px;">Priority Level</td>
						<td style="min-width:130px;">Inquiry Date</td>
						<td style="min-width:130px;">Inquiry Source</td>
						<td style="min-width:160px;">Inquiry Source Other</td>
						<td style="min-width:100px;">Purpose</td>
						<td style="min-width:130px;">Purpose Other</td>
						<td style="min-width:150px;">Check In Date</td>
						<td style="min-width:150px;">Check Out Date</td>
						<td style="min-width:100px;">House ID</td>
						<td>Country</td>
						<td>State</td>
						<td>City</td>
						<td style="min-width:100px;">City Other</td>
						<td style="min-width:130px;"># of Rooms</td>
						<td>Whole/Share</td>
						<td style="min-width:130px;">House Type</td>
						<td style="min-width:130px;">House Type Other</td>
						<td style="min-width:130px;">Room 1 Type</td>
						<td style="min-width:150px;">Room 1 Type Other</td>
						<td style="min-width:130px;">Room 2 Type</td>
						<td style="min-width:150px;">Room 2 Type Other</td>
						<td style="min-width:130px;">Room 3 Type</td>
						<td style="min-width:150px;">Room 3 Type Other</td>
						<td style="min-width:150px;"># of Adults</d>
						<td style="min-width:150px;"># of Kids</td>
						<td style="min-width:150px;">Kids Age</td>
						<td>Pregnant</td>
						<td style="min-width:130px;">Budget Lower</td>
						<td style="min-width:130px;">Budget Upper</td>
            			<td style="min-width:130px;">Budget Unit</td>
						<td style="min-width:130px;">Have Pet</td>
						<td style="min-width:130px;">Pet Type</td>
						<td style="min-width:130px;">Special Note</td>
						<td style="min-width:100px;">Inquirer ID</td>
						<td style="min-width:160px;">Inquirer First Name</td>
						<td style="min-width:160px;">Inquirer Last Name</td>
						<td style="min-width:160px;">US Phone #</td>
						<td style="min-width:350px;">Other Phone # Country</td>
						<td style="min-width:160px;">Other Phone #</td>
						<td>Email</td>
						<td style="min-width:150px;">TaoBao User Name</td>
						<td style="min-width:130px;">WeChat Name</td>
						<td style="min-width:130px;">WeChat ID</td>
						<td style="min-width:180px;">Status</td>
						<td style="min-width:200px;">Reason Of Decline</td>
						<td style="min-width:200px;">Note</td>
						<td style="min-width:200px;">Comment</td>
					</tr>
					<tbody id='mytable'></tbody>
				</table>
			</div>

			<div class='well' id='followup' hidden>
				<div class='input-group'>
				<form id='addFollowupForm' action='addFollowup.php' method='GET' hidden>
					<p>Inquiry ID: <input id='inquiryID' name='inquiryID' type='search'/></p>
					<p>Follow Up Date: <input id='followupDate' name='followupDate' type='date' value='<?php echo date("Y-m-d")?>'></p>
					<p>Follow Up Status: <input id='followupStatus' name='followupStatus' type='search' size=130></p>
					<input type='submit' class="btn btn-default" id='addFollowupSubmit' name='addFollowupFromDisplay' value='Submit'>
					<button type='button' class="btn btn-default" onclick='document.getElementById("addFollowupForm").style.display="none";document.getElementById("followup").style.display="none";'>Hide</button>
				</form>
			</div>
		</div>

		<div class='page' id='pagination' style='text-align: right;'>
		</div>

        <button id="extSearch" type='button' class="btn btn-success">Extract Search Results</button>
        <button id="extAll" type='button' class="btn btn-primary">Extract All Inquiries</button>
        <button id="extPri" type='button' class="btn btn-info">Extract High Priority Inquiries</button>	
    </div>


    <!-- Loading part , intial hidden -->
    <div class='loaderDiv'>
    	<div class = "loader"></div>
    	<div class ="loaderLabel text-center"><h4>Processing></h4><h4>Please Wait...</h4></div>
    </div>


	<script src="{{asset('js/jquery-1.11.3.js')}}"></script>
	<!-- Bootstrap Latest compiled and minified JavaScript -->
	<script src="{{asset('js/bootstrap.min.js')}}"></script>

	<script src="{{asset('js/util.js')}}"></script>

	<script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>

	<script src="{{asset('js/bootbox.min.js')}}"></script>


	<!-- jquery ui -->
	<script src="{{asset('js/jquery-ui.js')}}"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

	<!-- bootstrap -->
	<!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" href="../css/self.css"> -->

	<script>


		function filterInquiry(){
			$(".loaderDiv").show();
			$("#error").html("");

			// var inquiryDateFrom = document.getElementById('inquiryDateFrom').value;
			// document.getElementById('inquiryDateFrom').value = converttimetosql(inquiryDateFrom);
			//alert($("#inquiryDateFrom").datepicker( "option", "altField"));
			$('#inquiryinfo').submit();
			// var quiryinfo = $('#inquiryinfo').serializeArray();
			// var quiryinfojson = {};
			// for(var i =0;i<quiryinfo.length;++i){
			// 	quiryinfojson[quiryinfo[i]['name']] = quiryinfo[i]['value'];
			// }
			// quiryinfojson.inquiryDate = converttimetosql(quiryinfojson.inquiryDate);
			// quiryinfojson.inquiryDateFrom = converttimetosql(quiryinfojson.inquiryDateFrom);
			// quiryinfojson.inquiryDateTo = converttimetosql(quiryinfojson.inquiryDateTo);
			// quiryinfojson.CheckinDateFrom = converttimetosql(quiryinfojson.CheckinDateFrom);
			// var toSend = jQuery.param(quiryinfojson);

			// //TO DO: add handler 
			// $.ajax({
			// 	type:"GET",
			// 	dataType:"json",
			// 	url:"search/result",
			// 	data:toSend
			// })
			
			

			
		}

	</script>


	<script type="text/javascript">
		$(document).ready(function(){
			$("#inquiryDate").datepicker({
	          dateFormat: "mm/dd/yy",
	          altFormat: "yy-mm-dd",
    		  altField: "#altinquiryDate",
    		  onClose: function(){
    		  	if(!$(this).val()) $("#altinquiryDate").val('');
    		  }
	        });

			$("#inquiryDateFrom").datepicker({
	          dateFormat: "mm/dd/yy",
	          altFormat: "yy-mm-dd",
    		  altField: "#altinquiryDateFrom",
    		  onClose: function(){
    		  	if(!$(this).val())$("#altinquiryDateFrom").val('');
    		  }
	        });
	        $("#inquiryDateTo").datepicker({
	          dateFormat: "mm/dd/yy",
	          altFormat: "yy-mm-dd",
    		  altField: "#altinquiryDateTo",
    		  onClose: function(){
    		  	if(!$(this).val()) $("#altinquiryDateTo").val('');
    		  }
	        });
	        $("#CheckinDateFrom").datepicker({
	          dateFormat: "mm/dd/yy",
	          altFormat: "yy-mm-dd",
    		  altField: "#altCheckinDateFrom",
    		  onClose: function(){
    		  	if(!$(this).val()) $("#altCheckinDateFrom").val('');
    		  }
	        });
		});

	</script>


</body>

</html>


