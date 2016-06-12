<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../fungsi/sidebar/index.php';
	include '../../koneksi/koneksi.php';

	//get id_kategori
	$id_keluhan = $_GET['id_keluhan'];
	$folder_produk = "../gambar/keluhan/gambar_produk/";
	$folder_struk = "../gambar/keluhan/struk/";

	//select data produk
	$sql = "SELECT id_keluhan, tgl_keluhan, isi_keluhan, pesan_respon, foto_keluhan, foto_struk, status, pesan_respon, pelanggan.nama FROM keluhan, pelanggan WHERE keluhan.id_pelanggan=pelanggan.id_pelanggan AND id_keluhan='$id_keluhan'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_keluhan, $tgl_keluhan, $isi_keluhan, $pesan_respon, $foto_keluhan, $foto_struk, $status, $pesan_respon, $nama);
	$stmt->fetch();
	$stmt->close();
	
	Sidebar();
	
	?>

	<title>Detail Keluhan</title>

	<section class="content-header">
	  	<h1>
	    	
	    	<small></small>
	  	</h1>
	  	<ol class="breadcrumb">
	    	<li><a href="../keluhan/"><i class="fa fa-list-alt"></i> Keluhan</a></li>
	    	<li class="active">Detail Keluhan</li>
	  	</ol>
	</section>

	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<div class="box box-primary">
            		<div class="box-header with-border">
              			<h3 class="box-title">Detail Keluhan</h3>
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
				        		<?php echo ":   ".Tanggal($tgl_keluhan); ?>
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
			        			Status
			        		</label>
			        	</div>	
				        <div class="col-md-11">
				        	<label>
				        		<?php
				        			if ($status=="BR") {
				        			 	echo ": Belum di respon";
				        			}else{
				        				echo ": Sudah di respon";
				        			} 
				        		?>
				        	</label>	
				        </div>
				        <div class="col-md-1">
			        		<label>
			        			Pesan
			        		</label>
			        	</div>	
				        <div class="col-md-11">
				        	<label>
				        		<?php echo ":   ".$isi_keluhan; ?>
				        	</label>	
				        </div>
				        <div class="col-md-6">
			        		<label>
			        			Foto Keluhan
			        		</label>
			        		<img src="<?php echo $folder_produk.$foto_keluhan; ?>" alt="" class="img-responsive">
			        	</div>	
				        <div class="col-md-6">
				        	<label>
				        		Foto Struk Pembelian
				        	</label>	
			        		<img src="<?php echo $folder_struk.$foto_struk; ?>" alt="" class="img-responsive">
				        </div>
				    </div>    
				</div>
				<!-- /.box -->  	
			</div>
			<!-- .col -->
		</div>
		<!-- .row -->

		<div class="row">
        	<div class="col-xs-12">
        		<div class="box box-primary">
            		<div class="box-header with-border">
              			<h3 class="box-title">Kirim Jawaban <font color="red"><?php if ($status=="SR") {
              				echo "(Sudah di respon)";
              			} ?></font></h3>
              			<div class="box-tools pull-right">
				         </div>
            		</div>
		            <!-- /.box-header -->
		            <form action="" method="post">
			            <div class="box-body">
					        <div class="col-md-12">
					        	<div class="control-group form-group">
		                            <div class="controls">
		                            	<?php
		                            		if ($status=="BR") {
		                            			?>
		                            				<textarea rows="10" cols="100" class="form-control" name="pesan_respon" placeholder="Ketikkan pesan balasan....." style="resize:none"></textarea>
		                            			<?php
		                            		}else {
		                            			?>
		                            				<textarea rows="10" cols="100" class="form-control" placeholder="<?php echo $pesan_respon; ?>" style="resize:none"></textarea>
		                            			<?php
		                            		}
		                            	?>
		        					</div>
		                        </div>
					        </div>
					        <?php
	                    		if ($status=="BR") {
	                    			?>
						        	<div class="col-md-12">
						        		<input type="submit" name="balas" value="Balas" class="btn btn-primary">
						        	</div>
						        <?php
						        }?>	
					    </div>  
					</form>      
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