<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/promosi/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	//jika manager yang masuk
	if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="pemasaran") {

			if (isset($_POST['simpan'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					TambahDataPromosi();
					if ($_SESSION['status_operasi_promosi']=="berhasil_menyimpan") {
						?> <body onload="BerhasilMenyimpan()"></body><?php
					}else if ($_SESSION['status_operasi_promosi']=="gagal_menyimpan") {
						?> <body onload="GagalMenyimpan()"></body><?php
					}
				}

				if (isset($_POST['perbaharui'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditDataPromosi();
					if ($_SESSION['status_operasi_promosi']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}else if ($_SESSION['status_operasi_promosi']=="gagal_memperbaharui") {
						?> <body onload="GagalMemperbaharui()"></body><?php
					}
				}

				if (!empty($_GET['id_promosi'])) {
					HapusDataPromosi();
					if ($_SESSION['status_operasi_promosi']=="berhasil_menghapus") {
						?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../promosi/"><?php
					}else if ($_SESSION['status_operasi_promosi']=="gagal_menghapus") {
						?> <body onload="GagalMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../promosi/"><?php
					}
				}
		?>
		
		<title>Promosi</title>

		<!-- Content Header (Page header) -->
		<section class="content-header">
		  	<h1>
		    	Promosi
		    	<small></small>
		  	</h1>
		  	<ol class="breadcrumb">
		    	<li class="active"><i class="fa fa-tasks"></i> Promosi</li>
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
							<form method="post" action="" enctype="multipart/form-data">
					        	<!-- /.box-header -->
					        	<div class="box-body">
				            		<div class="col-md-12">
				              			<!-- /.form-group -->
				              			<div class="form-group">
				              				<label>Masukkan gambar promosi</label>
											<input type="file" name="gambar_promosi" id="gambar_promosi">
						              	</div>
				              			<!-- /.form-group -->
				            		</div>
				            		<!-- /.col -->
				            		<div class="col-md-1"><button class="btn btn-primary" name="simpan">Simpan</button></div>
					        	</div>
					        	<!-- /.box-body -->
						    </form>
						</div>
					</div>	    
						<?php
					}

					//Tampilkan Data Promosi 
					$sql = "SELECT id_promosi, url, status, id_pegawai FROM promosi";							
					$stmt = $db->prepare($sql);
					$stmt->execute();

					$stmt->bind_result($id_promosi, $url, $status, $id_pegawai);
					?>
					<div class="box">
	            		<div class="box-header with-border">
	              			<h3 class="box-title">Daftar Promosi</h3>
	            		</div>
			            <!-- /.box-header -->
			            <div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Gambar Promosi</th>
										<th>Status</th>
										<?php
											if (($jabatan=="manager")AND($jabatan=="direktur")) {
												?>
													<th>Dibuat oleh</th>
												<?php
											}
											if ($jabatan=="pemasaran") {
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
										$folder = "../gambar/promosi/";
									?>
									<tr>
										<td><img src="<?php echo $folder.$url; ?>" class="img-responsive" alt="" height="50" width="500"></td>
										<td><?php 
											if($status=="Y"){
												echo "Sedang Diterbitkan"; 
											}else{
												echo "Tidak Diterbitkan";
											}
											?></td>
										<?php
											if (($jabatan=="manager")AND($jabatan=="direktur")) {
												?>
													<th><?php echo $id_pegawai; ?></th>
												<?php
											}
											if ($jabatan=="pemasaran") {
												?>
													<td>
														<div class="dropdown">
														<button type="button" class="btn btn-primary dropdown-toggle btn-block" data-toggle="dropdown">Action <span class="caret"></span></button>
														<ul class="dropdown-menu" role="menu">
															<li>
																<a href="edit.php?id_promosi=<?php echo $id_promosi;?>"><i class="fa fa-pencil"></i> Edit</a>
															</li>
															<li>	
																<a href="index.php?id_promosi=<?php echo $id_promosi;?>"><i class="fa fa-trash-o"></i> Hapus</a>
															</li>
														</ul>
														</div>	
													</td>
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