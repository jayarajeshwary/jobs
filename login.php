

<?php
session_start();
header("Strict-Transport-Security:max-age=63072000");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//print_r($_SESSION);
$page_title = "Login";
 
require_once("init.php");
//require_once("./sett.php");
//require_once("./session.php");
require_once("star_tok_gen.php");

$min=1;
$max=15;
$img_no = mt_rand($min,$max);


unset($_SESSION['logtok']);
unset($_SESSION['Key']);
if(empty($_SESSION['Key']))
$_SESSION['Key']= bin2hex(random_bytes(32));
$_SESSION['logtok']=hash_hmac('sha256','logintoken:login.php', $_SESSION['Key']);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SimpleAdmin - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Icons CSS -->
        <link href="assets/css/icons.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">

    </head>


    <body class="gray-bg body_bg" >
    <?php include 'topbar.php'; ?>

<section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="wrapper-page">
                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h2 class="text-uppercase m-t-0 m-b-30">
                                        <a href="#" class="text-success">
                                            <span><img src="assets/images/logo.png" alt="" height="30"></span>
                                        </a>
                                    </h2>
                                </div>
                                <div class="account-content">
                                    <form class="" action="#">
                                        <?php startokgen::create_token(); ?>
                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="User Name">User Name</label>
                                                <div class="form-group m-b-20 " id="divctl1"></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                
                                                <label for="password">Password</label>
                                                <div class="form-group m-b-20 " id="divctl2" ></div>
                                            </div>
                                        </div>
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <div class="form-group m-b-20 " id="divctl3"></div>
                                                <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['logtok'] ?>"/> 
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                                <div class="col-md-6 text-right">
                                                    <div id="alertmsg" name="alertmsg" class="alert alert-danger custom-alert" style="display: none">
                                                        </div>
                                                </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
    













    <!--<section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h2 class="text-uppercase m-t-0 m-b-30">
                                        <a href="index.html" class="text-success">
                                            
                                            <span><img src="assets/images/logo.png" alt="" height="30"></span>
                                        </a>
                                    </h2>
                                   
                                </div>
<div class="account-content">
<form id="frmstar" name="frmSTAR" class="form-horizontal" method="POST">

<?php //startokgen::create_token(); ?>
    

    <div id="ibox" class="loginColumns animated bounceInDown">
        <div class="row">
            
               
            <div class="col-md-6">
                <div class="ibox" id="ibox1">
                
                    <div class="ibox-content">
                    
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                            
                            <div class="account-content">
                             <div class="form-group m-b-20">
                             <div class="col-xs-12">
                                <label for="User Name">User Name</label>
                                    <div class="form-group m-b-20 " id="divctl1">
                                                                     </div>
                             </div>
                             </div>



                             
                             <div class="form-group m-b-20">
                                <div class="col-xs-12">
                                <label for="password">Password</label>
                            <div class="form-group m-b-20 " id="divctl2" >
                                 
                            </div>
                            </div>
                            </div>

                            <div class="form-group account-btn text-center m-t-10">
                                <div class="col-xs-12">
                               <div class="form-group m-b-20 " id="divctl3">
                             
                               </div>
                               </div>
                            </div>

              <input type="hidden" id="csrf_token" name="csrf_token" value="<?php //echo $_SESSION['logtok'] ?>"/>                                             
                    </div>
                </div>
                </div>
            </div>
        </div>
        <hr/>
    </div> 
</form>
<div class="row">
            <div class="col-md-6 text-right">
                <div id="alertmsg" name="alertmsg" class="alert alert-danger custom-alert" style="display: none">
                    </div>
            </div>
        </div>
<div class="clearfix"></div>

                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </section>-->

<!--<section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h2 class="text-uppercase m-t-0 m-b-30">
                                        <a href="index.html" class="text-success">
                                            <span><img src="assets/images/logo_dark.png" alt="" height="30"></span>
                                        </a>
                                    </h2>
                                   
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" action="#">

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                
                                                <input class="form-control" type="text" id="emailaddress" required="" placeholder="Enter your password">
                                            </div>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                
                                                
                                                <input class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-custom btn-block" type="submit">Sign In</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </section>-->
        
        





        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>
        <script src="assets/js/default.js?v=2.9"></script>

        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
