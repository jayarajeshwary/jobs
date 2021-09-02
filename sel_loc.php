<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Expires: Mon, 9 Jul 1995 05:00:00 GMT"); 
header("Pragma: no-cache");
header("Cache: no-cache"); 

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$page_name = "Location";



$uniq_session_id = session_id();
$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');
include './init.php';
include 'session_check.php';


//(empty($tok_id) or is_null($tok_id) )

//$strJsonFileContents = file_get_contents("./jsondata/location.JSON");
//$loc_details = json_decode($strJsonFileContents);
//var_dump($strJsonFileContents);
//$data = json_decode($strJsonFileContents, true);
//var_dump($data);
//die;
//foreach($data as $loc_row)
//{
//	echo($loc_row['loc_id']."<br>" );
//}
//var_dump($strJsonFileContents);
//echo("<br><br><br>");
//$url = 'http://mars.fkinternal.com/gio/maintenance.php';
//header( "Location: $url" );

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>GATE IO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta http-equiv="no-cache">
		<meta http-equiv="Expires" content="-1">
		<meta http-equiv="Cache-Control" content="no-cache">
		
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
		  <!-- Sweet Alert -->
        <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
		
		
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap_lat.min.css" rel="stylesheet">
        <!-- Icons CSS -->
        <link href="assets/css/icons.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">

    </head>


    <body>
<form id="frm_gio" name="frm_gio" method="GET" action=""  >
        <div id="page-wrapper">
            <!-- Top Bar Start -->
				<?php include 'topbar.php'; ?>
            <!-- Top Bar End -->
            <!-- Page content start -->
            <div class="page-contentbar">

                <!-- START PAGE CONTENT -->
                <div id="page-right-content">
					
                    <div class="container">
                        <!--<div class="row">
                            <div class="col-sm-12">
                                <h4 class="header-title m-t-0 m-b-20">Location   </h4>
                            </div>
                        </div>-->
						<!-- end row -->
                   

					<!-- START CONTENT BODY -->

						<div id="alertmsg1" class="alert alert-danger alert-dismissible fade in" role="alert"  style="display: none;">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <span id="alertmsgspan">
													 
												</span>
                         </div>
										 
                      <div class="row">
                            <div class="col-md-12">

                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-20">Select Location/Center</h4>

                                     
                                    <p class="text-muted m-b-15 font-13">
                                        All your Transactions are alligned to the center you select.
                                    </p>
									
									<?php
									$strJsonFileContents = file_get_contents("./jsondata/location.JSON");
									//$loc_details = json_decode($strJsonFileContents);
									//var_dump($strJsonFileContents);
									$data = json_decode($strJsonFileContents, true);
									?>
									
                                    <select id="selloc" name="selloc" class="form-control select2 col-md-6" tabindex=1>
                                        <option value="0">Select</option>
										<?php
										foreach($data as $loc_row)
										{
											//echo($loc_row['loc_id']."<br>" );
											//echo($loc_row['facility_name']."<br>" );
											echo("<option value=".$loc_row['loc_id'].">".$loc_row['facility_name']."</option>");
										}
										?>
                                    </select>

                                   <h6 class="m-t-30 text-muted">Select Role</h6>
                                    <p class="text-muted m-b-15 font-13">
                                        The Role Selection gives Previleges to do certain activity.
                                    </p>

                                    <select  id="selrole" name="selrole"  class="select2 form-control" tabindex=2>
										<option value="0">Select</option>
										<option value="1">Token generator</option>
                                        <option value="2">Gate Timer</option>
                                        <option value="3">Dock Timer</option>
                                        <option value="4">Queue Manager</option>
										<option value="5">Entry Status</option>
                                    </select>
                                    <br><br><br>
                                     <div class="form-group row">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <button tabindex=3 id="btn_selloc" name="btn_selloc" type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Login
                                                    </button>
                                                    <button tabindex=4 id="btn_selloc_c" name="btn_selloc_c"  type="reset" class="btn btn-default waves-effect m-l-5">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
 

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

		<!-- Preloader -->
	<div id="preloader">
		<div class="preloader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<!-- /Preloader -->

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/bootstrap_lat.min.js?v=1"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>

		
		<script src="assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
		
		 <!-- Sweet-Alert  -->
        <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert.init.js"></script>
		 <!-- form advanced init js -->
        <script>
		$(".select2").select2();
		</script>
        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>
		<script src="assets/js/sel_location.app.js?v=3.1"></script>
	</form>
    </body>
</html>
