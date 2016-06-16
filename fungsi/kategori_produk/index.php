<?php
	
	/*========================= TAMBAH DATA PRODUK ========================*/
	function TambahDataKategoriProduk()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$nama_kategori = $_POST['nama_kategori'];

		//insert ke tabel user
		$sql = "INSERT INTO kategori_produk (nama_kategori) VALUES(?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('s', $nama_kategori);
		if($stmt->execute()){
			$stmt->insert_id;
			$_SESSION['status_operasi_kp'] = "berhasil_menyimpan";
		}else{
			$_SESSION['status_operasi_kp'] = "gagal_menyimpan";
		}
		$stmt->close();
	}

	/*========================= EDIT DATA PRODUK ========================*/
	function EditDataKategoriProduk()
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
			$_SESSION['status_operasi_kp'] = "berhasil_memperbaharui";
		}else{
			$_SESSION['status_operasi_kp'] = "gagal_memperbaharui";
		}
		$stmt->close();
	}

	/*========================= HAPUS DATA PRODUK ========================*/
	function HapusDataKategoriProduk()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_kategori_produk = $_GET['id_kategori'];

		$status_hapus = "0";

		//hapus dari tabel kategori produk
		$sql = "UPDATE kategori_produk SET status_hapus = ? WHERE id_kategori = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('si', $status_hapus, $id_kategori_produk);
		if($stmt->execute()){
			$_SESSION['status_operasi_kp'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_kp'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>
