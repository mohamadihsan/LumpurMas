<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../fungsi/sidebar/index.php';
	include '../../koneksi/koneksi.php';

	//get id_kategori
	$id_kategori = $_GET['id_kategori'];

	//select data kategori
	$sql = "SELECT id_kategori, nama_kategori FROM kategori_produk WHERE id_kategori='$id_kategori'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_kategori, $nama_kategori);
	$stmt->fetch();
	
	Sidebar();
	
	?>

	<title>Kategori Produk</title>

	<section class="content-header">
	  	<h1>
	    	Kategori Produk
	    	<small></small>
	  	</h1>
	  	<ol class="breadcrumb">
	    	<li class="active"><i class="fa fa-list-alt"></i> Kategori Produk</li>
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
						<form method="post" action="../kategori_produk/">
		            		<div class="col-md-6">
		              			<!-- /.form-group -->
		              			<div class="form-group">
									<input class="form-control" id="nama_kategori" type="text" name="nama_kategori" value="<?php echo $nama_kategori; ?>" placeholder="Nama Kategori" required>							       
		              			</div>
		              			<!-- /.form-group -->
		            		</div>
		            		<div class="col-md-6">
		              			<!-- /.form-group -->
		              			<div class="form-group" hidden="">
									<input class="form-control" id="id_kategori" type="text" name="id_kategori" value="<?php echo $id_kategori; ?>" placeholder="ID Kategori">							       
		              			</div>
		              			<!-- /.form-group -->
		            		</div>
		            		<div class="col-md-12"><button class="btn btn-primary" name="perbaharui">Perbaharui</button></div>
		            		<div class="col-md-12">
							</div>	
		            		<!-- /.col -->
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