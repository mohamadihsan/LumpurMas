<?php
	error_reporting(E_ALL & ~E_NOTICE);
	include '../login/check_login_pegawai.php';
	include '../../fungsi/rekomendasi/index.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pemasaran</title>
</head>
<body>
	<center>
		<h1>Halaman Utama Pemasaran</h1>
		<?php
			//jika pegawai pemasaran yang masuk
			if (!empty($user_check) AND $jabatan == "pemasaran") {
				echo "Selamat datang," .$nama_pegawai;
				?>
					<a href="../logout/"><button>Logout</button></a>
				<?php

				//Tampilkan rekomendasi
				$sql = "SELECT pelanggan.nama, pelanggan.no_telp, kategori_produk.nama_kategori, SUM(detail_transaksi.jumlah_pembelian) as Pembelian 
				FROM transaksi, detail_transaksi, pelanggan, produk, kategori_produk 
				WHERE detail_transaksi.id_transaksi=transaksi.id_transaksi AND pelanggan.id_pelanggan=transaksi.id_pelanggan AND 
				produk.id_produk=detail_transaksi.id_produk AND kategori_produk.id_kategori=produk.id_kategori 
				GROUP BY produk.id_kategori, transaksi.id_pelanggan ORDER BY pelanggan.nama";							
				$stmt = $db->prepare($sql);
				$stmt->execute();

				$stmt->bind_result($nama, $no_telp, $kategori, $pembelian);
				?>	
				<hr width="80%" />
				<table border="1" width="60%">
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>No Telp</th>
						<th>Kategori</th>
						<th>Pembelian</th>
						<th>Similarity Product</th>
						<th>Nilai Rekomendasi</th>
					</tr>
				<?php
					$no = 1;
					$tampung = 0;
					while ($stmt->fetch()) {
						//perhitungan nilai rekomendasi
						$similarity = 1/(1+$pembelian);
						$nilai_rekomendasi = $similarity*$pembelian;


						if ($tampung < $nilai_rekomendasi) {
							$tampung = $nilai_rekomendasi;
							echo "Selamat" . $tampung;
							echo $kategori;
						}
						echo "<br> ".$tampung;
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $nama; ?></td>
						<td><?php echo $no_telp; ?></td>
						<td><?php echo $kategori; ?></td>
						<td><?php echo $pembelian; ?></td>
						<td><?php echo $similarity; ?></td>
						<td><?php echo $nilai_rekomendasi; ?></td>
					</tr>
					<?php
					}				
				?>
				</table>
			<?php
			}else{
				//alihkan url jika bukan pegawai pemasaran
				header('location:../login/');
			}
		?>
	</center>
</body>
</html>