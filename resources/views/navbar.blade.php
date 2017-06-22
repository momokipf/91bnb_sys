<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="{{asset('img/icon.png')}}" type="image/png" sizes="16x16">
	<title>@yield('title')</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<!--------------------------------------  Bootstrap CSS  ------------------------------------------->
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">   
    <link rel="stylesheet" href="{{asset('css/self.css')}}">
    <link rel="stylesheet" href="{{asset('css/loader.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    @yield('head')

</head>
<body>

	<!-- Fixed navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top" >
	  <div class="container">
	        <div class="navbar-header">
	              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	              </button>
	            <a class="navbar-brand" style="padding-top:5px;"><img src="{{asset('img/icon.png')}}" class="img-rounded img-responsive" width="45px" height="45px" alt="" href="/MainPage"></a>
	              <a class="navbar-brand" href="/MainPage">91bnb Manage System</a>
	        </div>

	    <div id="navbar" class="navbar-collapse collapse">
	          <!-- navbar left -->
	          <ul class="nav navbar-nav">
	          	<!-- Admin -->
	          	@if($Rep->repPriority ==1)

				  <li class="dropdown">
				      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
				      <span class="caret"></span></a>
				      <ul class="dropdown-menu">
				        <li><a href="/representatives"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Representatives</a></li>
				        <li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> User Log</a></li>
				        <li><a href="#"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Accounting</a></li>
				        <li><a href="/report/houseReport"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> House Reporting</a></li>
				        <li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Inquiry Reporting</a></li>
				      </ul>
				  </li>

				@elseif($Rep->repPriority ==2)

				  <li class="dropdown">
				      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
				      <span class="caret"></span></a>
				      <ul class="dropdown-menu">
				        <li><a href="#">Accounting</a></li>
				        <li><a href="/report/houseReport"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> House Reporting</a></li>
				        <li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Inquiry Reporting</a></li>
				      </ul>
				  </li>

				@endif
	            
			    <!-- Inquiry -->
			    <li class="dropdown">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Inquiry
			        <span class="caret"></span></a>
			        <ul class="dropdown-menu">
			          <li><a href="/inquiry/add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Inquiry</a></li>
			          @if($Rep->repPriority<=3)
			          <li><a href="/inquiry/search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search/Modify/Follow Up</a></li>
			          @if(!($Rep->repPriority==3))
			          <li><a id="extAllInquiry" download><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Extract All Inquiries</a></li>
			          @endif
                      @endif
			          <li><a href="/inquiry/passdue"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Pass Due Log</a></li>
			    	</ul>
			    </li>
			    <!-- Inquirer -->
			    <li class="dropdown">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Inquirer
			        <span class="caret"></span></a>
			        <ul class="dropdown-menu">
			          @if($Rep->repPriority<=3)
			          <li><a href="/inquirer/searchAndModify"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search/Modify Inquirer</a></li>
			          @endif
			          <li><a href="/inquirer/showAll"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Show All Inquirers</a></li>
			    	</ul>
			    </li>
			    <!-- House -->
			    <li class="dropdown">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#">House
			        <span class="caret"></span></a>
			        <ul class="dropdown-menu">
			          <li><a href="/housesearchindex"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> House Search</a></li>
			          <li><a href="/house/add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New House</a></li>
			          <li><a href="/house/modify"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modify/Update House</a></li>
			          <li><a href="#"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Extract All Houses</a></li>
			    	</ul>
			    </li>

	          </ul>
	          <!-- navbar right -->
	          <ul class="nav navbar-nav navbar-right">
	              <li class="dropdown">
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	                      <span class="glyphicon glyphicon-user"></span><span id='username'>{{$Rep->repUserName}}</span><span class="caret"></span></a>
	                  <ul class="dropdown-menu">
	                    <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile</a></li>
	                    <li><a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Change Password</a></li>
	                    <li role="separator" class="divider"></li>
	                    <li><a href="/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log Out</a></li>
	                  </ul>
	                </li>
	          </ul>

	    </div><!--/.nav-collapse -->
	  </div><!--/ container -->
	</nav>

	@yield('content')

</body>
</html>

@yield('script')