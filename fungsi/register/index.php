<?php
/*========================= FORM REGISTER PEGAWAI ========================*/
function FormRegister() {
	?>
		<form action="" method="post">
			<div class="box-body">
	      		<div class="row">
					<div class="col-md-6">
			      		<div class="form-group has-feedback">
			        		<input type="text" name="id_pegawai" class="form-control" placeholder="ID Pegawai">
			        		<span class="glyphicon glyphicon-exclamation-sign form-control-feedback"></span>
			      		</div>
			      	</div>
					<div class="col-md-6">
			      		<div class="form-group has-feedback">
			        		<input type="text" name="username" class="form-control" placeholder="Username">
			        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			      		</div>
			      	</div>
					<div class="col-md-6">
			      		<div class="form-group has-feedback">
			        		<input type="text" name="nama" class="form-control" placeholder="Nama Pegawai">
			        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
			      		</div>
			      	</div>
					<div class="col-md-6">
			      		<div class="form-group has-feedback">
			        		<input type="password" name="password" class="form-control" placeholder="Password">
			        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			      		</div>
			      	</div>
					<div class="col-md-6">
  						<div class="form-group">
    						<select name="jabatan" class="form-control select2" style="width: 100%;">
      							<option value="direktur" selected="selected">Direktur</option>
			                  	<option value="pemasaran">Pemasaran</option>
			                  	<option value="inventori">Inventori</option>
			                  	<option value="administrasi">Administrasi</option>
			                </select>
  						</div>
					</div>
	        		<div class="col-md-2">
	          			<button type="submit" name="buat_akun" class="btn btn-primary btn-block btn-flat">Buat Akun</button>
	        		</div>
	      		</div>
	      	</div>
    	</form>
		<?php
}

/*========================= FORM REGISTER PENGUNJUNG ========================*/
function FormRegisterPengunjung() {
	?>
		<!DOCTYPE html>
			<html>
			<head>
				<title>Register</title>
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
   				<script type="text/javascript" src="../../bootstrap/bootstrap/js/jquery1.min.js"></script>
				<!-- SweetAlert -->
				<link rel="stylesheet" type="text/css" href="../../bootstrap/dist/sweet/sweetalert.css">
			  	<script type="text/javascript">
					function BerhasilMenyimpan(){
						swal({
							title: "",
							text: "Anda telah terdaftar menjadi member.",
							timer: 1500,
							type: "success",
							showConfirmButton: false });
					}

					function GagalMenyimpan(){
						swal({
							title: "",
							text: "Proses pendaftaran member tidak berhasil.",
							timer: 1500,
							type: "error",
							showConfirmButton: false });
					}
				</script>
			</head>
			<body class="hold-transition login-page">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="">
				 	<div class="login-logo">
				    	<a href="">Register <b>Lumpur</b>Mas</a>
				  	</div>
				  	<!-- /.login-logo -->
				  	<div class="login-box-body">
				  		<fieldset>
				  			<legend>Informasi Member</legend>
				  		</fieldset>
				    	<form action="" method="post">
							<div class="col-md-12">
								<label>Nama Lengkap</label>
					      		<div class="form-group has-feedback">
					        		<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required="" autofocus="">
					        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
					      		</div>
					      	</div>
					      	<div class="col-md-12">
								<label>No Telepon</label>
					      		<div class="form-group has-feedback">
					        		<input type="phone" name="no_telp" class="form-control" placeholder="No Telp" required="">
					        		<span class="glyphicon glyphicon-phone form-control-feedback"></span>
					      		</div>
					      	</div>
					      	<div class="col-md-12">
								<label>Email</label>
					      		<div class="form-group has-feedback">
					        		<input type="email" name="email" class="form-control" placeholder="contoh:abc@gmail.com">
					        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					      		</div>
					      	</div>
					      	<div class="col-md-12">
								<label>Alamat</label>
					      		<div class="form-group has-feedback">
					        		<textarea name="alamat" class="form-control" rows="5"></textarea>
					      		</div>
					      	</div>
							<div class="col-md-12">
								<label>Username</label>
					      		<div class="form-group has-feedback">
					        		<input type="text" name="username" class="form-control" placeholder="Username" required="">
					        		<span class="glyphicon glyphicon-info form-control-feedback"></span>
					      		</div>
					      	</div>
							<div class="col-md-12">
								<label>Password</label>
					      		<div class="form-group has-feedback">
					        		<input type="password" name="password" class="form-control" placeholder="Password" required="">
					        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					      		</div>
					      	</div>
					      	<div class="col-md-12">
			          			<button type="submit" name="buat_akun" class="btn btn-primary btn-block btn-flat">Buat Akun</button>
			        		</div>
						</form>
				    <div class="social-auth-links text-right">
				    	<a href="../../" class="text-center">Kembali</a>
					</div>
				</div>
			</div>

			<!-- jQuery 2.2.0 -->
			<script src="../../bootstrap/plugins/jQuery/jQuery-2.2.0.min.js"></script>
			<!-- Bootstrap 3.3.6 -->
			<script src="../../bootstrap/bootstrap/js/bootstrap.min.js"></script>
			<!-- iCheck -->
			<script src="../../bootstrap/plugins/iCheck/icheck.min.js"></script>
			<!-- jQuery -->
		    <script src="../../bootstrap/bootstrap/js/jquery.js"></script>

		    <!-- Contact Form JavaScript -->
		    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
		    <script src="../../bootstrap/bootstrap/js/jqBootstrapValidation.js"></script>
		    <script src="../../bootstrap/bootstrap/js/contact_me.js"></script>
		    <!-- SweetAlert -->
		    <script src="../../bootstrap/dist/sweet/sweetalert.min.js"></script>

		</body>
		</html>
		<?php
}

function TambahMember() {
	include '../../koneksi/koneksi.php';

	//inisialisasi
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_telp = $_POST['no_telp'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);

	//insert ke tabel pelanggan
	$sql = "INSERT INTO pelanggan (nama, alamat, no_telp, email) VALUES(?, ?, ?, ?)";
	$stmt = $db->prepare($sql);
	$stmt->bind_param('ssss', $nama, $alamat, $no_telp, $email);
	if ($stmt->execute()) {
		$stmt->insert_id;
		$_SESSION['status_operasi_tm'] = "berhasil_menyimpan";
	} else {
		$_SESSION['status_operasi_tm'] = "gagal_menyimpan";
	}
	$stmt->close();

	//insert ke tabel user
	$sql = "INSERT INTO user (username, password) VALUES(?, ?)";
	$stmt = $db->prepare($sql);
	$stmt->bind_param('ss', $username, $password);
	if ($stmt->execute()) {
		$stmt->insert_id;
		$_SESSION['status_operasi_tm'] = "berhasil_menyimpan";
	} else {
		$_SESSION['status_operasi_tm'] = "gagal_menyimpan";
	}
	$stmt->close();

	//select id user
	$sql = "SELECT id_user FROM user ORDER BY id_user DESC LIMIT 1";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_user);
	while ($stmt->fetch()) {
		$id_user;
	}
	$stmt->close();

	//select id pelanggan
	$sql = "SELECT id_pelanggan FROM pelanggan ORDER BY id_pelanggan DESC LIMIT 1";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_pelanggan);
	while ($stmt->fetch()) {
		$id_pelanggan;
	}
	$stmt->close();

	//update ke tabel pelanggan
	$sql = "UPDATE pelanggan SET id_user = ? WHERE id_pelanggan = ?";
	$stmt = $db->prepare($sql);
	$stmt->bind_param('ii', $id_user, $id_pelanggan);
	if ($stmt->execute()) {
		$_SESSION['status_operasi_tm'] = "berhasil_menyimpan";
	} else {
		$_SESSION['status_operasi_tm'] = "gagal_menyimpan";
	}
	$stmt->close();
}
?>