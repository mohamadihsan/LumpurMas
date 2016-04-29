<?php
	session_start();
	include 'koneksi/koneksi.php';
	$id_user = $_SESSION['id_user'];
	$user_check = $_SESSION['username'];

	//get data pelanggan
	$sql = "SELECT * FROM pelanggan WHERE id_user='$id_user'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$id_pelanggan = $_SESSION['id_pelanggan'] = $row['id_pelanggan'];
	$nama_pelanggan = $row['nama'];
	$alamat = $row['alamat'];
?>