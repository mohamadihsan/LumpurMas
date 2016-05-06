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
	if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="inventori") {

			if (isset($_POST['simpan'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					TambahDataProduk();
					if ($_SESSION['status_operasi_p']=="berhasil_menyimpan") {
						?> <body onload="BerhasilMenyimpan()"></body><?php
					}
				}

				if (isset($_POST['perbaharui'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditDataProduk();
					if ($_SESSION['status_operasi_p']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}
				}

				if (!empty($_GET['id_produk'])) {
					HapusDataProduk();
					if ($_SESSION['status_operasi_p']=="berhasil_menghapus") {
						?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../produk/"><?php
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
							<form method="post" action="">
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
				            		</div>
				            		<div class="col-md-1"><button class="btn btn-primary" name="simpan">Simpan</button></div>
				            		<div class="col-md-12">
				            		<?php							            		
										if (isset($_POST['simpan'])) {
											//jika tombol submit ditekan maka excute fungsi ini
											TambahDataProduk();
											if ($_SESSION['status_operasi']=="OK") {
												?> <body onload="BerhasilMenyimpan()"></body><?php
											}
										}
									?>
									</div>	
				            		<!-- /.col -->
					        	</div>
					        	<!-- /.box-body -->
						    </form>
						</div>
					</div>	    
						<?php
					}

					//Tampilkan Data Produk 
					$sql = "SELECT id_produk, kode_produk, nama_produk, harga, status_produk, nama_kategori FROM produk, kategori_produk WHERE produk.id_kategori = kategori_produk.id_kategori";							
					$stmt = $db->prepare($sql);
					$stmt->execute();

					$stmt->bind_result($id_produk, $kode_produk, $nama_produk, $harga, $status_produk, $nama_kategori);
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