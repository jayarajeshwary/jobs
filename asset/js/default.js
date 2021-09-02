$(document).ready(function(){
 
var  approle_id = $("#approle_id").val();
var  approle_hierarchy = $("#approle_hierarchy").val();
var  access_view = $("#access_view").val();
var  access_insert = $("#access_insert").val();
var  access_edit = $("#access_edit").val();
var  access_delete = $("#access_delete").val();
//console.log(access_view+"_"+access_insert+"_"+access_edit+"_"+access_delete); 

	//console.warn('LOGIN READY');
	//$("#errorMsg").hide();
	//var error_ele = $('#errorMsg');
	
	login_uname = Math.random().toString(36).substring(2, 15);
	login_pword = Math.random().toString(36).substring(2, 15);
	btnLogin = Math.random().toString(36).substring(2, 15);
	//console.warn(login_uname);
	//console.warn(login_pword);
	$('#divctl1').append('<input tabindex=1 id='+login_uname+' name='+login_uname+' type="text" tabindex=1 class="form-control" placeholder="Username" maxlength="25" required>');
	$('#divctl2').append('<input tabindex=2 id='+login_pword+' name='+login_pword+' type="password" tabindex=2 class="form-control" placeholder="Password"  maxlength="15"  >');
	$('#divctl3').append('<input type="button" value="Login" id='+btnLogin+' name='+btnLogin+' tabindex=3 class="btn btn-lg btn-custom btn-block">');
	$('#'+login_uname).focus();

	
	$("input[type='text']").click(function () {
				$(this).select();
	});
	
	$("form input[type=text]").bind("keypress", function (e) {
		//39 = 34  for ' "
		if (e.charCode == 96 || e.charCode == 34 || e.charCode == 39)
			{ e.preventDefault(); return false; }
			return true;
	}); 
	
	$("form input[type=text]").bind('paste', function(e) {
		var data = e.originalEvent.clipboardData.getData('Text');
		//console.warn(data);
		e.preventDefault();
		$(this).val("");
		$(this).val(data.replace(/['"]/g,''));
	});

	$('#'+login_uname).keypress(function (e) {
			
			//console.warn(e.charCode);
			var regex = new RegExp("[^\'\"\`]+$");
			//var regex = new RegExp("^[a-zA-Z0-9~!@#$%\^&\*()\-_+=}{|;:,./<>\?]+$");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			//console.warn(e.charCode);
			if (e.charCode == 13)
			{ $('#'+login_uname).focus(); }
			 		
			if (regex.test(str)) {
				return true;
			}
			//e.preventDefault();
			return false;
		});
		
	 $('#'+login_pword).keypress(function (e) {
			 
			//console.warn(e.charCode);
			//var regex = new RegExp("^[a-zA-Z0-9,.@#$%^&*()~<>?/}{][|\+$");
			var regex = new RegExp("^[a-zA-Z0-9~!@#$%\^&\*()\-_+=}{|;:,./<>\?]+$");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			if (e.charCode == 13)
			{
				$('#'+btnLogin).click();
			}
			if (regex.test(str)) {
				return true;
			}
			//e.preventDefault();
			return false;
		});
		
		
	$('#'+btnLogin).on('click', function (e) {
		//alert("JP");
		var delay = 2000;var timeoutID;	
        //console.warn("login");
		$('#ibox1').children('.ibox-content').toggleClass('sk-loading');
		$('#'+btnLogin).val("Checking");
		
		//var url = "./main/default.php";
		//window.location.href = url;
		
		var uname=$('#'+login_uname).val();
		var pword=$('#'+login_pword).val();
		
		uname = uname.replace(/['"]/g,'');
		pword = pword.replace(/['"]/g,'');
		
		//console.warn(uname+"_"+pword);
		var logtok=$("#csrf_token").val();
		var star_token=$("#star_csrf_token").val();
		
		if ( uname.trim() =='' || pword.trim() =='' )
		{
			//console.warn("UserName or Password Cannot be Empty!");	
			
			//$("#errorMsg").show();$("#errorMsg").html("<h4 class='font-bold'>UserName or Password Cannot be Empty!</h4>");
			$('.custom-alert').fadeIn();
			$('#alertmsg').append("<span id='alertmsgcontent'>UserName or Pasword Cannot be Empty .. </span>" );
			timeoutID = setTimeout(function() {
									$('#'+btnLogin).val("Login");
									//$("#errorMsg").html("<h4 class='font-bold text-danger'>UserName or Password Cannot be Empty!</h4>");$("#errorMsg").hide();
									$('#'+login_uname).focus();
									$('.custom-alert').fadeOut();$('#alertmsgcontent').remove();
									$('#ibox1').children('.ibox-content').toggleClass('sk-loading');
							}, 2000);
							
			return false;
		}
		else
		{
			
			$.ajax({
			  url:'./blayer/check_authentication.php',
			  type:'POST',
			  data: {uname:uname, pword:pword, logtok:logtok,star_token:star_token},
			  beforeSend: function()
				{	
					//console.warn("Sending for Validating");
					$('#'+btnLogin).val("Validating");
					//$('#ibox1').children('.ibox-content').toggleClass('sk-loading');
				},
			  success: function(resp) {
			  	
				 //console.warn("Response : "+resp);
				 var json_resp = $.parseJSON( resp );

				 //console.warn(json_resp['status']);	
				 stat_code = json_resp['status']; 
				 ret_message = json_resp['message'];
				 //return false;
				 if (stat_code) {
					//console.warn("pass");
					//action = json_resp['action'];
					//active = json_resp['active'];
					//console.warn("next action : "+ action);

					/*if (active == 0)
					{
						$('.custom-alert').fadeIn();
						$('#alertmsg').append("<span id='alertmsgcontent'>Account is Not active , Contact Admin ..</span>" );
			
						timeoutID = setTimeout(function() {
							$('#ibox1').children('.ibox-content').toggleClass('sk-loading');
						 
						}, 2000);
						return false;
					}*/	

					//console.warn(json_resp['change_pword']);
					//return false;
					
					if (json_resp['change_pword'] == 1 )
					{
						//$("#errorMsg").show();$("#errorMsg").html("<h4 class='font-bold'>Mandatory password Reset!</h4>");
						$('.custom-alert').fadeIn();
						$('#alertmsg').append("<span id='alertmsgcontent'>Mandatory password Reset!</span>" );
			
						timeoutID = setTimeout(function() {
							$('#ibox1').children('.ibox-content').toggleClass('sk-loading');
						var url = "./main/reset_pword.php";window.location.href = url;
						}, 2000);	
						//console.warn("cp");
					}
					else
					{
						//$("#errorMsg").show();$("#errorMsg").html("<h4 class='font-bold'>" + ret_message + "</h4>");
						$('.custom-alert').fadeIn();
						$('#alertmsg').append("<span id='alertmsgcontent'>"+ret_message+"</span>" );
						timeoutID = setTimeout(function() {
							$('#ibox1').children('.ibox-content').toggleClass('sk-loading');
						var url = json_resp['navigateto'];window.location.href = url;
						}, 2000);
						//console.warn("ncp");
					}
						
				 } else {
					 //console.warn("fail");
					 
					//$("#errorMsg").show();$("#errorMsg").html("<h4 class='font-bold'>" + ret_message + "</h4>");
					$('.custom-alert').fadeIn();
					$('#alertmsg').append("<span id='alertmsgcontent'>"+ret_message+"</span>" );
						
					timeoutID = setTimeout(function() {
						$('#ibox1').children('.ibox-content').toggleClass('sk-loading');
						$('#'+btnLogin).val("Login");$('#'+login_uname).focus();
						//$("#errorMsg").hide();
						$('.custom-alert').fadeOut();$('#alertmsgcontent').remove();
					}, 2000);
					
				}
				 
			  },
			  complete: function() {
					//console.warn("complete");
					
				   //$('#ibox1').children('.ibox-content').toggleClass('sk-loading');
			  },
			  error: function(xhr, textStatus, errorThrown) {
				$('#ibox1').children('.ibox-content').toggleClass('sk-loading');  
				console.warn('ajax loading error...');
				console.warn(xhr.responseText);
				console.warn(errorThrown);
				return false;
				}
			 });
		}
	});
});
