<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/rekomendasi/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	//jika manager yang masuk
	if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="pemasaran") {
		?>
		
		<title>Rekomedasi</title>

		<!-- Content Header (Page header) -->
		<section class="content-header">
		  	<h1>
		    	Rekomendasi
		    	<small></small>
		  	</h1>
		  	<ol class="breadcrumb">
		    	<li class="active"><i class="fa fa-tasks"></i> Rekomendasi</li>
		  	</ol>
		</section>

		<!-- Main content -->
	    <section class="content">
	      	<div class="row">
	        	<div class="col-xs-12">
					
					<?php
					//Tampilkan Data Transaksi 
					$sql = "SELECT nama, no_telp, kategori_produk, status_kirim FROM rekomendasi";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$stmt->bind_result($nama, $no_telp, $kategori_produk, $status_kirim);

					?>
					<div class="box">
	            		<div class="box-header with-border">
	              			<h3 class="box-title">Rekomendasi Kategori Produk untuk Pelanggan</h3>
	            		</div>
			            <!-- /.box-header -->
			            <div class="box-body">
			            	<div class="col-md-12" align="right">
			            		<a href="../analisa_rekomendasi/"><h4><font color="green"><b>=> Update Rekomendasi & Lihat Analisa</b></font></h4></a>
			            	</div>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Nama Pelanggan</th>
										<th>Telp</th>
										<th>Kategori Produk</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>	
									<?php
									while ($stmt->fetch()) {
									?>
									<tr>
										<td><?php echo $nama; ?></td>
										<td><?php echo $no_telp; ?></td>
										<td><?php echo $kategori_produk; ?></td>
										<td>
											<?php 
												if ($status_kirim=="BD") {
													echo "Belum Dikirim";
												}else{
													echo "Sudah Dikirim";
												}
											?>
										</td>
									</tr>	
									<?php
									}				
									?>
								</tbody>
							</table>
							<?php
								if (($jabatan=="pemasaran")AND !empty($status_kirim)) {
									?>
									<div class="col-md-3">
									<form method="post" action="">
										<input class="btn btn-success" type="submit" value="Kirim Rekomendasi ke Semua Pelanggan" name="sms_gateway">
									</form>
									</div>
									<div class="col-md-3">
									<form method="post" action="">
										<input class="btn btn-danger" type="submit" value="Hapus Rekomendasi yang belum di kirim" name="hapus">
									</form>
									</div>
									<?php
									if (isset($_POST['hapus'])) {
										HapusDataRekomendasi();
										if ($_SESSION['status_operasi_rek']=="berhasil_menghapus") {
											?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../rekomendasi/"><?php
										}else if ($_SESSION['status_operasi_rek']=="gagal_menghapus") {
											?> <body onload="GagalMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../rekomendasi/"><?php
										}
									}
								}
							?>
						</div>	
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
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