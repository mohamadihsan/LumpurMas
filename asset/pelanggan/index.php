<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../../koneksi/koneksi.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/pelanggan/index.php';
	include '../login/check_login_pegawai.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
		//jika manager yang masuk
		if (!empty($user_check) AND $jabatan == "manager" OR $jabatan=="direktur" OR $jabatan=="administrasi") {

				if (isset($_POST['simpan'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					TambahDataKategoriProduk();
					if ($_SESSION['status_operasi_kp']=="berhasil_menyimpan") {
						?> <body onload="BerhasilMenyimpan()"></body><?php
					}else if ($_SESSION['status_operasi_kp']=="gagal_menyimpan") {
						?> <body onload="GagalMenyimpan()"></body><?php
					}
				}

				if (isset($_POST['perbaharui'])) {
					//jika tombol submit ditekan maka excute fungsi ini
					EditDataKategoriProduk();
					if ($_SESSION['status_operasi_kp']=="berhasil_memperbaharui") {
						?> <body onload="BerhasilMemperbaharui()"></body><?php
					}else if ($_SESSION['status_operasi_kp']=="gagal_memperbaharui") {
						?> <body onload="GagalMemperbaharui()"></body><?php
					}
				}

				if (!empty($_GET['id_kategori'])) {
					HapusDataKategoriProduk();
					if ($_SESSION['status_operasi_kp']=="berhasil_menghapus") {
						?> <body onload="BerhasilMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../kategori_produk/"><?php
					}else if ($_SESSION['status_operasi_kp']=="gagal_menghapus") {
						?> <body onload="GagalMenghapus()"></body><meta http-equiv="refresh" content="1.5;url=../kategori_produk/"><?php
					}
				}
			?>

			<title>Data Pelanggan</title>

			<!-- Content Header (Page header) -->
			<section class="content-header">
			  	<h1>
			    	Data Pelanggan Terdaftar
			    	<small></small>
			  	</h1>
			  	<ol class="breadcrumb">
			    	<li class="active"><i class="fa fa-list-alt"></i> Pelanggan</li>
			  	</ol>
			</section>

			<!-- Main content -->
		    <section class="content">
		      	<div class="row">
		        	<div class="col-xs-12">
		          		<div class="box">
		            		<div class="box-header with-border">
		              			<h3 class="box-title">Detail</h3>
		            		</div>
				            <!-- /.box-header -->
				            <div class="box-body">
								<table id="example1" class="table table-bordered table-striped">
					                <thead>
					                <tr>
					                  	<th>Nama</th>
										<th>No Telp</th>
										<th>Email</th>
										<th>Poin</th>
										<th>Alamat</th>
					                </tr>
					                </thead>
					                <tbody>
					                <?php
					                	//Tampilkan Data Pelanggan 
										$sql = "SELECT nama, alamat, no_telp, email, poin, id_user FROM pelanggan";							
										$stmt = $db->prepare($sql);
										$stmt->execute();

										$stmt->bind_result($nama, $alamat, $no_telp, $email, $poin, $id_user);

										while ($stmt->fetch()) {
										?>
											<tr>
												<td><?php echo $nama; ?></td>
												<td><?php echo $no_telp; ?></td>
												<td><?php echo $email; ?></td>
												<td><?php echo $poin; ?></td>
												<td><?php echo $alamat; ?></td>
											</tr>
											<?php
										}
										$stmt->close();
									?>
					                </tbody>
					             </table>
							</div>
							<!-- /.box-body -->
					  	</div>
					  	<!-- /.box -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</section>
			<!-- /.content -->
	  		<?php
	  		
	  		CloseSidebar();

		}else{
			//alihkan url jika bukan manager
			?><meta http-equiv="refresh" content="0;url=../login/"><?php
		}
	?>