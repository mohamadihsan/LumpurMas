<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

	include '../../fungsi/login/index.php';
	include '../../fungsi/pegawai/index.php';
	include '../../fungsi/register/index.php';
	include '../../koneksi/koneksi.php';

	//deklarasi
	$data_user = "admin";
	$data_pass = "admin";
	//jika ada action dari form Register
	if (isset($_POST['buat_akun'])) {
		//jika tombol submit ditekan maka excute fungsi ini
		TambahDataPegawai();

		//deklarasi
		$_POST['username'] = $data_user;
		$_POST['password'] = $data_pass;
	}

	if (!empty($_POST['username']) AND !empty($_POST['password'])) {
		if ($_POST['username'] == $data_user AND $_POST['password']== $data_pass) {
			?>
				<!DOCTYPE html>
				<html>
				<head>
					<title>Admin Sistem</title>
				</head>
				<body>
					<center>
						<h1>Halaman Admin Sistem</h1>
						<?php

							//data manager belum ada maka tampilkan form 
							FormRegister(); 
							
							//Tampilkan Data Manager 
							$sql = "SELECT id_pegawai, nama, jabatan, username, user.id_user FROM pegawai, user WHERE pegawai.id_user=user.id_user AND pegawai.jabatan='manager'";							
							$stmt = $db->prepare($sql);
							$stmt->execute();

							$stmt->bind_result($id_pegawai, $nama, $jabatan, $username, $id_user);
						?>	
						<hr width="80%" />
						<table border="1" width="60%">
							<tr>
								<th>No</th>
								<th>ID</th>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Username</th>
								<th colspan="3"></th>
							</tr>
						<?php
							$no = 1;
							while ($stmt->fetch()) {
							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $id_pegawai; ?></td>
								<td><?php echo $nama; ?></td>
								<td><?php echo $jabatan; ?></td>
								<td><?php echo $username; ?></td>
								<td><a href="edit_pegawai.php?id_user=<?php echo $id_user;?>">Edit Pegawai</a></td>
								<td><a href="edit_user.php?id_user=<?php echo $id_user;?>">Edit User</a></td>
								<td><a href="hapus_pegawai.php?id_user=<?php echo $id_user;?>">Hapus</a></td>
							</tr>
							<?php
							}				
						?>
						</table>
					</center>
				</body>
				</html>
			<?php
		}else{
		//Fungsi dari folder fungsi/login/
			FormLogin();
		}
	}else{
		//Fungsi dari folder fungsi/login/
		FormLogin();
	}
?>