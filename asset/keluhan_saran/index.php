<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/keluhan_saran/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	//jika manager yang masuk
	if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="administrasi") {

			if (isset($_POST['jawab'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					JawabKeluhanSaran();
					if ($_SESSION['status_operasi_ks']=="berhasil_dijawab") {
						?> <body onload="BerhasilDijawab()"></body><?php
					}else if ($_SESSION['status_operasi_ks']=="gagal_dijawab") {
						?> <body onload="GagalDijawab()"></body><?php
					}
				}

				if (isset($_POST['perbaharui'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditDataKeluhanSaran();
					if ($_SESSION['status_operasi_ks']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}else if ($_SESSION['status_operasi_ks']=="gagal_memperbaharui") {
						?> <body onload="GagalMemperbaharui()"></body><?php
					}
				}

				if (!empty($_GET['id'])) {
					HapusDataProduk();
					if ($_SESSION['status_operasi_ks']=="berhasil_menghapus") {
						?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../produk/"><?php
					}else if ($_SESSION['status_operasi_ks']=="gagal_menghapus") {
						?> <body onload="GagalMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../produk/"><?php
					}
				}
		?>
		
		<title>Kuluhan & Saran</title>

		<!-- Content Header (Page header) -->
		<section class="content-header">
		  	<h1>
		    	Keluhan & Saran
		    	<small></small>
		  	</h1>
		  	<ol class="breadcrumb">
		    	<li class="active"><i class="fa fa-comments"></i> Keluhan & Saran</li>
		  	</ol>
		</section>

		<!-- Main content -->
	    <section class="content">
	      	<div class="row">
	      		<div class="col-md-3">

		          	<div class="box box-solid">
			            <div class="box-header with-border">
			              	<h3 class="box-title">Berkas</h3>

			              	<div class="box-tools">
			                	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			              	</div>
			            </div>
		            	<div class="box-body no-padding">
			            	<ul class="nav nav-pills nav-stacked">
				                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Belum Dibalas
				                  	<span class="label label-primary pull-right">12</span></a>
				                </li>
				                <li><a href="#"><i class="fa fa-envelope-o"></i> Sudah Dibalas</a></li>
			             	</ul>
		            	</div>
		            	<!-- /.box-body -->
		          	</div>
		          	<!-- /. box -->
		          	<div class="box box-solid">
		            	<div class="box-header with-border">
		              		<h3 class="box-title">Labels</h3>

		              		<div class="box-tools">
		                		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
		              		</div>
		           		</div>
		            	<div class="box-body no-padding">
			              	<ul class="nav nav-pills nav-stacked">
				                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
				                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
				                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
			              	</ul>
		            	</div>
		            	<!-- /.box-body -->
		          	</div>
		          	<!-- /.box -->
		        </div>
		        <!-- /.col -->
	        	<div class="col-md-9">
					
					<?php

					//Tampilkan Data Keluhan dan Saran 
					$sql = "SELECT subjek, tgl_keluhansaran, isi_keluhansaran, status_keluhansaran, url_foto_struk, url_foto_keluhan, id_pelanggan FROM keluhan_saran ORDER BY status_keluhansaran DESC";							
					$stmt = $db->prepare($sql);
					$stmt->execute();

					$stmt->bind_result($subjek, $tgl_keluhansaran, $isi_keluhansaran, $status_keluhansaran, $url_foto_struk, $url_foto_keluhan, $id_pelanggan);
					?>
					<div class="box box-primary">
	            		<div class="box-header with-border">
	              			<h3 class="box-title"></h3>
	            		</div>
			            <!-- /.box-header -->
			            <div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="15%">Pelanggan</th>
										<th width="20%">Tanggal</th>
										<th width="15%">Subjek</th>
										<th width="30%">Isi</th>
										<?php
											if ($jabatan=="manager") {
												?>
													<th width="5%"></th>
												<?php
											}
											if ($jabatan=="administrasi") {
												?>
													<th width="5%"></th>
													<th width="5%"></th>
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
										<td><?php echo $id_pelanggan; ?></td>
										<td><?php echo Tanggal($tgl_keluhansaran); ?></td>
										<td><?php echo $subjek; ?></td>
										<td><?php echo substr($isi_keluhansaran,0,30)."....."; ?></td>
										<?php
											if ($jabatan=="manager") {
												?>
													<th><center><a href="detail.php?id=<?php echo $id;?>"><i class="fa fa-info"></i></a></center></th>
												<?php
											}
											if ($jabatan=="administrasi") {
												?>
													<td><a href="balas.php?id=<?php echo $id;?>"><i class="fa fa-pencil"></i> Balas</a></td>
													<td><a href="index.php?id=<?php echo $id;?>"><i class="fa fa-trash-o"></i> Hapus</a></td>
												<?php
											}
										?>
									</tr>	
									<?php
									}
									$stmt->close();				
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