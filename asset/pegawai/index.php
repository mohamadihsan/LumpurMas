<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/register/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
		
	//jika manager yang masuk
	if (!empty($user_check) AND $jabatan == "manager") {
		?>
			<!-- Content Header (Page header) -->
			<section class="content-header">
			  	<h1>
			    	Pegawai
			    	<small></small>
			  	</h1>
			  	<ol class="breadcrumb">
			    	<li class="active"><i class="fa fa-users"></i> Pegawai</li>
			  	</ol>
			</section>

			<!-- Main content -->
		    <section class="content">
		      	<div class="row">
		        	<div class="col-xs-12">
						<div class="box box-primary">
		            		<div class="box-header with-border">
		              			<h3 class="box-title">Buat Akun Baru</h3>
		              			<div class="box-tools pull-right">
						            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						         </div>
		            		</div>
				            <!-- /.box-header -->
				            <div class="box-body">
				            <?php
				            	if (!empty($_SESSION['username']) AND !empty($_SESSION['jabatan'])) {
									FormRegister();
								}else{
									FormRegisterPengunjung();
								}
				            ?>
				            </div>
				            <!-- /.box-body -->
					    </div>
					    <!-- /.box -->
				
						<?php
							$jab = $_SESSION['jabatan'];
							//Tampilkan Data Pegawai 
							$sql = "SELECT id_pegawai, nama, jabatan FROM pegawai WHERE jabatan!='$jab'";							
							$stmt = $db->prepare($sql);
							$stmt->execute();

							$stmt->bind_result($id_pegawai, $nama, $jabatan);
						?>	
						<div class="box">
		            		<div class="box-header with-border">
		              			<h3 class="box-title">Data Pegawai </h3>
		            		</div>
				            <!-- /.box-header -->
				            <div class="box-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>ID Pegawai</th>
											<th>Nama</th>
											<th>Jabatan</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>	
									<?php
									while ($stmt->fetch()) {
									?>
									<tr>
										<td><?php echo $id_pegawai; ?></td>
										<td><?php echo $nama; ?></td>
										<td><?php echo $jabatan; ?></td>
										<td><a href="edit_pegawai.php?id_pegawai=<?php echo $id_pegawai;?>"><i class="fa fa-pencil"></i> Edit</a></td>
										<td><a href="hapus_pegawai.php?id_user=<?php echo $id_user;?>"><i class="fa fa-trash"></i> Hapus</a></td>
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
		header('location:../login/');
	}

	CloseSidebar();
	?>