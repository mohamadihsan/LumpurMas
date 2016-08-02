<?php
	session_start();
	error_reporting(0);
	include '../../koneksi/koneksi.php';

	// include autoloader
	require_once '../../dompdf/autoload.inc.php';

	// reference the Dompdf namespace
	use Dompdf\Dompdf;

	// instantiate and use the dompdf class
	$dompdf = new Dompdf();

	//get id_kategori
	$id_pemesanan = $_GET['id_pemesanan'];

	//select data pemesan
	$sql = "SELECT id_pemesanan, tgl_pemesanan, status_pemesanan, total_bayar, tgl_pengambilan, pelanggan.nama FROM pemesanan, pelanggan WHERE pemesanan.id_pelanggan=pelanggan.id_pelanggan AND pemesanan.id_pemesanan=$id_pemesanan";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_pemesanan, $tgl_pemesanan, $status_pemesanan, $total_bayar, $tgl_pengambilan, $nama);
	$stmt->fetch();
	$stmt->close();
	
	ob_start();?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Detail Pemesanan</title>
	 	<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  	<!-- Tell the browser to be responsive to screen width -->
	  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  	<!-- Font Awesome -->
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	  	<!-- Ionicons -->
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	</head>

	<body>
		<div class="wrapper">
			<!-- Main content -->
			<section class="content">
			  	<div class="row">
			    	<div class="col-xs-12">
			    		<div class="box box-primary">
			        		<div class="box-header with-border">
			          			<h3 class="box-title">Bukti Pemesanan</h3>
			          			<hr width="100%">
			        		</div>
				            <!-- /.box-header -->
				            <div class="box-body">

					        	<label><pre>ID Pemesanan<?php echo "      : " . $id_pemesanan; ?></pre></label>
					        	<label><pre>Nama Pelanggan   <?php echo " : " . strtoupper($nama); ?></pre></label>
					        	<label><pre>Tanggal Pemesanan<?php echo " : " . Tanggal($tgl_pemesanan); ?></pre></label>
					        	<?php if ($status_pemesanan=="BL") {
		        					$status = "Belum Dibayar";
		        				}else if ($status_pemesanan=="SL") {
		        					$status = "Sudah Dibayar";
		        				}else{
		        					$status = "Sedang dalam Pengecekkan";
		        				}   ?>
					        	<label><pre>Status<?php echo "            : " . $status; ?></pre></label>
					        	<?php
									//format rupiah
									$jumlah_desimal ="2";
									$pemisah_desimal =",";
									$pemisah_ribuan =".";
								?>
					        	<font style="align:right;"><h3><label><pre>Total Bayar <?php echo "   : Rp." .number_format($total_bayar, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);?>      </pre></label></h3></font>

						        <table width="100%" border="1=">
									<tr>
										<th>Kode Produk</th>
										<th>Nama Produk</th>
										<th>Harga</th>
										<th>Jumlah Beli</th>
									</tr>
										<?php

									//select data produk
									$sql = "SELECT detail_pemesanan.id_pemesanan, detail_pemesanan.id_produk, jumlah_beli, nama_produk, kode_produk, harga FROM detail_pemesanan, pemesanan, produk WHERE detail_pemesanan.id_pemesanan=$id_pemesanan AND pemesanan.id_pemesanan=detail_pemesanan.id_pemesanan AND detail_pemesanan.id_produk=produk.id_produk";
									$stmt = $db->prepare($sql);
									$stmt->execute();

									$stmt->bind_result($id_pemesanan, $id_produk, $jumlah_beli, $nama_produk, $kode_produk, $harga);
									while ($stmt->fetch()) {
									?>
									<tr>
										<td><?php echo strtoupper($kode_produk); ?></td>
										<td><?php echo strtoupper($nama_produk); ?></td>
										<td align="right">
											<?php
												//format rupiah
												$jumlah_desimal ="2";
												$pemisah_desimal =",";
												$pemisah_ribuan =".";

												echo "Rp." .number_format($harga, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
											?>
										</td>
										<td align="right"><?php echo $jumlah_beli; ?></td>
									</tr>
									<?php
									}
									$stmt->close();
									?>
								</table>
						    </div>
						</div>
						<!-- /.box -->
					</div>
					<!-- .col -->
				</div>
				<!-- .row -->
			</section>

			<footer class="footer text-center">
		    	<pre><strong>Copyright &copy; <?php echo date("Y");?> <a href="#">  Lumpur Mas</a>.</strong></pre>
		  	</footer>
		</div>

  		<div class="control-sidebar-bg"></div>
	</body>
	</html>	

	<?php
	$html = ob_get_clean();
	$dompdf->loadHtml($html);
	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	//$dompdf->stream();

	// Output the generated PDF (1 = download and 0 = preview)
	$dompdf->stream("Bukti Pemesanan",array("Attachment"=>0));

	function Tanggal($tanggal) {
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$tahun = substr($tanggal, 0, 4);
		$bulan = substr($tanggal, 5, 2);
		$tgl = substr($tanggal, 8, 2);

		$hasil = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
		return ($hasil);
	}

	function Rupiah($rupiah) {
		//format rupiah
		$jumlah_desimal = "2";
		$pemisah_desimal = ",";
		$pemisah_ribuan = ".";

		$hasil = number_format($rupiah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		return ($hasil);
	}			
				
?>
