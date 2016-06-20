<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../fungsi/sidebar/index.php';
	include '../../koneksi/koneksi.php';

	//get id
	$id = $_GET['id'];

	//select data kategori
	$sql = "SELECT id, jenis, isi FROM pesan WHERE id='$id'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id, $jenis, $isi);
	$stmt->fetch();
	
	Sidebar();
	
	?>

	<title>Template Pesan</title>

	<section class="content-header">
	  	<h1>
	    	Template Pesan
	    	<small></small>
	  	</h1>
	  	<ol class="breadcrumb">
	    	<li><a href="../template_pesan/"><i class="fa fa-list-alt"></i> Template Pesan</a></li>
	    	<li class="active"><i class="fa fa-list-alt"></i> Template Pesan</li>
	  	</ol>
	</section>

	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<div class="box box-primary">
            		<div class="box-header with-border">
              			<h3 class="box-title">Perbaharui Data</h3>
              			<div class="box-tools pull-right">
				         </div>
            		</div>
		            <!-- /.box-header -->
		            <div class="box-body">
						<form method="post" action="../template_pesan/">
		            		<div class="col-md-6" hidden="">
		              			<!-- /.form-group -->
		              			<div class="form-group">
									<input class="form-control" id="id" type="text" name="id" value="<?php echo $id; ?>" placeholder="ID">							       
		              			</div>
		              			<!-- /.form-group -->
		            		</div>
		            		<div class="form-group">
	              				<label>Jenis Pesan</label>
								<select name="jenis" class="form-control select2" required="">
									<option value="R" <?php if($jenis=="R") echo "selected=selected";?>>Rekomendasi</option>
									<option value="RD" <?php if($jenis=="RD") echo "selected=selected";?>>Rekomendasi & Diskon</option>
								</select>							                		
	              			</div>
	              			<div class="form-group">
	              				<label>Isi Pesan</label>
								<textarea name="isi" class="form-control" placeholder="Tulis Pesan..." required="" rows="8"><?php echo $isi; ?></textarea>							                		
	              			</div>
		            		<div class="col-md-12"><button class="btn btn-primary" name="perbaharui">Perbaharui</button></div>
					    </form>
					</div>
				    <!-- /.box-body -->    
				</div>
				<!-- /.box -->  	
			</div>
			<!-- .col -->
		</div>
		<!-- .row -->
	</section>		
	<?php

	CloseSidebar();				
?>