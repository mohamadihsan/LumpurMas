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
	
		//jika manager yang masuk
		if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="inventori") {

				if (isset($_POST['simpan'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					TambahDataKategoriProduk();
					if ($_SESSION['status_operasi_kp']=="berhasil_menyimpan") {
						?> <body onload="BerhasilMenyimpan()"></body><?php
					}
				}

				if (isset($_POST['perbaharui'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditDataKategoriProduk();
					if ($_SESSION['status_operasi_kp']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}
				}

				if (!empty($_GET['id_kategori'])) {
					HapusDataKategoriProduk();
					if ($_SESSION['status_operasi_kp']=="berhasil_menghapus") {
						?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../kategori_produk/"><?php
					}
				}
			?>

			<title>Kategori Produk</title>

			<!-- Content Header (Page header) -->
			<section class="content-header">
			  	<h1>
			    	Kategori Produk
			    	<small></small>
			  	</h1>
			  	<ol class="breadcrumb">
			    	<li class="active"><i class="fa fa-list-alt"></i> Kategori Produk</li>
			  	</ol>
			</section>

			<!-- Main content -->
		    <section class="content">
		      	<div class="row">
		        	<div class="col-xs-12">

						<?php
						//Jika pegawai inventori yang masuk
						if ($jabatan=="inventori") {					
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
					            		<div class="col-md-6">
					              			<!-- /.form-group -->
					              			<div class="form-group">
												<input class="form-control" id="nama_kategori" type="text" name="nama_kategori" placeholder="Nama Kategori" required>							                		
					              			</div>
					              			<!-- /.form-group -->
					            		</div>
					            		<div class="col-md-12"><button class="btn btn-primary" name="simpan">Simpan</button></div>
					            		<!-- /.col -->
								    </form>
								</div>
							    <!-- /.box-body -->    
							</div>
							<!-- /.box -->  	
							<?php
						}
						?>	

		          		<div class="box">
		            		<div class="box-header with-border">
		              			<h3 class="box-title">Daftar Kategori Produk</h3>
		            		</div>
				            <!-- /.box-header -->
				            <div class="box-body">
								<table id="example1" class="table table-bordered table-striped">
					                <thead>
					                <tr>
					                  	<th>Nama Kategori</th>
					                  	<?php
											if ($jabatan=="inventori") {
												?>
												<th width="10%"></th>
												<th width="10%"></th>
												<?php
											}
										?>
					                </tr>
					                </thead>
					                <tbody>
					                <?php
					                	//Tampilkan Data Produk 
										$sql = "SELECT id_kategori, nama_kategori FROM kategori_produk";							
										$stmt = $db->prepare($sql);
										$stmt->execute();

										$stmt->bind_result($id_kategori, $nama_kategori);

										while ($stmt->fetch()) {
										?>
										<tr>
											<td><?php echo $nama_kategori; ?></td>
											<?php
												if ($jabatan=="inventori") {
													?>
														<td><a href="edit.php?id_kategori=<?php echo $id_kategori;?>"><i class="fa fa-pencil"></i> Edit</a></td>
														<td><a href="index.php?id_kategori=<?php echo $id_kategori;?>"><i class="fa fa-trash-o"></i> Hapus</a></td>
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
			<!-- /.content -->
	  		<?php
	  		
	  		CloseSidebar();

		}else{
			//alihkan url jika bukan manager
			?><meta http-equiv="refresh" content="0;url=../login/"><?php
		}
	?>