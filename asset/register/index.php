<?php
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/register/index.php';
	include '../../fungsi/sidebar/index.php';

	$title = "Buat Akun";

	Sidebar();

	if (!empty($_SESSION['username']) AND !empty($_SESSION['jabatan'])) {
		FormRegister();
	}else{
		FormRegisterPengunjung();
	}

	CloseSidebar();

?>