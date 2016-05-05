<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	?>
	<section class="content-header">
      	<h1>
        	Halaman Utama
        	<small>Pemasaran</small>
      	</h1>
      	<ol class="breadcrumb">
        	<li><a href=""><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
      	</ol>
	</section>

	<?php
		//jika manager yang masuk
		if (!empty($user_check) AND $jabatan == "pemasaran") {
			?>
				<!-- Main content -->
				<section class="content">
					<!-- SELECT2 EXAMPLE -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title"><b></b></h3>
						</div>
						<div class="box-body">
				      		<div class="row">
		    					<div class="col-md-12">
									<h2>Selamat Datang, <small><?php echo $nama_pegawai; ?></small></h2>
									<!-- Small boxes (Stat box) -->
							      	<div class="row">
							        	<div class="col-lg-3 col-xs-6">
							          	<!-- small box -->
							          		<div class="small-box bg-red">
							            		<div class="inner">
							            			<?php
							            				$sql = "SELECT COUNT(id_promosi) FROM promosi";
							            				$stmt = mysqli_query($db, $sql);

														while($data = mysqli_fetch_array($stmt)){
															echo "<h3>". $data[0] . "</h3>";
														}
							            			?>
							              			<p>Promosi</p>
							            		</div>
							            		<div class="icon">
							              			<i class="fa fa-star"></i>
							            		</div>
							            		<a href="../promosi/" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
							          		</div>
							        	</div>
							        	<!-- ./col -->
							        	<div class="col-lg-3 col-xs-6">
							          	<!-- small box -->
							          		<div class="small-box bg-green">
							            		<div class="inner">
							            			<?php
							            				$sql = "SELECT COUNT(id) FROM rekomendasi";
							            				$stmt = mysqli_query($db, $sql);

														while($data = mysqli_fetch_array($stmt)){
															echo "<h3>". $data[0] . "</h3>";
														}
							            			?>
							              			<p>Rekomendasi</p>
							            		</div>
							            		<div class="icon">
							              			<i class="fa fa-trophy"></i>
							            		</div>
							            		<a href="../rekomendasi/" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
							          		</div>
							        	</div>
							        	<!-- ./col -->
							      	</div>
							      	<!-- /.row -->
								</div>
							</div>
						</div>		
					</div>
				</section>						
			<?php
		}else{
			//alihkan url jika bukan manager
			header('location:../login/');
		}

		CloseSidebar();
	?>