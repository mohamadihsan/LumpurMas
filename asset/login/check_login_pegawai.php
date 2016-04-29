<?php
	session_start();
	include '../../koneksi/koneksi.php';
	$id_user = $_SESSION['id_user'];
	$user_check = $_SESSION['username'];

	//get data pegawai
	$sql = "SELECT * FROM pegawai WHERE id_user='$id_user'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$id_pegawai = $_SESSION['id_pegawai'] = $row['id_pegawai'];
	$nama_pegawai = $_SESSION['nama_pegawai'] = $row['nama'];
	$jabatan = $_SESSION['jabatan'] = $row['jabatan'];
?>