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
			  	<!-- data tables -->
			  	<link rel="stylesheet" href="../../bootstrap/plugins/datatables/dataTables.bootstrap.css">
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
			  	<!-- SweetAlert -->
			  	<link rel="stylesheet" type="text/css" href="../../bootstrap/dist/sweet/sweetalert.css">
			</head>
			<body class="hold-transition skin-blue sidebar-mini">
				<div class="wrapper">
				  	<header class="main-header">
				    	<!-- Logo -->
				    	<a href="../../index2.html" class="logo">
				      		<!-- mini logo for sidebar mini 50x50 pixels -->
				      		<span class="logo-mini"><b>L</b>M</span>
				      		<!-- logo for regular state and mobile devices -->
				      		<span class="logo-lg"><b>Lumpur</b>Mas</span>
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
						          	<!-- Notifications: style can be found in dropdown.less -->
						          	<li class="dropdown notifications-menu">
						            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						              		<i class="fa fa-bell-o"></i>
						              		<span class="label label-warning">1</span>
						            	</a>
						            	<ul class="dropdown-menu">
						              		<li class="header">Kamu mempunya 1 notifications</li>
						              		<li>
						                		<!-- inner menu: contains the actual data -->
						                		<ul class="menu">
								                  	<li>
								                    	<a href="#">
								                      		<i class="fa fa-users text-red"></i> Keluhan dari pelanggan
								                    	</a>
								                  	</li>
								                </ul>
						              		</li>
						              		<li class="footer"><a href="#">View all</a></li>
						            	</ul>
						          	</li>
						          	
						          	</li>
				          			<!-- User Account: style can be found in dropdown.less -->
				          			<li class="dropdown user user-menu">
				            			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				              				<img src="../../bootstrap/dist/img/user.png" class="user-image" alt="User Image">
				              				<span class="hidden-xs"><?php echo $_SESSION['nama_pegawai']; ?></span>
				            			</a>
							            <ul class="dropdown-menu">
							              	<!-- User image -->
							              	<li class="user-header">
							                	<img src="../../bootstrap/dist/img/user.png" class="img-circle" alt="User Image">
							                	<p>
								                  	<?php echo $_SESSION['nama_pegawai']; ?>
								                  	<small><?php echo $_SESSION['jabatan']; ?></small>
							               	 	</p>
							              	</li>
				              				<!-- Menu Footer-->
							              	<li class="user-footer">
							                	<div class="pull-left">
							                  		<a href="#" class="btn btn-default btn-flat">Profil</a>
							                	</div>
							                	<div class="pull-right">
							                  		<a href="../logout/" class="btn btn-default btn-flat">Keluar</a>
							                	</div>
							              	</li>
							            </ul>
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
						          	<img src="../../bootstrap/dist/img/user.png" class="img-circle" alt="User Image">
						        </div>
						        <div class="pull-left info">
						          	<p><?php echo $_SESSION['nama_pegawai']; ?></p>
						          	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						        </div>
						    </div>
					      	<!-- sidebar menu: : style can be found in sidebar.less -->
					      	<ul class="sidebar-menu">
					        	<li class="header">NAVIGASI UTAMA</li>
					        	<!-- MENU HALAMAN UTAMA -->
					        	<li class="treeview">
					        		<?php
					        			if ($_SESSION['jabatan']=="manager") {
					        				$url = "../manager/";
					        			}else if ($_SESSION['jabatan']=="direktur") {
					        				$url = "../direktur/";
					        			}else if ($_SESSION['jabatan']=="pemasaran") {
					        				$url = "../pemasaran/";
					        			}else if ($_SESSION['jabatan']=="administrasi") {
					        				$url = "../administrasi/";
					        			}else if ($_SESSION['jabatan']=="inventori") {
					        				$url = "../inventori/";
					        			}
					        		?>
							        <a href="<?php echo $url; ?>">
							            <i class="fa fa-dashboard"></i>
							            <span>Halaman Utama</span>
							        </a>
							    </li>

							    <!-- MENU KATEGORI PRODUK -->
							    <?php
							    	if ($_SESSION['jabatan']=="manager" OR $_SESSION['jabatan']=="direktur" OR $_SESSION['jabatan']=="inventori") {
							    		?>
							    			<li class="treeview">
										        <a href="../kategori_produk/">
										            <i class="fa fa-list-alt"></i>
										            <span>Kategori Produk</span>
										        </a>
							    			</li>
							    		<?php
							    	}
							    ?>

							    <!-- MENU PRODUK -->
							    <?php
							    	if ($_SESSION['jabatan']=="manager" OR $_SESSION['jabatan']=="direktur" OR $_SESSION['jabatan']=="inventori") {
							    		?>
							    			<li class="treeview">
										        <a href="../produk/">
										            <i class="fa fa-tasks"></i>
										            <span>Produk</span>
										        </a>
							    			</li>
							    		<?php
							    	}
							    ?>

							    <!-- MENU PEGAWAI -->
							     <?php
							    	if ($_SESSION['jabatan']=="manager" OR $_SESSION['jabatan']=="direktur") {
							    		?>
							    			<li class="treeview">
										        <a href="../pegawai/">
										            <i class="fa fa-users"></i>
										            <span>Pegawai</span>
										        </a>
							    			</li>
							    		<?php
							    	}
							    ?>

							    <!-- MENU PROMOSI -->
							    <?php
							    	if ($_SESSION['jabatan']=="manager" OR $_SESSION['jabatan']=="direktur" OR $_SESSION['jabatan']=="pemasaran") {
							    		?>
							    			<li class="treeview">
										        <a href="../promosi/">
										            <i class="fa fa-star"></i>
										            <span>Promosi</span>
										        </a>
							   	 			</li>
							    		<?php
							    	}
							    ?>

							    <!-- MENU REKOMENDASI -->
							    <?php
							    	if ($_SESSION['jabatan']=="manager" OR $_SESSION['jabatan']=="direktur" OR $_SESSION['jabatan']=="pemasaran") {
							    		?>
							    			<li class="treeview">
										        <a href="../rekomendasi/">
										            <i class="fa fa-trophy"></i>
										            <span>Rekomendasi</span>
										        </a>
							    			</li>
							    		<?php
							    	}
							    ?>

							    <!-- MENU KELUHAN & SARAN -->
							    <?php
							    	if ($_SESSION['jabatan']=="manager" OR $_SESSION['jabatan']=="direktur" OR $_SESSION['jabatan']=="administrasi") {
							    		?>
							    			<li class="treeview">
										        <a href="../keluhan_saran/">
										            <i class="fa fa-comments"></i>
										            <span>Keluhan & Saran</span>
										        </a>
							    			</li>
							    		<?php
							    	}
							    ?>

							    <!-- MENU TRANSAKSI -->
							    <?php
							    	if ($_SESSION['jabatan']=="manager" OR $_SESSION['jabatan']=="direktur" OR $_SESSION['jabatan']=="administrasi") {
							    		?>
							    			<li class="treeview">
										        <a href="../transaksi/">
										            <i class="fa fa-money"></i>
										            <span>Transaksi</span>
										        </a>
							    			</li>
							    		<?php
							    	}
							    ?>
					   	 	</ul>
				    	</section>
				    	<!-- /.sidebar -->
					</aside>

				  	<!-- Content Wrapper. Contains page content -->
				  	<div class="content-wrapper">
		<?php
	}

	function CloseSidebar(){
		?>
		<!-- Wrapper -->
		</div>
		<footer class="main-footer">
	    	<div class="pull-right hidden-xs">
	      		<b></b>
	    	</div>
	    	<strong>Copyright &copy; 2016-2017 <a href="#">Lumpur Mas</a>.</strong>
	  	</footer>
  		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  		<div class="control-sidebar-bg"></div>	
		<!-- jQuery 2.2.0 -->
			<script src="../../bootstrap/plugins/jQuery/jQuery-2.2.0.min.js"></script>
			<!-- Bootstrap 3.3.6 -->
			<script src="../../bootstrap/bootstrap/js/bootstrap.min.js"></script>
			<!-- DataTables -->
			<script src="../../bootstrap/plugins/datatables/jquery.dataTables.min.js"></script>
			<script src="../../bootstrap/plugins/datatables/dataTables.bootstrap.min.js"></script>
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
			<!-- SweetAlert -->
			<script src="../../bootstrap/dist/sweet/sweetalert.min.js"></script>
			<!-- Page script -->
			<script>
			  $(function () {
			    //Initialize Select2 Elements
			    $(".select2").select2();
			    //Money Euro
			    $("[data-mask]").inputmask();
			    //Data Tables
			    $("#example1").DataTable();
			    $('#example2').DataTable({
			      "paging": true,
			      "lengthChange": false,
			      "searching": false,
			      "ordering": true,
			      "info": true,
			      "autoWidth": true
			    });
			  });

				function BerhasilMenyimpan(){
					swal({   
						title: "Berhasil!",   
						text: "Data telah disimpan.",   
						timer: 1500,   
						type: "success",
						showConfirmButton: false });
				}

				function GagalMenyimpan(){
					swal({   
						title: "Oops!",   
						text: "Data gagal disimpan.",   
						timer: 1500,   
						type: "error",
						showConfirmButton: false });
				}

				function BerhasilMemperbaharui(){
					swal({   
						title: "Berhasil!",   
						text: "Data telah diperbaharui.",   
						timer: 1500,   
						type: "success",
						showConfirmButton: false });
				}

				function GagalMemperbaharui(){
					swal({   
						title: "Oops!",   
						text: "Data gagal diperbaharui.",   
						timer: 1500,   
						type: "error",
						showConfirmButton: false });
				}

				function BerhasilMenghapus(){
					swal({   
						title: "Berhasil!",   
						text: "Data telah dihapus.",   
						timer: 1500,   
						type: "success",
						showConfirmButton: false });
				}

				function GagalMenghapus(){
					swal({   
						title: "Oops!",   
						text: "Data gagal dihapus.",   
						timer: 1500,   
						type: "error",
						showConfirmButton: false });
				}
			</script>
		</body>
		</html>
		<?php
	}
?>