<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/tukar_poin/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	//jika manager yang masuk
	if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="administrasi") {

			if (isset($_POST['simpan'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					BeliDenganPoin();
					if ($_SESSION['status_operasi_tr']=="berhasil_update_total_bayar") {
						?> <body onload="TransaksiDitolak()"></body><?php
					}else if ($_SESSION['status_operasi_tr']=="gagal_update_total_bayar") {
						?> <body onload="TerjadiKesalahan()"></body><?php
					}
				}

				if (isset($_POST['perbaharui'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditBeliDenganPoin();
					if ($_SESSION['status_operasi_tr']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}else if ($_SESSION['status_operasi_tr']=="gagal_memperbaharui") {
						?> <body onload="GagalMemperbaharui()"></body><?php
					}
				}

				if (!empty($_GET['id_transaksi'])) {
					HapusDataTransaksiPoin();
					if ($_SESSION['status_operasi_tr']=="berhasil_menghapus") {
						?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../tukar_poin/"><?php
					}else if ($_SESSION['status_operasi_tr']=="gagal_menghapus") {
						?> <body onload="GagalMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../tukar_poin/"><?php
					}
				}
		?>
		
		<title>Tukar Poin</title>

		<!-- Content Header (Page header) -->
		<section class="content-header">
		  	<h1>
		    	Transaksi dengan Tukar Poin
		    	<small></small>
		  	</h1>
		  	<ol class="breadcrumb">
		    	<li class="active"><i class="fa fa-tasks"></i> Tukar Poin</li>
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
					        		<div class="col-md-8"></div>
					        		<div class="col-md-4">
						            	<div class="form-group">
				              				<label>
				              					<h5><strong>Tanggal</strong></h5>
				              				</label>	
											<input class="form-control" id="tanggal" type="date" name="tanggal" required="">	
				              			</div>
					        		</div>
				            		<div class="col-md-6">
				            			<!-- /.form-group -->
				            			<div class="form-group" style="display: none;">
					              			<fieldset>
					              				<legend>Status Produk</legend>

						              				<div class="radio">
														<input id="garansi" type="radio" name="status_garansi" value="G">Ada yang bergaransi
													</div>								                		
						              			
						              				<div class="radio">
														<input id="tidak_garansi" type="radio" name="status_garansi" value="N" checked="">Tidak Garansi
													</div>								                		
						              			
					              			</fieldset>
				              			</div>
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
														$sql = "SELECT id_produk, nama_produk, harga, status_produk, url, id_kategori, kode_produk FROM produk WHERE status_hapus='1' ORDER BY nama_produk ASC";							
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
					              					<input class="form-control" type="number" name="jumlah_beli[]" placeholder="0" min="1" required="">
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
						            		<label>Username</label>
											<div class="form-group">
												<select name="username" class="form-control select2" style="width: 100%;">
													<?php
														//select username
														$sql = "SELECT pelanggan.nama, user.username FROM pelanggan, user WHERE pelanggan.id_user=user.id_user";							
														$stmt = $db->prepare($sql);
														$stmt->execute();

														$stmt->bind_result($nama_pelanggan, $username);

														?>
																<option selected="">Username (Kosong)</option>
														<?php
														
														while ($stmt->fetch()) {
															?>
																<option value="<?php echo $nama_pelanggan;?>"><?php echo $username; ?></option>
															<?php
														}
														$stmt->close();
													?>	
												</select>
											</div>							                		
				              			</div>
				            		</div> 
				            		<div class="col-md-12"><button class="btn btn-primary" name="simpan">Simpan</button></div>
					        	</div>
					        	<!-- /.box-body -->
						    </form>
						</div>
					</div>	    
						<?php
					}

					//Tampilkan Data Transaksi 
					$sql = "SELECT id_transaksi, tgl_transaksi, status_transaksi, nama_garansi, telp_garansi, total_bayar, id_pelanggan FROM transaksi WHERE status_transaksi='P'";							
					$stmt = $db->prepare($sql);
					$stmt->execute();

					$stmt->bind_result($id_transaksi, $tgl_transaksi, $status_transaksi, $nama_garansi, $telp_garansi, $total_bayar, $id_pelanggan);

					?>
					<div class="box">
	            		<div class="box-header with-border">
	              			<h3 class="box-title">Data Transaksi Dengan Penukaran Poin</h3>
	            		</div>
			            <!-- /.box-header -->
			            <div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Tanggal Transaksi</th>
										<th>Nama Pelanggan</th>
										<th>Telp</th>
										<th>Total Bayar</th>
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
										<td><?php echo Tanggal($tgl_transaksi); ?></td>
										<td><?php echo $nama_garansi; ?></td>
										<td><?php echo $telp_garansi; ?></td>
										<td>
											<?php 
												//format rupiah
												$jumlah_desimal ="2";
												$pemisah_desimal =",";
												$pemisah_ribuan =".";

												echo "Rp." .number_format($total_bayar, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); 
											?>
										</td>
										<?php
											if ($jabatan=="administrasi") {
												?>
													<td><a href="detail.php?id_transaksi=<?php echo $id_transaksi;?>"><i class="fa fa-info"></i> Detail</a></td>
													<td><a href="edit.php?id_transaksi=<?php echo $id_transaksi;?>"><i class="fa fa-pencil"></i> Edit</a></td>
													<td><a href="index.php?id_transaksi=<?php echo $id_transaksi;?>"><i class="fa fa-trash-o"></i> Hapus</a></td>
												<?php
											}else if(($jabatan=="manager")OR($jabatan=="direktur")){
												?>
													<td><a href="detail.php?id_transaksi=<?php echo $id_transaksi;?>"><i class="fa fa-info"></i> Detail</a></td>
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