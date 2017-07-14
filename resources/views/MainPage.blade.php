@extends('navbar')
@section('title', 'Main Page')

@section('head')
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

/*             .table-bordered tr,
             .table-bordered td {
                border: 1px solid #5D5F60 !important;
             }
            .my-title {
                color: gray;
                height: 20px;
            }*/
            .table-bordered th{
                text-align: center;
            }
/*
            .bg1 {background-color:deeppink};
            .bg2 {background-color:dodgerblue};
            .bg3 {background-color:antiquewhite};
*/

    </style>
@endsection



@section('content')
<div class='content container'>
    <h4><B><I>Hello {{$Rep->repFirstName}} </I></B></h4> 
    <span>Follow Up Closely of All Listed HOT Inquiries</span>


    <div class="table-responsive">
      <div id="modal"></div>
      <table border='1' style="text-align:center" class="table table-bordered table-hover">
       <thead style="text-align:center">

         <th style="min-width:70px;">Priority</th>
         <th style="min-width:90px;">Name</th>
         <th>City</th>
         <th style="min-width:70px;">Rooms</th>
         <th>Whole/Share</th>
         <th style="min-width:70px;">Adults</th>
         <th style="min-width:70px;">Kids</th>
         <th>Pregnant</th>
         <th style="min-width:100px;">Check In Date</th>
         <th style="min-width:100px;">Check Out Date</th>
         <th style="min-width:100px;">WeChat Name</th>
         <th style="min-width:100px;">TaoBao User Name</th>
         <!-- <td style="min-width:160px;">Inquiry Source Other</td> -->
         <!-- <td style="min-width:130px;">Purpose Other</td> -->

         
         <!-- <td style="min-width:100px;">City Other</td> -->
         
         <th>Email</th>
         <th>House Pair</th>

         <th>Modify</th>
         <th style="min-width:150px;">Show All Follow Up</th>
         <th style="min-width:130px;">Show Detail</th>
       </thead>

        <tbody id="mytable">
            @foreach($Hotquerys as $query)
            <tr>           
              <!-- Priority Level -->
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

              <!-- inquirer name -->
              <td>{{$query->quirer->inquirerFirst}} {{$query->quirer->inquirerLast}}</td>
              
              <!-- city -->
              <td nowrap="nowrap">
              @if($query->city=='')
                N/A
                @else
                {{$query->city}}
                @endif
              </td>

              <!-- # of rooms  -->
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
              
              <!-- # of adults -->
              <td>{{$query->numOfAdult}}</td>
              <!-- # of kids -->
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

              <!-- Check in Date -->
              <td>{{str_replace('-','/',$query->checkIn)}}</td>
              <!-- check out date -->
              <td>{{str_replace('-','/',$query->checkOut)}}</td>
              <!-- wechat name and id  -->
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


              @if($Rep->repPriority >=2)  
                <!-- To Do :: Add handler function in JS -->
                <td></td>
              @else 
                <!-- modify -->
                <td><a href="/inquiry/search/modify/{{$query->inquiryID}}"><button type='button' class='btn btn-primary btn-sm' id='modify'><span class='glyphicon glyphicon-edit'></span> Modify</button></a></td>
                

              @endif  

              <!-- show all follow up -->
              <td>
                <button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target='#myModal_{{$loop->index}}'><span class='glyphicon glyphicon-eye-open'></span> Show All Follow Up</button>
                
              </td>

              <!-- show detail -->
              <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='#myDetail_{{$loop->index}}'><span class="glyphicon glyphicon-list-alt"></span> Show Detail</button>

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
                    <button type="button" class="close" data-dismiss="modal">&times;</button> 
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
                      <form id="followupform_{{$loop->index}}" action='MainPage/addfollow' method='POST'>  
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
                  <a href="report/houseReport"><h6>House Reporting</h6></a>
                  <a href="#"><h6>Inquiry Reporting</h6></a>
                </div>
              </div>
              @elseif($Rep->repPriority ==2)
              <!-- Admin -->
              <div class="col-sm-2 bg2">
                <div class="caption">
                  <div class="my-title"><h5>ACCT</h5></div>
                  <a><h6>Accounting</h6></a>
                  <a href="report/houseReport"><h6>House Reporting</h6></a>
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
                        @if(!($Rep->repPriority==3))
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
                    <a href="/housesearchindex"><h6>House Search</h6></a>
                    <a href="/house/add"><h6>Add New House</h6></a>
                    <a href="/house/modify"><h6>Modify/Update Houses</h6></a>
                    <a id="extAllHouse" href=""><h6>Extract All Houses</h6></a>
                  </div>
              </div>

              <div class="col-sm-2 bg1">
                  <div class="caption">
                    <div class="my-title"><h5>Transaction</h5></div>
                    <a href=""><h6>Modify/Update Transactions</h6></a>
                    <a href="/transaction/showAll"><h6>Show All Transactions</h6></a>
                  </div>
              </div>
            </div>
           </div>




            </div>
        </div>
    </div>
@endsection

@section('script')

<script src="{{asset('js/jquery-1.11.3.js')}}"></script>
      <!-- Bootstrap Latest compiled and minified JavaScript -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>

  <script src="{{asset('js/bootbox.min.js')}}"></script>

  <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
  <!-- jquery ui -->
  <script src="{{asset('js/jquery-ui.js')}}"></script>
  <script src="{{asset('js/util.js')}}"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
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

    // for test
    function addFollowUp(rowNum){
      document.getElementById('addFollowupForm').style.display = 'block';
      document.getElementById('followup').style.display = 'block';
      document.getElementById('inquiryID').value = rowNum;//document.getElementById('inquiryID').innerHTML;
    }


    // for datepicker
    $( function() {
      $( "#datepicker" ).datepicker();
        dateFormat: "mm/dd/yy"
    } );


    $(document).ready(function(){
       $('.fordate').datepicker({
            dateFormat: "mm/dd/yy"
          });
       loadOpt();
    });

</script>
@endsection





