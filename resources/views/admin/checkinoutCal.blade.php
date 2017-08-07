@extends('navbar')
@section('title', 'Main Page')

@section('head')
<script type="text/javascript" src="{{asset('js/moment.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar.css')}}">
<script rel="stylesheet" type="text/javascript" src="{{asset('js/fullcalendar.min.js')}}"></script>
<style>

	.fc-unthemed td.fc-today {
	background: #fcf8e3;
	}

	.fc-event {
		font-size: .35em;
	}

	.date-disabled-day{
		 background-image: linear-gradient(to bottom right,  transparent calc(50% - 1px), red, transparent calc(50% + 1px));
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

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div id="calendar"></div>
		</div>
	</div>
	<div style="margin-top:50px;">
		<div style="margin:auto; text-align:center;">
			<button type="buton" class="btn btn-primary btn-sm" onclick="importTodatabase();">Import to system</button>
		</div>
	</div>
</div>


<div class="modal" id="loadele"></div>

@endsection

@section('script')
<script>

	$(document).ready(function() {
		$('#calendar').fullCalendar({
	        // put your options and callbacks here

	        eventSources: [
			    {
			        url:'/calendar/data',
			        allDay:true,
					// rendering: 'background',
					// color: '#FF0000'
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
				if(event.url){
					bootbox.dialog({
						message: event.url,
						title: "Infomation",
					});
				}
			}
			
	    });
	});


	function importTodatabase(){
		$.ajax({
			url:"/calendar/import",
			type:"GET",
			datatype:'json',
			succuss: function(data){
				alert('success');
				$('#loadele').removeClass("loading");	
			},
			error:function(){
				alert('failed');
				$('#loadele').removeClass("loading");	
			}
		});
		$('#loadele').addClass("loading");
	}
	
</script>
@endsection