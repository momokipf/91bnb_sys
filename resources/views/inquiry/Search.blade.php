@extends('navbar')
@section('title', 'Search/Modify/Add Follow up Inquiry')

@section('head')

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
	
	<script src="{{asset('js/jquery-ui.js')}}"></script>
	<script src="{{asset('js/bootbox.min.js')}}"></script>
	<script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>


	<style>
		body{
	  background-color:black;
				background-image: url('/img/bg_la2.jpg');
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
@endsection

@section('content')
	<div class='content container' style="margin-top:80px">
		<div class='well trans' style="margin-top:10px">
			<h3 class="text-center" style="margin-bottom:30px;">Search Inquiry</h3>
			<form id = 'inquiryinfo' action='/inquiry/search/result' method='GET'>
				<!-- {{ csrf_field() }} -->
				<div class="col-lg-3 col-md-3 col-sm-3">
					<label for="">Inquirer First Name</label>
					<input type="search" class="form-control input-sm" id="searchInquirerFirst" name='inquirerFirst' placeholder="First Name" value="{{ app('request')->input('inquirerFirst') }}">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3">
					<label for="searchInquirerLast">Inquirer Last Name</label>
					<input type="search" class="form-control input-sm" id="searchInquirerLast" name='inquirerLast' placeholder="Last Name" value="{{ app('request')->input('inquirerLast') }}">
				</div>

				<div class="col-lg-3 col-md-3 col-sm-3">
					<label for="searchInquirerWechatID">Inquirer Wechat ID</label>
					<input type="search" class="form-control input-sm" id="searchInquirerWechatID" name='inquirerWechatID' placeholder="Wechat ID" value="{{ app('request')->input('inquirerWechatID') }}">
				</div>

				<div class="col-lg-3 col-md-3 col-sm-3">
					<label for="InquiryID">Inquiry ID</label>
					<div class="input-group"><span class="input-group-addon">IQ#</span><input type="search" class="form-control input-sm" id="inquiryID" name='inquiryID' placeholder="Inquiry ID" value="{{ app('request')->input('inquiryID') }}"></div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-sm-12">
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label>Inquiry Date</label>
							<input name="inquiryDate" class="form-control input-sm" id="inquiryDate" type="search" placeholder="mm/dd/yyyy" value="{{ app('request')->input('inquiryDate') }}">
							<input type="hidden" name = 'inquiryDate' id = 'altinquiryDate'> 
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label>Inquiry Date Range From </label>
							<input type="search" class="form-control input-sm" id="inquiryDateFrom" name="inquiryDateFrom" placeholder="mm/dd/yyyy" value="{{ app('request')->input('inquiryDateFrom') }}">
							<input type="hidden" name='inquiryDateFrom' id='altinquiryDateFrom'>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-3">
							<label>Inquiry Date Range To </label>
							<input type="search" class="form-control input-sm" id="inquiryDateTo" name="inquiryDateTo" placeholder="mm/dd/yyyy" value="{{ app('request')->input('inquiryDateTo') }}">
							<input type="hidden" name = 'inquiryDateTo' id = 'altinquiryDateTo'> 
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label>Checkin Date Range</label>
							<input type="search" class="form-control input-sm" id="CheckinDateFrom" name="CheckinDateFrom" placeholder="mm/dd/yyyy" value="{{ app('request')->input('CheckinDateFrom') }}">
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
							<input type="text" class="form-control input-sm" name="InquiryCity" id="InquiryCity" value="{{ app('request')->input('InquiryCity') }}">
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<label for="WechatName">Wechat Name</label>
							<input type="text" class="form-control input-sm" id="WechatName" name="WechatName" value="{{ app('request')->input('WechatName') }}">
						</div>
					</div>
				</div>
				<br>

				<div class="text-center">
					<BUTTON type='submit' form="inquiryinfo" class="btn btn-success" id='searchInquirySubmit' onclick='filterInquiry();'>Search</BUTTON>&nbsp&nbsp
					<a href="/inquiry/search"><BUTTON type='button' class="btn btn-primary" >Reset</BUTTON></a>
				</div>
				<br>
				<div style="text-align:center;">
					<span id="error" style="color:red;"></span>
				</div>
			</form>

		</div>
		<hr>
	</div>

	@isset($hotquerys)

	<div class='content container'>
		<div class="well trans">
			<div class="table-responsive">	
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Pass</th>
							<th>Priority</th>
							<th>Inquiry ID</th>
							<th>Name</th>
							<th>City</th>
							<th>Rooms</th>
							<th>Whole/Share</th>
							<th>Adults</th>
							<th>Kids</th>
							<th>Pregnant</th>
							<th>Check In</th>
							<th>Check Out</th>
							<th>WeChat Name</th>
							<th>TaoBao User name</th>
							<th>Email</th>
							<th>house pair</th>
							<th>Modify</th>
							<th>Show All Follow Up</th>
							<th>Show Detail</th>

						</tr>
					</thead>	
					<tbody>
						@foreach($hotquerys as $query )
						<tr>
							<!-- pass -->
							<td>
							</td>
							<!-- priority -->
							<td>
								@if($query->inquiryPriorityLevel ==1)
				                <font id='image_{{$loop->index}}' color='red'>
				                  <i class='fa fa-star' aria-hidden='true'></i>
				                </font>
				                @elseif($query->inquiryPriorityLevel ==2)
				                <font id='image_{{$loop->index}}' color='orange'>
				                  <i class='fa fa-star' aria-hidden='true'></i>
				                </font>
				                @elseif($query->inquiryPriorityLevel ==3)
				                <font id='image_{{$loop->index}}' color='green'>
				                  <i class='fa fa-star' aria-hidden='true'></i>
				                </font>
				                @elseif($query->inquiryPriorityLevel ==4)
				                <font id='image_{{$loop->index}}' color='blue'>
				                  <i class='fa fa-star' aria-hidden='true'></i>
				                </font>
				                @elseif($query->inquiryPriorityLevel ==5)
				                <font id='image_{{$loop->index}}' color='grey'>
				                  <i class='fa fa-star' aria-hidden='true'></i>
				                </font>
				                @endif
							</td>
							<!-- Inquiry ID -->
							<td>{{$query->inquiryID}}</td>
							<!-- name -->
							<td>{{$query->quirer->inquirerFirst}} {{$query->quirer->inquirerLast}}</td>
							<!-- city -->
							<td>
								@if($query->city=='')
					            N/A
					            @else
					            {{$query->city}}
					            @endif
							</td>
							<!-- rooms -->
							<td>
								@if($query->rooms)
			                  	{{$query->rooms}}
			                  	@else
			                   	Not Specific
			                  	@endif
							</td>
							<!-- whole/share -->
							<td>
								@if($query->share==1)
				                Share
				                @elseif($query->share==0)
				                Whole
				                @elseif($query->share==-1)
				                Either
				                @endif
							</td>
							<!-- adults -->
							<td>{{$query->numOfAdult}}</td>
							<!-- kids -->
							<td>{{$query->numOfChildren}}</td>
							<!-- pregnant -->
							<td>
								@if($query->pregnancy==0)
				                N/A
				                @elseif($query->pregnancy==1)
				                Yes
				                @else
				                No
				                @endif
							</td>
							<!-- check in -->
							<td>{{str_replace('-','/',$query->checkIn)}}</td>
							<!-- check out -->
							<td>{{str_replace('-','/',$query->checkOut)}}</td>
							<!-- wechat name -->
							<td>
								<a href="#" data-toggle="tooltip" data-placement="top" title="{{$query->quirer->inquirerWechatID}}">{{$query->quirer->inquirerWechatUserName}}</a>
							</td>
							<!-- taobao user name -->
							<td>{{$query->quirer->inquirerTaobaoUserName}}</td>
							<!-- email -->
							<td>{{$query->quirer->inquirerEmail}}</td>
							<!-- house pair -->
							<td><button type="button" class="btn btn-primary btn-sm" onclick="location.reload(true);HousePair('{{$query->country}}','{{$query->state}}','{{$query->city}}');" > House Pair</button>
							</td>
							
							<!-- if priority is not enough -->
							@if($Rep->repPriority >=2)  
				            <td></td><td></td>
				            @else 
				            <!-- modify -->
			                <td><a href="/inquiry/search/modify/{{$query->inquiryID}}"><button type='button' class='btn btn-primary btn-sm' id='modify' onclick="bootbox_test()"><span class='glyphicon glyphicon-edit'></span> Modify</button></a></td>

    			            @endif 


							<!-- show all follow up -->
			                <td><button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target='#myModal_{{$loop->index}}'><span class='glyphicon glyphicon-eye-open'></span> Show All Follow Up</button></td>

			                <!-- show detail -->
			                <td>
			                	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='#myDetail_{{$loop->index}}'><span class="glyphicon glyphicon-list-alt"></span> Show Detail</button>
			                	
			                	<!-- Show detail model -->
				                <div class='modal fade' id='myDetail_{{$loop->index}}' style='text-align:center;' role='dialog'>
				                  <div class="modal-dialog modal-md">
				                    <div class="modal-content">
				                      <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
				                        <h4 class="modal-title"><p>Detail</p></h4>
				                      </div>
				                      <div class="modal-body" style="height: 400px; overflow-y: auto;">
				                        <table style="text-align:center" class="table table-striped">
				                          <thead>
				                            <tr>
				                              <th>Title</th>
				                              <th>Data</th>
				                            </tr>
				                          </thead>
				                          <tbody>
				                            <tr>
				                              <td>Rep. Name</td>
				                              <td>{{$query->represent->repFirstName.' '.$query->represent->repLastName}}</td>
				                            </tr>
				                            <tr>
				                              <td>RepID</td>
				                              <td>{{$query->represent->repID}}</td>
				                            </tr>
				                            <tr>
				                              <td>Inquiry ID</td>
				                              <td>IQ#{{$query->inquiryID}}</td>
				                            </tr>
				                            <tr>
				                              <td>Priority Level</td>
				                              <td>{{$query->inquiryPriorityLevel ==1}}
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
				                                </font>
				                              </td>
				                            </tr>
				                            <tr>
				                              <td>Inquiry Date</td>
				                              <td>{{str_replace('-','/',$query->inquiryDate)}}</td>
				                            </tr>
				                            <tr>
				                              <td>Inquiry Source</td>
				                              <td>{{$query->inquirySource}}</td>
				                            </tr>
				                            <tr>
				                              <td>Purpose</td>
				                              <td>{{$query->purpose}}</td>
				                            </tr>
				                            <tr>
				                              <td>Check In Date</td>
				                              <td>{{str_replace('-','/',$query->checkIn)}}</td>
				                            </tr>
				                            <tr>
				                              <td>Check Out Date</td>
				                              <td>{{str_replace('-','/',$query->checkOut)}}</td>
				                            </tr>
				                            <tr>
				                              <td>House ID</td>
				                              <td>
				                                @if($query->fullHouseID)
				                                {{$query->fullHouseID}} 
				                                @else
				                                Not Specific
				                                @endif
				                              </td>
				                            </tr>
				                            <tr>
				                              <td>Country</td>
				                              <td>{{$query->country}}</td>
				                            </tr>
				                            <tr>
				                              <td>State</td>
				                              <td>
				                                @php
				                                if(file_exists(public_path('list/Country_State/'.str_replace(' ','',$query->country).'_StateList'))){
				                                  echo($query->state);
				                                }
				                              @endphp
				                              </td>
				                            </tr>
				                            <tr>
				                              <td>City</td>
				                              <td>
				                                @php
				                                if(file_exists(public_path('list/State_City/'.$query->state.'CityList'))){
				                                  echo($query->city);
				                                }
				                                @endphp
				                              </td>
				                            </tr>
				                            <tr>
				                              <td># of Rooms</td>
				                              <td>
				                                @if($query->rooms)
				                                  {{$query->rooms}}
				                                @else
				                                  Not Specific
				                                @endif
				                              </td>
				                            </tr>
				                            <tr>
				                              <td>Whole/Share</td>
				                              <td>
				                                @if($query->share==1)
				                                  Whole
				                                @endif
				                                  
				                                @if($query->share==0)
				                                  Either
				                                @endif
				                                   
				                                @if($query->share==-1)
				                                  Share
				                                @endif
				                              </td>
				                            </tr>
				                            <tr>
				                              <td>House Type</td>
				                              <td>{{$query->houseType}}</td>
				                            </tr>
				                            <tr>
				                              <td>House Type Other</td>
				                              <td>
				                                @if($query->houseTypeOther)
				                                {{$query->houseTypeOther}}
				                                @endif
				                              </td>
				                            </tr>
				                            <tr>
				                              <td># of Adults</td>
				                              <td>{{$query->numOfAdult}}</td>
				                            </tr>
				                            <tr>
				                              <td># of Kids</td>
				                              <td>{{$query->numOfChildren}}</td>
				                            </tr>
				                            <tr>
				                              <td>Kids Age</td>
				                              <td>{{$query->childAge}}</td>
				                            </tr>
				                            <tr>
				                              <td>Pregnant</td>
				                              <td>
				                                @if($query->pregnancy==0)
				                                N/A
				                                @elseif($query->pregnancy==-1)
				                                No
				                                @elseif($query->pregnancy==1)
				                                Yes
				                                @endif
				                              </td>
				                            </tr>
				                            <tr>
				                              <td>Budget Lower</td>
				                              <td>{{$query->budgetLower}}</td>
				                            </tr>
				                            <tr>
				                              <td>Budget Upper</td>
				                              <td>{{$query->budgetUpper}}</td>
				                            </tr>
				                            <tr>
				                              <td>Budget Unit</td>
				                              <td>
				                                @if($query->budgetUnit==1)
				                                Per Day
				                                @elseif($query->budgetUnit==0)
				                                Per MOnth
				                                @endif
				                              </td>
				                            </tr>
				                            <tr>
				                              <td>Have Pet</td>
				                              <td>
				                                @if($query->pet==0)
				                                N/A
				                                @elseif($query->pet==1)
				                                Yes
				                                @elseif($query->pet==-1)
				                                No
				                                @endif
				                              </td>
				                            </tr>
				                            <tr>
				                              <td>Pet Type</td>
				                              <td>{{$query->petType}}</td>
				                            </tr>
				                            <tr>
				                              <td>Special Note</td>
				                              <td><{{$query->specialNote}}</td>
				                            </tr>
				                            <tr>
				                              <td>Inquirer ID</td>
				                              <td>{{$query->quirer->inquirerID}}</td>
				                            </tr>

				                            <tr>
				                              <td>Inquirer First Name</td>
				                              <td>{{$query->quirer->inquirerFirst}}</td>
				                            </tr>
				                            <tr>
				                              <td>Inquirer Last Name</td>
				                              <td>{{$query->quirer->inquirerLast}}</td>
				                            </tr>
				                            <tr>
				                              <td>US Phone #</td>
				                              <td>{{$query->quirer->inquirerUsPhoneNumber}}</td>
				                            </tr>
				                            <tr>
				                              <td>Other Phone # Country</td>
				                              <td>{{$query->quirer->inquirerPhoneCountry}}</td>
				                            </tr>
				                            <tr>
				                              <td>Other Phone #</td>
				                              <td>{{$query->quirer->inquirerPhoneUnmber}}</td>
				                            </tr>
				                            <tr>
				                              <td>Email</td>
				                              <td>{{$query->quirer->inquirerEmail}}</td>
				                            </tr>
				                            <tr>
				                              <td>TaoBao User Name</td>
				                              <td>{{$query->quirer->inquirerTaobaoUserName}}</td>
				                            </tr>
				                            <tr>
				                              <td>WeChat Name</td>
				                              <td>{{$query->quirer->inquirerWechatUserName}}</td>
				                            </tr>
				                            <tr>
				                              <td>WeChat ID</td>
				                              <td>{{$query->quirer->inquirerWechatID}}</td>
				                            </tr>
				                            <tr>
				                              <td>Status</td>
				                              <td>{{$query->quirer->inquirerStatus}}</td>
				                            </tr>
				                            <tr>
				                              <td>Reason Of Decline</td>
				                              <td><{{$query->reasonOfDecline}}/td>
				                            </tr>
				                            <tr>
				                              <td>Note</td>
				                              <td>{{$query->note}}</td>
				                            </tr>
				                            <tr>
				                              <td>Comment</td>
				                              <td>{{$query->comment}}</td>
				                            </tr>

				                          </tbody>
				                        </table>
				                      </div>
				                      <div class="modal-footer">
				                        
				                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				                      </div>
				                    </div>
				                    
				                  </div>
				                </div>
			                </td>
						</tr>
						
						<!--followUp Modal-->
			            <div class='modal fade' id='myModal_{{$loop->index}}' style='text-align:center;' role='dialog'>
			              <div class="modal-dialog modal-md">
			                <div class="modal-content">
			                  <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal" onclick='showAddfollowUp("{{$query->inquiryID}}","addfollowup_{{$loop->index}}","followup_{{$loop->index}}")'>&times;</button> 
			                    <h4 class="modal-title">
			                      <p>Inquiry Follow Up History of Customer: {{$query->quirer->inquirerFirst}} {{$query->quirer->inquirerLast}}</p>
			                      <p>(Inquiry ID: {{$query->inquiryID}})</p>
			                    </h4>
			                  </div>
			                  <div class="modal-body">
			                    @if($query->getfollowup->count()==0)
			                    <p>No Prior Follow Up Information</p>
			                    @else
			                    @foreach($query->getfollowup as $follow)
			                    <div class="panel panel-default">
			                      <div class="panel-heading">
			                        Follow Up {{$follow->followupID}} 
			                      </div>
			                      <ul class="list-group">
			                        <li class="list-group-item">Date: {{str_replace('-','/',$follow->followupDate)}} </li>
			                        <li class="list-group-item">Status:  {{$follow->followupStatus}}</li>
			                      </ul>
			                    </div>
			                      
			                    @endforeach
			                    @endif
			                    <!-- add follow up form -->
			                    <div id='followup_{{$loop->index}}' style="display: none;">
			                      <form id="followupform_{{$loop->index}}" action='addfollow' method='POST'>  
			                        {{ csrf_field() }}
			                        <input id='inquiryID' name='inquiryID' type='search' value="{{$query->inquiryID}}" hidden>
			                        <div class="panel panel-default">
			                          <div class="panel-heading">
			                            New Follow Up  
			                          </div>
			                          <ul class="list-group">
			                            <li class="list-group-item">
			                              Date: <input type="text" id="datepicker" name="followupDate" value='{{date("Y-m-d")}}'>
			                            </li>
			                            <li class="list-group-item">Status: <input type="text" name="followupStatus" value=""></li>
			                          </ul>
			                        </div>
			                      </form>
			                      <button class="btn btn-primary btn-sm" type="submit" form="followupform_{{$loop->index}}">Save</button>
			                    </div>
			                  </div>
			                  <div class="modal-footer">
			                    <button type='button' class='btn btn-primary btn-sm' id='addfollowup_{{$loop->index}}' onclick='showAddfollowUp("{{$query->inquiryID}}","addfollowup_{{$loop->index}}","followup_{{$loop->index}}")'>Add Follow Up</button>
			                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			                  </div>
			                </div>
			              </div>
			            </div>

						@endforeach

					
					</tbody>
				</table>
			</div>
		</div>
		<div class='page' id='pagination' style='text-align: right;'>
			{{$hotquerys->links()}}
		</div>
	</div>

	
	@endisset
		
	<div class='content container'>
        <button id="extSearch" type='button' class="btn btn-success">Extract Search Results</button>
        <button id="extAll" type='button' class="btn btn-primary">Extract All Inquiries</button>
        <button id="extPri" type='button' class="btn btn-info">Extract High Priority Inquiries</button>	
    </div>


    <!-- Loading part , intial hidden -->
    <div class='loaderDiv'>
    	<div class = "loader"></div>
    	<div class ="loaderLabel text-center"><h4>Processing></h4><h4>Please Wait...</h4></div>
    </div>
@endsection

@section('script')

	<script>

		// show add follow up
	    function showAddfollowUp(inquiryID, btnID,divID){
	      if(document.getElementById(divID).style.display =='none'){

	        document.getElementById(divID).style.display = "block";
	        document.getElementById(btnID).innerHTML = 'cancel follow up';        
	      }else{
	        document.getElementById(divID).style.display = "none";
	        document.getElementById(btnID).innerHTML = 'Add Follow Up';
	      }

	    }

		function HousePair(country, state, city){
			var data={};
			data['country'] = country;
			data['state'] = state;
			data['city'] = city;
			var para = $.param(data);
			console.log(para);
			window.location.replace("/houses/results?"+para);
		}


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
		    $('[data-toggle="tooltip"]').tooltip();   
		});

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
@endsection


<!DOCTYPE html>
<html>
<body>
	
	






	


	


</body>

</html>


