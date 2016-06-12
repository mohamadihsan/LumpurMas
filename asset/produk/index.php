<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/produk/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	//jika manager yang masuk
	if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="inventori" OR $jabatan=="administrasi") {

			if (isset($_POST['simpan'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					TambahDataProduk();
					if ($_SESSION['status_operasi_p']=="berhasil_menyimpan") {
						?> <body onload="BerhasilMenyimpan()"></body><?php
					}else if ($_SESSION['status_operasi_p']=="gagal_menyimpan") {
						?> <body onload="GagalMenyimpan()"></body><?php
					}
				}

				if (isset($_POST['perbaharui'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditDataProduk();
					if ($_SESSION['status_operasi_p']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}else if ($_SESSION['status_operasi_p']=="gagal_memperbaharui") {
						?> <body onload="GagalMemperbaharui()"></body><?php
					}
				}

				if (!empty($_GET['id_produk'])) {
					HapusDataProduk();
					if ($_SESSION['status_operasi_p']=="berhasil_menghapus") {
						?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../produk/"><?php
					}else if ($_SESSION['status_operasi_p']=="gagal_menghapus") {
						?> <body onload="GagalMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../produk/"><?php
					}
				}
		?>
		
		<title>Produk</title>

		<!-- Content Header (Page header) -->
		<section class="content-header">
		  	<h1>
		    	Produk
		    	<small></small>
		  	</h1>
		  	<ol class="breadcrumb">
		    	<li class="active"><i class="fa fa-tasks"></i> Produk</li>
		  	</ol>
		</section>

		<!-- Main content -->
	    <section class="content">
	      	<div class="row">
	        	<div class="col-xs-12">
					
					<?php
					//Jika pegawai inventori yang masuk
					if ($jabatan=="inventori") {
						//select kategori
						$sql = "SELECT id_kategori, nama_kategori FROM kategori_produk";							
						$stmt = $db->prepare($sql);
						$stmt->execute();

						$stmt->bind_result($id_kategori, $nama_kategori);
						
					?>
					<div class="box box-primary">
	            		<div class="box-header with-border">
	              			<h3 class="box-title">Tambah Data</h3>
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
				              			<!-- /.form-group -->
				              			<div class="form-group">
											<input class="form-control" id="kode_produk" type="text" name="kode_produk" placeholder="Kode Produk" required>							                		
				              			</div>
				              			<div class="form-group">
						                	<select class="form-control select2" style="width: 100%;" name="kategori" required>
						                		<option selected="selected">Kategori Produk</option>
						                		<?php
													while ($stmt->fetch()) {
														?>
															<option value="<?php echo $id_kategori;?>"><?php echo $nama_kategori; ?></option>
														<?php
													}
												?>
						                	</select>
						              	</div>
				              			<!-- /.form-group -->
				              			<div class="form-group">
				              				<label>Status Produk</label>
						                	<select class="form-control select2" style="width: 100%;" name="status_produk" required>
						                		<option selected="selected" value="TD">Tidak Diskon dan Tidak Begaransi</option>
						                		<option value="G">Bergaransi</option>
						                		<option value="D">Diskon</option>
						                		<option value="DG">Diskon Bergaransi</option>
						                	</select>
						              	</div>
				              			<!-- /.form-group -->
				              			<div class="form-group">
				              				<label>Diskon</label>
						                	<select class="form-control select2" style="width: 20%;" name="diskon" required>
						                		<option selected="selected" value="0">0%</option>
						                		<option value="10">10%</option>
						                		<option value="15">15%</option>
						                		<option value="20">20%</option>
						                		<option value="25">25%</option>
						                		<option value="30">30%</option>
						                		<option value="35">35%</option>
						                		<option value="40">40%</option>
						                		<option value="45">45%</option>
						                		<option value="50">50%</option>
						                		<option value="55">55%</option>
						                		<option value="60">60%</option>
						                		<option value="65">65%</option>
						                		<option value="70">70%</option>
						                		<option value="75">75%</option>
						                		<option value="80">80%</option>
						                		<option value="85">85%</option>
						                		<option value="90">90%</option>
						                	</select>
						              	</div>
				              			<!-- /.form-group -->
				            		</div>
				            		<!-- /.col -->
						            <div class="col-md-6">
						              	<div class="form-group">
						                	<input class="form-control" id="nama_produk" name="nama_produk" type="text" placeholder="Nama Produk" required>
						              	</div>
						              	<!-- /.form-group -->
						              	<div class="form-group">
						                	<input class="form-control" id="harga" type="text" name="harga" placeholder="Harga Rp.0,00" required>
						              	</div>
				              			<!-- /.form-group -->
				              			<div class="form-group">
						                  	<label for="gambar_produk">Gambar Produk</label>
						                  	<input type="file" name="gambar_produk" id="gambar_produk">

						                  	<p class="help-block">Format : jpeg,png</p>
						                </div>
				            		</div>
				            		<div class="col-md-1"><button class="btn btn-primary" name="simpan">Simpan</button></div>
					        	</div>
					        	<!-- /.box-body -->
						    </form>
						</div>
					</div>	    
						<?php
					}

					//Tampilkan Data Produk 
					$sql = "SELECT id_produk, kode_produk, nama_produk, harga, status_produk, diskon, nama_kategori, url FROM produk, kategori_produk WHERE produk.id_kategori = kategori_produk.id_kategori";							
					$stmt = $db->prepare($sql);
					$stmt->execute();

					$stmt->bind_result($id_produk, $kode_produk, $nama_produk, $harga, $status_produk, $diskon, $nama_kategori, $url);

					$file_path = '../gambar/produk/';

					?>
					<div class="box">
	            		<div class="box-header with-border">
	              			<h3 class="box-title">Daftar Produk</h3>
	            		</div>
			            <!-- /.box-header -->
			            <div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Kode Produk</th>
										<th>Nama Produk</th>
										<th>Harga</th>
										<th>Kategori</th>
										<th>Status</th>
										<th>Gambar Produk</th>
										<?php
											if ($jabatan=="inventori") {
												?>
													<th></th>
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
										<td><?php echo $kode_produk; ?></td>
										<td><?php echo $nama_produk; ?></td>
										<td>
											<?php 
												//format rupiah
												$jumlah_desimal ="2";
												$pemisah_desimal =",";
												$pemisah_ribuan =".";

												echo "Rp." .number_format($harga, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); 
											?>
										</td>
										<td><?php echo $nama_kategori; ?></td>
										<td>
											<?php 
												if ($status_produk=="TD") {
													echo "Tidak Diskon dan Tidak Garansi";
												}else if ($status_produk=="D") {
													echo "Diskon (<font color='green'>" .$diskon."%</font>)";
												}else if ($status_produk=="G") {
													echo "Garansi";
												}else if ($status_produk=="DG") {
													echo " Garansi & Diskon (<font color='green'>".$diskon."%</font>)";
												}  
											?>
										</td>
										<td align="center"><img src="<?php echo $file_path.$url; ?>" alt="" height="100" width="100"></td>
										<?php
											if ($jabatan=="inventori") {
												?>
													<td><a href="edit.php?id_produk=<?php echo $id_produk;?>"><i class="fa fa-pencil"></i> Edit</a></td>
													<td><a href="index.php?id_produk=<?php echo $id_produk;?>"><i class="fa fa-trash-o"></i> Hapus</a></td>
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