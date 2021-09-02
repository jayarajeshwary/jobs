$( document ).ready(function() {
	//console.log('READY');
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

		
	$('#btnSave').click(function(e) {
		console.log("BUTTON CLICKED");
        e.preventDefault();
        //logmsg="Action Save Initiated   "; write_log("a_log",logmsg);
        save_selected();
    });

    


    function save_selected()
    {

    	var fname = $('#fname').val();
		var lname = $('#lname').val();
		var email = $('#email').val();
		var pword = $('#pword').val();
		var emp_id = $('#emp_id').val();
		var usr_adid = $('#usr_adid').val();
		var ldap_id = $('#ldap_id').val();


		if ($.trim(fname) == ''){
			  
			  showalert('First Name is mandatory','Fill First name');
			  $('#fname').focus();		  
			  return false;
		   } 
		   if ($.trim(lname) == ''){
			  showalert('Last Name is mandatory','Fill Last name');
			  $('#lname').focus();
			  return false;
		   }
		   if ($.trim(email) == ''){
			  showalert('Email Id is mandatory','Fill Email Id');
			  $('#email').focus();
			  return false;
		   } 
		  
		   if ($.trim(pword) == ''){
			  showalert('Password is mandatory','Fill Password');
			  $('#pword').focus();
			  return false;
		   } 
		    if ($.trim(emp_id) == ''){
			  showalert('Employee ID is mandatory','Fill Employee ID');
			  $('#emp_id').focus();
			  return false;
		   }
		   if ($.trim(usr_adid)=='') {
		   	showalert('ActiveDir ID is mandatory','Fill ActiveDir ID');
		   	$('#usr_adid').focus();
		   }
		   if ($.trim(ldap_id) == ''){
			  showalert('LDAP ID is mandatory','Fill LDAP ID');
			  $('#ldap_id').focus();
			  return false;
		   }

            

            var para_type = {"para_type": "user_config" };
            var para_fname = {"para_fname": fname };
			var para_lname = {"para_lname": lname};
			var para_email = {"para_email": email};
			var para_pword = {"para_pword": pword};
			var para_emp_id = {"para_emp_id": emp_id};
			var para_usr_adid = {"para_usr_adid": usr_adid};
			var para_ldap_id = {"para_ldap_id": ldap_id};

            var configdata = $.param(para_type) + "&" +  $.param(para_fname) + "&" + 
                            $.param(para_lname) + "&" + 
                            $.param(para_email) + "&" + 
                            $.param(para_pword) + "&" + 
                            $.param(para_emp_id) + "&" + 
                            $.param(para_usr_adid) + "&" + 
                            $.param(para_ldap_id) ;
            $.ajax({
                type: 'POST',dataType:'JSON', url: './opsajax/users_oper_add_edit.php', data: configdata,
                beforeSend: function(){	
                    //console.log('before send'); 
                },			
                success:function(response)
                {
                console.log(response);
                    if(response && response.status!="error")
                    {
                            if (response.res.includes("Duplicate"))
                                { showalert(3,response.res); } 
                            else
                            { showalert(1,response.res); fn_load_master(); cls_vals(); $("#tabList").trigger("click"); } 
                                
                    }
                    else
                    {
                        showalert(response.errmsg,response.errmsg);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log('ajax loading error...');
                    console.log(xhr);
                    console.log(errorThrown);
                    return false;
                }
            });	
                            
        }

      
	

		function clr()
		{
				$('#regno').val('');
				//$("#veh_type").val("0").change();
				//$("#purpose").val("0").change();
				$('#fname').val('');
				$('#lname').val('');
				$('#phone').val('');
		}	


});
