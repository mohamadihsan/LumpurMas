<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/pemesanan/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	//jika manager yang masuk
	if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="administrasi") {

			if (isset($_POST['simpan'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					TambahDataPemesanan();
					if ($_SESSION['status_operasi_pemesanan']=="berhasil_update_total_bayar") {
						?> <body onload="Berhasil_Update_Total_Bayar()"></body><?php
					}else if ($_SESSION['status_operasi_tr']=="gagal_update_total_bayar") {
						?> <body onload="Gagal_Update_Total_Bayar()"></body><?php
					}
				}

				if (isset($_POST['perbaharui'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditDataPemesanan();
					if ($_SESSION['status_operasi_pemesanan']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}else if ($_SESSION['status_operasi_tr']=="gagal_memperbaharui") {
						?> <body onload="GagalMemperbaharui()"></body><?php
					}
				}

				if (!empty($_GET['id_pemesanan'])) {
					HapusDataPemesanan();
					if ($_SESSION['status_operasi_pemesanan']=="berhasil_menghapus") {
						?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../pemesanan/"><?php
					}else if ($_SESSION['status_operasi_tr']=="gagal_menghapus") {
						?> <body onload="GagalMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../pemesanan/"><?php
					}
				}
		?>
		
		<title>Pemesanan</title>

		<!-- Content Header (Page header) -->
		<section class="content-header">
		  	<h1>
		    	Pemesanan
		    	<small></small>
		  	</h1>
		  	<ol class="breadcrumb">
		    	<li class="active"><i class="fa fa-tasks"></i> Pemesanan</li>
		  	</ol>
		</section>

		<!-- Main content -->
	    <section class="content">
	      	<div class="row">
	        	<div class="col-xs-12">
					
					<?php
					//Jika pegawai inventori yang masuk
					if ($jabatan=="administrasi") { ?>
					<div class="box box-primary">
	            		<div class="box-header with-border">
	              			<center>
	              				<h3 class="box-title"><strong>Lumpur Mas</strong></h3><br>
	              			</center>
	              			<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					         </div>
	            		</div>
	            		<!-- /.box-header -->
			            <div class="box-body">
							<form method="post" action="" enctype="multipart/form-data">
					        	<!-- /.box-header -->
					        	<div class="box-body">
				            		<div class="col-md-6">
				              			<div class="col-md-10">
				              				<label>Produk</label>
				              			</div>
				              			<div class="col-md-2">
				              				<label>Qty</label>
				              			</div>
				              			<div id="tambah_produk">
			              					<div class="col-md-10">
					              				<div class="form-group">
					              					<?php
					              						//select produk
														$sql = "SELECT id_produk, nama_produk, harga, status_produk, url, id_kategori, kode_produk FROM produk ORDER BY nama_produk ASC";							
														$stmt = $db->prepare($sql);
														$stmt->execute();

														$stmt->bind_result($id_produk, $nama_produk, $harga, $status_produk, $url, $id_kategori, $kode_produk);
					              					?>
								                	<select class="form-control select" style="width: 100%;" name="produk[]" required>
								                		<option selected="selected">Pilih Produk</option>
								                		<?php
															while ($stmt->fetch()) {
																?>
																	<option value="<?php echo $id_produk;?>"><?php echo $nama_produk; if($status_produk == "DG" OR $status_produk == "G") echo "(Garansi)"; ?></option>
																<?php
															}
															$stmt->close();
														?>
								                	</select>
								              	</div>
						              			<!-- /.form-group -->
					              			</div>
					              			<div class="col-md-2">
					              				<div class="form-group">
					              					<input class="form-control" type="number" name="jumlah_beli[]" placeholder="0" min="0">
					              				</div>
					              			</div>
				              			</div>
				              			
					              		<div class="col-md-12" align="right">
					              			<a href="javascript:TambahProduk()"><i class="fa fa-plus"></i> Tambah Produk</a>
					              		</div>	
				            		</div>
				            		<!-- /.col -->
						            <div class="col-md-6">
						            	<div class="form-group">
				              				<fieldset>
				              					<legend>Status Pelanggan</legend>
				              					<div class="checkbox">
													<input id="member" type="checkbox" name="member" value="M">Member
												</div>
												<div id="form_username" style="display: none;">
													<div class="form-group">
														<select name="username" class="form-control select2" style="width: 100%;">
															<?php
																//select username
																$sql = "SELECT pelanggan.id_pelanggan, user.username FROM pelanggan, user WHERE pelanggan.id_user=user.id_user";							
																$stmt = $db->prepare($sql);
																$stmt->execute();

																$stmt->bind_result($id_pelanggan, $username);

																?>
																		<option selected="">Username (Kosong)</option>
																<?php
																
																while ($stmt->fetch()) {
																	?>
																		<option value="<?php echo $id_pelanggan;?>"><?php echo $username; ?></option>
																	<?php
																}
																$stmt->close();
															?>
															
														</select>
													</div>
												</div>		
				              				</fieldset>								                		
				              			</div>
				              			<div id="info_pelanggan">
					              			<div class="form-group">
					              				<label>Nama</label>
												<input class="form-control" id="nama_garansi" type="text" name="nama_garansi" placeholder=" Masukkan Nama Pelanggan">							                		
					              			</div>
					              			<div class="form-group">
					              				<label>No. Telp</label>
												<input class="form-control" id="telp_garansi" type="telp" name="telp_garansi" placeholder="Masukkan No. Telp Pelanggan">							                		
					              			</div>
					              		</div>
				            		</div> 
				            		<div class="col-md-12"><button class="btn btn-primary" name="pesan">Pesan</button></div>
					        	</div>
					        	<!-- /.box-body -->
						    </form>
						</div>
					</div>	    
						<?php
					}

					//Tampilkan Data Pemesanan 
					$sql = "SELECT id_pemesanan, tgl_pemesanan, status_pemesanan, total_bayar, tgl_pengambilan, pelanggan.nama FROM pemesanan, pelanggan WHERE pemesanan.id_pelanggan=pelanggan.id_pelanggan";							
					$stmt = $db->prepare($sql);
					$stmt->execute();

					$stmt->bind_result($id_pemesanan, $tgl_pemesanan, $status_pemesanan, $total_bayar, $tgl_pengambilan, $nama_pelanggan);

					?>
					<div class="box">
	            		<div class="box-header with-border">
	              			<h3 class="box-title">Data Pemesanan</h3>
	            		</div>
			            <!-- /.box-header -->
			            <div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Nama Pelanggan</th>
										<th>Status</th>
										<th>Total Bayar</th>
										<th>Tanggal Pemesanan</th>
										<th>Tanggal Pengambilan</th>
										<?php
											if ($jabatan=="administrasi") {
												?>
													<th></th>
													<th></th>
													<th></th>
												<?php
											}else if(($jabatan=="manager")OR($jabatan=="direktur")){
												?>
													<th></th>
												<?php
											}
										?>
									</tr>
								</thead>
								<tbody>	
									<?php
									while ($stmt->fetch()) {
									?>
									<tr>
										<td><?php echo $nama_pelanggan; ?></td>
										<td>
											<?php
												if ($status_pemesanan=="BL") {
												 	echo "Belum Dibayar";
												}else{
												 	echo "Sudah Dibayar";
												} ?>
										</td>
										<td>
											<?php 
												//format rupiah
												$jumlah_desimal ="2";
												$pemisah_desimal =",";
												$pemisah_ribuan =".";

												echo "Rp." .number_format($total_bayar, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); 
											?>
										</td>
										<td><?php echo Tanggal($tgl_pemesanan); ?></td>
										<td><?php echo Tanggal($tgl_pengambilan); ?></td>
										<?php
											if ($jabatan=="administrasi") {
												?>
													<td><a href="detail.php?id_pemesanan=<?php echo $id_pemesanan;?>"><i class="fa fa-info"></i> Detail</a></td>
													<td><a href="edit.php?id_pemesanan=<?php echo $id_pemesanan;?>"><i class="fa fa-pencil"></i> Edit</a></td>
													<td><a href="index.php?id_pemesanan=<?php echo $id_pemesanan;?>"><i class="fa fa-trash-o"></i> Hapus</a></td>
												<?php
											}else if(($jabatan=="manager")OR($jabatan=="direktur")){
												?>
													<td><a href="detail.php?id_pemesanan=<?php echo $id_pemesanan;?>"><i class="fa fa-info"></i> Detail</a></td>
												<?php
											}
										?>
									</tr>	
									<?php
									}				
									?>
								</tbody>
							</table>
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