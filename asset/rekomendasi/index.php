<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../login/check_login_pegawai.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/rekomendasi/index.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	?>

	<title>Rekomendasi</title>

	<section class="content-header">
      	<h1>
        	Rekomendasi
        	<small></small>
      	</h1>
      	<ol class="breadcrumb">
        	<li><a href=""><i class="fa fa-trophy"></i> Rekomendasi</a></li>
      	</ol>
	</section>

	<?php
		//jika pegawai pemasaran yang masuk
		if (!empty($user_check) AND $jabatan == "pemasaran" OR $jabatan == "manager" OR $jabatan == "direktur") {
			?>
			<!-- Main content -->
		    <section class="content">
		      	<div class="row">
		        	<div class="col-xs-12">
						<?php

						//Tampilkan Data Produk 
						$sql_nama = "SELECT DISTINCT nama_garansi FROM transaksi";
						$result_nama = mysqli_query($db, $sql_nama);
						$i=0;
						while ($row_nama = mysqli_fetch_array($result_nama, MYSQLI_ASSOC)) {
							$nama[$i] = $row_nama['nama_garansi'];
							$i++;
						}

						?>
						<div class="box">
		            		<div class="box-header with-border">
		              			<h3 class="box-title"></h3>
		            		</div>
				            <!-- /.box-header -->
				            <div class="box-body">
								
										<?php
										$x=0;
										$z=0;
										while ($x < $i) {
											?>
												<table id="example1" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th>Nama Pelanggan</th>
															<th>Nama Kategori</th>
															<th>Nilai Sim</th>
															<?php if ($jabatan=="pemasaran") {
																?>
																	<th></th>
																<?php
															} ?>
														</tr>
													</thead>
													<tbody>	
											<?php
											$y=0;
											while ($y < $i) {
												
												$sql = "SELECT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$x]."' UNION SELECT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y++]."'";							
												$result = mysqli_query($db, $sql);
												
												$sim[$z] = mysqli_num_rows($result);
												$nilai_sim[$z] = 1/$sim[$z];
												while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
												$nama_kategori = $row['nama_kategori'];
												?>
												<tr>
													<td><?php echo $nama[$x]; ?></td>
													<td><?php echo $nama_kategori; ?></td>
													<td><?php echo $nilai_sim[$z]; ?></td>
													<?php if ($jabatan=="pemasaran") {
														?>
															<td align="center"><a href=""><button class="btn-primary"> Kirim Pesan</button></a></td>
														<?php
													} ?>
												</tr>	
												<?php
											}	
											$x++;
												$z++;
											}	
										}
										
										?>
									</tbody>
								</table>
							</div>	
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->	
			</section>
		<?php
		}else{
			//alihkan url jika bukan pegawai pemasaran
			?><meta http-equiv="refresh" content="0;url=../login/"><?php
		}

		CloseSidebar();
	?>