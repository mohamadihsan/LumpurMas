<?php
	error_reporting(E_ALL & ~E_NOTICE);
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Administrasi</title>
</head>
<body>
	<center>
		<h1>Halaman Utama Administrasi</h1>
		<?php
			//jika pegawai administrasi yang masuk
			if (!empty($user_check) AND $jabatan == "admnistrasi") {
				echo "Selamat datang," .$nama_pegawai;
				?>
					<a href="../logout/"><button>Logout</button></a>
				<?php
			}else{
				//alihkan url jika bukan pegawai administrasi
				header('location:../login/');
			}
		?>
	</center>
</body>
</html>