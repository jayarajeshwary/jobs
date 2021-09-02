$( document ).ready(function() {
	console.log('READY');
	 
	 ///////////////////////////
	// Preloader
	$(window).on('load', function() {
		console.log("reloader");
		$("#preloader").delay(600).fadeOut();
	});
	
	$("#selloc").focus();
	$("#selloc").show();
	 //$('#selloc').attr('data-hidden', 'show');
	 
	 /*setTimeout(function() {
        $("#selloc").trigger('click');
		console.log('triggered');
    },1);*/
	function showalert(alertmsg)
	{
		$('#alertmsg1').show();
		$('#alertmsg1 #alertmsgspan').html(alertmsg);
		$('#alertmsg1').delay(2000).fadeOut('slow');
		//$("#txtscancode").val("");
		//$("#selloc").focus();
	}
	
	
	$('#btn_selloc_c').click(function(e) {
		e.preventDefault();
		console.log("BUTTON CANCEL");
		
		//$('#selloc option[value=0]').attr('selected','selected');
		//$('#selrole option[value=0]').attr('selected','selected');
		
		$("#selloc").val("0").change();
		$("#selrole").val("0").change();
        
    });

	$('#btn_selloc').click(function(e) {
		e.preventDefault();
		console.log("BUTTON SELECT");
		
		
		var value_loc;
		var value_rol;
		
		var txt_loc;
		var txt_rol;
		
		var $loc_opt = $("#selloc").find('option:selected');
		//Added with the EDIT
		value_loc = $loc_opt.val();//to get content of "value" attrib
		txt_loc = $loc_opt.text();//to get <option>Text</option> content
		
		if (value_loc==0)
		{
			console.log("return loc");
			//showalert("Select Location");
			
			swal({
                title: 'Location Not Selected!',
                text: 'please Select to Continue.',
                timer: 2000,
				allowOutsideClick: false
            }).then(
                function () {
                },
                // handling the promise rejection
                function (dismiss) {
                    if (dismiss === 'timer') {
                        console.log('closed by the timer')
                    }
                }
            )
			
			$("#selloc").focus();
			return false;			
		}
		
		var $rol_opt = $("#selrole").find('option:selected');
		//Added with the EDIT
		value_rol = $rol_opt.val();//to get content of "value" attrib
		txt_rol = $rol_opt.text();//to get <option>Text</option> content
		
		if (value_rol==0)
		{
			console.log("return role");
			//showalert("Select Role");
			swal({
                title: 'Role Not Selected!',
                text: 'please Select to Continue.',
                timer: 2000,
				allowOutsideClick: false
            }).then(
                function () {
                },
                // handling the promise rejection
                function (dismiss) {
                    if (dismiss === 'timer') {
                        console.log('closed by the timer')
                    }
                }
            )
			
			$("#selrole").focus();
			return false;			
		}
		
		
		
		var para_loc  = {"para_location": value_loc };
		var para_rol = {"para_role": value_rol };
		var para_txt_loc  = {"para_txt_location": txt_loc };
		var para_txt_rol = {"para_txt_role": txt_rol };
		data = $(this).serialize() + "&" + $.param(para_loc) + "&" + $.param(para_rol) + "&" + $.param(para_txt_loc) + "&" + $.param(para_txt_rol)  ;
		
		$.ajax({
									
			type : 'GET',
			url  : './sel_loc_ajax.php',
			data : data,
			beforeSend: function()
			{	
				//console.log("sending");
				//$("#preloader").delay(600).fadeOut();

				
				
			},
			success :  function(response)
			   {	
				//alert(response);
				//$("#ajax_dbname").html(response);
				console.log(response);
				if (response == "success")
				{
					console.log("value_rol"+value_rol);
					
					if (value_rol == "1")
						{ location.href = 'newtoken.php'; }			
					
					if (value_rol == "4")
						{ location.href = 'index.php'; }	
					
					if (value_rol == "2" || value_rol == "3")
						{ location.href = 'scanner.php'; }	
					
					if (value_rol == "5")
						{ location.href = 'entrystatus.php'; }						
					
				}
			  },
			error:function(exception,xhr)
				  {
				  console.log('Exeption:'+exception);
				  //alert(xhr.statusText);
				  }
			
			});	
		 
		
		//console.log($('#selloc option:selected').length);
		//console.log($('#selrole option:selected').length);
		
		//console.log($("#selloc").filter(":selected").val());
		//console.log($("#selrole").filter(":selected").val());
		
		/*
		if ($('#selloc option:selected').length == 0) 
		{ 
			console.log('location not selected'); 
			
		}
		
		if ($('#selrole option:selected').length == 0) 
		{ 
			console.log('role not  selected'); 
			
		}
		*/
    });
	
	 
	
});

