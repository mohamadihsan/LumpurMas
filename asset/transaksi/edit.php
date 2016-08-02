<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/transaksi/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	//jika manager yang masuk
	if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="administrasi") {

  			$id = $_GET['id_transaksi'];

			//get data transaksi 
			$sql_trans = "SELECT detail_transaksi.id_transaksi, detail_transaksi.id_produk, detail_transaksi.jumlah_beli FROM transaksi, detail_transaksi WHERE transaksi.id_transaksi=$id";							
			$result = mysqli_query($db, $sql_trans);
			$i=0;
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$tgl_transaksi[$i] = $row['tgl_transaksi'];
				$id_transaksi[$i] = $row['id_transaksi'];
				$id_produk_lama[$i] = $row['id_produk'];
				$jumlah_beli[$i] = $row['jumlah_beli'];
      			$i++;
			}

			
			//get data transaksi
			$sql = "SELECT tgl_transaksi, nama_garansi, telp_garansi FROM transaksi WHERE id_transaksi=$id";							
			$stmt = $db->prepare($sql);
			$stmt->execute();

			$stmt->bind_result($tgl_transaksi, $nama_garansi, $telp_garansi);
			$stmt->fetch();
			$stmt->close();
			
		?>
		
		<title>Transaksi</title>

		<!-- Content Header (Page header) -->
		<section class="content-header">
		  	<h1>
		    	Transaksi
		    	<small></small>
		  	</h1>
		  	<ol class="breadcrumb">
		    	<li class="active"><i class="fa fa-tasks"></i> Edit Transaksi</li>
		  	</ol>
		</section>

		<!-- Main content -->
	    <section class="content">
	      	<div class="row">
	        	<div class="col-xs-12">
					
					<?php
					//Jika pegawai inventori yang masuk
					if ($jabatan=="administrasi") { ?>
					<div class="box box-primary">
	            		<div class="box-header with-border">
	              			<center>
	              				<h3 class="box-title"><strong>Lumpur Mas</strong></h3><br>
	              			</center>
	              			<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse"></button>
					         </div>
	            		</div>
	            		<!-- /.box-header -->
			            <div class="box-body">
							<form method="post" action="" enctype="multipart/form-data">
					        	<!-- /.box-header -->
					        	<div class="box-body">
					        		<div class="col-md-8"></div>
					        		<div class="col-md-4">
						            	<div class="form-group">
				              				<label>
				              					<h5><strong>Tanggal</strong></h5>
				              				</label>	
											<input class="form-control" id="tanggal" type="text" name="tanggal" value="<?php echo Tanggal($tgl_transaksi); ?>" disabled>	
				              			</div>
					        		</div>
				            		<div class="col-md-6">
				            			<!-- /.form-group -->
				              			<div class="col-md-10">
				              				<label>Produk</label>
				              			</div>
				              			<div class="col-md-2">
				              				<label>Qty</label>
				              			</div>
				              			<div id="tambah_produk">
			              					<div class="col-md-10">
					              				<div class="form-group">
					              					<?php
					              						//select produk
														$sql = "SELECT id_produk, nama_produk, harga, status_produk, url, id_kategori, kode_produk FROM produk WHERE status_hapus='1' ORDER BY nama_produk ASC";							
														$stmt = $db->prepare($sql);
														$stmt->execute();

														$stmt->bind_result($id_produk, $nama_produk, $harga, $status_produk, $url, $id_kategori, $kode_produk);
					              					?>
								                	<select class="form-control select" style="width: 100%;" name="produk[]" required>
								                		<?php
															while ($stmt->fetch()) {
																?>
																	<option value="<?php echo $id_produk;?>"><?php echo $nama_produk; if($status_produk == "DG" OR $status_produk == "G") echo "(Garansi)"; ?></option>
																<?php
															}
															$stmt->close();
														?>
								                	</select>
								              	</div>
						              			<!-- /.form-group -->
					              			</div>
					              			<div class="col-md-2">
					              				<div class="form-group">
					              					<input class="form-control" type="number" name="jumlah_beli[]" placeholder="0" min="1" required="">
					              				</div>
					              			</div>
				              			</div>
				              			
					              		<div class="col-md-12" align="right">
					              			<a href="javascript:TambahProduk()"><i class="fa fa-plus"></i> Tambah Produk</a>
					              		</div>	
				            		</div>
				            		<!-- /.col -->
						            <div class="col-md-6">
						            	<div class="form-group">
				              				<fieldset>
				              					<legend>Data Pelanggan</legend>	
				              				</fieldset>								                		
				              			</div>
				              			<div class="form-group">
				              				<label>Nama</label>
											<input class="form-control" id="nama_garansi" type="text" name="nama_garansi" placeholder=" Masukkan Nama Pelanggan" value="<?php echo $nama_garansi; ?>" disabled>							                		
				              			</div>
				              			<div class="form-group">
				              				<label>No. Telp</label>
											<input class="form-control" id="telp_garansi" type="number" name="telp_garansi" placeholder="Masukkan No. Telp Pelanggan : 08xxxxx" value="<?php echo $telp_garansi; ?>" disabled>							                		
				              			</div>
				            		</div> 
				            		<div class="col-md-12"><button class="btn btn-primary" name="update">Update Transaksi</button></div>
					        	</div>
					        	<!-- /.box-body -->
						    </form>
						</div>
					</div>	    
						<?php
					}?>
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