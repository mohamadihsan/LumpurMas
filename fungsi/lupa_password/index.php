<?php
/*========================= FORM LUPA PASSWORD ========================*/
function FormLupaPassword() {
	?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>Lupa Password</title>
			  	<meta charset="utf-8">
			  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
			  	<!-- Tell the browser to be responsive to screen width -->
			  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  	<!-- Bootstrap 3.3.6 -->
			  	<link rel="stylesheet" href="../../bootstrap/bootstrap/css/bootstrap.min.css">
			  	<!-- Font Awesome -->
			  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
			  	<!-- Ionicons -->
			  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
			  	<!-- Theme style -->
			  	<link rel="stylesheet" href="../../bootstrap/dist/css/AdminLTE.min.css">
			  	<!-- iCheck -->
			  	<link rel="stylesheet" href="../../bootstrap/plugins/iCheck/square/blue.css">
			    <!-- SweetAlert -->
			    <link rel="stylesheet" type="text/css" href="../../bootstrap/dist/sweet/sweetalert.css">
			</head>
			<body class="hold-transition login-page">
			<div class="login-box">
			 	<div class="login-logo">
			    	<a href=""><b>Lumpur</b>Mas</a>
			  	</div>
			  	<div class="login-box-body">
			    	<form action="" method="post">
			    		<div class="form-group has-feedback">
				      		<label>Username</label>
				        	<input type="text" name="username" class="form-control" placeholder="Masukkan Username Anda-" required autofocus>
				        	<span class="glyphicon glyphicon-user form-control-feedback"></span>
				      	</div>
				      	<div class="form-group has-feedback">
				      		<label>Masukkan No Telepon Anda</label>
				        	<input type="phone" name="no_telp" class="form-control" placeholder="08xxxxxxxxxx-" required autofocus>
				        	<span class="glyphicon glyphicon-phone form-control-feedback"></span>
				      	</div>
				      	<div class="col-md-12">
				      		<div class="form-group has-feedback">
			        			<button type="submit" name="kirim" class="btn btn-primary btn-block btn-flat">Kirim</button>
			    			</div>
			    		</div>
			    		<div class="col-md-12">
				      		<div class="form-group has-feedback" align="right">
			        			<a href="../login/">Kembali</a>
			    			</div>
			    		</div>
					</form>
				</div>
			</div>

			<!-- jQuery 2.2.0 -->
			<script src="../../bootstrap/plugins/jQuery/jQuery-2.2.0.min.js"></script>
			<!-- Bootstrap 3.3.6 -->
			<script src="../../bootstrap/bootstrap/js/bootstrap.min.js"></script>
			<!-- iCheck -->
			<script src="../../bootstrap/plugins/iCheck/icheck.min.js"></script>
			<!-- SweetAlert -->
			<script src="../../bootstrap/dist/sweet/sweetalert.min.js"></script>
			<script>
				function BerhasilMengirimPassword(){
	            swal({
	            title: "Berhasil",
	            text: "Password baru telah di kirim ke no telepon anda.",
	            timer: 2000,
	            showConfirmButton: false });
	        }

	        function GagalMengirimPassword(){
	            swal({
	            title: "Ooops",
	            text: "Sepertinya terjadi kesalahan. Silahkan coba kembali!",
	            timer: 2000,
	            showConfirmButton: false });
	        }
			</script>
		</body>
		</html>
		<?php
}

function KirimPassword() {

	function randomPass($length = 5, $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890') {

		if ($length > 0) {
			$len_chars = (strlen($chars) - 1);
			$the_chars = $chars{rand(0, $len_chars)};
			for ($i = 1; $i < $length; $i = strlen($the_chars)) {
				$r = $chars{rand(0, $len_chars)};
				if ($r != $the_chars{$i - 1}) {
					$the_chars .= $r;
				}
			}
		}
		return $the_chars;
	}

	$no_telp = $_POST['no_telp'];
	$pesan = "[LUMPUR MAS] - Silahkan login dengan menggunakan password : ";
	$password = randomPass();
	$save_password = md5($password);
	$pesan_kirim = $pesan.$password;

	//Kirim sms dengan smsgateway

	$userkey="hyb10z"; // userkey lihat di zenziva

    $passkey="0000"; // set passkey di zenziva

    $url = "https://reguler.zenziva.net/apps/smsapi.php";$curlHandle = curl_init();

    curl_setopt($curlHandle, CURLOPT_URL, $url);

    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$no_telp.'&pesan='.urlencode($pesan_kirim));

    curl_setopt($curlHandle, CURLOPT_HEADER, 0);

    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);

    curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);

    curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);

    curl_setopt($curlHandle, CURLOPT_POST, 1);

    $results = curl_exec($curlHandle);

    curl_close($curlHandle);

	$_SESSION['kirim_password'] = "berhasil_dikirim";

	//update password
	include '../../koneksi/koneksi.php';

	//inisialisasi
	$username = $_POST['username'];

	//update ke tabel pegawai
	$sql = "UPDATE user SET password = ? WHERE username = ?";
	$stmt = $db->prepare($sql);
	$stmt->bind_param('ss', $save_password, $username);
	if($stmt->execute()){
		$_SESSION['status_operasi_tr'] = "berhasil_dikirim";
	}else{
		$_SESSION['status_operasi_tr'] = "gagal_dikirim";
	}
	$stmt->close();
}
?>
