<?php
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/login/index.php';
	include '../../fungsi/sidebar/index.php';

	if (isset($_POST['login'])) {

		//Inisialisasi
		$username = $_POST['username'];
		$password = $_POST['password'];

		//Protect dari SQL Injection
		$username = stripcslashes($username);
		$password = stripcslashes($password);
		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);
		$password = md5($password);

		//Cek username dan Password
		$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		//Jika data user ada dalam database
		if (mysqli_num_rows($result) == 1 ) {
			//buatkan session
			$id = $_SESSION['id_user'] = $row['id_user'];
			$_SESSION['username'] = $row['username'];

			//cek apakah user adalah pegawai atau pelanggan
			//jika id user ada di table pelanggan
			$sql = "SELECT id_pelanggan, nama, id_user FROM pelanggan WHERE id_user='$id'";
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if (mysqli_num_rows($result) == 1) {
				$nama_pelanggan = $_SESSION['nama'] = $row['nama'];
				$id_pelanggan = $_SESSION['id_pelanggan'] = $row['id_pelanggan'];
				?><meta http-equiv="refresh" content="0;url=../../"> <?php
			}else{
				//jika id user ada di table pegawai
				$sql = "SELECT id_user FROM pegawai WHERE id_user='$id'";
				$result = mysqli_query($db, $sql);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				if (mysqli_num_rows($result) == 1) {
					$sql = "SELECT jabatan FROM pegawai WHERE id_user='$id'";
					$result = mysqli_query($db, $sql);
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

					$jabatan = $_SESSION['jabatan'] = $row['jabatan'];

					if ($jabatan == "direktur") {
						header('location:../direktur/');
					}else if ($jabatan == "manager") {
						header('location:../manager/');
					}else if ($jabatan == "administrasi") {
						header('location:../administrasi/');
					}else if ($jabatan == "pemasaran") {
						header('location:../pemasaran/');
					}else if ($jabatan == "inventori") {
						header('location:../inventori/');
					}			
				}
			}
		}else{
			
			?> <body onload="GagalLogin()"></body> <?php
		}
	}else

	//Jika user sudah login
	if (!empty($_SESSION['id_pelanggan'])) {
		?><meta http-equiv="refresh" content="0;url=../../"> <?php
	}else if (!empty($_SESSION['id_pegawai'])) {
		$jabatan = $_SESSION['jabatan'];

		if ($jabatan == "direktur") {
			?><meta http-equiv="refresh" content="0;url=../direktur/"> <?php
		}else if ($jabatan == "manager") {
			?><meta http-equiv="refresh" content="0;url=../manager/"> <?php
		}else if ($jabatan == "administrasi") {
			?><meta http-equiv="refresh" content="0;url=../administrasi/"> <?php
		}else if ($jabatan == "pemasaran") {
			?><meta http-equiv="refresh" content="0;url=../pemasaran/"> <?php
		}			
	}else{
		//Fungsi dari folder fungsi/fungsi.php
		FormLogin();
	}
?>