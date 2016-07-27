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
		$nama = $_POST['nama'];
		$no_telp = $_POST['no_telp'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$username = $_POST['username'];
		$pass = $_POST['password'];
		$password = md5($pass);
		$id_pelanggan = $_POST['id_pelanggan'];
		$id_user = $_POST['id_user'];

		//update ke tabel pelanggan
		$sql = "UPDATE pelanggan SET nama = ?, alamat = ?, no_telp = ?, email = ? WHERE id_pelanggan = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ssssi', $nama, $alamat, $no_telp, $email, $id_pelanggan);
		if($stmt->execute()){
			$_SESSION['status_operasi_kp'] = "berhasil_memperbaharui";
		}else{
			$_SESSION['status_operasi_kp'] = "gagal_memperbaharui";
		}
		$stmt->close();

		//update ke tabel user
		$sql = "UPDATE user SET username = ?, password = ? WHERE id_user = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ssi', $username, $password, $id_user);
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
		$id_pelanggan = $_GET['id_pelanggan'];

		//hapus dari tabel user
		$sql = "DELETE FROM pelanggan WHERE id_pelanggan = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id_pelanggan);
		if($stmt->execute()){
			$_SESSION['status_operasi_p'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_p'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>
