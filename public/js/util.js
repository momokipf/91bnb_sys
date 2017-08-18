function loadOpt()
{
	$.get("/resource/inquirySource",function(data,status){
				$('#inquirySource').empty();
				for(i=0;i<data.length;++i){
					var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					if(typeof predataset !="undefined"&&predataset&&predataset['inquirySource']&&data[i]==predataset['inquirySource']){
						option[0].selected="true";
					}
					$('#inquirySource').append(option);
				}
		});
	//loadList("inquirySource",$('#inquirySource'));
	// Load list 
	$.get("/resource/purposes",function(data,status){
			$('.purpose').empty();
			for(i=0;i<data.length;++i){
				var option = $("<option></option>").attr("value", data[i]).text(data[i]);
				if(typeof predataset !="undefined"&&predataset&&predataset['purpose']&&data[i]==predataset['purpose']){
					option[0].selected="true";
				}
				$('.purpose').append(option);
			}

	});


	$('.country').load("/list/countryListOption");  
	$('.roomType').load("/list/roomTypeListOption",function(){
	});

	$('.reasonofDecline').load("/list/declineReasonList");

	$.get("/resource/houseTypes",function(data,status){
			$('#houseType').empty();
			for(i=0;i<data.length;++i){
				var option = $("<option></option>").attr("value", data[i]).text(data[i]);
				if(typeof predataset !="undefined"&&predataset&&predataset['houseType']&&data[i]==predataset['houseType']){
					option[0].selected="true";
				}
				$('#houseType').append(option);
			}

	});

	$.get("/resource/countryCode",function(data,status){
			$('.Phone').empty();
			for(i=0;i<data.length;++i){
				var option = $("<option></option>").attr("value", data[i]).text(data[i]);
				$('.Phone').append(option);
			}

	});
}

function bindhandler(){
	$('#houseType').change(function(){
		if($(this).val().trim()=="Other"){
			$('#houseTypeOtherDiv').show();
		}
		else{
			$('#houseTypeOtherDiv').hide();
			$('#houseTypeOther').val('');
		}
	});


	$('#inquirySource').change(function(){
		if($(this).val().trim()=="Other"){
			$('#inquirySourceOtherDiv').show();
		}
		else{
			$('#inquirySourceOtherDiv').hide();
			$('#inquirySourceOther').val('');//empty input
		}
	});

	$('#purpose').change(function(){
		if($(this).val().trim()=="Other"){
			$('#purposeOtherDiv').show();
		}
		else{
			$('#purposeOtherDiv').hide();
			$('#purposeOther').val('');
		}
	});
}


function getSearchParams(k){
 var p={};
 location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){p[k]=v})
 return k?p[k]:p;
}

function converttimetosql(str){
	if(str=="")
		return "";
	var d = new Date(str);
	return d.getFullYear()+"/"+('0' + (d.getMonth()+1)).slice(-2)+"/"+('0' + d.getDate()).slice(-2);
}


(function($) {
    $.fn.changeElementType = function(newType) {
        var attrs = {};

        $.each(this[0].attributes, function(idx, attr) {
            attrs[attr.nodeName] = attr.nodeValue;
        });

        var newelement = $("<" + newType + "/>", attrs).append($(this).contents());
    	this.replaceWith(newelement);
    		return newelement;
    }
    $.fn.animateCss = function(animationName){
    	var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        this.addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
})(jQuery);




