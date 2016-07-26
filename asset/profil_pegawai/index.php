<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/pegawai/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
		
	//jika manager yang masuk
	if (!empty($user_check)) {

		if (isset($_POST['update_akun'])) {
			//jika tombol submit ditekan maka excute fungsi ini
			EditProfilPegawai();
			if ($_SESSION['status_operasi_pg']=="berhasil_mengupdate") {
				?> <body onload="BerhasilMemperbaharui()"></body><?php
			}else if ($_SESSION['status_operasi_pg']=="gagal_mengupdate") {
				?> <body onload="GagalMemperbaharui()"></body><?php
			}
		}

		if (isset($_POST['perbaharui'])) {
			//jika tombol submit ditekan maka excute fungsi ini
			EditDataPegawai();
			if ($_SESSION['status_operasi_pg']=="berhasil_memperbaharui") {
				?> <body onload="BerhasilMemperbaharui()"></body><?php
			}else if ($_SESSION['status_operasi_pg']=="gagal_memperbaharui") {
				?> <body onload="GagalMemperbaharui()"></body><?php
			}
		}

		if (!empty($_GET['id_user'])) {
			HapusDataPegawai();
			if ($_SESSION['status_operasi_pg']=="berhasil_menghapus") {
				?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../pegawai/"><?php
			}else if ($_SESSION['status_operasi_pg']=="gagal_menghapus") {
				?> <body onload="GagalMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../pegawai/"><?php
			}
		}
		?>
			<title>Profil</title>
			
			<!-- Content Header (Page header) -->
			<section class="content-header">
			  	<h1>
			    	Profil Pegawai
			    	<small></small>
			  	</h1>
			  	<ol class="breadcrumb">
			    	<li class="active"><i class="fa fa-users"></i> Profil Pegawai</li>
			  	</ol>
			</section>

			<!-- Main content -->
		    <section class="content">
		      	<div class="row">
		        	<div class="col-xs-12">
		        		<?php 
							if (isset($_SESSION['jabatan'])) {
								$username = $_SESSION['username'];
								$jab = $_SESSION['jabatan'];
								
								//Get Data Pegawai 
								$sql = "SELECT pegawai.id_pegawai, pegawai.nama, pegawai.jabatan, user.id_user, user.username FROM pegawai, user WHERE pegawai.jabatan='$jab' AND pegawai.status_hapus ='1' AND user.id_user=pegawai.id_user";							
								$stmt = $db->prepare($sql);
								$stmt->execute();

								$stmt->bind_result($id_pegawai, $nama, $jabatan, $id_user, $username);
								$stmt->fetch();
								?>
								<form method="post" action="">
									<div class="box box-primary">
					            		<div class="box-header with-border">
					              			<h3 class="box-title">Update</h3>
					              			<div class="box-tools pull-right">
									            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									         </div>
					            		</div>
							            <!-- /.box-header -->
							            <div class="box-body">
								            <form action="" method="post">
												<div class="box-body">
										      		<div class="row">
														<div class="col-md-6">
												      		<div class="form-group has-feedback">
												      			<input type="text" name="id_user" value="<?php echo $id_user; ?>" hidden>
												        		<input type="text" name="id_pegawai" class="form-control" placeholder="ID Pegawai" value="<?php echo $id_pegawai; ?>" disabled>
												        		<span class="glyphicon glyphicon-exclamation-sign form-control-feedback"></span>
												      		</div>
												      	</div>
														<div class="col-md-6">
												      		<div class="form-group has-feedback">
												        		<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
												        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
												      		</div>
												      	</div>
														<div class="col-md-6">
												      		<div class="form-group has-feedback">
												        		<input type="text" name="nama" class="form-control" placeholder="Nama Pegawai" value="<?php echo $nama; ?>" disabled>
												        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
												      		</div>
												      	</div>
														<div class="col-md-6">
												      		<div class="form-group has-feedback">
												        		<input type="password" name="password" class="form-control" placeholder="Password">
												        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
												      		</div>
												      	</div>
														<div class="col-md-6">
									  						<div class="form-group">
									    						<select name="jabatan" class="form-control select2" style="width: 100%;" disabled>
									      							<option value="value="<?php if($jabatan=="direktur") echo 'selected="selected"' ; ?>">Direktur</option>
												                  	<option value="value="<?php if($jabatan=="pemasaran") echo 'selected="selected"' ; ?>">Pemasaran</option>
												                  	<option value="value="<?php if($jabatan=="inventori") echo 'selected="selected"' ; ?>">Inventori</option>
												                  	<option value="value="<?php if($jabatan=="administrasi") echo 'selected="selected"' ; ?>">Administrasi</option>
												                </select>
									  						</div>
														</div>
										        		<div class="col-md-2">
										          			<button type="submit" name="update_akun" class="btn btn-primary btn-block btn-flat">Update</button>
										        		</div>
										      		</div>
										      	</div>
									    	</form>
							            </div>
							            <!-- /.box-body -->
								    </div>
								    <!-- /.box -->
								</form>    
								<?php
							}
						?>	
					</div>
					<!-- /.col -->	
				</div>
				<!-- /.row -->
			</section>					
		<?php
	}else{
		//alihkan url jika bukan manager
		?><meta http-equiv="refresh" content="0;url=../login/"><?php
	}

	CloseSidebar();
	?>