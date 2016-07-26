<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/pelanggan/index.php';
	include '../../asset/login/check_login_pelanggan.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['id_pelanggan'])) {
		header('location:../login/');
	}
	
		//jika manager yang masuk
		if (!empty($_SESSION['username']) OR !empty($_SESSION['id_pelanggan'])) {

				if (isset($_POST['simpan'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					TambahDataKategoriProduk();
					if ($_SESSION['status_operasi_kp']=="berhasil_menyimpan") {
						?> <body onload="BerhasilMenyimpan()"></body><?php
					}else if ($_SESSION['status_operasi_kp']=="gagal_menyimpan") {
						?> <body onload="GagalMenyimpan()"></body><?php
					}
				}

				if (isset($_POST['update_akun'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditDataPelanggan();
					if ($_SESSION['status_operasi_kp']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}else if ($_SESSION['status_operasi_kp']=="gagal_memperbaharui") {
						?> <body onload="GagalMemperbaharui()"></body><?php
					}
				}
			?>

			<!DOCTYPE html>
			<html>
				<head>
					<title>Profil</title>
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
				  	<!-- Theme style -->
				  	<link rel="stylesheet" href="../../bootstrap/dist/css/AdminLTE.min.css">
				  	<!-- iCheck -->
				  	<link rel="stylesheet" href="../../bootstrap/plugins/iCheck/square/blue.css">
	   				<script type="text/javascript" src="../../bootstrap/bootstrap/js/jquery1.min.js"></script>
					<!-- SweetAlert -->
					<link rel="stylesheet" type="text/css" href="../../bootstrap/dist/sweet/sweetalert.css">
				  	<script type="text/javascript">
						function BerhasilMenyimpan(){
							swal({
								title: "",
								text: "Anda telah terdaftar menjadi member.",
								timer: 1500,
								type: "success",
								showConfirmButton: false });
						}

						function GagalMenyimpan(){
							swal({
								title: "",
								text: "Proses pendaftaran member tidak berhasil.",
								timer: 1500,
								type: "error",
								showConfirmButton: false });
						}
					</script>
				</head>
				<body class="hold-transition login-page">
				<!-- Navigation -->
	            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	                <div class="container">
	                    <!-- Brand and toggle get grouped for better mobile display -->
	                    <div class="navbar-header">
	                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                            <span class="sr-only">Toggle navigation</span>
	                            <span class="icon-bar"></span>
	                            <span class="icon-bar"></span>
	                            <span class="icon-bar"></span>
	                        </button>
	                        <a class="navbar-brand" href="../../">Lumpur Mas</a>
	                    </div>
	                    <!-- Collect the nav links, forms, and other content for toggling -->
	                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                        <ul class="nav navbar-nav navbar-right">
	                            <!-- MENU PRODUK -->
	                            <li>
	                                <a href="../../halaman/produk/">Produk</a>
	                            </li>
	                            <!-- MENU PROMO -->
	                            <li>
	                                <a href="../../halaman/promosi/">Promo</a>
	                            </li>
	                            <!-- MENU PEMESANAN -->
	                            <li>
	                                <a href="../../halaman/pemesanan/">Pemesanan</a>
	                            </li>
	                            <!-- MENU KELUHAN SARAN -->
	                            <li>
	                                <a href="../../halaman/keluhan_saran/">Keluhan Saran</a>
	                            </li>
	                            <!-- LOGIN -->
	                            <?php
	                                if (!empty($_SESSION['username']) AND !empty($_SESSION['id_user'])) {
			                          ?>
	                                    <!-- MENU KOTAK INFORMASI -->
	                                    <li class="dropdown">
	                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                                            Kotak Informasi
	                                            <b class="caret"></b>
	                                        </a>
	                                        <ul class="dropdown-menu">
	                                            <li>
	                                                <a href="../../halaman/info_pemesanan/">Info Pemesanan</a>
	                                            </li>
	                                            <li>
	                                                <a href="../../halaman/info_keluhan/">Info Keluhan</a>
	                                            </li>
	                                        </ul>
	                                    </li>
	                                    <li class="dropdown">
	                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                                            <?php echo "Selamat datang," . $_SESSION['nama']; ?>
	                                            <b class="caret"></b>
	                                        </a>
	                                        <ul class="dropdown-menu">
	                                            <li>
	                                                <a href="../../asset/profil_pelanggan/">Profil</a>
	                                            </li>
	                                            <li>
	                                                <a href="../../asset/logout/">Logout</a>
	                                            </li>
	                                        </ul>
	                                    </li>
	                                    <?php
	                                    } else {
	                                    		?>
	                                    <li>
	                                        <a href="../../asset/login/">Login</a>
	                                    </li>
	                                    <?php
	                                }
		                        ?>
	                        </ul>
	                    </div>
	                    <!-- /.navbar-collapse -->
	                </div>
	                <!-- /.container -->
	            </nav>
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="">
					 	<div class="login-logo">
					    	<a href="">Register <b>Lumpur</b>Mas</a>
					  	</div>
					  	<!-- /.login-logo -->
					  	<div class="login-box-body">
					  		<fieldset>
					  			<legend>Informasi User</legend>
					  		</fieldset>
					  		<?php
					  		//Get Data Pelanggan 
							$sql = "SELECT pelanggan.id_pelanggan, pelanggan.nama, pelanggan.alamat, pelanggan.no_telp, pelanggan.email, user.id_user, user.username FROM pelanggan, user WHERE user.id_user=pelanggan.id_user";							
							$stmt = $db->prepare($sql);
							$stmt->execute();

							$stmt->bind_result($id_pelanggan, $nama, $alamat, $no_telp, $email, $id_user, $username);
							$stmt->fetch();
					  		?>
					    	<form action="" method="post">
								<div class="col-md-12">
									<label>Nama Lengkap</label>
						      		<div class="form-group has-feedback">
						      			<input type="text" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>" hidden>
						      			<input type="text" name="id_user" value="<?php echo $id_user; ?>" hidden>
						        		<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $nama; ?>" required="" autofocus="">
						        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
						      		</div>
						      	</div>
						      	<div class="col-md-12">
									<label>No Telepon</label>
						      		<div class="form-group has-feedback">
						        		<input type="phone" name="no_telp" class="form-control" placeholder="No Telp" value="<?php echo $no_telp; ?>" required="">
						        		<span class="glyphicon glyphicon-phone form-control-feedback"></span>
						      		</div>
						      	</div>
						      	<div class="col-md-12">
									<label>Email</label>
						      		<div class="form-group has-feedback">
						        		<input type="email" name="email" class="form-control" placeholder="contoh:abc@gmail.com" value="<?php echo $email; ?>">
						        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						      		</div>
						      	</div>
						      	<div class="col-md-12">
									<label>Alamat</label>
						      		<div class="form-group has-feedback">
						        		<textarea name="alamat"  class="form-control" rows="5"><?php echo $alamat; ?></textarea>
						      		</div>
						      	</div>
								<div class="col-md-12">
									<label>Username</label>
						      		<div class="form-group has-feedback">
						        		<input type="text" name="username" value="<?php echo $username; ?>" class="form-control" placeholder="Username" required="">
						        		<span class="glyphicon glyphicon-info form-control-feedback"></span>
						      		</div>
						      	</div>
								<div class="col-md-12">
									<label>Password</label>
						      		<div class="form-group has-feedback">
						        		<input type="password" name="password" class="form-control" placeholder="Password" required="">
						        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						      		</div>
						      	</div>
						      	<div class="col-md-12">
				          			<button type="submit" name="update_akun" class="btn btn-primary btn-block btn-flat">Update</button>
				        		</div>
							</form>
					    <div class="social-auth-links text-right">
					    	<a href="../../" class="text-center">_</a>
						</div>
					</div>
				</div>

				<!-- Footer -->
		        <footer>
		        </footer>


				<!-- jQuery 2.2.0 -->
				<script src="../../bootstrap/plugins/jQuery/jQuery-2.2.0.min.js"></script>
				<!-- Bootstrap 3.3.6 -->
				<script src="../../bootstrap/bootstrap/js/bootstrap.min.js"></script>
				<!-- iCheck -->
				<script src="../../bootstrap/plugins/iCheck/icheck.min.js"></script>
				<!-- jQuery -->
			    <script src="../../bootstrap/bootstrap/js/jquery.js"></script>

			    <!-- Contact Form JavaScript -->
			    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
			    <script src="../../bootstrap/bootstrap/js/jqBootstrapValidation.js"></script>
			    <script src="../../bootstrap/bootstrap/js/contact_me.js"></script>
			    <!-- SweetAlert -->
			    <script src="../../bootstrap/dist/sweet/sweetalert.min.js"></script>
			    <script>
			    	function BerhasilMemperbaharui(){
					swal({
						title: "",
						text: "Data telah diperbaharui.",
						timer: 1500,
						type: "success",
						showConfirmButton: false });
					}

					function GagalMemperbaharui(){
						swal({
							title: "",
							text: "Data gagal diperbaharui.",
							timer: 1500,
							type: "error",
							showConfirmButton: false });
					}
			    </script>

			</body>
			</html>
	  		<?php

		}else{
			//alihkan url jika bukan manager
			?><meta http-equiv="refresh" content="0;url=../login/"><?php
		}
	?>