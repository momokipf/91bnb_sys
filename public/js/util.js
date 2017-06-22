function loadOpt()
{
		$.get("/resource/inquirySource",function(data,status){
					$('#inquirySource').empty();
					for(i=0;i<data.length;++i){
						var option = $("<option></option>").attr("value", data[i]).text(data[i]);
						$('#inquirySource').append(option);
					}

			});
		//loadList("inquirySource",$('#inquirySource'));
		// Load list 
		$.get("/resource/purposes",function(data,status){
				$('#Purpose').empty();
				for(i=0;i<data.length;++i){
					var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					$('#Purpose').append(option);
				}

		});
		$.get("/resource/countries",function(data,status){
				$('.country').empty();
				for(i=0;i<data.length;++i){
					var option = $("<option></option>").attr("value", data[i]).text(data[i]);
					$('.country').append(option);
				}

		});

		// $.get("/resource/roomTypes",function(data,status){
		// 		$('#room1Type').empty();
		// 		$('#room2Type').empty();
		// 		for(i=0;i<data.length;++i){
		// 			var option = $("<option></option>").attr("value", data[i]).text(data[i]);
		// 			$('#room1Type').append(option);
		// 			$('#room2Type').append("<option>" + data[i] + "</option>");
		// 		}

		// });

		$.get("/resource/houseTypes",function(data,status){
				$('#houseType').empty();
				for(i=0;i<data.length;++i){
					var option = $("<option></option>").attr("value", data[i]).text(data[i]);
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
})(jQuery);




