<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../fungsi/pegawai/index.php';
	include '../../fungsi/sidebar/index.php';
	include '../../koneksi/koneksi.php';

	//get id_user
	$id_pegawai = $_GET['id_pegawai'];
	
	if (isset($_POST['simpan'])) {
		//panggil fungsi EditPegawai
		EditDataPegawai();
	}

	//select data pegawai
	$sql = "SELECT id_pegawai,nama,jabatan FROM pegawai WHERE id_pegawai='$id_pegawai'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_pegawai,$nama,$jabatan);
	$stmt->fetch();
	
	Sidebar();
	
	?>

	<title>Pegawai</title>

	<section class="content-header">
      	<h1>
        	Pegawai
        	<small></small>
      	</h1>
      	<ol class="breadcrumb">
        	<li><a href="../pegawai/"><i class="fa fa-users"></i>Pegawai</a></li>
        	<li class="active">Edit Pegawai</li>
      	</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- SELECT2 EXAMPLE -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Perbaharui Data</h3>
			</div>
			<form action="../../index.html" method="post">
				<div class="box-body">
		      		<div class="row">
						<div class="col-md-6">
				      		<div class="form-group has-feedback">
				        		<input type="text" name="id_pegawai" value="<?php echo $id_pegawai; ?>" class="form-control" placeholder="ID Pegawai">
				        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
				      		</div>
				      	</div>	
				      	<div class="col-md-12"></div>
						<div class="col-md-6">	
				      		<div class="form-group has-feedback">
				        		<input type="text" name="nama" value="<?php echo $nama; ?>" class="form-control" placeholder="Nama Pegawai">
				        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
				      		</div>
				      	</div>	
				      	<div class="col-md-12"></div>
						<div class="col-md-6">	
	  						<div class="form-group">
	    						<select name="jabatan" class="form-control select2" style="width: 100%;">
	      							<option selected="selected">Direktur</option>
				                  	<option value="pemasaran">Pemasaran</option>
				                  	<option value="inventori">Inventori</option>
				                  	<option value="administrasi">Administrasi</option>
				                </select>
	  						</div>
						</div>
				      	<div class="col-md-12"></div>
		        		<div class="col-md-2">
		          			<button type="submit" name="perbaharui" class="btn btn-primary btn-block btn-flat">Perbaharui</button>
		        		</div>	
		      		</div>
		      	</div>	
	    	</form>
		</div>
	</section>	
	<?php

	CloseSidebar();				
?>