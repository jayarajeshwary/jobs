$(document).ready(function(){
    var  approle_id = $("#approle_id").val();
    var  approle_hierarchy = $("#approle_hierarchy").val();
    var  access_view = $("#access_view").val();
    var  access_insert = $("#access_insert").val();
    var  access_edit = $("#access_edit").val();
    var  access_delete = $("#access_delete").val();
    //console.log(access_view+"_"+access_insert+"_"+access_edit+"_"+access_delete); 
    
    //"use strict";	
        //console.log('app_cfg_zone.js');
        frmElement = $("#frmstar");
        msg_ele = $('#notif_msg');
        $('.chosen-select').chosen({width: "100%"});
        function showalertmsg(ele,msg)
        {	
        //$('html, body').animate({ scrollTop: $("#notif_msg").offset().top }, 600);	
        //ele.fadeIn('slow').append(msg).delay(700).hide(700);
        //setTimeout(function () { ele.html(''); }, 1500);	
        //success info warning error
            toastr.options = {
                closeButton:1,progressBar:1,showDuration:400,hideDuration:1000,timeOut:5000
            };
            if (ele == 1) { toastr.success('Success',msg); }
            else if (ele == 2) { toastr.info('Information',msg); }
            else if (ele == 3) { toastr.warning('Warning',msg); }
            else if (ele == 4) { toastr.error('Alert',msg); }
            else { toastr.info('Message',msg); }
        }
        
        fn_load_master();
        
        function fn_load_master()
        { 
        
            if ( $.fn.dataTable.isDataTable( '#datatable_master' ) ) 
            {
                    $('#datatable_master').dataTable().fnClearTable();
                    $('#datatable_master').dataTable().fnDestroy();
            }
             //configtype = {"configtype": "task_stage_config" }
             configtype = {"configtype": "concern_stage_config" }
            
             postData = $.param(configtype);
            $.ajax({
                url: "../opsajax/ops_config.php",
                beforeSend: function(){
            },
            type: "POST", dataType:'JSON', data : postData, 
            success: function(responseData)
            { 
                //console.log(responseData);
                 var json_resp = responseData;
                 var stat_code = responseData.stat; 
                 if(stat_code!="Success")
                 {
                     showalertmsg(4,"Error:"+responseData.errorMsg); 
                 }
                 else
                 {
                    loadTable(responseData.aaData); 
                 }
                 
               
            },
            complete: function()
            { },
            error: function(xhr, textStatus, errorThrown) {
                console.log('ajax loading error...');
                console.log(xhr);
                console.log(errorThrown);
                return false;
            }
            });
        }
        
        function loadTable(dt)
        {
            table=$('#datatable_master').DataTable( {
                select: true,
                pageLength: 25,
                responsive: true,
                "order": [[ 0, 'asc' ]],
                        data:dt,
            columns: [
            { data: "concern_id" 
            //, render: function ( data, type, row ) {
               // if  (type === "display" || type === "filter"){
                //    data = '<div class="i-checks taskstageidc"><label> <input type="radio" value="'+data+'" name="concern_id" id="'+data+'"> <i></i> '+data+' </label></div>';
              //  }
                //return data;
           // } 
            },
            { data: "concern_name"}, 
            { data: "concern_type"},
            { data: "concern_comment"},
            { data: "c_userkey"},
            { data: "created_date"}

           /* { data: "isactive" , render: function ( data, type, row ) {
                if  (type === "display" || type === "filter"){
                    if (data == "1") { data = "<div class='label label-success'>Yes</div>"; }
                    if (data == "0") { data = "<div class='label label-danger'>No</div>"; }
                }  
                return data;		
            } },*/

            /*{ data: "isvisible" , render: function ( data, type, row ) {
                if  (type === "display" || type === "filter"){
                    if (data == "1") { data = "<div class='label label-primary'>Yes</div>"; }
                    if (data == "0") { data = "<div class='label label-warning'>No</div>"; }
                }  
                return data;		
            }}*/

            ],
            dom: '<"html5buttons"B>lTfgitp',
            columnDefs: [ {className: "text-nowrap"} ],	
            buttons: [
                        {extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'AppDesignation'},
                        {extend: 'pdf', title: 'AppDesignation'},
                        {extend: 'print',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');
                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                        }
                        },
                        { text: 'Edit', action: function ( e, dt, node, config ) { edit_selected(); } },
                        { text: 'New', action: function ( e, dt, node, config ) { $("#tabAE").trigger("click");cls_vals(); } }
                        
                    ]
            } );
        }
        
        $('#btnSave').click(function(e) {
            e.preventDefault();
            logmsg="Action Save Initiated   "; write_log("a_log",logmsg);
            save_selected();
        });
        $('#edit').click(function(e) {
            e.preventDefault();
            logmsg="Action Edit Initiated   "; write_log("a_log",logmsg);
            edit_selected();
        });
        $('#btnClear').click(function(e) {
            e.preventDefault();
            logmsg="Action Clear Initiated   "; write_log("a_log",logmsg);
            cls_vals();
        });	
        $('#addnew').click(function(e) {
            e.preventDefault();
            logmsg="Action AddNew Initiated   "; write_log("a_log",logmsg);
            $("#tabAE").trigger("click");
            cls_vals();
        });	
        
        
        /*function edit_selected()
        {
            var collection=table.$("input:radio[name='task_stage_id']:checked", {"page": "all"});
            if(collection.length>0)
            {
                var d= table.row(table.$(table.$("input:radio[name='task_stage_id']:checked", {"page": "all"})).closest('tr') ).data();
                if(d)
                {
                    if(d.task_stage_id)
                        $('#ae_task_stage_id').val(d.task_stage_id);
                    if(d.task_stage_name)
                        $('#ae_task_stage_name').val(d.task_stage_name);
                    if(d.isactive)
                        $('#ae_sel_isactive').val(d.isactive).trigger('chosen:updated');
                    if(d.isvisible)
                        $('#ae_sel_isvisible').val(d.isvisible).trigger('chosen:updated');
                    $("#tabAE").trigger("click");
                }
            }
            else
            {
                 showalertmsg(2,"Select Task Stage ID"); 
                 return false; 
            }

           
        }

        
        function save_selected()
        {
            //console.log("saving data");
            var task_stage_id   = $('#ae_task_stage_id').val();
            //console.log(zone_id);
            logmsg="Action Save for   "+task_stage_id; write_log("a_log",logmsg);
            if ($.trim(task_stage_id) == ''){ task_stage_id=0; }
            if ( (parseInt(access_insert) == 0) && (task_stage_id==0) )
            {  showalertmsg(4,"No Permission to Add"); return false;  }	
            if ( (parseInt(access_edit) == 0) && (task_stage_id!=0) )
            {  showalertmsg(4,"No Permission to Update"); return false;  }		
            var task_stage_name = $('#ae_task_stage_name').val();
            var isactive  = $('#ae_sel_isactive').val();
            var isvisible = $('#ae_sel_isvisible').val();
            if ($.trim(task_stage_name) == ''){ 
                    //console.log("no Zone name");	
                      showalertmsg(2,"Enter Stage Name");
                      return false;
            }
            

            if ($.trim(isactive) == ''){ 
                    //console.log("no isactive");
                      showalertmsg(2,"Select Active or Not");
                      return false;
            }
            if ($.trim(isvisible) == ''){ 
                    //console.log("no isvisible");
                      showalertmsg(2,"Select Visible or Not");
                      return false;
            }
            para_type = {"para_type": "task_stage_config" };
           
            para_task_stage_id = {"para_task_stage_id": task_stage_id };
            para_task_stage_name = {"para_task_stage_name": task_stage_name };
            para_isactive = {"para_isactive": isactive };
            para_isvisible = {"para_isvisible": isvisible };
            var configdata = $.param(para_type) + "&" + 
                            $.param(para_task_stage_id) + "&" + 
                            $.param(para_task_stage_name) + "&" + 
                            $.param(para_isactive) + "&" + $.param(para_isvisible) ;
            $.ajax({
                type: 'POST',dataType:'JSON', url: '../opsajax/config_oper_add_edit.php', data: configdata,
                beforeSend: function(){	
                    //console.log('before send'); 
                },			
                success:function(response)
                {
                //console.log(response);
                    if(response && response.status!="error")
                    {
                            if (response.res.includes("Duplicate"))
                                { showalertmsg(3,response.res); } 
                            else
                            { showalertmsg(1,response.res); fn_load_master(); cls_vals(); $("#tabList").trigger("click"); } 
                                
                    }
                    else
                    {
                        showalertmsg(4,response.errmsg);
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
        
        
        function cls_vals()
        {
            $('#ae_task_stage_id').val("");
            $('#ae_task_stage_name').val("");
            $('#ae_sel_isactive').val("").trigger('chosen:updated');
            $('#ae_sel_isvisible').val("").trigger('chosen:updated');
        }
        $('#ae_task_stage_name').keypress(function (e) {
                var regex = new RegExp("^[a-zA-Z0-9- ]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
    
                e.preventDefault();
                return false;
            }).on('focusout', function (e) {  
                    var $this = $(this);  
                    $this.val($this.val().replace(/[^a-zA-Z0-9- ]/g, ''));  
                }).on('paste', function (e) {  
                    var $this = $(this);  
                    setTimeout(function () {  
                        $this.val($this.val().replace(/[^a-zA-Z0-9- ]/g, ''));  
                }, 5)});*/


              
        
    });	
