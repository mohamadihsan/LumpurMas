<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../fungsi/sidebar/index.php';
	include '../../koneksi/koneksi.php';

	//get id_kategori
	$id_produk = $_GET['id_produk'];
	$folder = "../gambar/produk/";

	//select data produk
	$sql = "SELECT id_produk, nama_produk, harga, status_produk, produk.id_kategori, kode_produk, nama_kategori, url FROM produk, kategori_produk WHERE produk.id_kategori=kategori_produk.id_kategori AND id_produk='$id_produk'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_produk, $nama_produk, $harga, $status_produk, $id_kategori, $kode_produk, $nama_kategori, $url);
	$stmt->fetch();
	$stmt->close();
	
	Sidebar();
	
	?>

	<title>Produk</title>

	<section class="content-header">
	  	<h1>
	    	Produk
	    	<small></small>
	  	</h1>
	  	<ol class="breadcrumb">
	    	<li><a href="../produk/"><i class="fa fa-list-alt"></i> Produk</a></li>
	    	<li class="active">Edit Produk</li>
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
						<form method="post" action="../produk/" enctype="multipart/form-data">
				        	<!-- /.box-header -->
				        	<div class="box-body">

			            		<div class="col-md-12" hidden="">
				            		<div class="form-group">
										<input class="form-control" id="id_produk" type="text" name="id_produk" value="<?php echo $id_produk; ?>" placeholder="ID Produk" required>							                		
			              			</div>
			              		</div>
			            		<div class="col-md-6">
			              			<!-- /.form-group -->
			              			<div class="form-group">
										<input class="form-control" id="kode_produk" type="text" name="kode_produk" value="<?php echo $kode_produk; ?>" placeholder="Kode Produk" required>							                	
			              			</div>
			              			<div class="form-group">
					                	<select class="form-control select2" style="width: 100%;" name="kategori" required>
					                		<option selected="selected">Kategori Produk</option>
					                		<?php
					                			$sql = "SELECT id_kategori, nama_kategori FROM kategori_produk";
												$stmt = $db->prepare($sql);
												$stmt->execute();

												$stmt->bind_result($id_kategori_produk, $nama_kategori_produk);
												
												while ($stmt->fetch()) {
													?>
														<option value="<?php echo $id_kategori_produk;?>" <?php if($id_kategori==$id_kategori_produk) echo "selected='selected'"; ?>><?php echo $nama_kategori_produk; ?></option>
													<?php
												}
												$stmt->close();
											?>
					                	</select>
					              	</div>
			              			<!-- /.form-group -->
			            		</div>
			            		<!-- /.col -->
					            <div class="col-md-6">
					              	<div class="form-group">
					                	<input class="form-control" id="nama_produk" name="nama_produk" type="text" value="<?php echo $nama_produk; ?>" placeholder="Nama Produk" required>
					              	</div>
					              	<!-- /.form-group -->
					              	<div class="form-group">
					                	<input class="form-control" id="harga" type="text" name="harga" value="<?php echo $harga; ?>" placeholder="Harga Rp.0,00" required>
					              	</div>
			              			<!-- /.form-group -->
			            		</div>
			            		<div class="col-md-6">
				            		<div class="form-group">
					                  	<label for="gambar_produk">Gambar Produk</label>
					                  	<input type="file" name="gambar_produk" id="gambar_produk">

					                  	<p class="help-block">Format : jpeg,png</p>
					                </div>
					                <button class="btn btn-primary" name="perbaharui">Perbaharui</button>
						        </div>
						        <div class="col-md-6">
						        	<div class="form-group">
						        		<img src="<?php echo $folder.$url; ?>" alt="" width="250" height="250">
						        	</div>
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