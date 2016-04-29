<?php
	error_reporting(E_ALL & ~E_NOTICE);
	include '../../fungsi/pegawai/index.php';
	include '../../koneksi/koneksi.php';

	//get id_user
	$id_user = $_GET['id_user'];
	
	if (isset($_POST['simpan'])) {
		//panggil fungsi EditPegawai
		EditDataPegawai();
	}
	
	//select data pegawai
	$sql = "SELECT id_pegawai,nama,jabatan FROM pegawai WHERE id_user='$id_user'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_pegawai,$nama,$jabatan);
	$stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Pegawai</title>
</head>
<body>
	<form method="post" action="">
		<input type="text" name="id_pegawai" value="<?php echo $id_pegawai; ?>" placeholder="ID Pegawai" required autofocus>
		<input type="text" name="nama" value="<?php echo $nama; ?>" placeholder="Nama Pegawai" required>
		<select name="jabatan">
			<option value="manager">Manager</option>
		</select>
		<input type="submit" name="simpan" value="Simpan">
	</form>
</body>
</html>