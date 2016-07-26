<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../fungsi/sidebar/index.php';
	include '../../koneksi/koneksi.php';

	//get id_kategori
	$id_pemesanan = $_GET['id_pemesanan'];

	//select data pemesan
	$sql = "SELECT id_pemesanan, tgl_pemesanan, status_pemesanan, total_bayar, tgl_pengambilan, pelanggan.nama FROM pemesanan, pelanggan WHERE pemesanan.id_pelanggan=pelanggan.id_pelanggan AND pemesanan.id_pemesanan=$id_pemesanan";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_pemesanan, $tgl_pemesanan, $status_pemesanan, $total_bayar, $tgl_pengambilan, $nama);
	$stmt->fetch();
	$stmt->close();

	Sidebar();

	?>

	<title>Detail Pemesanan</title>

	<section class="content-header">
	  	<h1>

	    	<small></small>
	  	</h1>
	  	<ol class="breadcrumb">
	    	<li><a href="../pemesanan/"><i class="fa fa-list-alt"></i> Pemesanan</a></li>
	    	<li class="active">Detail Pemesanan</li>
	  	</ol>
	</section>

	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<div class="box box-primary">
            		<div class="box-header with-border">
              			<h3 class="box-title">Detail Pemesanan</h3>
              			<div class="box-tools pull-right">
				         </div>
            		</div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<div class="col-md-6"></div>
			        	<div class="col-md-6">
			        		<fieldset>
			        			<div class="col-md-5">
			        				<label>ID Pemesanan</label>
			        			</div>
			        			<div class="col-md-7">
			        				<?php echo " : " . $id_pemesanan; ?>
			        			</div>
			        			<div class="col-md-12"></div>
			        			<div class="col-md-5">
			        				<label>Nama Pelanggan</label>
			        			</div>
			        			<div class="col-md-7">
			        				<?php echo " : " . strtoupper($nama); ?>
			        			</div>

			        			<div class="col-md-12"></div>
			        			<div class="col-md-5">
			        				<label>Tanggal Pemesanan</label>
			        			</div>
			        			<div class="col-md-7">
			        				<?php echo " : " . Tanggal($tgl_pemesanan); ?>
			        			</div>

			        			<div class="col-md-12"></div>
			        			<div class="col-md-5">
			        				<label>Status</label>
			        			</div>
			        			<div class="col-md-7">
			        				<?php if ($status_pemesanan=="BL") {
			        					echo " : Belum Dibayar";
			        				}  ?>
			        			</div>

			        			<div class="col-md-12"></div>
			        			<div class="col-md-5">
			        				<h3><label>Total Bayar</label></h3>
			        			</div>
			        			<div class="col-md-7">
			        				<?php
										//format rupiah
										$jumlah_desimal ="2";
										$pemisah_desimal =",";
										$pemisah_ribuan =".";

										echo "<h3>: Rp." .number_format($total_bayar, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</h3>";
									?>
			        			</div>
			        		</fieldset>
			        	</div>
			        	<div class="col-md-12"></div>
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
								$sql = "SELECT detail_pemesanan.id_pemesanan, detail_pemesanan.id_produk, jumlah_beli, nama_produk, kode_produk, harga FROM detail_pemesanan, pemesanan, produk WHERE detail_pemesanan.id_pemesanan='$id_pemesanan' AND pemesanan.id_pemesanan=detail_pemesanan.id_pemesanan AND detail_pemesanan.id_produk=produk.id_produk";
								$stmt = $db->prepare($sql);
								$stmt->execute();

								$stmt->bind_result($id_pemesanan, $id_produk, $jumlah_beli, $nama_produk, $kode_produk, $harga);
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
