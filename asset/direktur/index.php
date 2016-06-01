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

	<title>Halaman Utama</title>
	
	<section class="content-header">
      	<h1>
        	Halaman Utama
        	<small>Direktur</small>
      	</h1>
      	<ol class="breadcrumb">
        	<li class="active"><i class="fa fa-dashboard"></i> Halaman Utama</li>
      	</ol>
	</section>

	<?php
		//jika manager yang masuk
		if (!empty($user_check) AND $jabatan == "direktur") {
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
									<center>
										<h2>Selamat Datang, <small><?php echo $nama_pegawai; ?></small></h2>
										<!-- Small boxes (Stat box) -->
								      	<div class="row">
								        	<div class="col-lg-3 col-xs-6">
								          	<!-- small box -->
								          		<div class="small-box bg-yellow">
								            		<div class="inner">
								            			<?php
								            				$sql = "SELECT COUNT(id) FROM pegawai";
								            				$stmt = mysqli_query($db, $sql);

															while($data = mysqli_fetch_array($stmt)){
																echo "<h3>". $data[0] . "</h3>";
															}
								            			?>
								              			<p>Pegawai</p>
								            		</div>
								            		<div class="icon">
								              			<i class="ion ion-person-add"></i>
								            		</div>
								            		<a href="../pegawai/" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
								          		</div>
								        	</div>
								        	<!-- ./col -->
								        	<div class="col-lg-3 col-xs-6">
								          	<!-- small box -->
								          		<div class="small-box bg-gray">
								            		<div class="inner">
								            			<?php
								            				$sql = "SELECT COUNT(id_kategori) FROM kategori_produk";
								            				$stmt = mysqli_query($db, $sql);

															while($data = mysqli_fetch_array($stmt)){
																echo "<h3>". $data[0] . "</h3>";
															}
								            			?>
								              			<p>Kategori Produk</p>
								            		</div>
								            		<div class="icon">
								              			<i class="fa fa-list-alt"></i>
								            		</div>
								            		<a href="../kategori_produk/" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
								          		</div>
								        	</div>
								        	<!-- ./col -->
								        	<div class="col-lg-3 col-xs-6">
								          	<!-- small box -->
								          		<div class="small-box bg-aqua">
								            		<div class="inner">
								            			<?php
								            				$sql = "SELECT COUNT(id_produk) FROM produk";
								            				$stmt = mysqli_query($db, $sql);

															while($data = mysqli_fetch_array($stmt)){
																echo "<h3>". $data[0] . "</h3>";
															}
								            			?>
								              			<p>Produk</p>
								            		</div>
								            		<div class="icon">
								              			<i class="ion ion-bag"></i>
								            		</div>
								            		<a href="../produk/" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
								          		</div>
								        	</div>
								        	<!-- ./col -->
								        	<div class="col-lg-3 col-xs-6">
								          	<!-- small box -->
								          		<div class="small-box bg-green">
								            		<div class="inner">
								            			<?php
								            				$sql = "SELECT COUNT(id_transaksi) FROM transaksi";
								            				$stmt = mysqli_query($db, $sql);

															while($data = mysqli_fetch_array($stmt)){
																echo "<h3>". $data[0] . "</h3>";
															}
								            			?>
								              			<p>Data Transaksi</p>
								            		</div>
								            		<div class="icon">
								              			<i class="fa fa-money"></i>
								            		</div>
								            		<a href="../transaksi/" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
								          		</div>
								        	</div>
								        	<!-- ./col -->
								        	<div class="col-lg-3 col-xs-6">
								          	<!-- small box -->
								          		<div class="small-box bg-red">
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
								        	<div class="col-lg-3 col-xs-6">
								          	<!-- small box -->
								          		<div class="small-box bg-green">
								            		<div class="inner">
								            			<?php
								            				$sql = "SELECT COUNT(id_pemesanan) FROM pemesanan";
								            				$stmt = mysqli_query($db, $sql);

															while($data = mysqli_fetch_array($stmt)){
																echo "<h3>". $data[0] . "</h3>";
															}
								            			?>
								              			<p>Data Pemesanan</p>
								            		</div>
								            		<div class="icon">
								              			<i class="fa fa-money"></i>
								            		</div>
								            		<a href="../pemesanan/" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
								          		</div>
								        	</div><div class="col-lg-3 col-xs-6">
								          	<!-- small box -->
								          		<div class="small-box bg-yellow">
								            		<div class="inner">
								            			<?php
								            				$sql = "SELECT COUNT(id_keluhan) FROM keluhan";
								            				$stmt = mysqli_query($db, $sql);

															while($data = mysqli_fetch_array($stmt)){
																echo "<h3>". $data[0] . "</h3>";
															}
								            			?>
								              			<p>Keluhan dan Saran</p>
								            		</div>
								            		<div class="icon">
								              			<i class="fa fa-star"></i>
								            		</div>
								            		<a href="../keluhan/" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
								          		</div>
								        	</div>
								        	<!-- ./col -->
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
								      	</div>
								      	<!-- /.row -->
									</center>
								</div>
							</div>
						</div>		
					</div>
				</section>					
			<?php
		}else{
			//alihkan url jika bukan direktur
			?><meta http-equiv="refresh" content="0;url=../login/"> <?php
		}

		CloseSidebar();
	?>