<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="{{asset('img/icon.png')}}" type="image/png" sizes="16x16">
		<title>Home Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<!--------------------------------------  Bootstrap CSS  ------------------------------------------->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

       
        <link rel="stylesheet" href="{{asset('css/self.css')}}">
        <link rel="stylesheet" href="{{asset('css/loader.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

		<?php
		 $pagenum = 1;
    	 $itemsEachPage = 10;
    	 date_default_timezone_set('America/Los_Angeles');
         $date=date('Y-m-d');
         str_replace('-','/',$date);
         $inquirySources = list_to_data(public_path('list/inquirySourceList'));
         $purposes = list_to_data(public_path('list/purpose'));
         $countries = list_to_data(public_path('list/countryList'));
         $houseTypes = list_to_data(public_path('list/houseTypeList'));
         /*
         	This two function can be moved to an util php file 
         	 Here is for convenience.
         */

         function list_to_data($pathName){
         	$myfile = fopen($pathName,"r");
         	$res = array();
         	while(!feof($myfile)){
         		$tmp = fgets($myfile);
         		array_push($res,$tmp);
         	}
         	fclose($myfile);
         	return $res;
		 }

		 function data_to_option($array,$selected){
		 	$sel = trim($selected);
		 	$sel = str_replace(' ','',$sel);
		 	foreach($array as $ele)
		 	{
		 		$trimedele = trim($ele);
		 		$trimedele = str_replace(' ','',$trimedele);
		 		if(strcasecmp($sel,$trimedele)===0){
		 			 echo "<option selected value='$ele'>$ele</option>";
		 		}
		 		else {
		 			echo "<option value='$ele'>$ele</option>";
		 		}

		 	}
		 }
		 function data_to_option_test($array,$selected){
		 	$sel = trim($selected);
		 	$sel = str_replace(' ','',$sel);
		 	foreach($array as $ele)
		 	{
		 		$trimedele = trim($ele);
		 		$trimedele = str_replace(' ','',$trimedele);
		 		//echo $trimedele.' compared to '.$sel;
		 		// echo strcasecmp($sel,$trimedele).'/n';
		 		if(strcasecmp($sel,$trimedele)===0){
		 			echo "compare suc ";
		 			echo $trimedele.' compared to '.$sel;
		 		}

		 		}
		 }

		?>


		<style>
			body{
                background-color: white;
                background-size: cover;
			}
			input[type="search"]::-webkit-search-cancel-button{
				-webkit-appearance: searchfield-cancel-button;
			}

             .table-bordered tr,
             .table-bordered td {
                border: 1px solid #5D5F60 !important;
             }
            .my-title {
                color: gray;
                height: 20px;
            }
/*
            .bg1 {background-color:deeppink};
            .bg2 {background-color:dodgerblue};
            .bg3 {background-color:antiquewhite};
*/

		</style>
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
	            <a class="navbar-brand" style="padding-top:5px;"><img src="{{asset('img/icon.png')}}" class="img-rounded img-responsive" width="45px" height="45px" alt=""></a>
	              <a class="navbar-brand">91bnb Manage System</a>
	        </div>

	    <div id="navbar" class="navbar-collapse collapse">
	          <!-- navbar left -->
	          <ul class="nav navbar-nav">
	            <li class="active"><a>Home</a></li>
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
	                    <li><a href="/logout">Log Out</a></li>
	                  </ul>
	                </li>
	          </ul>

	    </div><!--/.nav-collapse -->
	  </div><!--/ container -->
	</nav>


	<div class='content container' style='margin-top:70px;'>
	        <h4><B><I>Hello {{$Rep->repName}} </I></B></h4> 
	        <span>Follow Up Closely of All Listed HOT Inquiries</span>


            <div class="table-responsive">
              <div id="modal"></div>
            	<table border='1' style="text-align:center" class="table table-bordered">
            	 <tr style="text-align:center">
              	 <td>Modify</td>
              	 <td style="min-width:130px;">Add Follow Up</td>
              	 <td style="min-width:150px;">Show All Follow Up</td>
              	 <td style="min-width:150px;">Rep. Name</td>
              	 <td>RepID</td>
              	 <td style="min-width:80px;">Inquiry ID</td>
              	 <td style="min-width:150px;">Priority Level</td>
              	 <td style="min-width:130px;">Inquiry Date</td>
              	 <td style="min-width:120px;">Inquiry Source</td>
              	 <!-- <td style="min-width:160px;">Inquiry Source Other</td> -->
              	 <td style="min-width:100px;">Purpose</td>
                 <!-- <td style="min-width:130px;">Purpose Other</td> -->
              	 <td style="min-width:150px;">Check In Date</td>
              	 <td style="min-width:150px;">Check Out Date</td>
              	 <td style="min-width:100px;">House ID</td>
              	 <td>Country</td>
              	 <td>State</td>
              	 <td>City</td>
              	 <!-- <td style="min-width:100px;">City Other</td> -->
              	 <td style="min-width:100px;"># of Rooms</td>
              	 <td>Whole/Share</td>
              	 <td style="min-width:120px;">House Type</td>
              	 <td style="min-width:130px;">House Type Other</td>
              	 <!-- td style="min-width:130px;">Room 1 Type</td>
              	 <td style="min-width:150px;">Room 1 Type Other</td>
              	 <td style="min-width:130px;">Room 2 Type</td>
              	 <td style="min-width:150px;">Room 2 Type Other</td>
              	 <td style="min-width:130px;">Room 3 Type</td>
              	 <td style="min-width:150px;">Room 3 Type Other</td> -->
              	 <td style="min-width:150px;"># of Adults</td>
              	 <td style="min-width:150px;"># of Kids</td>
              	 <td style="min-width:150px;">Kids Age</td>
              	 <td>Pregnant</td>
                 <td style="min-width:150px;">Budget Lower</td>
              	 <td style="min-width:150px;">Budget Upper</td>
              	 <td style="min-width:150px;">Budget Unit</td>
              	 <td style="min-width:130px;">Have Pet</td>
              	 <td style="min-width:130px;">Pet Type</td>
              	 <td style="min-width:150px;">Special Note</td>
              	 <td style="min-width:100px;">Inquirer ID</td>
              	 <td style="min-width:150px;">Inquirer First Name</td>
              	 <td style="min-width:150px;">Inquirer Last Name</td>
              	 <td style="min-width:150px;">US Phone #</td>
              	 <td style="min-width:350px;"> Other Phone # Country</td>
              	 <td style="min-width:150px;">Other Phone #</td>
              	 <td>Email</td>
              	 <td style="min-width:150px;">TaoBao User Name</td>
              	 <td style="min-width:130px;">WeChat Name</td>
              	 <td style="min-width:150px;">WeChat ID</td>
              	 <td style="min-width:200px;">Status</td>
              	 <td style="min-width:240px;">Reason Of Decline</td>
              	 <td style="min-width:180px;">Note</td>
              	 <td style="min-width:200px;">Comment</td>
            	 </tr>

            	 	<tbody id="mytable">
            	 			@foreach($Hotquerys as $query)
            	 			<tr>
            	 				<!-- @if($date>$query->checkIn)
            	 					<td><i class="glyphicon glyphicon-time" style="color:grey"></i></td>
            	 				@else
            	 					<td><i class="glyphicon glyphicon-time" style="color:green"></i></td>
            	 				@endif -->
            	 				<!-- check current name == repName ? Why ? Need to study -->
            	 				@if($Rep->repPriority >=2)  
            	 					<!-- To Do :: Add handler function in JS -->
                        <td></td><td></td>
                      @else 
            	 					<td><button type='button' class='btn btn-primary btn-sm' id='modify' onclick="bootbox_test()"><span class='glyphicon glyphicon-edit'></span> Modify</button></td>
            	 					<td><button type='button' class='btn btn-primary btn-sm' id='addfollowup' onclick='addFollowUp({{$query->inquiryID}})'><span class='glyphicon glyphicon-plus'></span> Add Follow Up</button></td>

            	 				@endif

            	 				<td><button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target='#myModal_{{$loop->index}}'><span class='glyphicon glyphicon-eye-open'></span> Show All Follow Up</button></td>
            	 				<td>
            	 					@if($Rep->repPriority >=2) 
	            	 					<select class='repName' id='repName_{{$loop->index}}' disable=true>  
	            	 				@else
	            	 					<select class='repName' id='repName_{{$loop->index}}'> 
	            	 				@endif
	            	 					<!--  Get All repName -->
	            	 					<!-- <option value="{{$query->reprensent->repName}}"> {{$query->reprensent->repName}}</option> -->
	            	 					@php
            	 							data_to_option($Allreps,$query->reprensent->repName);
            	 						@endphp
                          </select>
            	 				</td>
            	 				<td><div id='repID_{{$loop->index}}'> {{$query->reprensent->employeeID}}</div></td>
            	 				<td><div id='inquiryID_{{$loop->index}}'>IQ#{{$query->inquiryID}}</div></td>
            	 				<td>
            	 					<select class='inquiryPriorityLevel' id='inquiryPriorityLevel_{{$loop->index}}'>
            	 							@foreach(array(1,2,3,4,5) as $index)
            	 								@if($index==$query->inquiryPriorityLevel)
            	 									<option selected value="{{$index}}">{{$index}}</option>
            	 								@else 
            	 									<option value="{{$index}}">{{$index}}</option>
            	 								@endif
            	 							@endforeach
            	 					</select>
            	 					&nbsp
            	 					@if($query->inquiryPriorityLevel ==1)
            	 						<font id='image_{{$loop->index}}' color='red'>
            	 					@elseif($query->inquiryPriorityLevel ==2)
            	 						<font id='image_{{$loop->index}}' color='orange'>
            	 					@elseif($query->inquiryPriorityLevel ==3)
            	 						<font id='image_{{$loop->index}}' color='green'>
            	 					@elseif($query->inquiryPriorityLevel ==4)
            	 						<font id='image_{{$loop->index}}' color='blue'>
            	 					@elseif($query->inquiryPriorityLevel ==5)
            	 						<font id='image_{{$loop->index}}' color='grey'>
            	 					@endif
            	 					<i class='fa fa-star' aria-hidden='true'></i>
            	 				</td>
            	 				<td><input class='form-control input-sm fordate' type='search' id='inquiryDate' name='inquiryDate_{{$loop->index}}' value="{{str_replace('-','/',$query->inquiryDate)}}"></td>

            	 				<td>
  									@if($query->inquirySource)
	            	 					<select class='inquirySource' id='inquirySource_{{$loop->index}}'>
	            	 						@php data_to_option($inquirySources,$query->inquirySource); @endphp
	            	 					</select>
	            	 				@elseif($query->inquirySourceOther)
	            	 					<input type='search' id='otherInquirySource_{{$loop->index}}' value = '{{$query->inquirySourceOther}}'>
	            	 				@else 
	            	 					<input type='search' id='otherInquirySource_{{$loop->index}}' hidden>  
	            	 				@endif
            	 				</td>

            	 				<!-- Need to improve  
            	 					1. can store all possible choice into file in persistent layer
            	 					2. Or retrieve value each time 
            	 				 -->
            	 				<td>
            	 					<select class='purpose' id='purpose_{{$loop->index}}'>
            	 					@if($query->purpose)
            	 						@php data_to_option($purposes,$query->purpose); @endphp 
            	 					@elseif($query->purposeOther)
            	 						<option selected value = '0'> {{$purpose->purposeOther}} </option>
            	 					@else
            	 						<option selected value = '0'> Not Specific </option>
            	 					@endif
            	 					</select>
            	 				</td>

            	 				<td><input class='form-control input-sm fordate' type='search' id='checkInDate_{{$loop->index}}' name='checkInDate_{{$loop->index}}' value='{{str_replace('-','/',$query->checkIn)}}'></td>
            	 				<td><input class='form-control input-sm fordate' type='search' id='checkOutDate_{{$loop->index}}' name='checkOutDate_{{$loop->index}}' value='{{str_replace('-','/',$query->checkOut)}}'></td>
            	 				<td>
            	 					<input type='search' id='hid_{{$loop->index}}'  name='hid_{{$loop->index}}' 
            	 					@if($query->fullHouseID)
            	 						value = {{$query->fullHouseID}} 
            	 					@else
            	 						value = 'Not Specific'
            	 					@endif
            	 					> 
            	 				</td>
            	 				<td><select class='country' id='country_{{$loop->index}}'>
            	 						@php data_to_option($countries,$query->country); @endphp
            	 					</select>
            	 				</td>
            	 				<td><select class='state' id='state_{{$loop->index}}'>
            	 					@php
            	 						$States = list_to_data(public_path('list/Country_State/'.str_replace(' ','',$query->country).'_StateList'));
            	 						data_to_option($States,$query->state);
            	 					@endphp
            	 					</select>
            	 				</td>
            	 				<td><select class='city' id='city_{{$loop->index}}'>
            	 					@php
		    	 						$cities = list_to_data(public_path('list/State_City/'.$query->state.'CityList'));
		    	 						data_to_option($cities,$query->city);
		    	 					@endphp
            	 					</select></td>
            	 				</td>
            	 				<!-- city other -->
            	 				<td>
            	 						<input type='search' id='rooms_{{$loop->index}}' name='rooms_{{$loop->index}}' size='6' 
            	 						@if($query->rooms)
            	 							value = {{$query->rooms}}
            	 						@else
            	 							value = 'Not Specific'
            	 						@endif
            	 						>
            	 				</td>

            	 				<td><select class='share' id='share_{{$loop->index}}'>"      
            	 					<OPTION value =  -1
            	 					@if($query->share==1)
            	 						selected
            	 					@endif
            	 						>Share</OPTION>
            	 					<OPTION value =  1
            	 					@if($query->share==0)
            	 						selected
            	 					@endif
            	 						>Whole</OPTION>
            	 					<OPTION value =  0 
            	 					@if($query->share==-1)
            	 						selected
            	 					@endif
            	 						>Either</OPTION>
            	 					<select>
            	 				</td>

            	 				<td>
            	 					<select class='houseType' id='houseType_{{$loop->index}}'>
            	 						@php
            	 							data_to_option($houseTypes,$query->houseType);
            	 						@endphp
            	 					</select>
            	 				</td>
            	 				<td>
            	 					@if($query->houseTypeOther)
            	 						<input type='search' id='OtherHouseType_{{$loop->index}}' value={{$query->houseTypeOther}} hidden>
            	 					@else
            	 						<input type='search' id='OtherHouseType_{{$loop->index}}' hidden>
            	 					@endif
            	 				</td>

            	 				<td><input type='number' id='numOfAdult_{{$loop->index}}' name='numOfAdult_{{$loop->index}}' value='{{$query->numOfAdult}}'></td>
            	 				<td><input type='number' id='numOfChildren_{{$loop->index}}' name='numOfChildren_{{$loop->index}}' value='{{$query->numOfChildren}}'></td>
            	 				<td>@if($query->childAge&&$query->child!='null') 
            	 						<input type='search' id='childAge_{{$loop->index}}' name='childAge_{{$loop->index}}' value='{{$query->childAge}}'>
            	 					@else 
            	 						<input type='search' id='childAge_{{$loop->index}}' name='childAge_{{$loop->index}}'>
            	 					@endif
            	 				</td>

            	 				<td>
            	 					<select id='pregnancy_{{$loop->index}}'>
            	 						<OPTION value =  0 @if($query->pregnancy==0) selected @endif >N/A</OPTION>";
										<OPTION value =  1 @if($query->pregnancy==1) selected @endif >Yes</OPTION>";
										<OPTION value = -1 @if($query->pregnancy==-1) selected @endif >No</OPTION>";
            	 					</select>
            	 				</td>

            	 				<td><input type='search' id='budgetLower_{{$loop->index}}' name='budgetLower_{{$loop->index}}' value='{{$query->budgetLower}}'/></td>
            	 				<td><input type='search' id='budgetUpper_{{$loop->index}}' name='budgetUpper_{{$loop->index}}' value='{{$query->budgetUpper}}'/></td>
            	 				<td style='min-width:80px;'>
            	 					<select id='budgetUnit_{{$loop->index}}'>
            	 						<OPTION value = 1  @if($query->budgetUnit==1) selected @endif >Per Month</OPTION>
										<OPTION value = 0  @if($query->budgetUnit==0) selected @endif >Per Day</OPTION>
									</select>
								</td>

								<td style='min-width:80px;'>
									<select class='pet' id='pet_{{$loop->index}}'>
											<OPTION value =  0 @if($query->pet==0) selected @endif >N/A</OPTION>";
											<OPTION value =  1 @if($query->pet==1) selected @endif >Yes</OPTION>";
											<OPTION value = -1 @if($query->pet==-1) selected @endif >No</OPTION>
									</select>
								</td>

								<td>
									@if($query->pet!=1)
										@if($query->petType)
											<input type='search' id='petType_{{$loop->index}}' value='{{$query->petType}}' hidden>
										@else
											<input type='search' id='petType_{{$loop->index}}' hidden>
										@endif
									@else 
										@if($query->petType)
											<input type='search' id='petType_{{$loop->index}}' value='{{$query->petType}}'>
										@else
											<input type='search' id='petType_{{$loop->index}}'>
										@endif
									@endif
								</td>

								<td><button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target='#specialNote_{{$loop->index}}'><span class='glyphicon glyphicon-edit'></span>Show/Add SpecialNote</button></td>
            	 			</tr>
            	 			<!--followUp Modal-->
            	 			<div class='modal fade' id='myModal_{{$loop->index}}' style='text-align:center;' role='dialog'>
				    		  	<div class="modal-dialog modal-md">
				    		  		<div class="modal-content">
				    		  			<div class="modal-header">
				    		  				<button type="button" class="close" data-dismiss="modal">&times;</button>	
				    		  				<h4 class="modal-title"><p>Inquiry Follow Up History of Customer: Fan Pang</p><p>(Inquiry ID: {{$query->inquiryID}})</p></h4></div>
				    		  				<div class="modal-body">
				    		  					@if($query->getfollowup->count()==0)
				    		  						<p>No Prior Follow Up Information</p>
				    		  					@else
				    		  						@foreach($query->getfollowup as $follow)
				    		  							<div class="panel panel-default">
				    		  								<div class="panel-heading">Follow Up {{$follow->followupID}} </div>
				    		  									<ul class="list-group">
				    		  										<li class="list-group-item">Follow Up Date: {{str_replace('-','/',$follow->followupDate)}} </li>
				    		  										<li class="list-group-item">Follow Up Status:  {{$follow->followupStatus}}</li>
				    		  									</ul>
				    		  							</div>
				    		  						@endforeach
				    		  					@endif
				    		  					<div class="panel panel-default" d='followup_{{$loop->index}}'  hidden>
	
				    		  					</div>

				    		  	
				    		  				</div>
				    		  				<div class="modal-footer">
				    		  					<button type="button" class="btn btn-primary btn-sm" onclick='addFollowUp({{$loop->index}})' >Add Follow Up</button>
				    		  					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				    		  				</div>
				    		  			</div>
				    		  		</div>
				    		  	</div>
				    		  </div>


            	 			@endforeach 
         
    
            	 	</tbody>
            	 </table>
    		  </div>

   


    		  <div class='test'>
    		  		

            	 	<!-- @foreach($Hotquerys as $query)
            	 		<p>{{$Hotquerys->url('1')}}</p>
            	 	@endforeach -->
            	 	<!-- <p>{{$Hotquerys[2]}}</p> -->
           
            		
    		  </div>



    		<div class='well' id='followup' hidden>
                <div class='input-group'>
                  <form id='addFollowupForm' action='MainPage/addfollow' method='POST' hidden>
                  	{{ csrf_field() }}
                   	<p>Inquiry ID: <INPUT id='inquiryID' name='inquiryID' type='search'></p>
                    <p>Follow Up Date: <INPUT id='followupDate' name='followupDate' type='date' value='{{date("Y-m-d")}}' ></p>
                   	<p>Follow Up Status: <INPUT id='followupStatus' name='followupStatus' type='search' size=130></p>
                   	<INPUT type='submit' class='btn btn-default' id='addFollowupSubmit' name='addFollowupFromMainpage' value='Submit'>
                    &nbsp&nbsp<button type='button' class='btn btn-default' onclick='document.getElementById("addFollowupForm").style.display="none";
                   	document.getElementById("followup").style.display="none";'>Hide</button>
                 	</form>
                </div>
            </div>

            <div class='page' id='pagination' style='text-align:right'>
				    {{$Hotquerys->links()}}
			</div>


            <hr>




            <div class="row bg-3 text-center" style="margin:0; background-color:#FAFAFA; line-height:1.2;">
            	<div class="col-sm-1 bg1"></div>
            	@if($Rep->repPriority ==1)
	            	<!-- Admin -->
	            	<div class="col-sm-2 bg2">
            		<div class="caption">
                        <div class="my-title"><h5>Admin</h5></div>
                        <a href="/representatives"><h6>Representatives</h6></a>
                        <a><h6>User Log</h6></a>
                        <a><h6>Accounting</h6></a>
                        <a href="#"><h6>House Reporting</h6></a>
                        <a href="#"><h6>Inquiry Reporting</h6></a>
                    </div>
                </div>
                @elseif($Rep->repPriority ==2)
                	<!-- Admin -->
                    <div class="col-sm-2 bg2">

                        <div class="caption">
                            <div class="my-title"><h5>ACCT</h5></div>
                            <a><h6>Accounting</h6></a>
                            <a href="report/HouseReportIndex.php"><h6>House Reporting</h6></a>
                            <a href="report/reportIndex.php"><h6>Inquiry Reporting</h6></a>
                        </div>


                    </div>

	            @endif

	            <!-- Inquiry -->
                <div class="col-sm-2 bg1">

                    <div class="caption">
                        <div class="my-title"><h5>Inquiry</h5></div>
                        <a href='inquiry/add'><h6>Add New Inquiry</h6></a>
                        @if($Rep->repPriority<=3)
                        	<a href="/inquiry/search"><h6>Search/Modify/Follow Up</h6></a>
                        	@if(!$Rep->repPriority==3)
                        		<a href="" id="extAllInquiry" download><h6>Extract All Inquiries</h6></a>
                        	@endif
                        @endif
                    <a href="inquiry/passdue.php"><h6>Pass Due Log</h6></a>
                	</div>
                </div>

                <!-- Inquirer -->
                <div class="col-sm-2 bg1">
                    <div class="caption">
                        <div class="my-title"><h5>Inquirer</h5></div>
                        <!--<a href="inquiry/newInquirer.php"><h6>Add New Inquirer</h6></a>-->
                    @if($Rep->repPriority<=3)
                    	<a href="inquirer/searchAndModify"><h6>Search/Modify Inquirer</h6></a>
                    @endif
                    	<a href="inquirer/showAll"><h6>Show All Inquirers</h6></a>
                    </div>
                </div>



                <!-- House -->
                <div class="col-sm-2 bg1">
                      <div class="caption">
                        <div class="my-title"><h5>House</h5></div>
                        <a href="house"><h6>House Search</h6></a>
                        <a href="house/newHouse2.php"><h6>Add New House</h6></a>
                        <a href="house/modifyHouse2.php"><h6>Modify/Update Houses</h6></a>
                        <a id="extAllHouse" href=""><h6>Extract All Houses</h6></a>
                      </div>
                </div>


                	<div class="col-sm-1 bg1"></div>
                	</div>
	            </div>




            </div>
        </div>
    </div>

</html>

<script src="{{asset('js/jquery-1.11.3.js')}}"></script>
      <!-- Bootstrap Latest compiled and minified JavaScript -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>

  <script src="{{asset('js/bootbox.min.js')}}"></script>

  <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
  <!-- jquery ui -->
  <script src="{{asset('/js/jquery-ui.js')}}"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script type="text/javascript">
		function bootbox_test(){
			bootbox.dialog({
			message: 'Do you really want to modify?',
			title: 'Modify Confirmation',
			buttons: {
				success: {
					label: 'Yes',
					className: 'btn-success',
					callback:  function (){

					}
				},
				danger:{
					label: 'No',
					className: 'btn-danger',
					callback: function(){

					}
				}
			}
			});
		}
		// for test
		function addFollowUp(rowNum){
			document.getElementById('addFollowupForm').style.display = 'block';
			document.getElementById('followup').style.display = 'block';
			document.getElementById('inquiryID').value = rowNum;//document.getElementById('inquiryID').innerHTML;
		}



		$(document).ready(function(){
			 $('.fordate').datepicker({
	          dateFormat: "mm/dd/yy"
	        });
       loadOpt();
		});

</script>


