<?php
	
	/*========================= TAMBAH DATA PELANGGAN ========================*/
	function TambahDataPelanggan()
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

	/*========================= EDIT DATA PELANGGAN ========================*/
	function EditDataPelanggan()
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

	/*========================= HAPUS DATA PELANGGAN ========================*/
	function HapusDataPelanggan()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_kategori_produk = $_GET['id_kategori'];

		//hapus dari tabel user
		$sql = "DELETE FROM kategori_produk WHERE id_kategori = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id_kategori_produk);
		if($stmt->execute()){
			$_SESSION['status_operasi_kp'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_kp'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>
