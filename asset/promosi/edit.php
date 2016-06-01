<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../fungsi/sidebar/index.php';
	include '../../koneksi/koneksi.php';

	//get id_kategori
	$id_promosi = $_GET['id_promosi'];
	$folder = "../gambar/promosi/";

	//select data produk
	$sql = "SELECT id_promosi, url, status FROM promosi WHERE id_promosi='$id_promosi'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_promosi, $url, $status);
	$stmt->fetch();
	$stmt->close();
	
	Sidebar();
	
	?>

	<title>Promosi</title>

	<section class="content-header">
	  	<h1>
	    	Promosi
	    	<small></small>
	  	</h1>
	  	<ol class="breadcrumb">
	    	<li><a href="../promosi/"><i class="fa fa-list-alt"></i> Promosi</a></li>
	    	<li class="active">Edit Promosi</li>
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
						<form method="post" action="../promosi/" enctype="multipart/form-data">
				        	<!-- /.box-header -->
				        	<div class="box-body">

			            		<div class="col-md-12" hidden="">
				            		<div class="form-group">
										<input class="form-control" id="id_promosi" type="text" name="id_promosi" value="<?php echo $id_promosi; ?>" placeholder="ID Promosi" required>							                		
			              			</div>
			              		</div>
			            		<!-- /.col -->
			            		<div class="col-md-6">
						        	<div class="form-group">
						        		<img src="<?php echo $folder.$url; ?>" alt="" class="img-responsive">
						        	</div>
						        </div>    	
					            <div class="col-md-6">
					              	<div class="form-group">
					              		<div class="radio">
					                		<input type="radio" name="status" value="Y" id="terbitkan" <?php if ($status=="Y") {
					                			echo "checked";
					                		} ?>>Terbitkan
					              		</div>
					              	</div>
					              	<div class="form-group">
					              		<div class="radio">
					                		<input type="radio" name="status" value="T" id="tidak_diterbitkan"<?php if ($status=="T") {
					                			echo "checked";
					                		} ?>>Tidak diterbitkan
					              		</div>
					              	</div>
					              	<!-- /.form-group -->
			            		</div>
			            		<div class="col-md-6">
					                <button class="btn btn-primary" name="perbaharui">Perbaharui</button>
						        </div>
				        	</div>
				        	<!-- /.box-body -->
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