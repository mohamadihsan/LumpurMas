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
			echo "Data berhasil disimpan";
		}else{
			die('Error : ('. $db->errno .')'. $db->error);
		}
		$stmt->close();
	}

	/*========================= EDIT DATA PRODUK ========================*/
	function EditDataKategoriProduk()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_pegawai = $_POST['id_pegawai'];
		$nama = $_POST['nama'];
		$jabatan = $_POST['jabatan'];
		$id = $_GET['id_user'];

		//update ke tabel pegawai
		$sql = "UPDATE pegawai SET id_pegawai = ?, nama = ?, jabatan = ? WHERE id_user = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('issi', $id_pegawai, $nama, $jabatan, $id);
		if($stmt->execute()){
			echo "Data berhasil diperbaharui";
		}else{
			die('Error : ('. $db->errno .')'. $db->error);
		}
		$stmt->close();
	}

	/*========================= HAPUS DATA PRODUK ========================*/
	function HapusDataKategoriProduk()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id = $_GET['id_user'];

		//hapus dari tabel user
		$sql = "DELETE FROM user WHERE id_user = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id);
		if($stmt->execute()){
			echo "Data berhasil dihapus";
		}else{
			die('Error : ('. $db->errno .')'. $db->error);
		}
		$stmt->close();
	}

	
	/*========================= SELECT DATA PRODUK ========================*/
	function SelectDataKategoriProduk()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_pegawai = $_POST['id_pegawai'];
		$nama = $_POST['nama'];
		$jabatan = $_POST['jabatan'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);

		//insert ke tabel user
		$jab = $_SESSION['jabatan'];
		$sql = "SELECT id_pegawai, nama, jabatan FROM pegawai WHERE jabatan!=$jab";
		$stmt = $db->prepare($sql);
		$stmt->execute();

		$stmt->bind_result($id_pegawai, $nama, $jabatan);
		while($stmt->fetch()){
			$id_pegawai;
			$nama;
			$jabatan;
		}
		$stmt->close();
	}
?>
