 <div class="topbar" id="topnav">

                <!-- Top navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">

                            <!-- LOGO -->
                             <div class="topbar-left">
                                <a href="index.php" class="logo"><?php if (isset($logo_title) ){echo($logo_title);} ?> </a>

                            </div>

							<?php
								if ( (   !isset($_SESSION['loc_id']) or empty($_SESSION['loc_id']) or  is_null($_SESSION['loc_id'])  )  and
									(   !isset($_SESSION['role_id']) or  empty($_SESSION['role_id']) or  is_null($_SESSION['role_id'])  )	)
									{}else{
							?>
							<!--
								<option value="0">Select</option>
								<option value="1">Token generator</option>
								<option value="2">Gate Timer</option>
								<option value="3">Dock Controller</option>
								<option value="4">Queue Monitor</option>

							-->
                            <div class="navbar-custom navbar-left">
                                <div id="navigation">
                                    <!-- Navigation Menu-->
                                    <ul class="navigation-menu">
										<?php if ($_SESSION['role_id']=="4") { ?>
										<li>
                                            <a href="index.php">
                                                <span><i class="ti-home"></i></span><span> Dashboard </span> </a>
                                        </li>
										<li class="has-submenu">
                                            <a href="#"> <span><i class="ti-files"></i></span><span> Activity </span> </a>
                                            <ul class="submenu">
                                                <li><a href="regenerate.php">Regenerate</a></li>
                                                <!--<li><a href="assign_v1.php">Assign V1</a></li>-->
                                                <li><a href="assign.php">Assign</a></li>
												<li><a href="reports.php">Download</a></li>
                                            </ul>
                                        </li>
										<li class="has-submenu">
                                            <a href="#"> <span><i class="ti-files"></i></span><span> Config </span> </a>
                                            <ul class="submenu">
                                                <li><a href="dockconfig.php">Dock Config</a></li>
												<li><a href="view_dock_status.php">Dock Status</a></li>

                                            </ul>
                                        </li>


										<!--<li>
                                            <a href="reports.php">
                                                <span><i class="ti-view-list"></i></span><span> Reports </span> </a>
                                        </li>
										<li>
                                            <a href="regenerate.php">
                                                <span><i class="ti-reload"></i></span><span> Regenerate </span> </a>
                                        </li>-->
										<?php }?>

										<?php if ( $_SESSION['role_id']=="2" || $_SESSION['role_id']=="3" ) { ?>
										<li>
                                            <a href="scanner.php">
                                                <span><i class="ti-search"></i></span><span> Scanner </span> </a>
                                        </li>
										<?php }?>

										<?php if ( $_SESSION['role_id']=="0") { ?>
										<li>
                                            <a href="createjson.php">
                                                <span><i class="ti-files"></i></span><span> Json </span> </a>
                                        </li>
										<?php }?>

										<?php if ( $_SESSION['role_id']!="5") { ?>
										<li>
                                            <a href="onlyview.php">
                                                <span><i class="ti-view-list"></i></span><span> View </span> </a>
                                        </li>

										<li>
                                            <a href="rolechange.php">
                                                <span><i class="ti-user"></i></span><span> Role Change </span> </a>
                                        </li>

										<?php }?>

										<?php if ( $_SESSION['role_id']=="1") { ?>
										<li>
                                            <a href="regenerate.php">
                                                <span><i class="ti-reload"></i></span><span> Regenerate </span> </a>
                                        </li>

										<li>
                                            <a href="newtoken.php">
                                                <span><i class="ti-files"></i></span><span> New Token </span> </a>
                                        </li>

										<?php }?>

                                  <li>
                                           <a href="gio_help/">
                                               <span><i class="ti-help"></i></span><span> Help </span> </a>
                                       </li>

                                    </ul>
                                    <!-- End navigation menu  -->
                                </div>
                            </div>
									<?php } ?>
                            <!-- Top nav Right menu -->
                            <ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
                                <li class="top-menu-item-xs">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>
                                <li class="hidden-xs">
                                    <div role="search" class="navbar-left app-search pull-left">
                                         <label class="form-control" id="lblloc">
										 <?php if ( isset($_SESSION['loc_name']) ) { echo($_SESSION['loc_name']); } else { echo("No Location"); } ?>

										 </label>
                                         <!--<a href=""><i class="fa fa-search"></i></a>-->
                                    </div>
                                </li>


								<li class="dropdown top-menu-item-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle menu-right-item" data-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-bell"></i> <span class="label label-danger">3</span>
                                    </a>
                                   <?php include 'notification.php'; ?>
                                </li>




								<li class="dropdown top-menu-item-xs">
                                    <a href="#" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true" >
									 <img src="assets/images/logo.png" alt="logo" class="logo-lg img-circle" />
                                     <img src="assets/images/logo_sm.png" alt="logo" class="logo-sm hidden img-circle" /></a>
										<ul class="dropdown-menu">

										<li>
											<a href="centralview.php"><i class="ti-location-arrow"></i>
											Central View
											</a>
										</li>
                                         <!--
										<li>
											<a href="javascript:void(0)"><i class="ti-user"></i>
											Role
											</a>
										</li>

										<li class="divider"></li>
                                        <li><a href="rolechange.php"><i class="ti-power-off m-r-10"></i> Logout</a></li>
										-->
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- end container -->
                </div> <!-- end navbar -->
            </div>
