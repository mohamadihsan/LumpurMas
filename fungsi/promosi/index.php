<?php
	
	/*========================= TAMBAH DATA PRODUK ========================*/
	function TambahDataPromosi()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$gambar_promosi = $_FILES["gambar_promosi"]["name"]; 
		$file_basename = substr($gambar_promosi, 0, strripos($gambar_promosi, '.')); // get ekstensi 
		$file_ext = substr($gambar_promosi, strripos($gambar_promosi, '.')); // get nama file 

		$folder = "../gambar/promosi/";

		if ($gambar_promosi==null) {
			$gambar_promosi = "default.jpg";
		}

		if ($_FILES["gambar_promosi"]["error"] > 0){
		 	// jika file gambar tidak diupload
		 	//insert ke tabel produk
 			$url = $gambar_promosi;
			$sql = "INSERT INTO promosi (url, id_pegawai) VALUES(?, ?)";
			$stmt = $db->prepare($sql);
			$stmt->bind_param('si', $url, $id_pegawai);
			if($stmt->execute()){
				$stmt->insert_id;
				$_SESSION['status_operasi_promosi'] = "berhasil_menyimpan";
			}else{
				$_SESSION['status_operasi_promosi'] = "gagal_menyimpan";
			}
			$stmt->close();
		}else{
			// Rename file
		 	$newfilename = md5($file_basename) . $file_ext;

		 	// cek apakah file sudah ada 
		 	if (file_exists("$folder".$newfilename)){
		 		$_SESSION['status_operasi_promosi'] = "gagal_memperbaharui";
		 	}else{  
		 		//simpan gambar ke folder lalu save path/url ke database
		 		if(move_uploaded_file($_FILES["gambar_promosi"]["tmp_name"],"$folder".$gambar_promosi)){
		 			$url = $gambar_promosi;
		 			//insert ke tabel produk
					$sql = "INSERT INTO promosi (url, id_pegawai) VALUES(?, ?)";
					$stmt = $db->prepare($sql);
					$stmt->bind_param('si', $url, $id_pegawai);
					if($stmt->execute()){
						$stmt->insert_id;
						$_SESSION['status_operasi_promosi'] = "berhasil_menyimpan";
					}else{
						$_SESSION['status_operasi_promosi'] = "gagal_menyimpan";
					}
					$stmt->close();
		 		}
		 	}
		}
	}

	/*========================= EDIT DATA PRODUK ========================*/
	function EditDataPromosi()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_promosi = $_POST['id_promosi'];
		$status = $_POST['status'];
		
		//update ke tabel promosi
		$sql = "UPDATE promosi SET status = ?, id_pegawai = ? WHERE id_promosi = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('sii', $status, $id_pegawai, $id_promosi);
		if($stmt->execute()){
			$_SESSION['status_operasi_promosi'] = "berhasil_memperbaharui";
		}else{
			$_SESSION['status_operasi_promosi'] = "gagal_memperbaharui";
		}
		$stmt->close();
	}

	/*========================= HAPUS DATA PRODUK ========================*/
	function HapusDataPromosi()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_promosi = $_GET['id_promosi'];

		//hapus dari tabel produk
		$sql = "DELETE FROM promosi WHERE id_promosi = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id_promosi);
		if($stmt->execute()){
			$_SESSION['status_operasi_promosi'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_promosi'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>
