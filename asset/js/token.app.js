$( document ).ready(function() {
	console.log('READY');
	$('#regno').focus();
 
		$('#regno').keypress(function (e) {
			var regex = new RegExp("^[a-zA-Z0-9]+$");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			if (regex.test(str)) {
				return true;
			}

			e.preventDefault();
			return false;
		});	
		
		/*
		$('#meterreading').keypress(function (e) {
			var regex = new RegExp("^[0-9]+$");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			if (regex.test(str)) {
				return true;
			}

			e.preventDefault();
			return false;
		});	
		*/

		$('#fname').keypress(function (e) {
			var regex = new RegExp("^[a-zA-Z]+$");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			if (regex.test(str)) {
				return true;
			}

			e.preventDefault();
			return false;
		});	
		
		$('#lname').keypress(function (e) {
			var regex = new RegExp("^[a-zA-Z]+$");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			if (regex.test(str)) {
				return true;
			}

			e.preventDefault();
			return false;
		});
		
		$('#phone').keypress(function (e) {
			var regex = new RegExp("^[0-9]+$");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			if (regex.test(str)) {
				return true;
			}

			e.preventDefault();
			return false;
		});	
			
	
	$('#btntokengen').click(function(e) {
		console.log("BUTTON CLICKED");
        e.preventDefault();
		var regno = $('#regno').val();
		//var meterreading = $('#meterreading').val();
		
		//var $vt_opt = $("#veh_type").find('option:selected');
		//var veh_val = $vt_opt.val();
		//var veh_type = $vt_opt.text();
		
		//var $purp_opt = $("#purpose").find('option:selected');
		//var purpose_val = $purp_opt.val();
		//var purpose = $purp_opt.text();
		
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var phone = $('#phone').val();
		
		//console.log(regno+"_"+fname+"_"+lname+"_"+phone+"_"+veh_val+"_"+purpose_val);
		
		 
		
		if ($.trim(regno) == ''){
			  //alert('Input can not be left blank');
			  showalert('Vehicle Reg No is mandatory','No Blank Allowed');
			  $('#regno').focus();
			  //$('#regno').addClass("highl").delay(2000).removeClass("highl");;
			  return false;
		   } //else { $('#regno').removeClass("highl");}
		
		/*
		if ($.trim(meterreading) == ''){
			  //alert('Input can not be left blank');
			  showalert('Vehicle OdoMeter Reading is mandatory');
			  $('#meterreading').focus();
			  //$('#regno').addClass("highl").delay(2000).removeClass("highl");;
			  return false;
		   } //else { $('#regno').removeClass("highl");}
		
		if (veh_val == "0")
		 {
			 showalert('Select Vehicle Type');
			  $('#veh_type').focus();
			  //$('#veh_type').addClass("highl");
			  return false;
		 }	//else { $('#veh_type').removeClass("highl");}
		if (purpose_val == "0")
		 {
			 showalert('Select Purpose');
			  $('#purpose').focus();
			  //$('#purpose').addClass("highl");
			  return false;
		 }	//else { $('#purpose').removeClass("highl");}
		 */
		if ($.trim(fname) == ''){
			  //alert('Input can not be left blank');
			  showalert('First Name is mandatory','Fill First name');
			  $('#fname').focus();
			  //$('#fname').addClass("highl");
			  return false;
		   } //else { $('#fname').removeClass("highl");}
		if ($.trim(phone) == ''){
			  //alert('Input can not be left blank');
			  showalert('Phone Number is mandatory','Fill Phone Number');
			  $('#phone').focus();
			  //$('#phone').addClass("highl");
			  return false;
		   } //else { $('#phone').removeClass("highl");}
		
		var para_regno = {"para_regno": regno };
		//var para_meterreading = {"para_meterreading": meterreading };
		//var para_veh_type = {"para_veh_type": veh_type };
		//var para_purpose = {"para_purpose": purpose };
		var para_fname = {"para_fname": fname };
		var para_lname = {"para_lname": lname };
		var para_phone = {"para_phone": phone };
		
		//console.log(regno+"-"+veh_type+"-"+purpose+"-"+fname+"-"+lname+"-"+phone);
		//var data = $(this).serialize() + "&" + $.param(para_regno) + "&" + $.param(para_meterreading) + "&" + $.param(para_veh_type) + "&" + $.param(para_purpose) + "&" + $.param(para_fname) + "&" + $.param(para_lname) + "&" + $.param(para_phone)  ;
		var data = $(this).serialize() + "&" + $.param(para_regno) + "&" + $.param(para_fname) + "&" + $.param(para_lname) + "&" + $.param(para_phone)  ;
		console.log(data);
		$.ajax({
									
			type : 'GET',
			url  : './gentoken.php',
			data : data,
			beforeSend: function()
			{	
				console.log("sending");
				$("#btntokengen").attr("disabled", true);
			},
			success :  function(response)
			   {	
				 console.log(response);
				 response = response.trim();
				 if(response != '' && response != null){
					//console.log('DUPOK'); 
					//console.log(response);
					if (response == "DUPLICATE")
					{
						//console.log('OK');
						showalert('VEH-REG-NUM DUPLICATE  NOT ALLOWED','Check Reg Number History'); 
					}
					else					
					{
						
						var resp = parseInt(response);
							if (resp > 0){
								showalert('Token Created : ', resp );clr();	
								location.href="printcsv.php?token_id="+resp; 
							}
							
					}		
				 }
				 
				if (response == "success")
				{
					
				}
			  },
			error:function(exception,xhr)
				  {
				  console.log('Exeption:'+exception);
				  console.log(xhr.statusText);
				  $('#btntokengen').attr("disabled", false);
				  //alert(xhr.statusText);
				  }
			,
			complete:function(){
				$('#btntokengen').attr("disabled", false);
			  }
			
			});	
    });

function clr()
{
		$('#regno').val('');
		//$("#veh_type").val("0").change();
		//$("#purpose").val("0").change();
		$('#fname').val('');
		$('#lname').val('');
		$('#phone').val('');
}	

function showalert(alertmsg1,alertmsg2)
	{
		$('#alertmsg1').show();
		$('#alertmsg1 #alertmsgspan').html(alertmsg1);
		$('#alertmsg1').delay(2000).fadeOut('slow');
		
		swal({
                title: alertmsg1,
                text: alertmsg2,
                timer: 2000,
				allowOutsideClick: false
            }).then(
                function () {
                },
                // handling the promise rejection
                function (dismiss) {
                    if (dismiss === 'timer') {
                        //console.log('closed by the timer')
                    }
                }
            )
		//$("#txtscancode").val("");
		//$("#txtscancode").focus();
	}	
});
