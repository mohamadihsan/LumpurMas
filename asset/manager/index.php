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
	<title>Manager</title>
</head>
<body>
	<center>
		<h1>Halaman Utama Manager</h1>
		<?php
			//jika manager yang masuk
			if (!empty($user_check) AND $jabatan == "manager") {
				echo "Selamat datang," .$nama_pegawai;
				?>
					<a href="../logout/"><button>Logout</button></a>
				<?php
			}else{
				//alihkan url jika bukan manager
				header('location:../login/');
			}
		?>
	</center>
</body>
</html>