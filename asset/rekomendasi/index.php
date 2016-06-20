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
				HapusDataRekomendasiBelumDikirim();
				if ($_SESSION['status_operasi_rek']=="berhasil_menghapus") {
					?> <body onload="BerhasilMenghapus()"></body><?php
				}else if ($_SESSION['status_operasi_rek']=="gagal_menghapus") {
					?> <body onload="GagalMenghapus()"></body><?php
				}
			}

			if (isset($_POST['kirim_rekomendasi'])) {
				$sql = "SELECT id, nama, no_telp, kategori_produk FROM rekomendasi WHERE status_kirim='BD'";
				$result = mysqli_query($db, $sql);
				$i=0;
				while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$id[$i] = $rows['id'];
					$nama[$i] = $rows['nama'];
					$no_telp[$i] = $rows['no_telp'];
					$kategori_produk[$i] = $rows['kategori_produk'];

					//cek total transaksi terakhir pelanggan
					$sql = "SELECT total_bayar FROM transaksi WHERE nama_garansi='$nama[$i]' ORDER BY tgl_transaksi DESC LIMIT 1";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$stmt->bind_result($total_bayar);
					$stmt->fetch();
					$stmt->close();

					if (($total_bayar>=200000)AND($total_bayar<=499900)) {
						$diskon = "10%";
						$sql = "SELECT id FROM pesan WHERE jenis='RD' AND status_hapus='1' ORDER BY id ASC LIMIT 1";
						$stmt = $db->prepare($sql);
						$stmt->execute();
						$stmt->bind_result($id_rek);
						$stmt->fetch();
						$stmt->close();
					}else if ($total_bayar>500000) {
						$diskon = "15%";
						$sql = "SELECT id FROM pesan WHERE jenis='RD' AND status_hapus='1' ORDER BY id ASC LIMIT 1";
						$stmt = $db->prepare($sql);
						$stmt->execute();
						$stmt->bind_result($id_rek);
						$stmt->fetch();
						$stmt->close();
					}else{
						$sql = "SELECT id FROM pesan WHERE jenis='R' AND status_hapus='1' ORDER BY id ASC LIMIT 1";
						$stmt = $db->prepare($sql);
						$stmt->execute();
						$stmt->bind_result($id_rek);
						$stmt->fetch();
						$stmt->close();
					}

					//execute
					$status_kirim = "SD";
					//update dari tabel rekomendasi
					$sql = "UPDATE rekomendasi SET status_kirim = ?, id_pesan = ? WHERE id = ?";
					$stmt = $db->prepare($sql);
					$stmt->bind_param('sii', $status_kirim, $id_rek, $id[$i]);
					if($stmt->execute()){
						$_SESSION['status_operasi_kirim_rek'] = "berhasil_mengirim";
					}else{
						$_SESSION['status_operasi_kirim_rek'] = "gagal_mengirim";
					}
					$stmt->close();

					$i++;
				}
				
				if ($_SESSION['status_operasi_kirim_rek']=="berhasil_mengirim") {
					?> <body onload="BerhasilMengirimRekomendasi()"></body><?php
				}else if ($_SESSION['status_operasi_kirim_rek']=="gagal_mengirim") {
					?> <body onload="GagalMengirimRekomendasi()"></body><?php
				}
			}
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
					//Tampilkan Data Pelanggan Rekomendasi 
					$sql = "SELECT nama, no_telp, kategori_produk, status_kirim FROM rekomendasi WHERE status_kirim='BD'";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$stmt->store_result();
					$rows = $stmt->num_rows;
					$stmt->bind_result($nama, $no_telp, $kategori_produk, $status_kirim);

					?>
					<div class="box">
	            		<div class="box-header with-border">
	              			<h3 class="box-title">Rekomendasi Kategori Produk untuk Pelanggan</h3> 
	              			(<a href="../histori_rekomendasi/"><font color="red" size="2sp">Lihat Histori</font></a>)
	            		</div>
			            <!-- /.box-header -->
			            <div class="box-body">
			            	<div class="col-md-12" align="right">
			            		<a href="../analisa_rekomendasi/"><font color="green" size="4sp"><u>Update & Analisa</u></font></a><br><br><br>
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
									$stmt->close();				
									?>
								</tbody>
							</table>
							<?php
								if (($jabatan=="pemasaran")AND !empty($status_kirim)) {
									$sql = "SELECT COUNT(*) FROM rekomendasi WHERE status_kirim='BD'";
									$stmt = $db->prepare($sql);
									$stmt->execute();
									$stmt->bind_result($jml_pelanggan);
									$stmt->fetch();
									$stmt->close();
									?>

									<!-- tampilkan kotak pengiriman pesan -->
									<table>
										<tr>
											<th>
												<div class="col-md-12">
													<a href="#openModal"><button class="btn btn-success" title="Kirim Rekomendasi ke Seluruh Pelanggan">Kirim Rekomendasi</button></a>
												</div>
												<div id="openModal" class="modalDialog">
													<div>
														<form method="post" action="">
															<a href="#close" title="Close" class="close">X</a>
															<center>	
																<h4>Kirim Pesan Rekomendasi</h4>
																<p>Apakah anda yakin ?</p>
																<input type="submit" name="kirim_rekomendasi" class="btn btn-success" value="Ya, kirim">
																<a href="#close"><button class="btn btn-danger">Tidak</button></a><br><br>
																<p>Pesan akan dikirim ke <?php echo $jml_pelanggan;?> pelanggan</p>
															</center>
														</form>	
													</div>
												</div>
											</th>
											<?php
											if ($jml_pelanggan>0) {
												?>
													<th>	
														<form method="post" action="">
															<input class="btn btn-danger" type="submit" value="Hapus" title="Hapus Rekomendasi yang belum di kirim" name="hapus">
														</form>
													</th>
												<?php
											}?>
										</tr>
									</table>			
									<?php
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