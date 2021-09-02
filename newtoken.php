<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$page_name = "NEWTOKEN";

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
                                <h4 class="header-title m-t-0 m-b-20">Generate Token</h4>
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
						</div>
								
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-horizontal"  >
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Veh Reg Number</label>
                                                <div class="col-md-10">
                                                    <input id="regno" name="regno" type="text" class="form-control" value="" maxlength="12">
                                                </div>
                                            </div>
											  <div class="form-group">
                                                <label class="col-md-2 control-label">First Name</label>
                                                <div class="col-md-10">
                                                    <input  id="fname" name="fname" type="text" class="form-control" value=""  maxlength="15">
                                                </div>
                                            </div>
											
											<div class="form-group">
                                                <label class="col-md-2 control-label">Last Name</label>
                                                <div class="col-md-10">
                                                    <input  id="lname" name="lname" type="text" class="form-control" value=""  maxlength="15">
                                                </div>
                                            </div>
											
											<div class="form-group">
                                                <label class="col-md-2 control-label">Phone</label>
                                                <div class="col-md-10">
                                                    <input  id="phone" name="phone" type="text" class="form-control" value=""  maxlength="10">
                                                  
                                                </div>
                                            </div>
											<!--
											<div class="form-group">
                                                <label class="col-md-2 control-label">OdoMeter Reading</label>
                                                <div class="col-md-10">
                                                    <input id="meterreading" name="meterreading" type="text" class="form-control" value="" maxlength="10">
                                                </div>
                                            </div>
											-->
											<!--<div class="form-group">
                                                <label class="col-sm-2 control-label">Vehicle Type</label>
                                                <div class="col-sm-10">
                                                    <select  id="veh_type" name="veh_type"  class="form-control">
													    <option value="0">SELECT</option>
                                                        <option value="1">TRUCK</option>
                                                        <option value="2">LORRY</option>
                                                        <option value="3">CONTAINER</option>
                                                        <option value="4">VAN</option>
                                                        <option value="5">MINIVAN</option>
														<option value="6">AUTO</option>
														<option value="7">OTHER</option>
                                                    </select>
                                                   
                                                </div>
                                            </div>-->
											
											<!--<div class="form-group">
                                                <label class="col-sm-2 control-label">Purpose</label>
                                                <div class="col-sm-10">
                                                    <select  id="purpose" name="purpose" class="form-control">
														<option value="0">SELECT</option>
                                                        <option value="1">INWARD</option>
                                                        <option value="2">OUTWARD</option>
                                                        <option value="3">BOTH</option>
                                                        <option value="4">OTHER</option>
                                                    </select>
                                                   
                                                </div>
                                            </div>-->
											
											

                                        </div>
                                    </div>
									
									 
                                          
										

                                    
                                </div>
                                <!-- end row -->
								<div class="row">
									<div class="form-horizontal"  >
										<div class="form-group">
											<div class="col-md-6">
												<button id="btntokengen" name="btntokengen" class="btn btn-primary">Submit</button>
											</div>
										</div>	
									</div>
								</div>	
								
								

                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div>
                    <!-- end container -->
                  

					<br><br><br><br><br>
					
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
		<script src="assets/js/token.app.js?v=3.3"></script>

    </body>
</html>
