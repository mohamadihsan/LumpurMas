<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/template_pesan/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
		//jika manager yang masuk
		if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="pemasaran") {

				if (isset($_POST['simpan'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					TambahDataTemplatePesan();
					if ($_SESSION['status_operasi_tp']=="berhasil_menyimpan") {
						?> <body onload="BerhasilMenyimpan()"></body><?php
					}else if ($_SESSION['status_operasi_tp']=="gagal_menyimpan") {
						?> <body onload="GagalMenyimpan()"></body><?php
					}
				}

				if (isset($_POST['perbaharui'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditDataTemplatePesan();
					if ($_SESSION['status_operasi_tp']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}else if ($_SESSION['status_operasi_tp']=="gagal_memperbaharui") {
						?> <body onload="GagalMemperbaharui()"></body><?php
					}
				}

				if (!empty($_GET['id'])) {
					HapusDataTemplatePesan();
					if ($_SESSION['status_operasi_tp']=="berhasil_menghapus") {
						?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../template_pesan/"><?php
					}else if ($_SESSION['status_operasi_tp']=="gagal_menghapus") {
						?> <body onload="GagalMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../template_pesan/"><?php
					}
				}
			?>

			<title>Template Pesan</title>

			<!-- Content Header (Page header) -->
			<section class="content-header">
			  	<h1>
			    	Template Pesan
			    	<small></small>
			  	</h1>
			  	<ol class="breadcrumb">
			    	<li class="active"><i class="fa fa-list-alt"></i> Template Pesan</li>
			  	</ol>
			</section>

			<!-- Main content -->
		    <section class="content">
		      	<div class="row">
		        	<div class="col-xs-12">

						<?php
						//Jika pegawai inventori yang masuk
						if ($jabatan=="pemasaran") {					
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
					            		<div class="col-md-8">
					              			<!-- /.form-group -->
					              			<div class="form-group">
					              				<label>Jenis Pesan</label>
												<select name="jenis" class="form-control select2" required="">
													<option value="R" selected="">Rekomendasi</option>
													<option value="RD">Rekomendasi & Diskon</option>
												</select>							                		
					              			</div>
					              			<div class="form-group">
					              				<label>Isi Pesan</label>
												<textarea name="isi" class="form-control" placeholder="Tulis Pesan..." required="" rows="8"></textarea>							                		
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
		              			<h3 class="box-title">Daftar Template Pesan</h3>
		            		</div>
				            <!-- /.box-header -->
				            <div class="box-body">
								<table id="example1" class="table table-bordered table-striped">
					                <thead>
					                <tr>
					                  	<th>Jenis Pesan</th>
					                  	<th>Isi Pesan</th>
					                  	<?php
											if ($jabatan=="pemasaran") {
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
										$sql = "SELECT id, jenis, isi FROM pesan WHERE status_hapus='1'";							
										$stmt = $db->prepare($sql);
										$stmt->execute();

										$stmt->bind_result($id, $jenis, $isi);

										while ($stmt->fetch()) {
										?>
										<tr>
											<td>
												<?php if ($jenis=="R") {
													echo "Rekomendasi";
												}else if ($jenis=="RD"){
													echo "Rekomendasi & Diskon";
													} ?>
											</td>
											<td><?php echo $isi; ?></td>
											<?php
												if ($jabatan=="pemasaran") {
													?>
														<td><a href="edit.php?id=<?php echo $id;?>"><i class="fa fa-pencil"></i> Edit</a></td>
														<td><a href="index.php?id=<?php echo $id;?>"><i class="fa fa-trash-o"></i> Hapus</a></td>
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