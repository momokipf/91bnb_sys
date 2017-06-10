<!doctype html>
<html lang="{{ config('app.locale') }}">
	<head>
		<title>Report Index</title>

		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!--  Bootstrap CSS  -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

		<!--  Defined CSS  -->
		<link rel="stylesheet" href="{{asset('css/self.css')}}">
		<link rel="stylesheet" href="{{asset('css/loader.css')}}">
		<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

		<script type="text/javascript" src="{{ asset('js/jquery-1.11.3.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js')}}"></script>
		<script src="{{ asset('js/bootstrap-formhelpers-phone.js')}}"></script>
		<script src="{{ asset('js/bootbox.min.js')}}"></script>

		<style>
			html {
				overflow: hidden;
			}

			#content {
				margin-top:60px;
			}
		</style>
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container container-class">
				<div class="navbar-header">
					<!--  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
				</div>
				<div>
					<!-- Tab panes -->
					<div class="tab-content" id="content" style='margin-top:0px;'>
						<div role="tabpanel" class="tab-pane fade in active" id="InquiryDate">
						<!-- <iframe style="position: absolute; width:100%; height: 90%; border: none"  scrolling="yes" src="InquiryDate.html"></iframe> -->
						</div>
					</div>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<!-- navbar left -->
					<ul class="nav navbar-nav">
					<li class=""><a href="/MainPage">Home</a></li>
					<li class=""><a href="#">|</a></li>
					<li role="presentation" class="active"><a href="#map" aria-controls="map" role="tab" data-toggle="tab">House Map</a></li>
					<li role="presentation"><a href="#total" aria-controls="RentArea" role="tab" data-toggle="tab">Total</a></li>
					<li role="presentation"><a href="#RentArea" aria-controls="RentArea" role="tab" data-toggle="tab">Location</a></li>
					<li role="presentation"><a href="#Houses" aria-controls="Houses" role="tab" data-toggle="tab">Whole/Share</a></li>
					<li role="presentation"><a href="#houseType" aria-controls="houseType" role="tab" data-toggle="tab">House Type</a></li>
					<li role="presentation"><a href="#houseInquiry" aria-controls="houseType" role="tab" data-toggle="tab">Inquiry</a></li>
					<li role="presentation"><a href="#InquiryDate" aria-controls="home" role="tab" data-toggle="tab">Date</a></li>
					   
					<!-- <li role="presentation"><a href="#InquirySource" aria-controls="InquirySource" role="tab" data-toggle="tab">Source</a></li> -->
					<!-- <li role="presentation"><a href="#Purpose" aria-controls="Purpose" role="tab" data-toggle="tab">Purpose</a></li> -->
					<!-- <li role="presentation"><a href="#Duration" aria-controls="Duration" role="tab" data-toggle="tab">Term</a></li> -->
					<li role="presentation"><a href="#ConsistOfGuests" aria-controls="ConsistOfGuests" role="tab" data-toggle="tab">Guest</a></li>
					<li role="presentation"><a href="#Budget" aria-controls="Budget" role="tab" data-toggle="tab">$</a></li>
				   
					
					<!-- <li role="presentation"><a href="#Decline" aria-controls="Decline" role="tab" data-toggle="tab">Decline</a></li> -->
					<li role="presentation"><a href="#RepSearch" aria-controls="RepSearch" role="tab" data-toggle="tab">Rep</a></li>
					<li role="presentation"><a href="#PastDue" aria-controls="PastDue" role="tab" data-toggle="tab">Due</a></li>
					</ul>
					<!-- navbar right -->
					<!-- <ul class="nav navbar-nav navbar-right"> -->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
						<!-- test 0314 -->
							<a href="#" class="dropdown-toggle " id="navbarDropdownMenuLink" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-user"></span>
								{{ $rep->repUserName }} 
								<span class="caret"></span>
							</a>
							<!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> -->
							<ul class="dropdown-menu" >
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
		<div>
			<div class="tab-content" id="content">
				<div role="tabpanel" class="tab-pane fade in active" id="map">
					<iframe style="position: absolute; width:100%; height: 90%; border: none"  scrolling="yes" src="/report/houseVisual"></iframe>
				</div>
				<div role="tabpanel" class="tab-pane fade " id="total">
					<iframe style="position: absolute; width:100%; height: 90%; border: none"  scrolling="yes" src="/report/houseTotal"></iframe>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="RentArea">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="/report/houseLocation"></iframe>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="houseType">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="HouseTypeNew.html"></iframe>
				</div>

				<div role="tabpanel" class="tab-pane fade" id="houseInquiry">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="HouseInquiry.html"></iframe>
				</div>
				<!--  <div role="tabpanel" class="tab-pane fade" id="InquirySource">
					<iframe style="position: absolute; width:100%; height: 90%; border: none"  scrolling="yes" src="InquirySource.html"></iframe>
				</div>

				<div role="tabpanel" class="tab-pane fade" id="Purpose">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="purpose.html"></iframe>
				</div>

				<div role="tabpanel" class="tab-pane fade" id="Duration">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="duration.html"></iframe>
				</div> -->

				<div role="tabpanel" class="tab-pane fade" id="ConsistOfGuests">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="HouseGuest.html"></iframe>
				</div>

				<div role="tabpanel" class="tab-pane fade" id="Budget">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="HouseCost.html"></iframe>
				</div>

			 

				<div role="tabpanel" class="tab-pane fade" id="Houses">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="HouseWholeShareEither.html"></iframe>
				</div>

				<!--  <div role="tabpanel" class="tab-pane fade" id="Decline">
					<iframe style="position: absolute; width:100%; height: 90%; border: none"  scrolling="yes" src="decline.html"></iframe>
				</div> -->

				<div role="tabpanel" class="tab-pane fade" id="RepSearch">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="HouseRep.html"></iframe>
				</div>

				<!-- <div role="tabpanel" class="tab-pane fade" id="PastDue">
					<iframe style="position: absolute; width:100%; height: 90%; border: none" scrolling="yes" src="pastDue.html"></iframe>
				</div> -->
			</div>
		</div>

</html>
