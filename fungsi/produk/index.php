<?php
	
	/*========================= TAMBAH DATA PRODUK ========================*/
	function TambahDataProduk()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$kode_produk = $_POST['kode_produk'];
		$nama_produk = $_POST['nama_produk'];
		$id_kategori = $_POST['kategori'];
		$harga = $_POST['harga'];
		$status_produk = $_POST['status_produk'];
		$diskon = $_POST['diskon'];
		$gambar_produk = $_FILES["gambar_produk"]["name"]; 
		$file_basename = substr($gambar_produk, 0, strripos($gambar_produk, '.')); // get ekstensi 
		$file_ext = substr($gambar_produk, strripos($gambar_produk, '.')); // get nama file 

		$folder = "../gambar/produk/";

		if ($gambar_produk==null) {
			$gambar_produk = "default.jpg";
		}

		if ($_FILES["gambar_produk"]["error"] > 0){
		 	// jika file gambar tidak diupload
		 	//insert ke tabel produk
 			$url = $gambar_produk;
			$sql = "INSERT INTO produk (kode_produk, nama_produk, harga, status_produk, diskon, id_kategori, url) VALUES(?, ?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($sql);
			$stmt->bind_param('ssisiis', $kode_produk, $nama_produk, $harga, $status_produk, $diskon, $id_kategori, $url);
			if($stmt->execute()){
				$stmt->insert_id;
				$_SESSION['status_operasi_p'] = "berhasil_menyimpan";
			}else{
				$_SESSION['status_operasi_p'] = "gagal_menyimpan";
			}
			$stmt->close();
		}else{
			// Rename file
		 	$newfilename = md5($file_basename) . $file_ext;

		 	// cek apakah file sudah ada 
		 	if (file_exists("$folder".$newfilename)){
		 		$_SESSION['status_operasi_p'] = "gagal_memperbaharui";
		 	}else{  
		 		//simpan gambar ke folder lalu save path/url ke database
		 		if(move_uploaded_file($_FILES["gambar_produk"]["tmp_name"],"$folder".$gambar_produk)){
		 			$url = $gambar_produk;
		 			//insert ke tabel produk
					$sql = "INSERT INTO produk (kode_produk, nama_produk, harga, status_produk, diskon, id_kategori, url) VALUES(?, ?, ?, ?, ?, ?, ?)";
					$stmt = $db->prepare($sql);
					$stmt->bind_param('ssisiis', $kode_produk, $nama_produk, $harga, $status_produk, $diskon, $id_kategori, $url);
					if($stmt->execute()){
						$stmt->insert_id;
						$_SESSION['status_operasi_p'] = "berhasil_menyimpan";
					}else{
						$_SESSION['status_operasi_p'] = "gagal_menyimpan";
					}
					$stmt->close();
		 		}
		 	}
		}
	}

	/*========================= EDIT DATA PRODUK ========================*/
	function EditDataProduk()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$kode_produk = $_POST['kode_produk'];
		$nama_produk = $_POST['nama_produk'];
		$id_kategori = $_POST['kategori'];
		$harga = $_POST['harga'];
		$status_produk = $_POST['status_produk'];
		$diskon = $_POST['diskon'];
		$id_produk = $_POST['id_produk'];
		$gambar_produk = $_FILES["gambar_produk"]["name"]; 
		$file_basename = substr($gambar_produk, 0, strripos($gambar_produk, '.')); // get ekstensi 
		$file_ext = substr($gambar_produk, strripos($gambar_produk, '.')); // get nama file

		$folder = "../gambar/produk/";

		if ($_FILES["gambar_produk"]["error"] > 0){
		 	// jika file gambar tidak diupload
		 	//insert ke tabel produk
 			$url = $gambar_produk;
			$sql = "INSERT INTO produk (kode_produk, nama_produk, harga, status_produk, diskon, id_kategori, url) VALUES(?, ?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($sql);
			$stmt->bind_param('ssisiis', $kode_produk, $nama_produk, $harga, $status_produk, $diskon, $id_kategori, $url);
			if($stmt->execute()){
				$_SESSION['status_operasi_p'] = "berhasil_menyimpan";
			}else{
				$_SESSION['status_operasi_p'] = "gagal_menyimpan";
			}
			$stmt->close();
		}else{
		 	// Rename file
		 	$newfilename = md5($file_basename) . $file_ext;

		 	// cek apakah file sudah ada 
		 	if (file_exists("$folder".$newfilename)){
		 		$_SESSION['status_operasi_p'] = "gagal_memperbaharui";
		 	}else{  
		 		//simpan gambar ke folder lalu save path/url ke database
		 		if(move_uploaded_file($_FILES["gambar_produk"]["tmp_name"],"$folder".$gambar_produk)){
		 			$url = $gambar_produk;
		 			//update ke tabel produk
					$sql = "UPDATE produk SET nama_produk = ?, harga = ?, status_produk = ?, diskon = ?, id_kategori = ?, kode_produk = ?, url = ? WHERE id_produk = ?";
					$stmt = $db->prepare($sql);
					$stmt->bind_param('sisiissi', $nama_produk, $harga, $status_produk, $diskon, $id_kategori, $kode_produk, $url, $id_produk);
					if($stmt->execute()){
						$_SESSION['status_operasi_p'] = "berhasil_memperbaharui";
					}else{
						$_SESSION['status_operasi_p'] = "gagal_memperbaharui";
					}
					$stmt->close();
		 		}else{
					//update ke tabel produk
		 			$url = "default.jpg";
					$sql = "UPDATE produk SET nama_produk = ?, harga = ?, status_produk = ?, diskon = ?, id_kategori = ?, kode_produk = ?, url = ? WHERE id_produk = ?";
					$stmt = $db->prepare($sql);
					$stmt->bind_param('sisiissi', $nama_produk, $harga, $status_produk, $diskon, $id_kategori, $kode_produk, $url, $id_produk);
					if($stmt->execute()){
						$_SESSION['status_operasi_p'] = "berhasil_memperbaharui";
					}else{
						$_SESSION['status_operasi_p'] = "gagal_memperbaharui";
					}
					$stmt->close();
		 		}
		 	}
		}
	}

	/*========================= HAPUS DATA PRODUK ========================*/
	function HapusDataProduk()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_produk = $_GET['id_produk'];

		//hapus dari tabel produk
		$sql = "DELETE FROM produk WHERE id_produk = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id_produk);
		if($stmt->execute()){
			$_SESSION['status_operasi_p'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_p'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>
