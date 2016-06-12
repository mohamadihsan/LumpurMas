<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../fungsi/sidebar/index.php';
	include '../../koneksi/koneksi.php';

	//get id_kategori
	$id_transaksi = $_GET['id_transaksi'];

	//select data produk
	$sql = "SELECT DISTINCT nama_garansi, telp_garansi FROM detail_transaksi, transaksi WHERE detail_transaksi.id_transaksi='$id_transaksi' AND transaksi.id_transaksi=detail_transaksi.id_transaksi";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($nama_garansi, $telp_garansi);
	$stmt->fetch();
	$stmt->close();
	
	Sidebar();
	
	?>

	<title>Detail Transaksi</title>

	<section class="content-header">
	  	<h1>
	    	
	    	<small></small>
	  	</h1>
	  	<ol class="breadcrumb">
	    	<li><a href="../transaksi/"><i class="fa fa-list-alt"></i> Transaksi</a></li>
	    	<li class="active">Detail Transaksi</li>
	  	</ol>
	</section>

	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<div class="box box-primary">
            		<div class="box-header with-border">
              			<h3 class="box-title">Detail Transaksi</h3>
              			<div class="box-tools pull-right">
				         </div>
            		</div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<div class="col-md-6"></div>
			        	<div class="col-md-6">
			        		<fieldset>
			        			<div class="col-md-4">
			        				<label>ID Transaksi</label>
			        			</div>
			        			<div class="col-md-8">
			        				<?php echo " : " . $id_transaksi; ?>
			        			</div>
			        			<div class="col-md-12"></div>
			        			<div class="col-md-4">
			        				<label>Nama Pelanggan</label>
			        			</div>
			        			<div class="col-md-8">
			        				<?php echo " : " . strtoupper($nama_garansi); ?>
			        			</div>

			        			<div class="col-md-12"></div>
			        			<div class="col-md-4">
			        				<label>No. Telp</label>
			        			</div>
			        			<div class="col-md-8">
			        				<?php echo " : " . $telp_garansi; ?>
			        			</div>
			        		</fieldset>
			        	</div>
				        <table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Harga</th>
									<th>Jumlah Beli</th>
									<?php
										if ($jabatan=="administrasi") {
											?>
												<th></th>
												<th></th>
											<?php
										}
									?>
								</tr>
							</thead>
							<tbody>	
								<?php

								//select data produk
								$sql = "SELECT detail_transaksi.id_transaksi, detail_transaksi.id_produk, jumlah_beli, nama_garansi, telp_garansi, nama_produk, kode_produk, harga FROM detail_transaksi, transaksi, produk WHERE detail_transaksi.id_transaksi='$id_transaksi' AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND detail_transaksi.id_produk=produk.id_produk";
								$stmt = $db->prepare($sql);
								$stmt->execute();

								$stmt->bind_result($id_transaksi, $id_produk, $jumlah_beli, $nama_garansi, $telp_garansi, $nama_produk, $kode_produk, $harga);
								while ($stmt->fetch()) {
								?>
								<tr>
									<td><?php echo strtoupper($kode_produk); ?></td>
									<td><?php echo strtoupper($nama_produk); ?></td>
									<td>
										<?php 
											//format rupiah
											$jumlah_desimal ="2";
											$pemisah_desimal =",";
											$pemisah_ribuan =".";

											echo "Rp." .number_format($harga, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); 
										?>
									</td>
									<td><?php echo $jumlah_beli; ?></td>
									<?php
										if ($jabatan=="administrasi") {
											?>
												<td><a href="edit.php?id_transaksi=<?php echo $id_transaksi;?>"><i class="fa fa-pencil"></i> Edit</a></td>
												<td><a href="index.php?id_transaksi=<?php echo $id_transaksi;?>"><i class="fa fa-trash-o"></i> Hapus</a></td>
											<?php
										}
									?>
								</tr>	
								<?php
								}
								$stmt->close();				
								?>
							</tbody>
						</table>
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