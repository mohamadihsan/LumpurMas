<?php
	error_reporting(E_ALL & ~E_NOTICE);
	include 'asset/login/check_login_pelanggan.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Utama</title>
</head>
<body>
	<center>
		<h1>Halaman Utama Web Katalog</h1>
		<?php
			if (!empty($user_check) AND !empty($id_pelanggan)) {
				echo "Selamat datang," .$nama_pelanggan;
				?>
					<a href="asset/logout/"><button>Logout</button></a>
				<?php
			}else{
				?>
					<a href="asset/login/"><button>Login</button></a>
				<?php
			}
		?>
	</center>
</body>
</html>