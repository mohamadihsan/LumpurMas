<?php
	/*========================= FORM LOGIN ========================*/
	function FormLogin()
	{
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>Login</title>
			</head>
			<body>
				<form method="post" action="">
					<input type="text" name="username" placeholder="Username" required autofocus>
					<input type="password" name="password" placeholder="Password" required>
					<input type="submit" name="login" value="Login">
				</form>
			</body>
			</html>
		<?php
	}

	/*========================= FORM REGISTER ========================*/
	function FormRegister()
	{
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>Register</title>
			</head>
			<body>
				<form method="post" action="">
					<input type="text" name="id_pegawai" placeholder="ID Pegawai" required autofocus>
					<input type="text" name="nama" placeholder="Nama Pegawai" required>
					<select name="jabatan">
						<option value="manager">Manager</option>
					</select>
					<input type="text" name="username" placeholder="Username" required>
					<input type="password" name="password" placeholder="Password" required>
					<input type="submit" name="buat_akun" value="Buat Akun">
				</form>
			</body>
			</html>
		<?php
	}

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
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);

		//update ke tabel pegawai
		$sql = "UPDATE pegawai SET id_pegawai = ?, nama = ?, jabatan = ? WHERE id = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('iss', $id_pegawai, $nama, $jabatan);
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
		$id = $_POST['id'];

		//hapus dari tabel user
		$sql = "DELETE FROM user WHERE id = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id);
		if($stmt->execute()){
			echo "Data berhasil dihapus";
		}else{
			die('Error : ('. $db->errno .')'. $db->error);
		}
		$stmt->close();
	}
?>
