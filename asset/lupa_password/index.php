<?php
include '../../fungsi/lupa_password/index.php';

FormLupaPassword();

if (isset($_POST['kirim'])) {
	KirimPassword();
	if ($_SESSION['kirim_password'] == "berhasil_dikirim") {
		?>
		<body onload="BerhasilMengirimPassword()"></body><?php
	} else {
			?>
			<body onload="GagalMengirimPassword()"></body>
			<?php
	}
}
?>