<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../fungsi/sidebar/index.php';
	include '../../koneksi/koneksi.php';

	//get id_kategori
	$id_kritiksaran = $_GET['id_kritiksaran'];

	//select data produk
	$sql = "SELECT id_kritiksaran, tgl_kritiksaran, status_kritiksaran, isi_kritiksaran, nama, no_telp, email FROM kritiksaran WHERE id_kritiksaran='$id_kritiksaran'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_kritiksaran, $tgl_kritiksaran, $status_kritiksaran, $isi_kritiksaran, $nama, $no_telp, $email);
	$stmt->fetch();
	$stmt->close();
	
	Sidebar();
	
	?>

	<title>Detail Kritik Saran</title>

	<section class="content-header">
	  	<h1>
	    	
	    	<small></small>
	  	</h1>
	  	<ol class="breadcrumb">
	    	<li><a href="../kritik_saran/"><i class="fa fa-list-alt"></i> Kritik&Saran</a></li>
	    	<li class="active">Detail Kritik& Saran</li>
	  	</ol>
	</section>

	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<div class="box box-primary">
            		<div class="box-header with-border">
              			<h3 class="box-title">Detail</h3>
              			<div class="box-tools pull-right">
				         </div>
            		</div>
		            <!-- /.box-header -->
		            <div class="box-body">
			        	<div class="col-md-1">
			        		<label>
			        			Tanggal
			        		</label>
			        	</div>	
				        <div class="col-md-11">
				        	<label>
				        		<?php echo ":   ".Tanggal($tgl_kritiksaran); ?>
				        	</label>	
				        </div>
				        <div class="col-md-1">
			        		<label>
			        			Nama
			        		</label>
			        	</div>	
				        <div class="col-md-11">
				        	<label>
				        		<?php echo ":   ".$nama; ?>
				        	</label>	
				        </div>
				        <div class="col-md-1">
			        		<label>
			        			Pesan
			        		</label>
			        	</div>	
				        <div class="col-md-12">
	                        <div class="control-group form-group">
	                            <div class="controls">
	        						<textarea rows="10" cols="100" class="form-control" placeholder="<?php echo $isi_kritiksaran; ?>" style="resize:none" disabled></textarea>
	        					</div>
	                        </div>
				        </div>
				    </div>    
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