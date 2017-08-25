@extends('navbar')
@section('title', 'Airbnb Sync')

@section('head')
<script type='text/javascript' src="{{asset('js/spectrum.js')}}"></script>
<script type="text/javascript" src="{{asset('js/moment.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar.css')}}">
<link rel='stylesheet' type='text/css' href="{{asset('css/spectrum.css')}}">

<script rel="stylesheet" type="text/javascript" src="{{asset('js/fullcalendar.min.js')}}"></script>
<style>

	/*#calendar .fc-unthemed td.fc-today {
		background: #fcf8e3;
	}*/

	.fc-day-grid-event{
		margin: 1px 20px 0px 0px;
	}

	/*.fc-ltr .fc-h-event.fc-selected .fc-end-resizer{
		margin-right: 20px;
	}*/
	 .fc td {
		border-color: black;
	}

	#calendar .fc-event {
		font-size: .50em;
	}

	#calendar .date-disabled-day{
		 background-image: linear-gradient(to bottom right,  transparent calc(50% - 1px), red, transparent calc(50% + 1px));
	}

	.setcleaning{

	}

	#houseslistdiv{
		float: left;
		margin-top: 50px;
		/*margin-left: 20px;*/
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
	}
	#houseslistdiv h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}
	#houseslistdiv p input {
		margin: 0;
		vertical-align: middle;
	}
	.sp-replacer{
		border: none;
	}
	.sp-preview{
		width:15px;
    	height: 15px;

	}

	#loadele{
        display:    none;
        position:   fixed;
        z-index:    1000;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 ) 
        url('http://sampsonresume.com/labs/pIkfp.gif') 
        50% 50% 
        no-repeat;
    }
    #loadele.loading{
        overflow:hidden;
        display:block;
    }

    #loadele.loading .modal{
        display:block;
    }
    .foo {
	  /*float: left;*/
	  width: 40px;
	  height: 20px;
	  margin: 5px;
	  border: 1px solid rgba(0, 0, 0, .2);
	}

</style>

@endsection
@section('inbody', 'onload=doload()')
@section('content')
<div class='container-fluid'>
	<div class="row">
		<div class='col-sm-2'>
			<div id='houseslistdiv'>
				<h4> Houses on AirBNB</h4>
				<p>
					<input type='checkbox' value ='27' onchange="eventSourceToggle(this);"</><label>&nbspAlhambra_23&nbsp</label>
					<input type="text" class='color form-control' value="#A52A2A" onchange='colorchange(this);' />
				</p>
				<p>
					<input type='checkbox' value ='634' onchange="eventSourceToggle(this);"</><label>&nbspMonrovia_13&nbsp</label>
					<input type="text" class='color form-control' value="#A52A2A" onchange='colorchange(this);'/>
				</p>
				<p>
					<input type='checkbox' value ='893' onchange="eventSourceToggle(this);"</><label>&nbspRH_89&nbsp</label>
					<input type="text" class='color form-control' value="#A52A2A" onchange='colorchange(this);'/>
				</p>
				<p>
					<input type='checkbox' value ='512' onchange="eventSourceToggle(this);"</><label>&nbspIrvine_85&nbsp</label>
					<input type="text" class='color form-control' value="#A52A2A" onchange='colorchange(this);'/>
				</p>
				<p>
					<input type='checkbox' value ='1135' onchange="eventSourceToggle(this);"</><label>&nbspTempleCity_01&nbsp</label>
					<input type="text" class='color form-control' value="#A52A2A" onchange='colorchange(this);'/>
				</p>
				<p>
					<input type='checkbox' value = '181' onchange="eventSourceToggle(this);"</><label>&nbspArcadia_128&nbsp</label>
					<input type="text" class='color form-control' value="#A52A2A" onchange='colorchange(this);'/>
				</p>
				<p>
					<input type='checkbox' value ='183' onchange="eventSourceToggle(this);"</><label>&nbspArcadia_130&nbsp</label>
					<input type="text" class='color form-control' value="#A52A2A" onchange='colorchange(this);'/>
				</p>
				<p>
					<input type='checkbox' value ='1160' onchange="eventSourceToggle(this);"</><label>&nbspTustin_03&nbsp</label>
					<input type="text" class='color form-control'/>
				</p>
				<p><input type='checkbox'</><label>&nbspTempleCity_0021</label></p>
				<div style="margin:auto; text-align:center;">
				<button type='button' class='btn btn-primary btn-sm' onclick='clearall()' >Clear all</button>
				</div>
			</div>

		</div>
		<div class="col-sm-10">
			<div id="calendar"></div>
		</div>
	</div>
	<div style="margin-top:50px;">
		<div style="margin:auto; text-align:center;">
			<button type="button" class="btn btn-primary btn-sm" onclick="importTodatabase();">Import to system</button>
		</div>
	</div>
</div>


<div class="modal" id="loadele"></div>

@endsection

@section('script')
<script>

	//var eventsource = [];
	$('.color').spectrum({
		showPaletteOnly: true,
    	togglePaletteOnly: true,
    	togglePaletteMoreText: 'more',
    	togglePaletteLessText: 'less',
    	hideAfterPaletteSelect:true,
    	color: '#A52A2A',
    	palette: [
        	["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
	        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
	        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
	        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
	        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
	        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
	        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
	        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130","#A52A2A"]
    	],
	});
	$(document).ready(function() {
		$('#calendar').fullCalendar({
	        // put your options and callbacks here
	        eventSources: [
			    {
			        // url:'/calendar/data',
			        // allDay:true,
			    },

			],
			selectable:true,
			selectMinDistance:2, 
			selectOverlap: false,
			eventLimit: true, // allow "more" link when too many events
			select: function( start, end, jsEvent, view){
				alert("from: "+moment(start).format("YYYY-MM-DD") + " to " + moment(end).format("YYYY-MM-DD") + " has been selected");
				$('#calendar').fullCalendar('unselect');
			},
			loading: function( isLoading, view){
				if(isLoading){
					$('#loadele').addClass("loading");
				}
				else{
					$('#loadele').removeClass("loading");	
				}
			},
			dayRender:function(date,cell){
				if(moment().diff(date,'days') > 0){
					cell.addClass('date-disabled-day');
				}
			},
			eventClick:function(event){
				var para={};
				para['id'] = event.id;
				var url = event.url+'?'+$.param(para);
				window.location.href(url);
			}
			
	    });
	});


	function doload(){
		var checkboxs = $('#houseslistdiv').find("input[type='checkbox']");
		for(var i = 0 ; i < checkboxs.length;++i){
			eventSourceToggle(checkboxs[i]);
		}

	}
	function importTodatabase(){
		$('#loadele').addClass("loading");
		$.ajax({
			url:"/calendar/import",
			type:"GET",
			datatype:'json',
			success: function(data){
				$('#loadele').removeClass("loading");	
			},
			error:function(){
				alert('failed');
				$('#loadele').removeClass("loading");	
			}
		});
	}
	
	function clearall(){
		var ele = $('#houseslistdiv').find('input');
		for(var i=0;i<ele.length;++i){
			$(ele[i]).prop('checked', false);
			eventSourceToggle(ele[i]);
		}
	}

	function createEvents(){
		eventsources = [];
		var ele = $('#houseslistdiv').find('input');
		var date = new Date();
	    var d = date.getDate();
	    var m = date.getMonth();
	    var y = date.getFullYear();
		for(var i=0;i<ele.length;++i){
			var source = new Object();
			source.url = '/houseavailability/'+$(ele[i]).val();
			eventsource.push(source);
		}

	}

	function eventSourceToggle(checkbox){
		var colorbox = $(checkbox).siblings("input");
		var color = colorbox.val();
		var htmlurl = '/houseavailability/'+$(checkbox).val();
		if(checkbox.checked==true){
			$('#calendar').fullCalendar( 'addEventSource', {url:htmlurl,allDay:true,color:color});
		}
		else{
			$('#calendar').fullCalendar( 'removeEventSource', {url:htmlurl});
		}
	}

	function colorchange(ele){
		var checkbox = $(ele).siblings("input[type='checkbox']");
		var color = $(ele).val();
		if(checkbox[0].checked==true){
			var htmlurl = '/houseavailability/'+$(checkbox).val();
			$('#calendar').fullCalendar( 'removeEventSource', {url:htmlurl});
			$('#calendar').fullCalendar( 'addEventSource', {url:htmlurl,allDay:true,color:color});
		}
	}
</script>
@endsection