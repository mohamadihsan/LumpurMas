<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
include '../../koneksi/koneksi.php';
include '../../fungsi/register/index.php';
include '../../fungsi/sidebar/index.php';

FormRegisterPengunjung();

if (isset($_POST['buat_akun'])) {
	//jika tombol submit ditekan maka excute fungsi ini
	TambahMember();
	if ($_SESSION['status_operasi_tm'] == "berhasil_menyimpan") {
		?> <body onload="BerhasilMenyimpan()"></body><meta http-equiv="refresh" content="1;url=../login/"><?php
	} else if ($_SESSION['status_operasi_tm'] == "gagal_menyimpan") {
			?> <body onload="GagalMenyimpan()"></body><?php
	}else if ($_SESSION['status_operasi_tm'] = "pesan_error_pelanggan") {
		?>
		<script>
			window.onload = function() {
				alert("Password harus minimal 5 karakter");
				window.history.back();
			};
		</script>
		<?php
	}
}
?>