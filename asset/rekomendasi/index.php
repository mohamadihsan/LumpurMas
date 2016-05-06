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


	<center>
		<?php
			//jika pegawai pemasaran yang masuk
			if (!empty($user_check) AND $jabatan == "pemasaran" OR $jabatan == "manager" OR $jabatan == "direktur") {
				?>
				<!-- Main content -->
				<section class="content">
					<!-- SELECT2 EXAMPLE -->
					<div class="box box-primary">
					<?php
					$sql="SELECT DISTINCT transaksi.id_pelanggan, pelanggan.nama, pelanggan.no_telp  FROM transaksi, pelanggan 
					WHERE transaksi.id_pelanggan=pelanggan.id_pelanggan";
					// $stmt=$db->prepare($sql);
					// $stmt->execute();

					// $stmt->bind_result($id_pelanggan);
					$stmt = mysqli_query($db, $sql);
					$i=0;
					while ($data = mysqli_fetch_array($stmt)) {
						$id_pelanggan = $data[0];
						$nama_pelanggan = $data[1];
						$no_telp = $data[2];
						$sql1="SELECT kategori_produk.id_kategori, SUM(detail_transaksi.jumlah_pembelian) as Pembelian, kategori_produk.nama_kategori 
						FROM transaksi, detail_transaksi, kategori_produk, produk 
						WHERE transaksi.id_transaksi=detail_transaksi.id_transaksi AND kategori_produk.id_kategori=produk.id_kategori 
						AND produk.id_produk=detail_transaksi.id_produk  
						AND id_pelanggan='$id_pelanggan' GROUP BY detail_transaksi.id_produk";
						$stmt1=mysqli_query($db, $sql1);

						$tampung = 0;
						while ($data1 = mysqli_fetch_array($stmt1)) {
							$similarity = 1/(1+$data1[1]);
							$nilai_rekomendasi = $similarity*$data1[1];
							if ($tampung < $nilai_rekomendasi) {
								$tampung = $nilai_rekomendasi;
								$kate[] = $data1[0];
								$nama_kate = $data1[2];
							}
						}	

							$sql2 = "SELECT detail_transaksi.id_produk, SUM(jumlah_pembelian), produk.nama_produk FROM `detail_transaksi`, produk 
							WHERE produk.id_produk=detail_transaksi.id_produk AND produk.id_kategori='$kate[$i]'
							GROUP BY id_produk";
							$stmt2 = mysqli_query($db, $sql2);
							$tampung1 = 0;
							while ($data2 = mysqli_fetch_array($stmt2)) {
								$pem = $data2[1];
								if ($tampung1<$pem) {
									$tampung1 = $pem;
									$nama_produk = $data2[2];
								}
							}
							?>
								<table style="width:90%" class="table table-stripped">
									<tr>
										<th>No Telepon</th>
										<th>Nama</th>
										<th>Produk Rekomendasi</th>
										<th>Isi SMS</th>
										<th></th>
									</tr>
									<tr>
										<td><?php echo $no_telp; ?></td>
										<td><?php echo $nama_pelanggan?></td>
										<td><?php echo $nama_kate ." - ". $nama_produk ?></td>
										<td></td>
										<td><button class="btn btn-primary">Kirim</button></td>
									</tr>
								</table>
							<?php
							$i++;
					}
				?>
				</div>
				</section>	
			<?php
			}else{
				//alihkan url jika bukan pegawai pemasaran
				?><meta http-equiv="refresh" content="0;url=../login/"><?php
			}

			CloseSidebar();
		?>