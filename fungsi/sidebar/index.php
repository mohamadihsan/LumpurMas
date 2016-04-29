<?php
	function Sidebar(){
		?>
			<!DOCTYPE html>
			<html>
			<head>
			 	<meta charset="utf-8">
			  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
			  	<!-- Tell the browser to be responsive to screen width -->
			  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  	<!-- Bootstrap 3.3.6 -->
			  	<link rel="stylesheet" href="../../bootstrap/bootstrap/css/bootstrap.min.css">
			  	<!-- Font Awesome -->
			  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
			  	<!-- Ionicons -->
			  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
			  	<!-- daterange picker -->
			  	<link rel="stylesheet" href="../../bootstrap/plugins/daterangepicker/daterangepicker-bs3.css">
			  	<!-- bootstrap datepicker -->
			  	<link rel="stylesheet" href="../../bootstrap/plugins/datepicker/datepicker3.css">
			  	<!-- iCheck for checkboxes and radio inputs -->
			  	<link rel="stylesheet" href="../../bootstrap/plugins/iCheck/all.css">
			  	<!-- Bootstrap Color Picker -->
			  	<link rel="stylesheet" href="../../bootstrap/plugins/colorpicker/bootstrap-colorpicker.min.css">
			  	<!-- Bootstrap time Picker -->
			  	<link rel="stylesheet" href="../../bootstrap/plugins/timepicker/bootstrap-timepicker.min.css">
			  	<!-- Select2 -->
			  	<link rel="stylesheet" href="../../bootstrap/plugins/select2/select2.min.css">
			  	<!-- Theme style -->
			  	<link rel="stylesheet" href="../../bootstrap/dist/css/AdminLTE.min.css">
			  	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
			  <link rel="stylesheet" href="../../bootstrap/dist/css/skins/_all-skins.min.css">
			</head>
			<body class="hold-transition skin-blue sidebar-mini">
				<div class="wrapper">
				  	<header class="main-header">
				    	<!-- Logo -->
				    	<a href="../../index2.html" class="logo">
				      		<!-- mini logo for sidebar mini 50x50 pixels -->
				      		<span class="logo-mini"><b>A</b>LT</span>
				      		<!-- logo for regular state and mobile devices -->
				      		<span class="logo-lg"><b>Admin</b>LTE</span>
				    	</a>
					    <!-- Header Navbar: style can be found in header.less -->
					    <nav class="navbar navbar-static-top">
					     	<!-- Sidebar toggle button-->
				      		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					        	<span class="sr-only">Toggle navigation</span>
					        	<span class="icon-bar"></span>
					        	<span class="icon-bar"></span>
					        	<span class="icon-bar"></span>
				      		</a>

				      		<div class="navbar-custom-menu">
				        		<ul class="nav navbar-nav">
				          			<!-- Messages: style can be found in dropdown.less-->
				          			<li class="dropdown messages-menu">
				            			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				              				<i class="fa fa-envelope-o"></i>
				              				<span class="label label-success">4</span>
				            			</a>
				            			<ul class="dropdown-menu">
					              			<li class="header">You have 4 messages</li>
					              			<li>
					                			<!-- inner menu: contains the actual data -->
					                			<ul class="menu">
							                  		<li><!-- start message -->
							                    		<a href="#">
							                     			<div class="pull-left">
							                        			<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
							                      			</div>
							                      			<h4>
							                        			Support Team
							                        			<small><i class="fa fa-clock-o"></i> 5 mins</small>
							                      			</h4>
							                      			<p>Why not buy a new awesome theme?</p>
							                    		</a>
							                  		</li>
									                <!-- end message -->
									                <li>
					                    				<a href="#">
					                      					<div class="pull-left">
					                        					<img src="../../dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
					                      					</div>
					                      					<h4>
										                        AdminLTE Design Team
										                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
										                    </h4>
					                      					<p>Why not buy a new awesome theme?</p>
					                    				</a>
					                  				</li>
					                  				<li>
					                    				<a href="#">
					                      					<div class="pull-left">
					                        					<img src="../../dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
					                      					</div>
					                      					<h4>
					                        					Developers
					                        					<small><i class="fa fa-clock-o"></i> Today</small>
					                      					</h4>
					                      					<p>Why not buy a new awesome theme?</p>
					                    				</a>
					                  				</li>
					                  				<li>
					                    				<a href="#">
					                      					<div class="pull-left">
										                        <img src="../../dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
										                    </div>
					                      					<h4>
										                        Sales Department
										                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
										                    </h4>
					                      					<p>Why not buy a new awesome theme?</p>
					                    				</a>
					                  				</li>
								                  	<li>
								                    	<a href="#">
								                      		<div class="pull-left">
								                       			 <img src="../../dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
								                      		</div>
								                      		<h4>
								                        		Reviewers
								                        		<small><i class="fa fa-clock-o"></i> 2 days</small>
								                      		</h4>
								                      		<p>Why not buy a new awesome theme?</p>
								                    	</a>
								                  	</li>
					                			</ul>
					              			</li>
					              			<li class="footer"><a href="#">See All Messages</a></li>
				            			</ul>
				          			</li>
						          	<!-- Notifications: style can be found in dropdown.less -->
						          	<li class="dropdown notifications-menu">
						            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						              		<i class="fa fa-bell-o"></i>
						              		<span class="label label-warning">10</span>
						            	</a>
						            	<ul class="dropdown-menu">
						              		<li class="header">You have 10 notifications</li>
						              		<li>
						                		<!-- inner menu: contains the actual data -->
						                		<ul class="menu">
						                  			<li>
						                    			<a href="#">
						                      				<i class="fa fa-users text-aqua"></i> 5 new members joined today
						                    			</a>
						                  			</li>
						                  			<li>
								                    	<a href="#">
								                      		<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
								                      		page and may cause design problems
								                    	</a>
								                  	</li>
								                  	<li>
								                    	<a href="#">
								                      		<i class="fa fa-users text-red"></i> 5 new members joined
								                    	</a>
								                  	</li>
								                  	<li>
								                    	<a href="#">
								                      		<i class="fa fa-shopping-cart text-green"></i> 25 sales made
								                    	</a>
								                  	</li>
								                  	<li>
								                    	<a href="#">
								                      		<i class="fa fa-user text-red"></i> You changed your username
								                    	</a>
								                  	</li>
								                </ul>
						              		</li>
						              		<li class="footer"><a href="#">View all</a></li>
						            	</ul>
						          	</li>
						          	<!-- Tasks: style can be found in dropdown.less -->
						          	<li class="dropdown tasks-menu">
						            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						              		<i class="fa fa-flag-o"></i>
						              		<span class="label label-danger">9</span>
						            	</a>
						            	<ul class="dropdown-menu">
						              		<li class="header">You have 9 tasks</li>
						              		<li>
						                		<!-- inner menu: contains the actual data -->
						                		<ul class="menu">
						                  			<li><!-- Task item -->
						                    			<a href="#">
						                      				<h3>
						                        				Design some buttons
										                        <small class="pull-right">20%</small>
										                    </h3>
									                      	<div class="progress xs">
									                        	<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									                          		<span class="sr-only">20% Complete</span>
									                        	</div>
									                      	</div>
						                    			</a>
						                  			</li>
								                  	<!-- end task item -->
								                  	<li><!-- Task item -->
								                    	<a href="#">
								                      		<h3>
								                        		Create a nice theme
										                        <small class="pull-right">40%</small>
										                    </h3>
								                      		<div class="progress xs">
								                        		<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
										                          	<span class="sr-only">40% Complete</span>
										                        </div>
										                    </div>
								                    	</a>
								                  	</li>
									                <!-- end task item -->
									                <li><!-- Task item -->
									                    <a href="#">
									                      	<h3>
									                        	Some task I need to do
									                        	<small class="pull-right">60%</small>
									                      	</h3>
									                      	<div class="progress xs">
									                        	<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									                          		<span class="sr-only">60% Complete</span>
									                        	</div>
									                      	</div>
									                    </a>
									                </li>
									                <!-- end task item -->
						                  			<li><!-- Task item -->
						                    			<a href="#">
						                      				<h3>
						                        				Make beautiful transitions
						                        				<small class="pull-right">80%</small>
						                      				</h3>
									                      	<div class="progress xs">
									                        	<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									                          		<span class="sr-only">80% Complete</span>
									                        	</div>
									                      	</div>
									                    </a>
									                </li>
						                  		<!-- end task item -->
						                		</ul>
						              		</li>
						              		<li class="footer">
						                		<a href="#">View all tasks</a>
						              		</li>
						            	</ul>
						          	</li>
				          			<!-- User Account: style can be found in dropdown.less -->
				          			<li class="dropdown user user-menu">
				            			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				              				<img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
				              				<span class="hidden-xs">Iqbal Aditya Pangestu</span>
				            			</a>
							            <ul class="dropdown-menu">
							              	<!-- User image -->
							              	<li class="user-header">
							                	<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
							                	<p>
								                  	Iqbal Aditya Pangestu - Web Developer
								                  	<small>Member since Nov. 2012</small>
							               	 	</p>
							              	</li>
							              	<!-- Menu Body -->
							              	<li class="user-body">
							                	<div class="row">
							                  		<div class="col-xs-4 text-center">
							                    		<a href="#">Followers</a>
							                  		</div>
								                  	<div class="col-xs-4 text-center">
								                    	<a href="#">Sales</a>
								                  	</div>
								                  	<div class="col-xs-4 text-center">
								                    	<a href="#">Friends</a>
								                  	</div>
							                	</div>
							                	<!-- /.row -->
							              	</li>
				              				<!-- Menu Footer-->
							              	<li class="user-footer">
							                	<div class="pull-left">
							                  		<a href="#" class="btn btn-default btn-flat">Profile</a>
							                	</div>
							                	<div class="pull-right">
							                  		<a href="#" class="btn btn-default btn-flat">Sign out</a>
							                	</div>
							              	</li>
							            </ul>
							        </li>
				          			<!-- Control Sidebar Toggle Button -->
				          			<li>
							            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
							        </li>
				        		</ul>
				      		</div>
				    	</nav>
				  	</header>
				  	<!-- Left side column. contains the logo and sidebar -->
				  	<aside class="main-sidebar">
				    	<!-- sidebar: style can be found in sidebar.less -->
				    	<section class="sidebar">
				      		<!-- Sidebar user panel -->
				      		<div class="user-panel">
						        <div class="pull-left image">
						          	<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
						        </div>
						        <div class="pull-left info">
						          	<p>Iqbal Aditya Pangestu</p>
						          	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						        </div>
						    </div>
						    <!-- search form -->
						    <form action="#" method="get" class="sidebar-form">
						        <div class="input-group">
						          	<input type="text" name="q" class="form-control" placeholder="Search...">
						              	<span class="input-group-btn">
						                	<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
						                	</button>
						              </span>
						        </div>
						    </form>
					      	<!-- /.search form -->
					      	<!-- sidebar menu: : style can be found in sidebar.less -->
					      	<ul class="sidebar-menu">
					        	<li class="header">NAVIGASI UTAMA</li>
					        	<li class="treeview">
							        <a href="#">
							            <i class="fa fa-dashboard"></i>
							            <span>Halaman Utama</span>
							        </a>
							    </li>
							    <li class="treeview">
							        <a href="#">
							            <i class="fa fa-dashboard"></i>
							            <span>Pegawai</span>
							        </a>
							    </li>	
						        <li class="treeview">
							        <a href="#">
							            <i class="fa fa-dashboard"></i>
							            <span>Produk</span>
							        </a>
							    </li>
							    <li class="treeview">
							        <a href="#">
							            <i class="fa fa-dashboard"></i>
							            <span>Kategori Produk</span>
							        </a>
							    </li>
							    <li class="treeview">
							        <a href="#">
							            <i class="fa fa-dashboard"></i>
							            <span>Promosi</span>
							        </a>
							    </li>
							    <li class="treeview">
							        <a href="#">
							            <i class="fa fa-dashboard"></i>
							            <span>Rekomendasi</span>
							        </a>
							    </li>
							    <li class="treeview">
							        <a href="#">
							            <i class="fa fa-dashboard"></i>
							            <span>Keluhan & Saran</span>
							        </a>
							    </li>
							    <li class="treeview">
							        <a href="#">
							            <i class="fa fa-dashboard"></i>
							            <span>Transaksi</span>
							        </a>
							    </li>
						        <li><a href="../../documentation/index.html"><i class="fa fa-book"></i> <span>Laporan</span></a></li>
					   	 	</ul>
				    	</section>
				    	<!-- /.sidebar -->
					</aside>

				  	<!-- Content Wrapper. Contains page content -->
				  	<div class="content-wrapper">
				    	<!-- Content Header (Page header) -->
				    	<section class="content-header">
					      	<h1>
					        	Advanced Form Elements
					        	<small>Preview</small>
					      	</h1>
					      	<ol class="breadcrumb">
					        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					        	<li><a href="#">Forms</a></li>
					        	<li class="active">Advanced Elements</li>
					      	</ol>
			    		</section>
		<?php
	}

	function CloseSidebar(){
		?>
		<!-- Wrapper -->
		</div>
		<!-- jQuery 2.2.0 -->
			<script src="../../bootstrap/plugins/jQuery/jQuery-2.2.0.min.js"></script>
			<!-- Bootstrap 3.3.6 -->
			<script src="../../bootstrap/bootstrap/js/bootstrap.min.js"></script>
			<!-- Select2 -->
			<script src="../../bootstrap/plugins/select2/select2.full.min.js"></script>
			<!-- InputMask -->
			<script src="../../bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
			<script src="../../bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
			<script src="../../bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
			<!-- date-range-picker -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
			<script src="../../bootstrap/plugins/daterangepicker/daterangepicker.js"></script>
			<!-- bootstrap datepicker -->
			<script src="../../bootstrap/plugins/datepicker/bootstrap-datepicker.js"></script>
			<!-- bootstrap color picker -->
			<script src="../../bootstrap/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
			<!-- bootstrap time picker -->
			<script src="../../bootstrap/plugins/timepicker/bootstrap-timepicker.min.js"></script>
			<!-- SlimScroll 1.3.0 -->
			<script src="../../bootstrap/plugins/slimScroll/jquery.slimscroll.min.js"></script>
			<!-- iCheck 1.0.1 -->
			<script src="../../bootstrap/plugins/iCheck/icheck.min.js"></script>

			<!-- AdminLTE App -->
			<script src="../../bootstrap/dist/js/app.min.js"></script>
			<!-- AdminLTE for demo purposes -->
			<script src="../../bootstrap/dist/js/demo.js"></script>
			<!-- Page script -->
			<script>
			  $(function () {
			    //Initialize Select2 Elements
			    $(".select2").select2();
			    //Money Euro
			    $("[data-mask]").inputmask();
			  });
			</script>
		</body>
		</html>
		<?php
	}
?>