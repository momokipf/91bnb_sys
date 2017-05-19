
function modifyRow(rowNum, rootPath){
	bootbox.dialog({
			message: 'Do you really want to modify?',
			title: 'Modify Confirmation',
			buttons: {
			success: {
				label: 'Yes',
				className: 'btn-success',
				callback: function() {
					//convert date here!
					 function convertToMysqlDate(d) {
				        var res = d.substring(6, 10);
				        res += "-";
				        res += d.substring(0, 2);
				        res += "-";
				        res += d.substring(3, 5);
				        return res;
				      }
					var repName = document.getElementById("repName"+rowNum).value;
					var inquiryID = document.getElementById('inquiryID'+rowNum).innerHTML;
					inquiryID = inquiryID.substring(3);
					var inquiryDate = convertToMysqlDate(document.getElementById('inquiryDate'+rowNum).value);
				

					var inquirySource = document.getElementById('inquirySource'+rowNum).value;
					var otherInquirySource = document.getElementById('otherInquirySource'+rowNum).value;
					var purpose = document.getElementById('purpose'+rowNum).value;
					var purposeOther = document.getElementById('purposeOther'+rowNum).value;
					var checkInDate = convertToMysqlDate(document.getElementById('checkInDate'+rowNum).value);
					var checkOutDate = convertToMysqlDate(document.getElementById('checkOutDate'+rowNum).value);
					var country = document.getElementById('country'+rowNum).value;
					var hid = document.getElementById('hid'+rowNum).value;
					var state = document.getElementById('state'+rowNum).value;
					var city = document.getElementById('city'+rowNum).value;
					var cityOther = document.getElementById('cityOther'+rowNum).value;
					var rooms = document.getElementById('rooms'+rowNum).value;
					var share = document.getElementById('share'+rowNum).value;
					var houseType = document.getElementById('houseType'+rowNum).value;
					var otherHouseType = document.getElementById('otherHouseType'+rowNum).value;
					var room1Type = document.getElementById('room1Type'+rowNum).value;
					var room1TypeOther = document.getElementById('room1TypeOther'+rowNum).value;
					var room2Type = document.getElementById('room2Type'+rowNum).value;
					var room2TypeOther = document.getElementById('room2TypeOther'+rowNum).value;
					var room3Type = document.getElementById('room3Type'+rowNum).value;
					var room3TypeOther = document.getElementById('room3TypeOther'+rowNum).value;

					var numOfAdult = document.getElementById('numOfAdult'+rowNum).value;
					var numOfChildren = document.getElementById('numOfChildren'+rowNum).value;
					var childAge = document.getElementById('childAge'+rowNum).value;
					var pregnancy = document.getElementById('pregnancy'+rowNum).value;
					var budgetLower = document.getElementById('budgetLower'+rowNum).value;
					var budgetUpper = document.getElementById('budgetUpper'+rowNum).value;
					var budgetUnit = document.getElementById('budgetUnit'+rowNum).value;
					var pet = document.getElementById('pet'+rowNum).value;
					var petType = document.getElementById('petType'+rowNum).value;
					var specialNote = document.getElementById('specialNoteDetail'+rowNum).value;
					var inquirerID = document.getElementById('inquirerID'+rowNum).innerHTML;
					inquirerID = inquirerID.substring(3);
					var inquirerFirst = document.getElementById('inquirerFirst'+rowNum).value;
					var inquirerLast = document.getElementById('inquirerLast'+rowNum).value;
					var inquirerUsPhoneNumber = document.getElementById('inquirerUsPhoneNumber'+rowNum).value;
					//fix 0124
					//inquirerUsPhoneNumber = inquirerUsPhoneNumber.replace(/[^\d]/g, '');
					var inquirerPhoneCountry = document.getElementById('inquirerPhoneCountry'+rowNum).value;
					var inquirerPhoneNumber = document.getElementById('inquirerPhoneNumber'+rowNum).value;
					var inquirerEmail = document.getElementById('inquirerEmail'+rowNum).value;
					var inquirerTaobaoUserName = document.getElementById('inquirerTaobaoUserName'+rowNum).value;
					var inquirerWechatUserName = document.getElementById('inquirerWechatUserName'+rowNum).value;
					var inquirerWechatID = document.getElementById('inquirerWechatID'+rowNum).value;

					var inquiryPriorityLevel = document.getElementById('inquiryPriorityLevel'+rowNum).value;
					var status = document.getElementById('status'+rowNum).value;
					var reasonOfDecline = document.getElementById('reasonOfDecline'+rowNum).value;
					var note = document.getElementById('note'+rowNum).value;
					var comment = document.getElementById('commentdetail'+rowNum).value;
					// alert(rootPath);
					console.log(document.getElementById('inquiryDate'+rowNum).value );
					console.log(document.getElementById('checkInDate'+rowNum).value );
					if(checkInDate > checkOutDate){
						bootbox.dialog({
						message: 'Check-In Date must be earlier than Check-Out Date',
						title: 'Error in the Table',
						buttons: {
							success: {
							label: 'Ok',
							className: 'btn-danger',
							callback: function() {

								}
							}
						}
						});
					}
					else if(inquiryDate > checkInDate){
						bootbox.dialog({
						message: 'Inquiry Date must be earlier than Check-In Date',
						title: 'Error in the Table',
						buttons: {
							success: {
							label: 'Ok',
							className: 'btn-danger',
							callback: function() {

								}
							}
						}
						});
					}
					else{

						var xhttp = new XMLHttpRequest();

						xhttp.onreadystatechange = function(){
							if(xhttp.readyState == 4 && xhttp.status == 200) {
								console.log(xhttp.responseText);
								if(xhttp.responseText.indexOf('Updated successfully') > -1){
								bootbox.dialog({
								message: 'Successfully Modified',
								title: 'Modify Status',
								buttons: {
									success: {
									label: 'Ok',
									className: 'btn-success',
									callback: function() {
										location.reload();
									}
								}
							}
							});
						}else{
							bootbox.dialog({
							message: 'Unsuccessfully Modified',
							title: 'Modify Status',
							buttons: {
								success: {
								label: 'Ok',
								className: 'btn-danger',
								callback: function() {

								}
							}
						}
						});

						}

							}
						};

						//fix 0131
						//alert(rootPath);
						if(rootPath=="../"||rootPath=="./")
						{
							//alert("141");
						}else{
							//alert("undefined");
							rootPath="../";
						}
						//test 0131 fixrootpat?
						xhttp.open('POST', rootPath+'inquiry/modifyInquiry.php?repName='+repName+'&inquiryID='
						+inquiryID+'&inquiryDate='+inquiryDate+'&inquirySource='+inquirySource+
						'&otherInquirySource='+otherInquirySource+'&purpose='+purpose+'&purposeOther='+purposeOther+'&checkInDate='+checkInDate+
						'&checkOutDate='+checkOutDate+'&hid='+hid+'&country='+country+'&state='+state+'&city='+city+'&cityOther='+cityOther+
						'&rooms='+rooms+'&share='+share+'&houseType='+houseType+'&otherHouseType='+otherHouseType+
						'&room1Type='+room1Type+'&room1TypeOther='+room1TypeOther+'&room2Type='+room2Type+'&room2TypeOther='+room2TypeOther+
						'&room3Type='+room3Type+'&room3TypeOther='+room3TypeOther+'&numOfAdult='+numOfAdult+'&numOfChildren='+numOfChildren+
						'&childAge='+childAge+'&pregnancy='+pregnancy+'&budgetLower='+budgetLower+
						'&budgetUpper='+budgetUpper+'&budgetUnit='+budgetUnit+'&pet='+pet+'&petType='+petType+'&specialNote='+specialNote+'&inquirerID='+inquirerID+'&inquirerFirst='
						+inquirerFirst+'&inquirerLast='+inquirerLast+'&inquirerUsPhoneNumber='+inquirerUsPhoneNumber+'&inquirerPhoneCountry='+inquirerPhoneCountry+
						'&inquirerPhoneNumber='+inquirerPhoneNumber+'&inquirerEmail='+inquirerEmail+
						'&inquirerTaobaoUserName='+inquirerTaobaoUserName+'&inquirerWechatUserName='+
						inquirerWechatUserName+'&inquirerWechatID='+inquirerWechatID+'&inquiryPriorityLevel='
						+inquiryPriorityLevel+'&inquiryDate='+inquiryDate+'&status='+status+'&reasonOfDecline='
						+reasonOfDecline+'&note='+note+'&comment='+comment, true);
						xhttp.send();

					}

				}
			},
			danger: {
				label: 'No',
				className: 'btn-danger',
				callback: function() {

				}
			}
			}
	});

}

function data_to_option(data, selected){
	var len = data.length;
	var res = '';
	var selected = (selected+"").trim();
	for(var i=0;i<len;i++){
		data[i]=(data[i]+"").trim();
		if(data[i] == selected){
			res += "<option selected value='"+data[i]+"'>"+data[i]+"</option>";
		}else{
			res += "<option value='"+data[i]+"'>"+data[i]+"</option>";
		}
	}
	return res;
}

function addFollowUp(rowNum){
	document.getElementById('addFollowupForm').style.display = 'block';
	document.getElementById('followup').style.display = 'block';
	document.getElementById('inquiryID').value = document.getElementById('inquiryID'+rowNum).innerHTML;
}

function inquiry(res,rootPath){
	var len = res.length;
	var txt = "";
	var modal = "";
	function convertToWebDate(d) {
		if(d==''||d==undefined)
		{
			return "";
		}
        var res = d.substring(5, 7);
        res += "/";
        res += d.substring(8, 10);
        res += "/";
        res += d.substring(0, 4);
        return res;
     }
	for(var i=0;i<len;i++){
		txt += "<tr>";
		if(res[i]["today"] != null){
			var date = res[i]["today"]["date"].split(" ")[0];
			if(date > res[i]["checkIn"]){
				txt += "<td><i class=\"glyphicon glyphicon-time\" style=\"color:grey\"></i></td>";
			}else{
				txt += "<td><i class=\"glyphicon glyphicon-time\" style=\"color:green\"></i></td>";
			}
		}
		if(res[i]["priority"] >= 2&& res[i]["currUser"] != res[i]["repName"]){
			txt += "<td></td><td></td>";
		}else{
			txt += "<td><button type='button' class='btn btn-primary btn-sm' id='modify' onclick='modifyRow("+res[i]["rowNum"]+",\""+rootPath+"\")'><span class='glyphicon glyphicon-edit'></span> Modify</button></td>";
			txt += "<td><button type='button' class='btn btn-primary btn-sm' onclick='addFollowUp("+res[i]["rowNum"]+")'><span class='glyphicon glyphicon-plus'></span> Add Follow Up</button></td>";
		}
		txt += "<td><button type='button' class='btn btn-primary btn-sm' data-toggle=\"modal\" data-target='#myModal"+res[i]["rowNum"]+"'><span class='glyphicon glyphicon-eye-open'></span> Show All Follow Up</button></td>";
		txt += "<td><select class='repName' id='repName"+res[i]["rowNum"]+"'";
		if(res[i]["priority"] >  1)
				txt += "disabled='true' >"+data_to_option(res[i]["allRepName"],res[i]["repName"])+"</select></td>";
		else {
			  txt += ">"+data_to_option(res[i]["allRepName"],res[i]["repName"])+"</select></td>";
		}
		txt += "<td><div id='repID"+res[i]["rowNum"]+"'>"+res[i]['employeeID']+"</div></td>";
		txt += "<td><div id='inquiryID"+res[i]["rowNum"]+"'>IQ#"+res[i]["inquiryID"]+"</div></td>";
		txt += "<td><select class='inquiryPriorityLevel' id='inquiryPriorityLevel"+res[i]["rowNum"]+"'>"+data_to_option([1,2,3,4,5],res[i]["inquiryPriorityLevel"])+"</select>";
		if(res[i]['inquiryPriorityLevel'] == 1){
			txt += "&nbsp<font id='image"+res[i]["rowNum"]+"' color='red'><i class='fa fa-star' aria-hidden='true'></i></td>";
		}else if(res[i]['inquiryPriorityLevel'] == 2){
			txt += "&nbsp<font id='image"+res[i]["rowNum"]+"' color='orange'><i class='fa fa-star' aria-hidden='true'></i></td>";
		}else if(res[i]['inquiryPriorityLevel'] == 3){
			txt += "&nbsp<font id='image"+res[i]["rowNum"]+"' color='green'><i class='fa fa-star' aria-hidden='true'></i></td>";
		}else if(res[i]['inquiryPriorityLevel'] == 4){
			txt += "&nbsp<font id='image"+res[i]["rowNum"]+"' color='blue'><i class='fa fa-star' aria-hidden='true'></i></td>";
		}else{
			txt += "&nbsp<font id='image"+res[i]["rowNum"]+"' color='grey'><i class='fa fa-star' aria-hidden='true'></i></td>";
		}


		//--------------------------------------
		//test 0201
		var newInquiryDate=convertToWebDate(res[i]["inquiryDate"]);

		txt+="<td><input class='form-control input-sm fordate' type='search' id='inquiryDate"+res[i]["rowNum"]+"' name='inquiryDate"+res[i]["rowNum"]+"' value='"+newInquiryDate+"'/'>"+"</td>";
		// txt += "<td><input type='date' id='inquiryDate"+res[i]["rowNum"]+"' name='inquiryDate"+res[i]["rowNum"]+"' value='"+res[i]["inquiryDate"]+"'/></td>";
		txt += "<td><select class='inquirySource' id='inquirySource"+res[i]["rowNum"]+"'>"+data_to_option(res[i]["allInquirySource"],res[i]["inquirySource"])+"</select></td>";
		if(res[i]["inquirySource"] == "Other"){
			if(res[i]["inquirySourceOther"] != null){
				txt += "<td><input type='search' id='otherInquirySource"+res[i]["rowNum"]+"' value='"+res[i]["inquirySourceOther"]+"'></td>";
			}else{
				txt += "<td><input type='search' id='otherInquirySource"+res[i]["rowNum"]+"'></td>";
			}
		}else{
			if(res[i]["inquirySourceOther"] != null){
				txt += "<td><input type='search' id='otherInquirySource"+res[i]["rowNum"]+"' value='"+res[i]["inquirySourceOther"]+"' hidden></td>";
			}else{
				txt += "<td><input type='search' id='otherInquirySource"+res[i]["rowNum"]+"' hidden></td>";
			}
		}
		// if(res[i]['purpose'] == null){
		// 		txt += "<td><input type='search' id='purpose"+res[i]["rowNum"]+"' name='purpose"+res[i]["rowNum"]+"' ></td>";
		// }else{
		// 		txt += "<td><input type='search' id='purpose"+res[i]["rowNum"]+"' name='purpose"+res[i]["rowNum"]+"' value='"+res[i]['purpose']+"'></td>";
		// }
		txt += "<td><select class='purpose' id='purpose"+res[i]["rowNum"]+"'>"+data_to_option(res[i]["allPurpose"],res[i]["purpose"])+"</select></td>";
		if(res[i]["purpose"] == "Other"){
			if(res[i]["purposeOther"] != null){
				txt += "<td><input type='search' id='purposeOther"+res[i]["rowNum"]+"' value='"+res[i]["purposeOther"]+"'></td>";
			}else{
				txt += "<td><input type='search' id='purposeOther"+res[i]["rowNum"]+"'></td>";
			}
		}else{
			if(res[i]["purposeOther"] != null){
				txt += "<td><input type='search' id='purposeOther"+res[i]["rowNum"]+"' value='"+res[i]["purposeOther"]+"' hidden></td>";
			}else{
				txt += "<td><input type='search' id='purposeOther"+res[i]["rowNum"]+"' hidden></td>";
			}
		}
		//fix 0201
		var newCheckinDate=convertToWebDate(res[i]["checkIn"]);
		txt+="<td><input class='form-control input-sm fordate' type='search' id='checkInDate"+res[i]["rowNum"]+"' name='checkInDate"+res[i]["rowNum"]+"' value='"+newCheckinDate+"'/'>"+"</td>";
		var newCheckoutDate=convertToWebDate(res[i]["checkOut"]);
		txt+="<td><input class='form-control input-sm fordate' type='search' id='checkOutDate"+res[i]["rowNum"]+"' name='checkOutDate"+res[i]["rowNum"]+"' value='"+newCheckoutDate+"'/'>"+"</td>";
		
		// txt += "<td><input type='date' id='checkInDate"+res[i]["rowNum"]+"' name='checkInDate"+res[i]["rowNum"]+"' value='"+res[i]['checkIn']+"'/></td>";
		// txt += "<td><input type='date' id='checkOutDate"+res[i]["rowNum"]+"' name='checkOutDate"+res[i]["rowNum"]+"' value='"+res[i]['checkOut']+"'/></td>";
		if(res[i]['fullHouseID'] == null){
				txt += "<td><input type='search' id='hid"+res[i]["rowNum"]+"'  name='hid"+res[i]["rowNum"]+"' ></td>";
		}else{
				txt += "<td><input type='search' id='hid"+res[i]["rowNum"]+"'  name='hid"+res[i]["rowNum"]+"' value='"+res[i]['fullHouseID']+"'></td>";
		}
		txt += "<td><select class='country' id='country"+res[i]["rowNum"]+"'>"+data_to_option(res[i]["allCountry"],res[i]["country"])+"</select></td>";
		txt += "<td><select class='state' id='state"+res[i]["rowNum"]+"'>"+data_to_option(res[i]["allState"],res[i]["state"])+"</select></td>";
		txt += "<td><select class='city' id='city"+res[i]["rowNum"]+"'>"+data_to_option(res[i]["allCity"],res[i]["city"])+"</select></td>";
		//console.log(res[i]["city"]);
		if(res[i]['cityOther'] == null){
			txt += "<td><input type='search' id='cityOther"+res[i]["rowNum"]+"' name='cityOther"+res[i]["rowNum"]+"'></td>";
		}else{
			txt += "<td><input type='search' id='cityOther"+res[i]["rowNum"]+"' name='cityOther"+res[i]["rowNum"]+"' value='"+res[i]['cityOther']+"'></td>";
		}
		if(res[i]['rooms'] == null){
			txt += "<td><input type='search' id='rooms"+res[i]["rowNum"]+"' name='rooms"+res[i]["rowNum"]+"' size='6'></td>";
		}else{
			txt += "<td><input type='search' id='rooms"+res[i]["rowNum"]+"' name='rooms"+res[i]["rowNum"]+"' value='"+res[i]['rooms']+"' size='6'></td>";
		}
		txt += "<td><select class='share' id='share"+res[i]["rowNum"]+"'>";


		//fix 0124

		//alert(res[i]["share"]);
		if(res[i]["share"] == -1){
			txt += "<OPTION value =  0>Either</OPTION>";
			txt += "<OPTION value =  -1 selected>Share</OPTION>";
			txt += "<OPTION value = 1>Whole</OPTION>";
		}else if(res[i]["share"] == 1){
			txt += "<OPTION value =  0>Either</OPTION>";
			txt += "<OPTION value =  -1>Share</OPTION>";
			txt += "<OPTION value = 1 selected>Whole</OPTION>";
		}else{
			txt += "<OPTION value =  0 selected>Either</OPTION>";
			txt += "<OPTION value =  -1>Share</OPTION>";
			txt += "<OPTION value = 1>Whole</OPTION>";
		}
		// if(res[i]["share"] == 1){
		// 	txt += "<OPTION value =  0>Either</OPTION>";
		// 	txt += "<OPTION value =  1 selected>Share</OPTION>";
		// 	txt += "<OPTION value = -1>Whole</OPTION>";
		// }else if(res[i]["share"] == -1){
		// 	txt += "<OPTION value =  0>Either</OPTION>";
		// 	txt += "<OPTION value =  1>Share</OPTION>";
		// 	txt += "<OPTION value = -1 selected>Whole</OPTION>";
		// }else{
		// 	txt += "<OPTION value =  0 selected>Either</OPTION>";
		// 	txt += "<OPTION value =  1>Share</OPTION>";
		// 	txt += "<OPTION value = -1>Whole</OPTION>";
		// }
		txt +="</select></td>";
		txt += "<td><select class='houseType' id='houseType"+res[i]["rowNum"]+"'>"+data_to_option(res[i]["allHouseType"],res[i]["houseType"])+"</select></td>";
		if(res[i]["houseType"] != "Other"){
			if(res[i]["houseTypeOther"] != null){
				txt += "<td><input type='search' id='otherHouseType"+res[i]["rowNum"]+"' value='"+res[i]["houseTypeOther"]+"' hidden></td>";
			}else{
				txt += "<td><input type='search' id='otherHouseType"+res[i]["rowNum"]+"' hidden></td>";
			}
		}else{
			if(res[i]["houseTypeOther"] != null){
				txt += "<td><input type='search' id='otherHouseType"+res[i]["rowNum"]+"' value='"+res[i]["houseTypeOther"]+"'></td>";
			}else{
				txt += "<td><input type='search' id='otherHouseType"+res[i]["rowNum"]+"'></td>";
			}
		}

//-------------------------------------------------Room Type--------------------------------------------------//
		var room1Type = res[i]['room1Type'];
		var room1TypeOther = res[i]['room1TypeOther'];
		var room2Type = res[i]['room2Type'];
		var room2TypeOther= res[i]['room2TypeOther'];
		var room3Type = res[i]['room3Type'];
		var room3TypeOther = res[i]['room3TypeOther'];
		if(res[i]['share'] == -1){
			txt += "<td><select class='room1Type' id='room1Type"+res[i]["rowNum"]+"' hidden>";
			txt += data_to_option(res[i]["allRoomType"],res[i]["room1Type"])+"</select></td>";
			if(room1Type == 'Other'){
				if(room1TypeOther != null){
					txt += "<td><input type='search' id='room1TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room1TypeOther']+"' hidden></td>";
				}else{
					txt += "<td><input type='search' id='room1TypeOther"+res[i]["rowNum"]+"'  hidden></td>";
				}
			}else{
				if(room1TypeOther != null){
					txt += "<td><input type='search' id='room1TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room1TypeOther']+"' hidden></td>";
				}else{
					txt += "<td><input type='search' id='room1TypeOther"+res[i]["rowNum"]+"' hidden></td>";
				}
			}

			txt += "<td><select class='room2Type' id='room2Type"+res[i]["rowNum"]+"' hidden>";
			txt += data_to_option(res[i]["allRoomType"],res[i]["room2Type"])+"</select></td>";
			if(room2Type == 'Other'){
				if(room2TypeOther != null){
					txt += "<td><input type='search' id='room2TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room2TypeOther']+"' hidden></td>";
				}else{
					txt += "<td><input type='search' id='room2TypeOther"+res[i]["rowNum"]+"' hidden></td>";
				}
			}else{
				if(room2TypeOther != null){
					txt += "<td><input type='search' id='room2TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room2TypeOther']+"' hidden></td>";
				}else{
					txt += "<td><input type='search' id='room2TypeOther"+res[i]["rowNum"]+"' hidden></td>";
				}
			}

			txt += "<td><select class='room3Type' id='room3Type"+res[i]["rowNum"]+"' hidden>";
			txt += data_to_option(res[i]["allRoomType"],res[i]["room3Type"])+"</select></td>";
			if(room3Type == 'Other'){
				if(room3TypeOther != null){
					txt += "<td><input type='search' id='room3TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room3TypeOther']+"' hidden></td>";
				}else{
					txt += "<td><input type='search' id='room3TypeOther"+res[i]["rowNum"]+"' hidden></td>";
				}
			}else{
				if(room3TypeOther != null){
					txt += "<td><input type='search' id='room3TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room3TypeOther']+"' hidden></td>";
				}else{
					txt += "<td><input type='search' id='room3TypeOther"+res[i]["rowNum"]+"' hidden></td>";
				}
			}
		}

		else{
		txt += "<td><select class='room1Type' id='room1Type"+res[i]["rowNum"]+"'>";
		txt += data_to_option(res[i]["allRoomType"],res[i]["room1Type"])+"</select></td>";
		if(room1Type == 'Other'){
			if(room1TypeOther != null){
				txt += "<td><input type='search' id='room1TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room1TypeOther']+"'></td>";
			}else{
				txt += "<td><input type='search' id='room1TypeOther"+res[i]["rowNum"]+"'></td>";
			}
		}else{
			if(room1TypeOther != null){
				txt += "<td><input type='search' id='room1TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room1TypeOther']+"' hidden></td>";
			}else{
				txt += "<td><input type='search' id='room1TypeOther"+res[i]["rowNum"]+"' hidden></td>";
			}
		}

		txt += "<td><select class='room2Type' id='room2Type"+res[i]["rowNum"]+"'>";
		txt += data_to_option(res[i]["allRoomType"],res[i]["room2Type"])+"</select></td>";
		if(room2Type == 'Other'){
			if(room2TypeOther != null){
				txt += "<td><input type='search' id='room2TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room2TypeOther']+"'></td>";
			}else{
				txt += "<td><input type='search' id='room2TypeOther"+res[i]["rowNum"]+"'></td>";
			}
		}else{
			if(room2TypeOther != null){
				txt += "<td><input type='search' id='room2TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room2TypeOther']+"' hidden></td>";
			}else{
				txt += "<td><input type='search' id='room2TypeOther"+res[i]["rowNum"]+"' hidden></td>";
			}
		}

		txt += "<td><select class='room3Type' id='room3Type"+res[i]["rowNum"]+"'>";
		txt += data_to_option(res[i]["allRoomType"],res[i]["room3Type"])+"</select></td>";
		if(room3Type == 'Other'){
			if(room3TypeOther != null){
				txt += "<td><input type='search' id='room3TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room3TypeOther']+"'></td>";
			}else{
				txt += "<td><input type='search' id='room3TypeOther"+res[i]["rowNum"]+"' ></td>";
			}
		}else{
			if(room3TypeOther != null){
				txt += "<td><input type='search' id='room3TypeOther"+res[i]["rowNum"]+"'  value='"+res[i]['room3TypeOther']+"' hidden></td>";
			}else{
				txt += "<td><input type='search' id='room3TypeOther"+res[i]["rowNum"]+"' hidden></td>";
			}
		}
	}

		txt += "<td><input type='number' id='numOfAdult"+res[i]["rowNum"]+"' name='numOfAdult"+res[i]["rowNum"]+"' value='"+res[i]['numOfAdult']+"'></td>";
		txt += "<td><input type='number' id='numOfChildren"+res[i]["rowNum"]+"' name='numOfChildren"+res[i]["rowNum"]+"' value='"+res[i]['numOfChildren']+"'></td>";
		if(res[i]['childAge'] != null && res[i]['childAge'] != "null"){
			txt += "<td><input type='search' id='childAge"+res[i]["rowNum"]+"' name='childAge"+res[i]["rowNum"]+"' value='"+res[i]['childAge']+"'></td>";
		}else{
			txt += "<td><input type='search' id='childAge"+res[i]["rowNum"]+"' name='childAge"+res[i]["rowNum"]+"'></td>";
		}
		txt += "<td><select id='pregnancy"+res[i]["rowNum"]+"'>";
		if(res[i]["pregnancy"] == 1){
			txt += "<OPTION value =  0>N/A</OPTION>";
			txt += "<OPTION value =  1 selected>Yes</OPTION>";
			txt += "<OPTION value = -1>No</OPTION>";
		}else if(res[i]["pregnancy"] == -1){
			txt += "<OPTION value =  0>N/A</OPTION>";
			txt += "<OPTION value =  1>Yes</OPTION>";
			txt += "<OPTION value = -1 selected>No</OPTION>";
		}else{
			txt += "<OPTION value =  0>N/A</OPTION>";
			txt += "<OPTION value =  1>Yes</OPTION>";
			txt += "<OPTION value = -1>No</OPTION>";
		}
		txt += "</select></td>";
		txt += "<td><input type='search' id='budgetLower"+res[i]["rowNum"]+"' name='budgetLower"+res[i]["rowNum"]+"' value='"+res[i]['budgetLower']+"'/></td>";
		txt += "<td><input type='search' id='budgetUpper"+res[i]["rowNum"]+"' name='budgetUpper"+res[i]["rowNum"]+"' value='"+res[i]['budgetUpper']+"'/></td>";
		txt += "<td style='min-width:80px;'><select id='budgetUnit"+res[i]["rowNum"]+"'>";
		if(res[i]["budgetUnit"] == 1){
			txt += "<OPTION value = 1 selected>Per Month</OPTION>";
			txt += "<OPTION value = 0>Per Day</OPTION>";
		}else{
			txt += "<OPTION value = 1>Per Month</OPTION>";
			txt += "<OPTION value = 0 selected>Per Day</OPTION>";
		}
		txt += "</select></td>";
		txt += "<td style='min-width:80px;'><select class='pet' id='pet"+res[i]["rowNum"]+"'>";
		if(res[i]["pet"] == 1){
			txt += "<OPTION value =  0>N/A</OPTION>";
			txt += "<OPTION value =  1 selected>Yes</OPTION>";
			txt += "<OPTION value = -1>No</OPTION>";
		}else if(res[i]["pet"] == -1){
			txt += "<OPTION value =  0>N/A</OPTION>";
			txt += "<OPTION value =  1>Yes</OPTION>";
			txt += "<OPTION value = -1 selected>No</OPTION>";
		}else{
			txt += "<OPTION value =  0>N/A</OPTION>";
			txt += "<OPTION value =  1>Yes</OPTION>";
			txt += "<OPTION value = -1>No</OPTION>";
		}
		txt += "</select></td>";
		if(res[i]['pet'] != 1){
			if(res[i]['petType'] != null){
				txt += "<td><input type='search' id='petType"+res[i]["rowNum"]+"' value='"+res[i]['petType']+"' hidden></td>";
			}else{
				txt += "<td><input type='search' id='petType"+res[i]["rowNum"]+"' hidden></td>";
			}
		}else{
			if(res[i]['petType'] != null){
					txt += "<td><input type='search' id='petType"+res[i]["rowNum"]+"' value='"+res[i]['petType']+"'></td>";
			}else{
					txt += "<td><input type='search' id='petType"+res[i]["rowNum"]+"' ></td>";
			}
		}
		//txt += "<td><input type='search' id='specialNote"+res[i]["rowNum"]+"' name='specialNote"+res[i]["rowNum"]+"' value='"+res[i]['specialNote']+"'></td>";
		txt += "<td><button type='button' class='btn btn-primary btn-sm' data-toggle=\"modal\" data-target='#specialNote"+res[i]["rowNum"]+"'><span class='glyphicon glyphicon-edit'></span>Show/Add SpecialNote</button></td>";


		txt += "<td><span id='inquirerID"+res[i]["rowNum"]+"'>ER#"+res[i]['inquirerID']+"</span></td>";
		txt += "<td><input type='search' id='inquirerFirst"+res[i]["rowNum"]+"' value='"+res[i]['inquirerFirst']+"'></td>";
		txt += "<td><input type='search' id='inquirerLast"+res[i]["rowNum"]+"' value='"+res[i]['inquirerLast']+"'></td>";
		if(res[i]['inquirerUsPhoneNumber'] != null){
			var USphone = res[i]['inquirerUsPhoneNumber'];
			txt += "<td><input type='search' class='inquirerUsPhoneNumber' id='inquirerUsPhoneNumber"+res[i]["rowNum"]+"' value='"+USphone+"'></td>";
		}else{
			txt += "<td><input class='bfh-phone' type='search' class='inquirerUsPhoneNumber' id='inquirerUsPhoneNumber"+res[i]["rowNum"]+"'></td>";
		}

		txt += "<td><select class='form-control' id='inquirerPhoneCountry"+res[i]["rowNum"]+"'>"+data_to_option(res[i]["phoneCountryCode"],res[i]["inquirerPhoneCountry"])+"</select></td>";
		if(res[i]['inquirerPhoneNumber'] != null && res[i]['inquirerPhoneNumber'] != "null"){
			txt += "<td><input type='search' id='inquirerPhoneNumber"+res[i]["rowNum"]+"' value='"+res[i]['inquirerPhoneNumber']+"'></td>";
		}else{
			txt += "<td><input type='search' id='inquirerPhoneNumber"+res[i]["rowNum"]+"'></td>";
		}
		txt += "<td><input type='search' id='inquirerEmail"+res[i]["rowNum"]+"' value='"+res[i]['inquirerEmail']+"'></td>";
		txt += "<td><input type='search' id='inquirerTaobaoUserName"+res[i]["rowNum"]+"' value='"+res[i]['inquirerTaobaoUserName']+"'></td>";
		txt += "<td><input type='search' id='inquirerWechatUserName"+res[i]["rowNum"]+"' value='"+res[i]['inquirerWechatUserName']+"'></td>";
		txt += "<td><input type='search' id='inquirerWechatID"+res[i]["rowNum"]+"' value='"+res[i]['inquirerWechatID']+"'></td>";
		txt += "<td><select class='form-control status' id='status"+res[i]["rowNum"]+"'>"+data_to_option(res[i]["statusList"],res[i]["status"])+"</select></td>";
		if(res[i]["status"] != 'Declined'){
			txt += "<td><select class='reasonOfDecline' id='reasonOfDecline"+res[i]["rowNum"]+"' hidden>"+data_to_option(res[i]["declineReasonList"],res[i]["reasonOfDecline"])+"</select></td>";
			if(res[i]['note'] != null){
				txt += "<td><select id='note"+res[i]["rowNum"]+"' hidden><option value='"+res[i]['note']+"' selected>"+res[i]['note']+"</option></select></td>";
			}else{
				txt += "<td><select id='note"+res[i]["rowNum"]+"' hidden><option value='"+res[i]['note']+"' selected></option></select></td>";
			}
		}else{
			txt += "<td><select class='reasonOfDecline' id='reasonOfDecline"+res[i]["rowNum"]+"'>"+data_to_option(res[i]["declineReasonList"],res[i]["reasonOfDecline"])+"</select></td>";
			if(res[i]['note'] != null){
				txt += "<td><select id='note"+res[i]["rowNum"]+"'><option value='"+res[i]['note']+"' selected>"+res[i]['note']+"</option></select></td>";
			}else{
				txt += "<td><select id='note"+res[i]["rowNum"]+"'><option value='"+res[i]['note']+"' selected></option></select></td>";
			}
		}
		txt += "<td><button type='button' class='btn btn-primary btn-sm' data-toggle=\"modal\" data-target='#comment"+res[i]["rowNum"]+"'><span class='glyphicon glyphicon-edit'></span>Show/Add Comment</button></td>";
		txt += "</tr>";
//---------------------------followUp Modal---------------------------------------//
		modal += "<div class='modal fade' id='myModal"+res[i]["rowNum"]+"' style='text-align:center;' role='dialog'>";
		modal +=  "<div class=\"modal-dialog modal-md\">";
		modal +=  "<div class=\"modal-content\">";
		modal +=  "<div class=\"modal-header\">";
		modal +=  "<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
		modal +=  "<h4 class=\"modal-title\"><p>Inquiry Follow Up History of Customer: "+res[i]['inquirerFirst']+" "+res[i]['inquirerLast']+"</p><p>(Inquiry ID: IQ#"+res[i]['inquiryID']+")</p></h4></div>";
		modal +=  "<div class=\"modal-body\">";
		if(res[i]["followUp"] == "No Prior Follow Up Information" || res[i]["followUp"] == null){
			modal += "<p>No Prior Follow Up Information</p>";
		}else{
			var followUp = res[i]["followUp"];
			var length = followUp.length;
			for(var j=0;j<length;j++){
				var datearray = followUp[j]["followupDate"].split("-");
				var followdate = datearray[1]+"/"+datearray[2]+"/"+datearray[0];
				modal += "<div class=\"panel panel-default\"><div class=\"panel-heading\">Follow Up "+followUp[j]["followupID"]+
				"</div><ul class=\"list-group\">"+"<li class=\"list-group-item\">Follow Up Date:  "+followdate+"</li>";
				if(followUp[j]["followupStatus"] != null){
					modal += "<li class=\"list-group-item\">Follow Up Status:  "+followUp[j]["followupStatus"]+"</li></ul></div>";
				}else{
					modal += "<li class=\"list-group-item\">Follow Up Status: </li></ul></div>";
				}
			}

		}
		modal +=  "</div>";
		modal +=  "<div class=\"modal-footer\">";
		modal +=  "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
		modal +=  "</div></div></div></div>";

		//-------------------------------modal for add comment--------------------------------//
		modal += "<div class='modal fade' id='comment"+res[i]["rowNum"]+"' style='text-align:center;' role='dialog'>";
		modal += "<div class=\"modal-dialog modal-md\">";
		modal += "<div class=\"modal-content\">";
		modal += "<div class=\"modal-header\">";
		modal += "<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
		modal += "<h4 class=\"modal-title\"><p>Add Comment</p></h4></div>";
		modal += "<div class=\"modal-body\">";
		if(res[i]['comment'] != null){
			modal += "<textarea rows='4' cols='50' id='commentdetail"+res[i]["rowNum"]+"' >"+res[i]['comment']+"</textarea>";
		}else{
			modal += "<textarea rows='4' cols='50' id='commentdetail"+res[i]["rowNum"]+"' ></textarea>";
		}
		modal += "</div>";
		modal += "<div class=\"modal-footer\">";
		modal += "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"document.getElementById('commentdetail"+res[i]["rowNum"]+"').value = '';\">Clear Comment</button>";
		modal += "<button type=\"button\" class=\"btn btn-success btn-sm\" data-dismiss=\"modal\">Add Comment</button>";
		modal += "</div></div></div></div>";

		//-------------------------------modal for special note--------------------------------//
		modal += "<div class='modal fade' id='specialNote"+res[i]["rowNum"]+"' style='text-align:center;' role='dialog'>";
		modal += "<div class=\"modal-dialog modal-md\">";
		modal += "<div class=\"modal-content\">";
		modal += "<div class=\"modal-header\">";
		modal += "<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
		modal += "<h4 class=\"modal-title\"><p>Add Special Note</p></h4></div>";
		modal += "<div class=\"modal-body\">";
		if(res[i]['specialNote'] != null){
			modal += "<textarea rows='4' cols='50' id='specialNoteDetail"+res[i]["rowNum"]+"' >"+res[i]['specialNote']+"</textarea>";
		}else{
			modal += "<textarea rows='4' cols='50' id='specialNoteDetail"+res[i]["rowNum"]+"' ></textarea>";
		}
		modal += "</div>";
		modal += "<div class=\"modal-footer\">";
		modal += "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"document.getElementById('specialNoteDetail"+res[i]["rowNum"]+"').value = '';\">Clear Special Note</button>";
		modal += "<button type=\"button\" class=\"btn btn-success btn-sm\" data-dismiss=\"modal\">Add Special Note</button>";
		modal += "</div></div></div></div>";
	}

	var results = [txt, modal];
	return results;

}

function methods(res, rootPath){
	$(document).ready(function(){
		$('.inquirerUsPhoneNumber').mask("(999)999-9999");
	});

	$(document).ready(function(){
		 $('.fordate').datepicker({
          dateFormat: "mm/dd/yy"
        });
	});

	$(document).ready(function(){
			$('.inquirySource').change(function(){
					var inquirySource = $(this).val();
					var id = $(this).attr('id');
					var index = id.search(/\d/);
					var rowNum = id.substring(index);
					if(inquirySource != 'Other'){
						document.getElementById('otherInquirySource'+rowNum).value = '';
						document.getElementById('otherInquirySource'+rowNum).style.display='none';
					}else{
						document.getElementById('otherInquirySource'+rowNum).style.display='block';
					}
				});
		});

		$(document).ready(function(){
				$('.purpose').change(function(){
						var purpose = $(this).val();
						var id = $(this).attr('id');
						var index = id.search(/\d/);
						var rowNum = id.substring(index);
						if( purpose != 'Other'){
							document.getElementById('purposeOther'+rowNum).value = '';
							document.getElementById('purposeOther'+rowNum).style.display='none';
						}else{
							document.getElementById('purposeOther'+rowNum).style.display='block';
						}
					});
			});

		$(document).ready(function(){
				$('.houseType').change(function(){
						var houseType = $(this).val();
						var id = $(this).attr('id');
						var index = id.search(/\d/);
						var rowNum = id.substring(index);
						if( houseType != 'Other'){
							document.getElementById('otherHouseType'+rowNum).value = '';
							document.getElementById('otherHouseType'+rowNum).style.display='none';
						}else{
							document.getElementById('otherHouseType'+rowNum).style.display='block';
						}
					});
			});

			$(document).ready(function(){
					$('.room1Type').change(function(){
							var room1Type = $(this).val();
							var id = $(this).attr('id');
							var len = "room1Type".length;
							var rowNum = id.substring(len);
							console.log(rowNum);
							if( room1Type != 'Other'){
								document.getElementById('room1TypeOther'+rowNum).value = '';
								document.getElementById('room1TypeOther'+rowNum).style.display='none';
							}else{
								document.getElementById('room1TypeOther'+rowNum).style.display='block';
							}
						});
				});

				$(document).ready(function(){
						$('.room2Type').change(function(){
								var room2Type = $(this).val();
								var id = $(this).attr('id');
								var len = "room2Type".length;
								var rowNum = id.substring(len);
								if( room2Type != 'Other'){
									document.getElementById('room2TypeOther'+rowNum).value = '';
									document.getElementById('room2TypeOther'+rowNum).style.display='none';
								}else{
									document.getElementById('room2TypeOther'+rowNum).style.display='block';
								}
							});
					});

					$(document).ready(function(){
							$('.room3Type').change(function(){
									var room3Type = $(this).val();
									var id = $(this).attr('id');
									var len = "room3Type".length;
									var rowNum = id.substring(len);
									if( room3Type != 'Other'){
										document.getElementById('room3TypeOther'+rowNum).value = '';
										document.getElementById('room3TypeOther'+rowNum).style.display='none';
									}else{
										document.getElementById('room3TypeOther'+rowNum).style.display='block';
									}
								});
						});

						$(document).ready(function(){
										$('.share').change(function(){
										var share = $(this).val();
										var id = $(this).attr('id');
										var index = id.search(/\d/);
										var rowNum = id.substring(index);
										if( share != -1){
										document.getElementById('room1Type'+rowNum).style.display = 'inline';
										document.getElementById('room2Type'+rowNum).style.display = 'inline';
										document.getElementById('room3Type'+rowNum).style.display = 'inline';
										if(document.getElementById('room1Type'+rowNum).value == 'Other'){
											document.getElementById('room1TypeOther'+rowNum).style.display = 'inline';
										}else{
											document.getElementById('room1TypeOther'+rowNum).style.display = 'none';
										}
										if(document.getElementById('room2Type'+rowNum).value == 'Other'){
											document.getElementById('room2TypeOther'+rowNum).style.display = 'inline';
										}else{
												document.getElementById('room2TypeOther'+rowNum).style.display = 'none';
										}
										if(document.getElementById('room3Type'+rowNum).value == 'Other'){
											document.getElementById('room3TypeOther'+rowNum).style.display = 'inline';
										}else{
												document.getElementById('room3TypeOther'+rowNum).style.display = 'none';
										}

										}else{
											document.getElementById('room1Type'+rowNum).style.display = 'none';
											document.getElementById('room2Type'+rowNum).style.display = 'none';
											document.getElementById('room3Type'+rowNum).style.display = 'none';
											document.getElementById('room1TypeOther'+rowNum).style.display = 'none';
											document.getElementById('room2TypeOther'+rowNum).style.display = 'none';
											document.getElementById('room3TypeOther'+rowNum).style.display = 'none';
										}
								});
						});

						$(document).ready(function(){
								$('.pet').change(function(){
										var havePet = $(this).val();
										var id = $(this).attr('id');
										var index = id.search(/\d/);
										var rowNum = id.substring(index);
										if(havePet != 1){
											document.getElementById('petType'+rowNum).value = '';
											document.getElementById('petType'+rowNum).style.display='none';
										}else{
											document.getElementById('petType'+rowNum).style.display='block';
										}
									});
							});

							$(document).ready(function(){
									$('.country').change(function(){
											var country = $(this).val().replace(/\s/g, '');
											var id = $(this).attr('id');
											var index = id.search(/\d/);
											var rowNum = id.substring(index);
											$('#state'+rowNum).load(rootPath+'list/Country_State_Option/' + country.trim() + '_StateListOption');
									});
							});

							$(document).ready(function(){
									$('.state').change(function(){
											var state = $(this).val().replace(/\s/g, '');
											var id = $(this).attr('id');
											var index = id.search(/\d/);
											var rowNum = id.substring(index);
											$('#city'+rowNum).load(rootPath+'list/State_City_Option/' + state + 'CityListOption');
									});
							});

							$(document).ready(function(){
									$('.status').change(function(){
											var status = $(this).val();
											var id = $(this).attr('id');
											var index = id.search(/\d/);
											var rowNum = id.substring(index);
											if(status != "Declined"){
												document.getElementById('reasonOfDecline'+rowNum).style.display='none';
												document.getElementById('note'+rowNum).style.display='none';
											}else{
												document.getElementById('reasonOfDecline'+rowNum).style.display='inline';
												document.getElementById('note'+rowNum).style.display='inline';
											}
										});
								});

								$(document).ready(function(){
									$('.reasonOfDecline').change(function(){
										var id = $(this).attr('id');
										var index = id.search(/\d/);
										var rowNum = id.substring(index);
										switch($(this).val()){
											case 'Guest - Change of plan':
												$('#note'+rowNum).css('display','inline');
												$('#note'+rowNum).load(rootPath+'list/reasonOfDecNote/Guest_Change_Of_Plan');
												break;
											case 'Guest - Conflict':
												$('#note'+rowNum).css('display','inline');
												$('#note'+rowNum).load(rootPath+'list/reasonOfDecNote/Guest_Conflict');
												break;
											case 'Owner - Not available':
												$('#note'+rowNum).css('display','inline');
												$('#note'+rowNum).load(rootPath+'list/reasonOfDecNote/Owner_Not_Available');
												break;
											case 'Owner - Puropose':
												$('#note'+rowNum).css('display','inline');
												$('#note'+rowNum).load(rootPath+'list/reasonOfDecNote/Owner_Purpose');
												break;
											default:
												$('#note'+rowNum).hide();
										}
									});
								});

					$(document).ready(function(){
						$('.repName').change(function(){
							var repName = $(this).val();
							var id = $(this).attr('id');
							var index = id.search(/\d/);
							var rowNum = id.substring(index);
							var allRepName = res[0]['allRepName'];
							var allEmployeeID = res[0]['allEmployeeID'];
							var Emp_ID = -1;
							for(var k=0; k < allRepName.length; k++){
								if(allRepName[k] == repName){
									 var Emp_ID = allEmployeeID[k];
									 break;
								}
							}
							$("#repID"+rowNum).html(Emp_ID);
						});
					});

					$(document).ready(function(){
							$('.inquiryPriorityLevel').change(function(){
								var id = $(this).attr('id');
								var index = id.search(/\d/);
								var rowNum = id.substring(index);
								switch($(this).val()){
									case '1':
										$('#image'+rowNum).attr("color",'red');
										break;
									case '2':
										$('#image'+rowNum).attr("color","orange");
										break;
									case '3':
										$('#image'+rowNum).attr("color","green");
										break;
									case '4':
										$('#image'+rowNum).attr("color","blue");
										break;
									default:
										$('#image'+rowNum).attr('color','grey');
								}
							});
						});
					}


		function mainPagination(pageName,rootPath){
			$('#btn1').click(function nextPage(){    // first page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							itemsEachPage : itemsEachPage,
							offset : 0
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = 1;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }
								 window.location = "#btn0";
							}
						}
					});
				});

			});




			$('#btn2').click(function nextPage(){    // previous page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				if(pagenum > 1){
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							itemsEachPage : itemsEachPage,
							offset : (pagenum-2)*itemsEachPage
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = (pagenum-'0')-1;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }
								 window.location = "#btn0";
							}
						}
					});
				});
			}
			});



			$('#btn3').click(function nextPage(){    // next page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';

				if(pagenum < page){
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							itemsEachPage : itemsEachPage,
							offset : pagenum*itemsEachPage
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = (pagenum-'0')+1;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }
								 window.location = "#btn0";
							}
						}
					});
				});
			}
			});


			$('#btn4').click(function nextPage(){    // last page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				alert("btn4 "+rootPath);
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							itemsEachPage : itemsEachPage,
							offset : itemsEachPage * (page - 1)
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = page;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }

							}
						}
					});
				});

			});

		}



		function inquirySearchPagination(pageName,rootPath){
			$('#btn1').click(function nextPage(){    // first page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							inquirerFirst : localStorage.getItem("inquirerFirst"),
							inquirerLast : localStorage.getItem("inquirerLast"),
							inquirerWechatID : localStorage.getItem("inquirerWechatID"),
							inquiryID : localStorage.getItem("inquiryID"),
							inquiryDate : localStorage.getItem("inquiryDate"),
							inquiryDateFrom : localStorage.getItem("inquiryDateFrom"),
							inquiryDateTo : localStorage.getItem("inquiryDateTo"),
							checkinDateFrom : localStorage.getItem("checkinDateFrom"),
							repName : localStorage.getItem("repName"),
							inquiryPriorityLevel : localStorage.getItem("inquiryPriorityLevel"),
							inquirycity : localStorage.getItem("inquirycity"),
							wechatname : localStorage.getItem("wechatname"),
							itemsEachPage : itemsEachPage,
							offset : 0
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = 1;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }
								 window.location = "#btn0";
							}
						}
					});
				});

			});




			$('#btn2').click(function nextPage(){    // previous page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				if(pagenum > 1){
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							inquirerFirst : localStorage.getItem("inquirerFirst"),
							inquirerLast : localStorage.getItem("inquirerLast"),
							inquirerWechatID : localStorage.getItem("inquirerWechatID"),
							inquiryID : localStorage.getItem("inquiryID"),
							inquiryDate : localStorage.getItem("inquiryDate"),
							inquiryDateFrom : localStorage.getItem("inquiryDateFrom"),
							inquiryDateTo : localStorage.getItem("inquiryDateTo"),
							checkinDateFrom : localStorage.getItem("checkinDateFrom"),
							repName : localStorage.getItem("repName"),
							inquiryPriorityLevel : localStorage.getItem("inquiryPriorityLevel"),
							inquirycity : localStorage.getItem("inquirycity"),
							wechatname : localStorage.getItem("wechatname"),
							itemsEachPage : itemsEachPage,
							offset : (pagenum-2)*itemsEachPage
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = (pagenum-'0')-1;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }
								 window.location = "#btn0";
							}
						}
					});
				});
			}
			});



			$('#btn3').click(function nextPage(){    // next page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				if(pagenum < page){
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							inquirerFirst : localStorage.getItem("inquirerFirst"),
							inquirerLast : localStorage.getItem("inquirerLast"),
							inquirerWechatID : localStorage.getItem("inquirerWechatID"),
							inquiryID : localStorage.getItem("inquiryID"),
							inquiryDate : localStorage.getItem("inquiryDate"),
							inquiryDateFrom : localStorage.getItem("inquiryDateFrom"),
							inquiryDateTo : localStorage.getItem("inquiryDateTo"),
							checkinDateFrom : localStorage.getItem("checkinDateFrom"),
							repName : localStorage.getItem("repName"),
							inquiryPriorityLevel : localStorage.getItem("inquiryPriorityLevel"),
							inquirycity : localStorage.getItem("inquirycity"),
							wechatname : localStorage.getItem("wechatname"),
							itemsEachPage : itemsEachPage,
							offset : pagenum*itemsEachPage
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = (pagenum-'0')+1;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }
								 window.location = "#btn0";
							}
						}
					});
				});
			}
			});


			$('#btn4').click(function nextPage(){    // last page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							inquirerFirst : localStorage.getItem("inquirerFirst"),
							inquirerLast : localStorage.getItem("inquirerLast"),
							inquirerWechatID : localStorage.getItem("inquirerWechatID"),
							inquiryID : localStorage.getItem("inquiryID"),
							inquiryDate : localStorage.getItem("inquiryDate"),
							inquiryDateFrom : localStorage.getItem("inquiryDateFrom"),
							inquiryDateTo : localStorage.getItem("inquiryDateTo"),
							checkinDateFrom : localStorage.getItem("checkinDateFrom"),
							repName : localStorage.getItem("repName"),
							inquiryPriorityLevel : localStorage.getItem("inquiryPriorityLevel"),
							inquirycity : localStorage.getItem("inquirycity"),
							wechatname : localStorage.getItem("wechatname"),
							itemsEachPage : itemsEachPage,
							offset : itemsEachPage * (page - 1)
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = page;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }
								 window.location = "#btn0";
							}
						}
					});
				});

			});

		}



		function passdueSearchPagination(pageName,rootPath){
			$('#btn1').click(function nextPage(){    // first page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							passdueDateFrom : localStorage.getItem("passdueDateFrom"),
							passdueDateTo : localStorage.getItem("passdueDateTo"),
							itemsEachPage : itemsEachPage,
							offset : 0
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = 1;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }

							}
						}
					});
				});

			});




			$('#btn2').click(function nextPage(){    // previous page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				if(pagenum > 1){
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							passdueDateFrom : localStorage.getItem("passdueDateFrom"),
							passdueDateTo : localStorage.getItem("passdueDateTo"),
							itemsEachPage : itemsEachPage,
							offset : (pagenum-2)*itemsEachPage
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = (pagenum-'0')-1;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }

							}
						}
					});
				});
			}
			});



			$('#btn3').click(function nextPage(){    // next page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				if(pagenum < page){
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							passdueDateFrom : localStorage.getItem("passdueDateFrom"),
							passdueDateTo : localStorage.getItem("passdueDateTo"),
							itemsEachPage : itemsEachPage,
							offset : pagenum*itemsEachPage
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = (pagenum-'0')+1;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }

							}
						}
					});
				});
			}
			});


			$('#btn4').click(function nextPage(){    // last page
				var username = ($("#username").html()).trim();
				var pagenum = document.getElementById('pagenum').innerHTML - '0';
				var itemsEachPage = document.getElementById('itemsEachPage').innerHTML - '0';
				var page = document.getElementById('page').innerHTML - '0';
				var items = document.getElementById('items').innerHTML - '0';
				$(function(){
					$.ajax({
						type: 'GET',
						url: rootPath+'dataSource/inquiryData.php',
						data: {
							pageName : pageName,
							username : username,
							passdueDateFrom : localStorage.getItem("passdueDateFrom"),
							passdueDateTo : localStorage.getItem("passdueDateTo"),
							itemsEachPage : itemsEachPage,
							offset : itemsEachPage * (page - 1)
						},
						success: function(data){
							if(data != 'No Results'){
								 document.getElementById('pagenum').innerHTML = page;
								 var res=JSON.parse(data);
								 var results = inquiry(res);
								 $("#mytable").html(results[0]);
								 $("#modal").html(results[1]);
								 if(res.length > 0){
									 methods(res,rootPath);
								 }

							}
						}
					});
				});

			});

		}
