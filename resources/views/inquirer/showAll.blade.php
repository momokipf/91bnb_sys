<!doctype html>
<html lang="{{ config('app.locale') }}">
	<head>
		<title>Show All Inquirers</title>

		<meta charset="utf-8" />
		<!--  Bootstrap CSS  -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

		<!--  Defined CSS  -->
		<link rel="stylesheet" href="{{asset('css/self.css')}}">
		<link rel="stylesheet" href="{{asset('css/loader.css')}}">
		<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

		<script src="{{ asset('js/jquery-1.11.3.js') }}"></script>

		<style>
			/*body {
				padding-left: 5%; padding-right: 5%;
			}*/
			body{
				background-color:black;
				background-image: url(../img/bg_sea.jpg);
				background-size: cover;
				background-repeat: no-repeat;
			}

			.trans{
			  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3f000000',endColorstr='#3f000000');
			  background-color:rgba(255, 255, 255, 0.7)
			}
		</style>
	</head>

	<body>
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
					<a class="navbar-brand" href="../mainPage.php">91bnb Manage System</a>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<!-- navbar left -->
					<ul class="nav navbar-nav">
						<li><a href="../mainPage.php">Home</a></li>
						<li class="active"><a>Show All Inquirers</a></li>
					</ul>
					<!-- navbar right -->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-user"></span><span id="username"> {{$rep->repUserName}} </span><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Profile</a></li>
								<li><a href="#">Change Password</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="../logout.php">Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div><!--/.nav-collapse -->

			</div><!--/ container -->
		</nav>

		<?php
			function phoneFormatting($num) {
				$num = trim($num);
				$num = preg_replace("/[^0-9\.]/", "", $num);
				if (strlen($num) != 0) {
					return '('. substr($num, 0, 3). ') '. substr($num, 3, 3). '-'. substr($num, 6, 4);
				}
				else {
					return "";
				}
			}
		?>

		<div class="container" style="margin-top:60px;">
			<div class="well trans" style="margin-top:10px;">
				<h3 style="text-align:center;">Show All Inquirers</h3>
				<div class='table-responsive' style="text-align:center;">
					<table class='table table-striped table-bordered'>
						<tr>
							<th style="min-width:150px;"><B>Inquirer ID</B></th>
							<th style="min-width:150px;"><B>First Name</B></th>
							<th style="min-width:150px;"><B>Last Name</B></th>
							<th style="min-width:200px;"><B>U.S. Phone Number</B></th>
							<th style="min-width:200px;"><B>Phone Country</B></th>
							<th style="min-width:180px;"><B>Phone Number</B></th>
							<th style="min-width:150px;"><B>Email</B></th>
							<th style="min-width:200px;"><B>Inquirer Taobao Username</B></th>
							<th style="min-width:200px;"><B>WeChat Username</B></th>
							<th style="min-width:150px;"><B>WeChat ID</B></th>
							<th style="min-width:180px;"><B>Inquirer Country From</B></th>
							<th style="min-width:180px;"><B>Inquirer State From</B></th>
							<th style="min-width:180px;"><B>Inquirer City From</B></th>
							<th style="min-width:180px;"><B>Inquirer Other City From</B></th>
						</tr>

						@foreach ($inquirers as $inquirer)
							<tr>
								<td>{{ $inquirer->inquirerID }}</td>
								<td>{{ $inquirer->inquirerFirst }}</td>
								<td>{{ $inquirer->inquirerLast }}</td>
								<td>{{ phoneFormatting($inquirer->inquirerUsPhoneNumber) }}</td>
								<td>{{ $inquirer->inquirerPhoneCountry }}</td>
								<td>{{ $inquirer->inquirerPhoneNumber }}</td>
								<td>{{ $inquirer->inquirerEmail }}</td>
								<td>{{ $inquirer->inquirerTaobaoUserName }}</td>
								<td>{{ $inquirer->inquirerWechatUserName }}</td>
								<td>{{ $inquirer->inquirerWechatID }}</td>
								<td>{{ $inquirer->inquirerCountry }}</td>
								<td>{{ $inquirer->inquirerState }}</td>
								<td>{{ $inquirer->inquirerCity }}</td>
								<td>{{ $inquirer->inquirerCityOther }}</td>
							</tr>
						@endforeach
					</table>
				</div>

				<div align="center">
					{{ $inquirers->links() }}
				</div>

				<div class="row">
					<div class="col-lg-4">
						<button id="extAll" type="button" class="btn btn-primary">Extract All Inquirers</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	
	<script type="text/javascript">
		$("#extAll").click(function(){
			console.log("extract all inquirers");
		
			// post excel download requeset to myResponse.php
			$.post("../PHPExcel/ExcelExtraction/inquirerExt.php",
				// data
				{   msg: "all"
				},
				// return a redirection
				function(data){ $(".loaderDiv").hide();  window.location.href="../PHPExcel/Files/" + data;})
		});
	</script>
</html>
