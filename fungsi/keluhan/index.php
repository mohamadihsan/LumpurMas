<?php
	
	/*========================= TAMBAH DATA KELUHAN SARAN ========================*/
	function BalasKeluhan()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$pesan_respon = $_POST['pesan_respon'];
		$id_keluhan = $_GET['id_keluhan'];
		$status = "SR";

		//update ke tabel keluhan
		$sql = "UPDATE keluhan SET pesan_respon = ?, status = ? WHERE id_keluhan = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ssi', $pesan_respon, $status, $id_keluhan);
		if($stmt->execute()){
			$_SESSION['status_operasi_ks'] = "berhasil_dibalas";
		}else{
			$_SESSION['status_operasi_ks'] = "gagal_dibalas";
		}
		$stmt->close();
	}

	/*========================= HAPUS DATA KELUHAN SARAN ========================*/
	function HapusDataKeluhan()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_keluhan = $_GET['id_keluhan'];

		//hapus dari tabel produk
		$sql = "DELETE FROM keluhan WHERE id_keluhan = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id_keluhan);
		if($stmt->execute()){
			$_SESSION['status_operasi_ks'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_ks'] = "gagal_menghapus";
		}
		$stmt->close();
	}

	/*========================= JAWAB KELUHAN SARAN ========================*/
	function JawabKeluhanSaran()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$kode_produk = $_POST['kode_produk'];
		$nama_produk = $_POST['nama_produk'];
		$id_kategori = $_POST['kategori'];
		$harga = $_POST['harga'];

		//insert ke tabel user
		$sql = "INSERT INTO produk (kode_produk, nama_produk, harga, id_kategori) VALUES(?, ?, ?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ssii', $kode_produk, $nama_produk, $harga, $id_kategori);
		if($stmt->execute()){
			$stmt->insert_id;
			$_SESSION['status_operasi_ks'] = "berhasil_dijawab";
		}else{
			$_SESSION['status_operasi_ks'] = "gagal_dijawab";
		}
		$stmt->close();
	}
?>
