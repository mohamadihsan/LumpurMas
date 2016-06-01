<?php
	
	/*========================= TAMBAH DATA KELUHAN SARAN ========================*/
	function TambahDataKritikSaran()
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
			$_SESSION['status_operasi_ks'] = "berhasil_menyimpan";
		}else{
			$_SESSION['status_operasi_ks'] = "gagal_menyimpan";
		}
		$stmt->close();
	}

	/*========================= EDIT DATA KELUHAN SARAN ========================*/
	function EditDataKritikSaran()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$kode_produk = $_POST['kode_produk'];
		$nama_produk = $_POST['nama_produk'];
		$id_kategori = $_POST['kategori'];
		$harga = $_POST['harga'];
		$id_produk = $_POST['id_produk'];

		//update ke tabel produk
		$sql = "UPDATE produk SET nama_produk = ?, harga = ?, id_kategori = ?, kode_produk = ? WHERE id_produk = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('siisi', $nama_produk, $harga, $id_kategori, $kode_produk, $id_produk);
		if($stmt->execute()){
			$_SESSION['status_operasi_ks'] = "berhasil_memperbaharui";
		}else{
			$_SESSION['status_operasi_ks'] = "gagal_memperbaharui";
		}
		$stmt->close();
	}

	/*========================= HAPUS DATA KELUHAN SARAN ========================*/
	function HapusDataKritikSaran()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_produk = $_GET['id_produk'];

		//hapus dari tabel produk
		$sql = "DELETE FROM produk WHERE id_produk = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id_produk);
		if($stmt->execute()){
			$_SESSION['status_operasi_ks'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_ks'] = "gagal_menghapus";
		}
		$stmt->close();
	}

	/*========================= JAWAB KELUHAN SARAN ========================*/
	function JawabKritikSaran()
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
