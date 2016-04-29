<?php
	error_reporting(E_ALL & ~E_NOTICE);
	include '../../fungsi/pegawai/index.php';
	include '../../koneksi/koneksi.php';

	//get id_user
	$id_user = $_GET['id_user'];
	
	if (isset($_POST['simpan'])) {
		//panggil fungsi HapusPegawai
		EditDataUser();
	}
	
	//select data pegawai
	$sql = "SELECT username,password FROM user 
			WHERE id_user='$id_user'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($username,$password);
	$stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
</head>
<body>
	<form method="post" action="">
		<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username" required autofocus>
		<input type="password" name="password" placeholder="Password" required>
		<input type="submit" name="simpan" value="Simpan">
	</form>
</body>
</html>