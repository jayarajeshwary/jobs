<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$page_name = "Add User";

include 'session_check.php';

$uniq_session_id = session_id();
$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');
include './init.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>GATE IO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!--Morris Chart CSS -->
		 <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap_lat.min.css" rel="stylesheet">
        <!-- Icons CSS -->
        <link href="assets/css/icons.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">

    </head>


    <body>

        <div id="page-wrapper">
            <!-- Top Bar Start -->
				<?php include 'topbar.php'; ?>
            <!-- Top Bar End -->
            <!-- Page content start -->
            <div class="page-contentbar">

                <!-- START PAGE CONTENT -->
                <div id="page-right-content">

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="header-title m-t-0 m-b-20">Add User</h4>
                            </div>
                        </div> <!-- end row -->
						
						
						<div class="row">
								<div id="alertmsg1" class="alert alert-danger alert-dismissible fade in" role="alert" style="display: none;"> <!--style="display: none;"-->
									<button type="button" class="close" data-dismiss="alert"
											aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<span id="alertmsgspan">
										
									</span>
                                </div>

                                <div class="row wrapper border-bottom white-bg page-heading">
			                       <div id="notif_msg" name="notif_msg" class="alert alert-danger alert-dismissable" style="display:none"></div>
                                </div>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
 		
                      <div class="row">
        
                       <form method="post" id="user" action="" class="form-horizontal" role="form">
                         <div class="col-md-6">
                                        
                                        <div class="form-group">
                                    <label class="col-md-2 control-label">First Name<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" name="fname" id="fname" class="form-control" value="" maxlength="40">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Last Name<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" name="lname" id="lname" class="form-control" value="" maxlength="40">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email">Email<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="email" value="" id="email" name="email" class="form-control" maxlength="40">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Password<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="password" name="pword" class="form-control" value="" id="pword" maxlength="40">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Employee ID<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value=""  name="emp_id" id="emp_id" maxlength="40">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">ActiveDir ID<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value=""  name="usr_adid" id="usr_adid" maxlength="40">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">LDAP ID<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="" name="ldap_id" id="ldap_id" maxlength="40">
                                    </div>
                                </div>
                                        
                         </div>

                         <div class="col-md-6">              
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Default Site<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="default_site_id">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Site Access<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <select multiple="" class="form-control" name = "site_ids[]">
                                            
                                        </select> 
                                         <div class="dropdown-mul-1">
									        <select style="display:none"  name="site_ids[]" id="" multiple placeholder="Select"> 
									          	
									        </select>
									      </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Default Role<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="default_approle_id">
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Roles<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                         <select multiple="" class="form-control" name = "approle_ids[]">
                                        
                                        </select> 
                                        <div class="dropdown-mul-2">
									        <select style="display:none"  name="approle_ids[]" id="" multiple placeholder="Select"> 
									          	
									        </select>
									      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label class="col-sm-3 control-label">Visible</label>
                                <div class="col-sm-9 checkbox checkbox-success checkbox-circle">
                                    <input id="checkbox-10" type="checkbox" name="isvisible" checked="">
                                    <label for="checkbox-10">
                                    </label>
                                </div>     
                                </div>

                                <div class="form-group">
                                <label class="col-sm-3 control-label">Active</label>
                                <div class="col-sm-9 checkbox checkbox-success checkbox-circle">
                                    <input id="checkbox-10" type="checkbox" name="isactive" checked="">
                                    <label for="checkbox-10">
                                    </label>
                                </div>     
                                </div>
                                
                                <div class="form-group row">
                                                <div class="col-sm-8">
                                                    <button id="btnSave" name="btnSave" class="btn btn-primary">Submit</button>                                                     
                                                    <button tabindex=4 id="btn_selloc_c" name="btn_selloc_c"  type="reset" class="btn btn-primary">
                                                        Clear
                                                    </button>
                                                </div>
                                </div>
                           </div>
</form>
                                </div>
                            </div> 
                        </div>
                        
								
                        



                    </div>
                    <!-- end container -->
                  

					
					<!-- Start footer -->
						<?php include 'footer.php'; ?>
					<!-- end footer -->

                </div>
                <!-- End #page-right-content -->

                <div class="clearfix"></div>

            </div>
            <!-- end .page-contentbar -->
        </div>
        <!-- End #page-wrapper -->



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/bootstrap_lat.min.js?v=1"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>

		
		 <!-- Sweet-Alert  -->
        <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert.init.js"></script>
		
		
        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>
		<script src="assets/js/user_app.js?v=3.5"></script>

    </body>
</html>
