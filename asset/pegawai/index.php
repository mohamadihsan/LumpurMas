<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	?>
	<section class="content-header">
      	<h1>
        	Pegawai
        	<small></small>
      	</h1>
      	<ol class="breadcrumb">
        	<li><a href=""><i class="fa fa-user"></i> Pegawai</a></li>
      	</ol>
	</section>

	<?php
		//jika manager yang masuk
		if (!empty($user_check) AND $jabatan == "manager") {
			?>
				<!-- Main content -->
				<section class="content">
					<!-- SELECT2 EXAMPLE -->
					<div class="box box-default">
					<div class="box-header with-border">
							<h3 class="box-title"><b></b></h3>
							<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
							</div>
					</div>
					<center>
						<h2><small>Daftar Pegawai Lumpur Mas</small></h2>
					</center>
					<div class="col-md-1"></div>
					<div class="col-md-2">
						<a href="tambah_pegawai.php/">
				            <i class="fa fa-plus"></i>
				            <span>Tambah</span>
				        </a>
					</div>
					<center>	
						<?php
							$jab = $_SESSION['jabatan'];
							//Tampilkan Data Pegawai 
							$sql = "SELECT id_pegawai, nama, jabatan FROM pegawai WHERE jabatan!='$jab'";							
							$stmt = $db->prepare($sql);
							$stmt->execute();

							$stmt->bind_result($id_pegawai, $nama, $jabatan);
						?>	
						<table style="width:80%" class="table table-stripped">
							<tr>
								<th>No</th>
								<th>ID Pegawai</th>
								<th>Nama</th>
								<th>Jabatan</th>
								<th colspan="2"></th>
							</tr>
						<?php
							$no = 1;
							while ($stmt->fetch()) {
							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $id_pegawai; ?></td>
								<td><?php echo $nama; ?></td>
								<td><?php echo $jabatan; ?></td>
								<td><a href="edit_pegawai.php?id_pegawai=<?php echo $id_pegawai;?>">Edit</a></td>
								<td><a href="hapus_pegawai.php?id_user=<?php echo $id_user;?>">Hapus</a></td>
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