<?php
	
	/*========================= TAMBAH DATA PRODUK ========================*/
	function TambahDataTransaksi()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$status_garansi = $_POST['status_garansi'];
		$produk = $_POST['produk'];
		$jumlah_beli = $_POST['jumlah_beli'];
		$member = $_POST['member'];
		$username = $_POST['username'];
		$nama_garansi = $_POST['nama_garansi'];
		$telp_garansi = $_POST['telp_garansi'];
		$tanggal = $_POST['tanggal'];
		if ($tanggal=="") {
			$tanggal = date("Y-m-d");
		}

		if ($member=="M") {
			$nama_pelanggan_trx = $username;

			$sql = "SELECT id_user FROM pelanggan WHERE nama='$username'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->bind_result($id_user);
			$stmt->fetch();
			$stmt->close();

			$sql = "SELECT no_telp, id_pelanggan FROM pelanggan WHERE id_user='$id_user'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->bind_result($telp, $id_pel);
			$stmt->fetch();
			$stmt->close();
		}else{
			$nama_pelanggan_trx = $nama_garansi;
			$telp = $telp_garansi;
		}

		//insert ke transaksi
		$sql = "INSERT INTO transaksi (nama_garansi, telp_garansi, id_pelanggan, tgl_transaksi) VALUES(?, ?, ?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ssis', $nama_pelanggan_trx, $telp, $id_pel, $tanggal);
		if($stmt->execute()){
			$stmt->insert_id;
			$_SESSION['status_operasi_tr'] = "berhasil_menyimpan";
		}else{
			$_SESSION['status_operasi_tr'] = "gagal_menyimpan";
		}
		$stmt->close();

		$sql = "SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id_transaksi);
		$stmt->fetch();
		$stmt->close();

		for($i=0;$i<count($produk);$i++){
			//insert ke detail transaksi
			$sql = "INSERT INTO detail_transaksi (id_transaksi, id_produk, jumlah_beli) VALUES(?, ?, ?)";
			$stmt = $db->prepare($sql);
			$stmt->bind_param('isi', $id_transaksi, $produk[$i], $jumlah_beli[$i]);
			if($stmt->execute()){
				$_SESSION['status_operasi_tr'] = "berhasil_menyimpan";
			}else{
				$_SESSION['status_operasi_tr'] = "gagal_menyimpan";
			}
			$stmt->close();
		}

		//select id trx
		$sql = "SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->execute();

		$stmt->bind_result($id_transaksi);
		$stmt->fetch();
		$stmt->close();

		//select data produk
		$sql = "SELECT detail_transaksi.id_transaksi, detail_transaksi.id_produk, jumlah_beli, nama_garansi, telp_garansi, nama_produk, kode_produk, harga FROM detail_transaksi, transaksi, produk WHERE detail_transaksi.id_transaksi='$id_transaksi' AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND detail_transaksi.id_produk=produk.id_produk";
		$stmt = $db->prepare($sql);
		$stmt->execute();

		$stmt->bind_result($id_transaksi, $id_produk, $jumlah_beli, $nama_garansi, $telp_garansi, $nama_produk, $kode_produk, $harga);

		$total_bayar = 0;

		while ($stmt->fetch()) {
			$total_bayar = $total_bayar + ($harga*$jumlah_beli);
		}

		$_SESSION['total_bayar'] = $total_bayar;
		$stmt->close();	

		//Update Transaksi
		$status_transaksi = "L";

		$sql = "UPDATE transaksi SET status_transaksi = ?, total_bayar = ? WHERE id_transaksi = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('sii', $status_transaksi, $total_bayar, $id_transaksi);
		if($stmt->execute()){
			$_SESSION['status_operasi_tr'] = "berhasil_update_total_bayar";
		}else{
			$_SESSION['status_operasi_tr'] = "gagal_update_total_bayar";
		}
		$stmt->close(); 

		//update poin pelanggan
		/*if ($member=="M") {

			$sql = "SELECT id_pelanggan, poin FROM pelanggan WHERE nama='$username'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->bind_result($id_pelanggan, $poin_pelanggan);
			$stmt->fetch();
			$stmt->close();

			//perhitungan poin
			$temp_poin = $total_bayar / 100000;
			$poin = $poin_pelanggan + $temp_poin;

			$sql = "UPDATE pelanggan SET poin = ? WHERE id_pelanggan = ?";
			$stmt = $db->prepare($sql);
			$stmt->bind_param('ii', $poin, $id_pelanggan);
			$stmt->execute();
			$stmt->close();
		}*/
	}

	/*========================= EDIT DATA PRODUK ========================*/
	function EditDataTransaksi()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$nama_kategori = $_POST['nama_kategori'];
		$id_kategori_produk = $_POST['id_kategori'];

		//update ke tabel pegawai
		$sql = "UPDATE kategori_produk SET nama_kategori = ? WHERE id_kategori = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('si', $nama_kategori, $id_kategori_produk);
		if($stmt->execute()){
			$_SESSION['status_operasi_tr'] = "berhasil_memperbaharui";
		}else{
			$_SESSION['status_operasi_tr'] = "gagal_memperbaharui";
		}
		$stmt->close();
	}

	/*========================= HAPUS DATA PRODUK ========================*/
	function HapusDataTransaksi()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_transaksi = $_GET['id_transaksi'];

		//get total bayar pada transaksi ini
		/*$sql = "SELECT total_bayar, id_pelanggan FROM transaksi WHERE id_transaksi = $id_transaksi";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($total_bayar, $id_pelanggan);
		$stmt->fetch();
		$stmt->close();

		if ($id_pelanggan!=null) {

			//get poin pelanggan
			$sql = "SELECT poin FROM pelanggan WHERE id_pelanggan = $id_pelanggan";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->bind_result($poin);
			$stmt->fetch();
			$stmt->close();

			$minus_poin = ($total_bayar/100000) - $poin;

			//update poin pelanggan
			$sql = "UPDATE pelanggan SET poin = ? WHERE id_pelanggan = ?";
			$stmt = $db->prepare($sql);
			$stmt->bind_param('ii', $minus_poin, $id_pelanggan);
			$stmt->execute();
			$stmt->close();
		}*/

		//hapus dari tabel transaksi
		$sql = "DELETE FROM transaksi WHERE id_transaksi = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id_transaksi);
		if($stmt->execute()){
			$_SESSION['status_operasi_tr'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_tr'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>
