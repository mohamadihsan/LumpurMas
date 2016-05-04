<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/kategori_produk/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	?>
	<section class="content-header">
      	<h1>
        	Kategori Produk
        	<small></small>
      	</h1>
      	<ol class="breadcrumb">
        	<li><a href=""><i class="fa fa-user"></i> Ketegori Produk</a></li>
      	</ol>
	</section>

	<?php
		//jika manager yang masuk
		if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="inventori") {
			?>
				<!-- Main content -->
				<section class="content">
					<!-- SELECT2 EXAMPLE -->
					<div class="box box-default">
					<center>
					</center>
					<center>
						
						<?php
							//Jika pegawai inventori yang masuk
							if ($jabatan=="inventori") {
									
								?>
								<form method="post" action="">
							        <div class="box-header">
							          	<div class="box-tools pull-right">
							            	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							            	<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
							          	</div>
							        	<!-- /.box-header -->
							        	<div class="box-body">
							          		<div class="row">
							          			<div class="box-header with-border">
													<h4 class="box-title" align="left">Tambah Kategori Produk</h5>
													<div class="box-tools pull-right">
										            	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
													</div>
												</div>
												<div class="col-md-3"></div>
							            		<div class="col-md-6">
							              			<!-- /.form-group -->
							              			<div class="form-group">
														<input class="form-control" id="nama_kategori" type="text" name="nama_kategori" placeholder="Nama Kategori" required>							                		
							              			</div>
							              			<!-- /.form-group -->
							            		</div>
							            		<div class="col-md-12"><button class="btn btn-primary" name="simpan">Simpan</button></div>
							            		<div class="col-md-12">
							            		<?php							            		
													if (isset($_POST['simpan'])) {
														//jika tombol submit ditekan maka excute fungsi ini
														TambahDataKategoriProduk();
													}
												?>
												</div>	
							            		<!-- /.col -->
							          		</div>
							          		<!-- /.row -->
							        	</div>
							        </form>
									
									<hr/>	
								<?php
							}

							//Tampilkan Data Produk 
							$sql = "SELECT nama_kategori FROM kategori_produk";							
							$stmt = $db->prepare($sql);
							$stmt->execute();

							$stmt->bind_result($nama_kategori);
						?>
						<center>
							<h2><small>Daftar Kategori Produk</small></h2>
						</center>	
						<table style="width:60%" class="table table-stripped">
							<tr>
								<th>No</th>
								<th>Nama Kategori Produk</th>
								<?php
									if ($jabatan=="inventori") {
										?>
											<th colspan="2"></th>
										<?php
									}
								?>
							</tr>
						<?php
							$no = 1;
							while ($stmt->fetch()) {
							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $nama_kategori; ?></td>
								<?php
									if ($jabatan=="inventori") {
										?>
											<td><a href="edit_kategori_produk.php?id_kategori=<?php echo $id_kategori;?>">Edit</a></td>
											<td><a href="hapus_kategori_produk.php?id_kategori=<?php echo $id_kategori;?>">Hapus</a></td>
										<?php
									}
								?>
							</tr>
							<?php
							}				
						?>
						</table>
					</center>
					<div class="box-footer">
		          		
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