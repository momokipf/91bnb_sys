
<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="{{asset('img/icon.png')}}" type="image/png" sizes="16x16">
    <meta charset="utf-8">
    <meta name="viewport"    content="width=device-width, initial-scale=1">
    <meta name="description" content="main page, index">
    <meta name="author"      content="91bnb">
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Login Portal</title>
    <script src="{{asset('js/jquery-1.11.3.js')}}"></script>
    <!--------------------------------------  Bootstrap CSS  ------------------------------------------->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <!--------------------------------------  Defined CSS  ------------------------------------------->
    <link rel="stylesheet" href="{{asset('css/self.css')}}">
    <!--------------------------------------  In Page CSS  ------------------------------------------->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <style>
        body {background-color: black;
              background-image: url(img/bg2.jpg);
              background-repeat: no-repeat;
              background-size: cover;
        }
        .center {
            margin: auto;
            width: 20%;
            margin-top: 80px;
            color: white;
        }
        .m-width {width:100px;}
        .box { height: 100%; padding-top: 10%;}
        input[type="search"]::-webkit-search-cancel-button{
  				-webkit-appearance: searchfield-cancel-button;
  			}

    </style>
</head>
<body>

<!---------------------------------- Fixed navbar ------------------------------------------------>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
        <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" style="padding-top:5px;"><img src="{{asset('img/icon.png')}}" class="img-rounded img-responsive" width="45px" height="45px" alt=""></a>
              <a class="navbar-brand">91bnb Manage System</a>
        </div>

    <div id="navbar" class="navbar-collapse collapse">
          <!-- navbar left -->
          <ul class="nav navbar-nav">
            <li class="active"><a>Log In Portal</a></li>
          </ul>


    </div><!--/.nav-collapse -->
  </div><!--/ container -->
</nav>
<!---------------------------------- / Fixed navbar -------------------------------------------------->

<!---------------------------------- background vedio ------------------------------------------------>
<div class="homepage-hero-module">
    <div class="video-container">

        <div class="filter box" style="height:100%">
            <div class="size center" >
                <div class="text-center"><h3>Sign In</h3></div>
                <form id="loginForm" action="/login" method="POST">
                	{{ csrf_field() }}
                    <fieldset class="form-group">
                        <label>User ID</label>
                        <input id="userID" type="search" class="form-control input-sm" name="userID" placeholder="Input User ID" value="{{old('userID')}}" autocomplete="off">
                    </fieldset>
                    <fieldset class="form-group">
                        <label>Password</label>hous
                        <input id="userPwd" type="password" class="form-control input-sm" name="userPwd" placeholder="Input Password"  value="{{old('userPwd')}}" autocomplete="off">
                    </fieldset>
                    <div style="height:15px;">
                    	<h5 id="msg" style="color:red">
	                    @if ($errors->has('userID'))
	                    	{{$errors->first('userID')}}
                        @elseif($errors->has('userPwd'))
                            {{$errors->first('userPwd')}}
                        @elseif($errors->has('email'))
                            {{$errors->first('email')}}
	                    @elseif ($errors->has('massage'))
               				{{$errors->first('message')}}
                        @elseif($errors->has('errorid'))
                            {{$errors->first('errorid')}}
                        @elseif($errors->has('errorpwd'))
                            {{$errors->first('errorpwd')}}
               			@endif
                        <!-- @foreach($errors->all() as $key => $error )
                           Key: {{ $key }}
                           Value: {{ $error }}
                        @endforeach -->
                    	</h5>
                    </div>
                    



                    <div class="text-left">
                        <button id="btnLogin" class="btn btn-success m-width btn-sm" name="submit" type="">
                            <span id="btnLoginText">Login</span>
                        </button>
                    <button id="clear" class="btn btn-warning m-width btn-sm" type="reset">Clear</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
<!--------------------------------- / background vedio ------------------------------------------------>
</body>



<script src="{{asset('js/jquery-1.11.3.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/vediobg.js')}}"></script>

<script>
	// clear button
    $("#clear").click(function() {
        $("#msg").text("");
    });


    // submit button
    $("#btnLogin").click(function() {
        btnProcessing();
    });


    function btnSuccess() {
        $("#btnLoginText").text("Success!");
    }

    function btnProcessing() {
        $("#btnLoginText").html('<i class="fa fa-spinner fa-pulse fa-x fa-fw"></i>');
    }

    function btnFailed() {
        $("#btnLoginText").text("Success!");
    }

    function btnReset() {
        $("#btnLoginText").text("Login");
    }




</script>
</html>


