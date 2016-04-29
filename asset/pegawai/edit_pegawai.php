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
	<section class="content-header">
      	<h1>
        	Edit Pegawai
        	<small></small>
      	</h1>
      	<ol class="breadcrumb">
        	<li><a href="../pegawai/"><i class="fa fa-user"></i>Pegawai</a></li>
        	<li><a href="">Edit Pegawai</a></li>
      	</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
		<div class="box-header with-border">
				<h3 class="box-title"><b>Edit Pegawai</b></h3>
				<div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				</div>
		</div>
		<form action="../../index.html" method="post">
			<div class="box-body">
	      		<div class="row">
					<div class="col-md-8">
			      		<div class="form-group has-feedback">
			        		<input type="text" name="id_pegawai" value="<?php echo $id_pegawai; ?>" class="form-control" placeholder="ID Pegawai">
			        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
			      		</div>
			      	</div>	
			      	<div class="col-md-12"></div>
					<div class="col-md-8">	
			      		<div class="form-group has-feedback">
			        		<input type="text" name="nama" value="<?php echo $nama; ?>" class="form-control" placeholder="Nama Pegawai">
			        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
			      		</div>
			      	</div>	
			      	<div class="col-md-12"></div>
					<div class="col-md-8">	
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
	        		<div class="col-md-8">
	          			<button type="submit" name="simpan" class="btn btn-primary btn-block btn-flat">Simpan</button>
	        		</div>	
	      		</div>
	      	</div>	
    	</form>
			
		<div class="box-footer">
      		
		</div>
		</div>
	</section>	
	<?php

	CloseSidebar();				
?>