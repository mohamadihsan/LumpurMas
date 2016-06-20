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

			if (isset($_POST['hapus'])) {
				HapusDataRekomendasiSudahDikirim();
				if ($_SESSION['status_operasi_rek']=="berhasil_menghapus") {
					?> <body onload="BerhasilMenghapus()"></body><?php
				}else if ($_SESSION['status_operasi_rek']=="gagal_menghapus") {
					?> <body onload="GagalMenghapus()"></body><?php
				}
			}
		?>
		
		<title>Histori Rekomedasi</title>

		<!-- Content Header (Page header) -->
		<section class="content-header">
		  	<h1>
		    	Histori Rekomendasi
		    	<small></small>
		  	</h1>
		  	<ol class="breadcrumb">
		    	<li><a href="../rekomendasi/"><i class="fa fa-tasks"></i> Rekomendasi</a></li>
		    	<li class="active"><i class="fa fa-tasks"></i> Histori Rekomendasi</li>
		  	</ol>
		</section>

		<!-- Main content -->
	    <section class="content">
	      	<div class="row">
	        	<div class="col-xs-12">
					
					<?php
					//Tampilkan Data Pelanggan Rekomendasi 
					$sql = "SELECT nama, no_telp, kategori_produk, status_kirim, jenis FROM rekomendasi, pesan WHERE status_kirim='SD' AND pesan.id=rekomendasi.id_pesan";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$stmt->store_result();
					$rows = $stmt->num_rows;
					$stmt->bind_result($nama, $no_telp, $kategori_produk, $status_kirim, $jenis);

					?>
					<div class="box">
	            		<div class="box-header with-border">
	              			<h3 class="box-title">Histori Pengiriman Rekomendasi</h3>
	            		</div>
			            <!-- /.box-header -->
			            <div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Nama Pelanggan</th>
										<th>Telp</th>
										<th>Kategori Produk</th>
										<th>Jenis Pesan</th>
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
												if ($jenis=='R') {
												 	echo "Rekomendasi";
												 }else if ($jenis=='RD') {
												 	echo "Rekomendasi + Diskon";
												 } 
											?>
										</td>
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
									$stmt->close();				
									?>
								</tbody>
							</table>
							<?php
								if (($jabatan=="pemasaran")AND !empty($status_kirim)) {
									$sql = "SELECT COUNT(*) FROM rekomendasi WHERE status_kirim='SD'";
									$stmt = $db->prepare($sql);
									$stmt->execute();
									$stmt->bind_result($jml_pelanggan);
									$stmt->fetch();
									$stmt->close();
									if ($jml_pelanggan>0) {
										?>
											<th>	
												<form method="post" action="">
													<input class="btn btn-danger" type="submit" value="Hapus" title="Hapus Histori Pengiriman Rekomendasi " name="hapus">
												</form>
											</th>
										<?php
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