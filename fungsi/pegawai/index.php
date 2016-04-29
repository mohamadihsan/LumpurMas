<?php
	
	/*========================= TAMBAH DATA PEGAWAI ========================*/
	function TambahDataPegawai()
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
		$sql = "INSERT INTO user (username, password) VALUES(?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ss', $username, $password);
		if($stmt->execute()){
			$stmt->insert_id;
		}else{
			die('Error : ('. $db->errno .')'. $db->error);
		}
		$stmt->close();

		//get id user 
		$sql = "SELECT id_user FROM user WHERE username='$username'";
		$stmt = $db->prepare($sql);
		$stmt->execute();

		$stmt->bind_result($id_user);
		while($stmt->fetch()){
			$id_user;
		}

		//insert ke tabel pegawai
		$sql = "INSERT INTO pegawai (id_pegawai, nama, jabatan, id_user) VALUES(?, ?, ?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('sssi', $id_pegawai, $nama, $jabatan, $id_user);
		if($stmt->execute()){
			echo "Data berhasil disimpan";
		}else{
			die('Error : ('. $db->errno .')'. $db->error);
		}
		$stmt->close();
	}

	/*========================= EDIT DATA PEGAWAI ========================*/
	function EditDataPegawai()
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

	/*========================= HAPUS DATA PEGAWAI ========================*/
	function HapusDataPegawai()
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

	/*========================= EDIT DATA USER ========================*/
	function EditDataUser()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);
		$id_user = $_GET['id_user'];

		//update ke tabel pegawai
		$sql = "UPDATE user SET username = ?, password = ? WHERE id_user = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ssi', $username, $password, $id_user);
		if($stmt->execute()){
			echo "Data berhasil diperbaharui";
		}else{
			die('Error : ('. $db->errno .')'. $db->error);
		}
		$stmt->close();
	}

	/*========================= SELECT DATA PEGAWAI ========================*/
	function SelectDataPegawai()
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
		$sql = "SELECT id_pegawai, nama, jabatan FROM pegawai WHERE jabatan!='$_SESSION['jabatan']";
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
